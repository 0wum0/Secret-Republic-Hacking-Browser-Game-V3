<?php

$_tut_url = defined('URL') ? URL : '';
$_tut_vars = [
	':username' => $user['username'],
	':url_tutorial' => $_tut_url . 'pages/page/beginner-tutorial',
	':url_dna' => $_tut_url . 'dna',
	':url_referrals' => $_tut_url . 'referrals',
	':url_storage' => $_tut_url . 'storage',
	':url_ac_storage' => $_tut_url . 'alpha_coins/option/extraStorage1',
	':url_ac_time' => $_tut_url . 'alpha_coins/option/extraTime',
	':url_ac_quest' => $_tut_url . 'alpha_coins/option/questManager',
	':url_ac_chat' => $_tut_url . 'alpha_coins/option/partyChat',
	':url_achievements' => $_tut_url . 'achievements',
	':url_simulator' => $_tut_url . 'simulator',
	':url_grid' => $_tut_url . 'grid',
	':url_dp' => $_tut_url . 'data-points',
	':url_ac_dp' => $_tut_url . 'alpha_coins/option/extraDataPoints15',
	':url_forum' => $_tut_url . 'forum/fid/7',
];

$tutorialSteps = array(
	1 => array(
		"title" => t('TUT_STEP1_TITLE'),
		"content" => t('TUT_STEP1_CONTENT', null, $_tut_vars),
		"rewards" => array(
			"money" => 25,
			"exp" => 20,
			"skillPoints" => 4,
			)
		),
2 => array(
	"title" => t('TUT_STEP2_TITLE'),
	"content" => t('TUT_STEP2_CONTENT', null, $_tut_vars),
	"rewards" => array(
		"money" => 30,
		"exp" => 20,
		"skillPoints" => 2,
		)
	),
3 => array(
	"title" => t('TUT_STEP3_TITLE'),
	"content" => t('TUT_STEP3_CONTENT', null, $_tut_vars),
	"rewards" => array(
		"money" => 20,
		"exp" => 20,
		"skillPoints" => 2,
		)
	),
4 => array(
	"title" => t('TUT_STEP4_TITLE'),
	"content" => t('TUT_STEP4_CONTENT', null, $_tut_vars),
	"rewards" => array(
		"money" => 60,
		"exp" => 20,
		"skillPoints" => 2,
		)
	),

5 => array(
	"title" => t('TUT_STEP5_TITLE'),
	"content" => t('TUT_STEP5_CONTENT', null, $_tut_vars),
	"rewards" => array(
		"money" => 100,
		"exp" => 20,
		"skillPoints" => 2,
		)
	),

6 => array(
	"title" => t('TUT_STEP6_TITLE'),
	"content" => t('TUT_STEP6_CONTENT', null, $_tut_vars),
	"rewards" => array(
		"money" => 20,
		"exp" => 20,
		"skillPoints" => 2,
		)
	),

7 => array(
	"title" => t('TUT_STEP7_TITLE'),
	"content" => t('TUT_STEP7_CONTENT', null, $_tut_vars),
	"rewards" => array(
		"money" => 40,
		"exp" => 20,
		"skillPoints" => 2,
		)
	),

8 => array(
	"title" => t('TUT_STEP8_TITLE'),
	"content" => t('TUT_STEP8_CONTENT', null, $_tut_vars),
	"rewards" => array(
		"money" => 10,
		"exp" => 20,
		"skillPoints" => 4,
		)
	),

9 => array(
	"title" => t('TUT_STEP9_TITLE'),
	"content" => t('TUT_STEP9_CONTENT', null, $_tut_vars),
	"rewards" => array(
		"money" => 10,
		"exp" => 20,
		"skillPoints" => 4,
		)
	),
10 => array(
	"title" => t('TUT_STEP10_TITLE'),
	"content" => t('TUT_STEP10_CONTENT', null, $_tut_vars),
	"rewards" => array(
		"money" => 10,
		"exp" => 20,
		"skillPoints" => 4,
		)
	),

11 => array(
	"title" => t('TUT_STEP11_TITLE'),
	"content" => t('TUT_STEP11_CONTENT', null, $_tut_vars),
	"rewards" => array(
		"money" => 30,
		"exp" => 20,
		"skillPoints" => 4,
		)
	),

12 => array(
	"title" => t('TUT_STEP12_TITLE'),
	"content" => t('TUT_STEP12_CONTENT', null, $_tut_vars),
	"rewards" => array(
		"money" => 30,
		"exp" => 20,
		"skillPoints" => 2,
		)
	),

13 => array(
	"title" => t('TUT_STEP13_TITLE'),
	"content" => t('TUT_STEP13_CONTENT', null, $_tut_vars),
	"rewards" => array(
		"money" => 30,
		"exp" => 20,
		"skillPoints" => 2,
		)
	),

14 => array(
	"title" => t('TUT_STEP14_TITLE'),
	"content" => t('TUT_STEP14_CONTENT', null, $_tut_vars),
	"rewards" => array(
		"money" => 50,
		"exp" => 20,
		"skillPoints" => 4,
		)
	),

15 => array(
	"title" => t('TUT_STEP15_TITLE'),
	"content" => t('TUT_STEP15_CONTENT', null, $_tut_vars),
	"rewards" => array(
		"money" => 60,
		"exp" => 20,
		"skillPoints" => 2,
		)
	),


16 => array(
	"title" => t('TUT_STEP16_TITLE'),
	"content" => t('TUT_STEP16_CONTENT', null, $_tut_vars),
	"rewards" => array(
		"money" => 60,
		"exp" => 20,
		"skillPoints" => 2,
		)
	),

17=> array(
	"title" => t('TUT_STEP17_TITLE'),
	"content" => t('TUT_STEP17_CONTENT', null, $_tut_vars),
	"rewards" => array(
		"money" => 33,
		"exp" => 20,
		"skillPoints" => 2,
		)
	),


18 => array(
	"title" => t('TUT_STEP18_TITLE'),
	"content" => t('TUT_STEP18_CONTENT', null, $_tut_vars),
	"rewards" => array(
		"money" => 100,
		"exp" => 40,
		"skillPoints" => 10,
		)
	),
);


function tutorial_step_1_check()
{
	global $GET;

	if ($GET['currentPage'] == 'pages' && $GET['page'] == "beginner-tutorial")
		tutorial_step_complete();
}

function tutorial_step_2_check()
{

	global $user;

	if (!$user['rewardsToReceive'])
		tutorial_step_complete();
}

function tutorial_step_3_check()
{

	global $GET;

	if ($GET['currentPage'] == 'friends')
		tutorial_step_complete();
}

function tutorial_step_4_check()
{

	global $user;

	if ($user['server'])
		tutorial_step_complete();
}

function tutorial_step_5_check()
{

	global $db, $user;
	$check = $db->where('user_id', $user['id'])->where('quest', 70)->getOne('quests_user', 'id');
	if ($check['id'])
		tutorial_step_complete();
}


function tutorial_step_6_check()
{

	global $user;
	if ($user['in_party'])
		tutorial_step_complete();
}

function tutorial_step_7_check()
{

	global $GET;

	if ($GET['currentPage'] == 'profile')
		tutorial_step_complete();
}

function tutorial_step_8_check()
{

	global $GET;

	if ($GET['currentPage'] == 'grid/grid' && $GET['layers'])
		tutorial_step_complete();
}

function tutorial_step_9_check()
{

	global $GET, $user;

	if ($GET['currentPage'] == 'skills' && !$user['skillPoints'])
		tutorial_step_complete();
}


function tutorial_step_10_check()
{

	global $user, $db;
	$check = $db->where('user_id', $user['id'])->where('level > 0')->getOne('abilities', 'ability_id');

	if ($check['ability_id'])
		tutorial_step_complete();
}

function tutorial_step_11_check()
{

	global $user, $db;
	$check = $db->where('server_id', $user['server'])->where('running is not null and running != 0')->getOne('server_apps', 'process_id');

	if ($check['process_id'])
		tutorial_step_complete();
}

function tutorial_step_12_check()
{
	global $GET;

	if ($GET['currentPage'] == 'data-points')
		tutorial_step_complete();
}

function tutorial_step_13_check()
{

	global $user, $db;
	$check = $db->where('user_id', $user['id'])->getOne('user_job_logs', 'log_id');

	if ($check['log_id'])
		tutorial_step_complete();
}

function tutorial_step_14_check()
{

	global $user, $db;
	$check = $db->where('user_id', $user['id'])->getOne('user_train_logs', 'log_id');

	if ($check['log_id'])
		tutorial_step_complete();
}

function tutorial_step_15_check()
{

	global $user, $db;
	$check = $db->where('user_id', $user['id'])->where("fid", 7)->getOne('forum_posts', 'id');

	if ($check['id'])
		tutorial_step_complete();
}




function tutorial_step_16_check()
{

	global $GET;

	if ( $GET['view'] == "hackingPoints")
		tutorial_step_complete();
}

function tutorial_step_17_check()
{


	if ($_POST['youtube'])
		tutorial_step_complete();
}

function tutorial_step_18_check()
{

	global $db, $user;

	$check = $db->where('quest', 39)->where('user_id', $user['id'])->getOne('quests_user', 'id');
	if ($check['id'])
		tutorial_step_complete();
}


function tutorial_step_complete()
{

	global $tutorial, $uclass, $myModal;
	$tutorial['status'] = 1;
	$myModal['show'] = true;
	$uclass->updatePlayer(array('tutorial' => $tutorial['step'] * 10 + $tutorial['status']));
}
