<?php 

require_once('config.php');
//////////////////////////
//Specify default values//
//////////////////////////

//Your E-mail

$to = EMAIL;

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


///////////////////////////
//Contact Form Processing//
///////////////////////////
$errors = array();

if(isset($_POST['message']) and isset($_POST['username'])) {
	$adminemail = 'sanjay@technostacks.com';
	$message = sendemails($_POST['email'],$_POST['message'],$adminemail,'Contact us',$_POST['username']);
   	$message = sendemails($adminemail,$_POST['message'],$_POST['email'],'Contact us',$_POST['username']);
   	echo json_encode($message);
} else {
	// if "name" or "message" vars not send ('name' attribute of contact form input fields was changed)
	$message =  '"name" and "message" variables were not received by server. Please check "name" attributes for your input fields';
echo json_encode($message);
}
?>
