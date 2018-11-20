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

$data = array();

$data = $_POST;
if(isset($data['message']) && isset($data['username'])) {

	$adminemail = 'sanjay@technostacks.com';
	$message = sendemails($data['email'],$data['message'],$adminemail,'Contact us',$data['username']);
   	$message = sendemails($adminemail,$data['message'],$data['email'],'Contact us',$data['username']);
   	echo json_encode($message);
} else {
	// if "name" or "message" vars not send ('name' attribute of contact form input fields was changed)
	$message =  '"name" and "message" variables were not received by server. Please check "name" attributes for your input fields';
echo json_encode($message);
}
?>
