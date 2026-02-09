<?php

require_once('functions.php');
require_once('class/RewardsManager.class.php');
require_once('class/Item.class.php');
require("constants/skills.php");


require('class/userclass.php');

if ($cardinal) {
  $cardinal->loginSystem();
}

$growl = $myModals = array();
$success = $warnings = $errors = $info = array();
$messenger = array();
$voice = null;

require(ABSPATH . 'includes/class/paginator.class.php');

require_once('class/taskclass.php');

if (!$logged) {

  if (!empty($GET['i']) && empty($_SESSION['referrer'])) {
    $_SESSION['referrer'] = base64_decode($GET['i']);

  } //$GET['i'] && !$_SESSION['referrer']
} //!$cardinal->loginSystem->logged
else {

  if ($_SESSION['unconfirmed_email']) {
    $warnings[]       = t('HDR_UNCONFIRMED_EMAIL', null, [':resend_url' => URL . 'register/resend/confirmation', ':change_url' => URL . 'dna']);
    $no_warning_voice = true;
  } //$_SESSION['unconfirmed_email']


  if ($_SESSION['showTutorial']) {

    require("constants/tutorial.php");

    $tutorial['step']   = floor($user['tutorial'] / 10);
    $tutorial['status'] = $user['tutorial'] % 10;

    if ($tutorial['tutorialStep'] = $tutorialSteps[$tutorial['step']]) {

      if (!$tutorial['status']) {
        $tutorial['status'] = 2;
        $uclass->updatePlayer(array(
          'tutorial' => $tutorial['step'] * 10 + 2
        ));
        $myModal['show'] = true;
      } //!$tutorial['status']

      $functionName = "tutorial_step_" . $tutorial['step'] . "_check";
      if ($tutorial['status'] != 1 && !$_POST['skipStep']) {
        if (!function_exists($functionName)) {
          echo "Undefined required function in tutorial.php: " . $functionName;
          die();
        }
        $functionName();
      } elseif ($_POST['nextTutorialStep'] || $_POST['skipStep']) {
        $tutorial['step']++;
        $uclass->updatePlayer(array(
          'tutorial' => $tutorial['step'] * 10
        ));

        if ($_POST['skipStep']) {
          $success[] = t('HDR_TUTORIAL_SKIPPED');
        } //$_POST['skipStep']
        else {
          $success[] = t('HDR_TUTORIAL_COMPLETE');
          $uclass->addReward($user['id'], $tutorial['tutorialStep']['rewards'], "Tutorial: " . $tutorial['tutorialStep']['title']);
        }
        if ($tutorial['step'] > $config['tutorialSteps']) {
          $info[] = t('HDR_TUTORIAL_FINISHED');
          unset($_SESSION['showTutorial'], $tutorial);
        } //$tutorial['step'] > $config['tutorialSteps']

        $cardinal->redirect(URL_C);
      } //$_POST['nextTutorialStep'] || $_POST['skipStep']

      $tVars['tutorial'] = true;
      $myModal['title']              = romanic_number($tutorial["step"]) . " | " . $tutorial["tutorialStep"]["title"];
      $myModal['content']            = '<div style="padding:10px ">' . $tutorial["tutorialStep"]["content"] .'</div>';

      if ($tutorial["status"] == 1)
        $myModal['content'] .= "<p><strong>" . $tutorial["tutorialStep"]["complete"] . "</strong></p>";

      $myModal['content'] .= sprintf('
<div class="panel panel-future ">
	<div class="panel-heading ">%s</div>
	<div class="panel-body">
	<button disabled><div class="row">
		<div class="col-xs-4">
			%s$
		</div>
		<div class="col-xs-4">
			%s EXP
		</div>
		<div class="col-xs-4">
			%s USC
		</div>
		</div>
		</button>
	', t('HDR_TUTORIAL_REWARDS'), number_format($tutorial["tutorialStep"]["rewards"]["money"]), number_format($tutorial["tutorialStep"]["rewards"]["exp"]), number_format($tutorial["tutorialStep"]["rewards"]["skillPoints"]));
     if ($tutorial['status'] != 1)
		 $myModal['content'] .= '<br/><div class="alert alert-danger nomargin text-center">
			  	' . t('HDR_TUTORIAL_SKIP_WARN') . '
			  </div>';

		$myModal['content'] .= "</div>";
      if ($tutorial["status"] == 1)
        $myModal['content'] .= '
<form method="post">
	<button type="submit" name="nextTutorialStep" value="go">' . t('HDR_TUTORIAL_RECEIVE') . '</button>
</form>';
		else
			  $myModal['content'] .= '

<form method="post" >
	<button type="submit" name="skipStep" value="go">' . t('HDR_TUTORIAL_SKIP', null, [':step' => romanic_number($tutorial["step"])]) . '</button>
</form>';

      $tutorialPercent = floor($tutorial["step"] / ($config['tutorialSteps'] / 100));
      $myModal['content'] .= sprintf('
</div>


<div class="panel panel-future">

	<div class="panel-body">
	<div class="progress"> <div class="progress-bar" role="progressbar" style="width:%s%%"> </div> </div>
	</div>
	<div class="panel-footer text-right">%s</div>
</div>
', $tutorialPercent, t('HDR_TUTORIAL_PROGRESS', null, [':current' => $tutorial["step"], ':total' => $config['tutorialSteps']]));

		$myModal['id'] = 'tutorial';
		$myModals[] = $myModal;
		$tVars['tutorialPercent'] = $tutorialPercent;

    } //$tutorial['tutorialStep'] = $tutorialSteps[$tutorial['step']]

  } //$_SESSION['showTutorial']


  //Classes

  $finish =  ($user["cardinal"] && $GET["alpha"]);
	if ($finish) $info[] = t('HDR_CARDINAL_ACTIVE');


}


if ($cardinal && $_SESSION["last_quote"] <= time() - 10 * 60) {
  $_SESSION["last_quote"] = time();
  $quote                  = $db->orderBy("RAND()")->getOne("hacker_quotes");
  $message                = strip_tags('\"' . htmlspecialchars_decode($quote["quote"] . '\"'));
  if ($quote["author"])
    $message .= " ~ " . $quote["author"];
  if ($quote["source"])
    $message .= " @ " . $quote["source"];

  $messenger[] = array(
    "message" => ($message)
  );

} //$_SESSION["last_quote"] <= time() - 10 * 60




?>
