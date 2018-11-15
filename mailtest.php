<?php

function sendemails($to,$msg,$from,$subject,$sender_name)
{
	//Default Subject if 'subject' field not specified
	$default_subject = 'From My Contact Form';

	//Message if 'name' field not specified
	$name_not_specified = 'Please type a valid name';

	//Message if 'message' field not specified
	$message_not_specified = 'Please type a vaild message';

	//Message if e-mail sent successfully
	$email_was_sent = 'Send message complete!';

	//Message if e-mail not sent (server not configured)
	$server_not_configured = 'Sorry, mail server not configured';


	//Message if no sender name was specified
	if(empty($sender_name)) {
		$errors[] = $name_not_specified;
	}

	//Message if no message was specified
	if(empty($msg)) {
		$errors[] = $message_not_specified;
	}

	/*$from = (!empty($sender_email)) ? 'From: '.$sender_email : '';*/

	$subject = (!empty($subject)) ? $subject : $default_subject;

	//$message = (!empty($message)) ? wordwrap($message, 70) : '';

	$message = "	Name: $sender_name 

	E-mail: $from 

	Message: $msg

	";


	//sending message if no errors
	if(empty($errors)) {
		if (mail($to, $subject, $message)) {
			echo $email_was_sent;
		} else {
			$errors[] = $server_not_configured;
			echo implode('<br>', $errors );
		}
	} else {
		echo implode('<br>', $errors );
	}
}
	
?>