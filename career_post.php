<?php

require_once('config.php');
$data=$_POST;
$data['websiteId'] = WEBSITE_ID;
$result = (array) $curl->send_api($data, 'CareerPost/add');
if($result['code'] == 200)
{
	$adminemail = 'sanjay@technostacks.com';
	$message = sendemails($data['email'],'Thank you For applying.You Job Request has been Successfully Submitted.',$adminemail,'Career Post',$data['first_name'].' '.$data['last_name']);
   	$message = sendemails($adminemail,'One Request is receive from career.Please Check ',$data['email'],'Career Post',$data['first_name'].' '.$data['last_name']);
   
}
echo json_encode($result);