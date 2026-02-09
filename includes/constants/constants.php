<?php
/* Nenu Adrian Mircea 2012+ */
	return [
		'url' => $_SERVER['REQUEST_SCHEME'] .  '://' . $_SERVER['HTTP_HOST'] . str_replace('index.php', '', $_SERVER['SCRIPT_NAME']),
		'contact_email' => 'undefined@undefined.com',
		
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

		'recaptcha_site_key' => '', // get key if you would like to activate! https://www.google.com/recaptcha/admin/create
		'recaptcha_secret_key' => '', // get key if you would like to activate! https://www.google.com/recaptcha/admin/create
		
		// ── SMTP Configuration (PHPMailer) ──────────────────────────
		// Leave smtp_host empty to disable email sending.
		// Registration and other flows will continue without errors.
		//
		// Hostinger example:
		//   smtp_host     => "smtp.hostinger.com"
		//   smtp_port     => 465
		//   smtp_secure   => "ssl"
		//   smtp_username => "noreply@yourdomain.com"
		//   smtp_password => "<email-account-password>"
		//   smtp_from     => "noreply@yourdomain.com"
		//   smtp_name     => "Secret Republic"
		// ─────────────────────────────────────────────────────────────
		"smtp_host"     => "",                      // SMTP server hostname
		"smtp_port"     => 587,                     // 587 for TLS, 465 for SSL
		"smtp_secure"   => "tls",                   // "tls" or "ssl"
		"smtp_username" => "",                       // SMTP login / email address
		"smtp_password" => "",                       // SMTP password
		"smtp_from"     => "noreply@yourdomain.com", // Envelope-From address
		"smtp_name"     => "Secret Republic",        // Sender display name


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
