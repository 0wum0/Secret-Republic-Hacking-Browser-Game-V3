<?php
/**
 * Front Controller – Secret Republic V3
 *
 * SR_ROOT points to the project / webroot directory.
 * All paths are resolved from SR_ROOT – no ../ hacks.
 */
define('SR_ROOT', __DIR__);

require_once SR_ROOT . '/includes/vendor/autoload.php';

if(!ob_start("ob_gzhandler")) ob_start();
error_reporting(E_ALL ^E_NOTICE);
ini_set( 'display_errors','0');
ini_set("pcre.jit", "0");

date_default_timezone_set("Europe/London");

define('cardinalSystem', true);

require_once SR_ROOT . '/includes/i18n.php';
require_once SR_ROOT . '/includes/class/cardinal.php';

$smarty = new \Smarty\Smarty;
$smarty->setTemplateDir(SR_ROOT . '/templates');
$smarty->setCompileDir(SR_ROOT . '/includes/templates_c');
$smarty->setCacheDir(SR_ROOT . '/includes/cache');
// Smarty config dir - use project-level configs directory if it exists, otherwise use a temp path
$configDir = SR_ROOT . '/includes/configs';
if (!is_dir($configDir)) {
    @mkdir($configDir, 0775, true);
}
$smarty->setConfigDir($configDir);

// Smarty 5: PHP-Funktionen muessen explizit als Modifier registriert werden
$_smartyPhpModifiers = [
    'ceil', 'floor', 'round', 'abs', 'intval', 'floatval',
    'count', 'in_array', 'is_array', 'array_keys', 'array_values',
    'strtoupper', 'strtolower', 'ucfirst', 'substr', 'str_pad', 'strlen', 'trim',
    'nl2br', 'urlencode', 'urldecode',
    'htmlentities', 'htmlspecialchars', 'strip_tags',
    'json_encode', 'json_decode',
    'print_r', 'var_export',
    'date', 'time', 'strtotime',
    'md5', 'sha1', 'base64_encode', 'base64_decode',
];
foreach ($_smartyPhpModifiers as $_mod) {
    $smarty->registerPlugin('modifier', $_mod, $_mod);
}
unset($_smartyPhpModifiers, $_mod);

/**
 * Safe number_format wrapper for PHP 8.x strict types.
 *
 * PHP 8.0+ enforces that number_format() receives a numeric value.
 * Database results and Smarty variables often arrive as strings, which
 * triggers: "Argument #1 ($num) must be of type float, string given".
 * This wrapper casts the first argument to float before formatting.
 */
function safe_number_format($value, int $decimals = 0, string $dec_point = '.', string $thousands_sep = ','): string {
    return number_format((float) $value, $decimals, $dec_point, $thousands_sep);
}
$smarty->registerPlugin('modifier', 'number_format', 'safe_number_format');

// Strip query string from REQUEST_URI – the route MUST only use the path.
$_requestPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?: '/';

$pageURL = array_filter(explode('/', stripslashes($_requestPath)));
$containsPage = array_search('page', $pageURL);
if ($containsPage) {
	unset($pageURL[$containsPage], $pageURL[$containsPage + 1]);
}
define("URL_C", stripslashes($_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . $_requestPath) . '/');

$pageURL =  stripslashes($_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST']) . '/' . implode ("/", $pageURL);

if (isset($_SERVER['PATH_INFO'])) {
  $GETQuery = urldecode($_SERVER['PATH_INFO']);
} else {
  // Use the clean path (without query string) as the route source.
  $GETQuery = urldecode($_requestPath);
}

$GETQuery = array_values(array_filter(explode("/", $GETQuery)));
$include = 'main';
$GET = array();
if ($GETQuery) {
	//$include =  str_replace(array('-','_'), '', $GETQuery[0]);
	$include =  $GETQuery[0];
	unset($GETQuery[0]);
	$GETQuery = array_values($GETQuery);

	for ($i = 0; $i < count($GETQuery); $i += 2)
		$GET[$GETQuery[$i]] = isset( $GETQuery[$i + 1]) ? $GETQuery[$i + 1] : "" ;
}

if (!file_exists(SR_ROOT . '/includes/database_info.php')) {
	$include = 'setup';
} else {
	$cardinal = new Cardinal();
	$url = $cardinal->config['url'];
}

if ($include != "404" && !file_exists(SR_ROOT . '/includes/modules/' . $include . '.php'))
  $include .= is_dir(SR_ROOT . '/includes/modules/' . $include) ? "/" . $include : $include = "main/main";

$GET["currentPage"] = $include;


// Preserve original query string parameters (e.g. ?lang=en) before overwrite
$_ORIG_GET = $_GET;
$_GET = array_merge(array("GET" => $_ORIG_GET), $GET ?? array());


require_once SR_ROOT . '/includes/header.php';

// i18n: handle ?lang= switch + assign language dict to Smarty
handle_lang_switch();
$tVars['L'] = get_lang_dict();
$tVars['current_lang'] = get_lang();

// Smarty 5: Custom app functions als Modifier registrieren (nach header.php geladen)
if (function_exists('date_fashion'))    $smarty->registerPlugin('modifier', 'date_fashion', 'date_fashion');
if (function_exists('profile_link'))    $smarty->registerPlugin('modifier', 'profile_link', 'profile_link');
if (function_exists('romanic_number'))  $smarty->registerPlugin('modifier', 'romanic_number', 'romanic_number');
if (function_exists('sec2hms'))         $smarty->registerPlugin('modifier', 'sec2hms', 'sec2hms');
if (function_exists('ordinal'))         $smarty->registerPlugin('modifier', 'ordinal', 'ordinal');
if (function_exists('ordinalSuffix'))   $smarty->registerPlugin('modifier', 'ordinalSuffix', 'ordinalSuffix');

$include = file_exists(SR_ROOT . '/includes/modules/' . $include . '.php') ? SR_ROOT . '/includes/modules/' . $include . '.php' : '404';
if ($include == "404")
  $cardinal->show_404();
else require( $include );


$tVars["GET"] = $GET;

if (empty($tVars["json"]))
{

  if (!empty($tVars["show_404"]))
  {
    $tVars["audio"] = "eve/404.mp3";

    $tVars["display"] = 'pages/404.tpl';
  }

  if (isset($tVars["display"]))
  {
	/** HANDLE NOTICES DISPLAYED AFTER REDIRECTS **/
	if (!empty($_SESSION["success"]))
		$success[]  = $_SESSION["success"];

	if (!empty($_SESSION["info"]))
		$info[]  = $_SESSION["info"];

	if (!empty($_SESSION["error"]))
		$errors[]  = $_SESSION["error"];

	if (!empty($_SESSION["warning"]))
		$warnings[]  = $_SESSION["warning"];

	if (!empty($_SESSION["voice"]))
		$voice = $_SESSION["voice"];

	if (!empty($_SESSION["messenger"]))
	  $messenger[] = $_SESSION["messenger"];

	if (!empty($_SESSION["myModal"]))
	  array_unshift($myModals, $_SESSION["myModal"]);

	unset($_SESSION['myModal'], $_SESSION["success"], $_SESSION["error"], $_SESSION["warning"], $_SESSION["voice"], $_SESSION['info'], $_SESSION["messenger"]);
    /** //HANDLE NOTICES DISPLAYED AFTER REDIRECTS **/

	$tVars['queries'] = $db->trace;
	errors_success();
    $smarty->assign($tVars);
    $smarty->display($tVars["display"]);
    $smarty->display("footer_home.tpl");
  }
}

  $getContent = ob_get_contents();
  ob_end_clean();
  echo $getContent;
