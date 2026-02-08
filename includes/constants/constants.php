<?php
/* Nenu Adrian Mircea 2012+ */

	// Helper: read from environment with fallback
	function _env(string $key, $default = '') {
		$val = getenv($key);
		return ($val !== false && $val !== '') ? $val : $default;
	}

	return [
		'url' => $_SERVER['REQUEST_SCHEME'] .  '://' . $_SERVER['HTTP_HOST'] . str_replace('index.php', '', $_SERVER['SCRIPT_NAME']),
		'contact_email' => _env('CONTACT_EMAIL', 'undefined@undefined.com'),
		
		'tutorialSteps' => 20,

		'gridBrowseZone' => 5,
		'gridBrowseNode' => 0.1,

		'gridClustersPerZone' => 1000,

		'newMessageDataPoints' => 10,
		'newMessageReplyDataPoints' => 3,

		'ac_bonus_when_above' => 100,
		'ac_bonus_percent' => 20,
		"trainEvery" => 10*60*60,
		'timeBetweenJobs' => 12 * 60 * 60,

		// reCAPTCHA v2 - set via ENV or leave empty to disable
		'recaptcha_site_key' => _env('RECAPTCHA_SITE_KEY'),
		'recaptcha_secret_key' => _env('RECAPTCHA_SECRET_KEY'),
		
		// SMTP Mail - set via ENV or leave empty to disable email sending
		"smtp_host" => _env('SMTP_HOST'),
		"smtp_username" => _env('SMTP_USER'),
		"smtp_password" => _env('SMTP_PASS'),
		"smtp_name" => _env('SMTP_FROM_NAME', 'Secret Republic'),
		"smtp_from" => _env('SMTP_FROM', 'undefined@undefined.com'),
		"smtp_secure" => _env('SMTP_SECURE', 'tls'),
		"smtp_port" => (int) _env('SMTP_PORT', 587),


	  	"gridNodeSize" => 10,
		"worldBirth" => 1395530364,


		"max_tasks"=>3,
		"defaultGroup"=>2,

		"detention_bail"=>2,


		"captcha_check"=>60*15,
		"connection_time"=>10,


		//CONNECT FEATURE

		"energy_hour"=>10,



		"blog_title_size"=>50,
		"blog_article_size"=>8888,
		"forum_post_size"=>6666,


		"org_application_size"=>500,


		"nra_page"=>10,
		"nrc_page"=>10,



	];
