<?php require_once('config.php'); 

/*$emailSub['email'] =$_POST['subemail']; 
$emailSub['websiteId'] = WEBSITE_ID; 
$email_data = (array) $curl->send_api($emailSub, 'Usubscriptions/add');

 echo json_encode($email_data);
exit;*/


$emailSub['email'] = $_POST['subemail'];
$emailSub['first_name'] = $_POST['first_name'];
$emailSub['last_name'] = $_POST['last_name'];
$emailSub['websiteId'] = WEBSITE_ID;
$email_data = (array) $curl->send_api($emailSub, 'Usubscriptions/add');
if ($email_data['code'] == 102 || ($email_data['code']==400)) {
    echo json_encode($email_data);
    exit;
} elseif ($email_data['code'] == 200) {

    $message = "Thank you for subscribe !!";
    $adminemail = 'sanjay@technostacks.com';

    $user = strstr($emailSub['email'], '@', true);

   
  //  sendSubscribeemails($emailSub['email'], $message, $adminemail, 'Subscriber', $user);
    
    $to = $emailSub['email'];
    $msg = $message;
    $from = $adminemail;
    $subject = 'Subscriber';
    $sender_name = $user;
    
    
    
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    // More headers
    $headers .= 'From: <sanjay@technostacks.com>' . "\r\n";
    //Default Subject if 'subject' field not specified
    //echo "$to - $msg - $from - $subject - $sender_name";
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
    if (empty($sender_name)) {
        $errors[] = $name_not_specified;
    }

    //Message if no message was specified
    if (empty($msg)) {
        $errors[] = $message_not_specified;
    }

    /* $from = (!empty($sender_email)) ? 'From: '.$sender_email : ''; */

    $subject = (!empty($subject)) ? $subject : $default_subject;

    //$message = (!empty($message)) ? wordwrap($message, 70) : '';

    $message = "Name: $sender_name 

		

		Message: $msg

		";


    //sending message if no errors
    if (empty($errors)) {
        if (mail($to, $subject, $message, $headers)) {
          //  echo $email_was_sent;
        } else {
            $errors[] = $server_not_configured;
           // echo implode('<br>', $errors);
        }
    } else {
        //echo implode('<br>', $errors);
    }
    
     echo json_encode($email_data);
    exit;
    
    
   

}


?>		
