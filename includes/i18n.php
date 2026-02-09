<?php
/**
 * i18n System for Secret Republic V3
 *
 * Supported languages: 'de' (default), 'en'
 * Priority: DB user.language > Cookie sr_lang > Session > 'de'
 */

define('SR_SUPPORTED_LANGS', ['de', 'en']);
define('SR_DEFAULT_LANG', 'de');

$_SR_LANG_CACHE = null;

/**
 * Get current language code.
 */
function get_lang(): string
{
    global $user, $logged;

    // 1) Logged-in user with DB preference
    if (!empty($logged) && !empty($user['language']) && in_array($user['language'], SR_SUPPORTED_LANGS, true)) {
        return $user['language'];
    }

    // 2) Cookie
    if (!empty($_COOKIE['sr_lang']) && in_array($_COOKIE['sr_lang'], SR_SUPPORTED_LANGS, true)) {
        return $_COOKIE['sr_lang'];
    }

    // 3) Session
    if (!empty($_SESSION['sr_lang']) && in_array($_SESSION['sr_lang'], SR_SUPPORTED_LANGS, true)) {
        return $_SESSION['sr_lang'];
    }

    return SR_DEFAULT_LANG;
}

/**
 * Set language (validates, persists to cookie + session, optionally DB).
 */
function set_lang(string $lang): void
{
    global $db, $user, $logged;

    if (!in_array($lang, SR_SUPPORTED_LANGS, true)) {
        $lang = SR_DEFAULT_LANG;
    }

    // Session
    $_SESSION['sr_lang'] = $lang;

    // Cookie (1 year)
    setcookie('sr_lang', $lang, time() + 365 * 24 * 60 * 60, '/');

    // DB (if logged in)
    if (!empty($logged) && !empty($user['id']) && isset($db)) {
        $db->where('id', $user['id'])->update('users', ['language' => $lang]);
        $user['language'] = $lang;
    }

    // Reset cache
    $GLOBALS['_SR_LANG_CACHE'] = null;
}

/**
 * Load language dictionary (cached per request).
 */
function _sr_load_dict(): array
{
    if ($GLOBALS['_SR_LANG_CACHE'] !== null) {
        return $GLOBALS['_SR_LANG_CACHE'];
    }

    $lang = get_lang();
    $file = dirname(__DIR__) . '/lang/' . $lang . '.php';

    if (file_exists($file)) {
        $GLOBALS['_SR_LANG_CACHE'] = require $file;
    } else {
        // Fallback to default language
        $fallbackFile = dirname(__DIR__) . '/lang/' . SR_DEFAULT_LANG . '.php';
        $GLOBALS['_SR_LANG_CACHE'] = file_exists($fallbackFile) ? require $fallbackFile : [];
    }

    return $GLOBALS['_SR_LANG_CACHE'];
}

/**
 * Translate a key.
 *
 * @param string      $key      Translation key (e.g. 'NAV_DASHBOARD')
 * @param string|null $fallback Fallback if key not found (null = return key)
 * @param array       $vars     Placeholder replacements [':name' => 'value']
 * @return string
 */
function t(string $key, ?string $fallback = null, array $vars = []): string
{
    $dict = _sr_load_dict();
    $text = $dict[$key] ?? ($fallback !== null ? $fallback : $key);

    if (!empty($vars)) {
        foreach ($vars as $placeholder => $value) {
            $text = str_replace($placeholder, (string) $value, $text);
        }
    }

    return $text;
}

/**
 * Get the full dictionary (for Smarty assign).
 */
function get_lang_dict(): array
{
    return _sr_load_dict();
}

/**
 * Handle ?lang= parameter for language switching.
 * Call early in request lifecycle.
 */
function handle_lang_switch(): void
{
    if (isset($_GET['lang']) && in_array($_GET['lang'], SR_SUPPORTED_LANGS, true)) {
        set_lang($_GET['lang']);
    }
}
