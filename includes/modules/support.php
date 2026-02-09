<?php

	


  
  if ($_POST)
  {
  

    if (!$cardinal->verify_captcha_response()) {
      $errors [] = t('ERR_CAPTCHA_INVALID');
    } else {
      
		if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
			$errors[] = t('ERR_EMAIL_NOT_VALID');
		
      if (!(strlen($_POST["title"]) >= 5 && strlen($_POST["title"]) <=200))
        $errors[] = t('ERR_TITLE_LENGTH');
		
      
      if (!(strlen($_POST["content"]) >= 50 && strlen($_POST["content"]) <=1010))
        $errors[] = t('ERR_CONTENT_LENGTH');
        
      if (!$errors)
      {
        $insertData = array(
          "title" => htmlentities($_POST["title"]),
          "email" => ($_POST["email"]),
          "content" => htmlentities($_POST["content"]),
          "created" => time()
        );
        if ($logged) $insertData["user_id"] = $user["id"];
        
        if ($db->insert("user_support", $insertData))
		{
			
			$email['recipients'] = array($_POST['email'], $config['contact_email']);
	       $email['subject'] = "Support: ".$_POST['title'];
			$email['message'] = $_POST['content'];
			
		  $cardinal->sendEmail($email);

      add_alert(t('MSG_SUPPORT_RECEIVED'), 'success');
			$cardinal->redirect(URL);
		}
        else $errors [] = t('ERR_UNKNOWN_SUPPORT');
      }
    }
  
  }
  $tVars["captcha"] = $cardinal->generate_captcha_box();
	
  $tVars["display"] = "support/support.tpl";
	

?>
