<?php
     define('API_URL','');
    define('EMAIL','');
    define('API_TOKEN','');
    define('WEBSITE_ID','');
   
class CURL {

    function send_api($fields, $action) {
        $url = API_URL . $action . '.json';
        $email = EMAIL;
        $api_token = API_TOKEN;
        $headers = array(
            'Content-Type: application/json'
        );
        $ch = curl_init();        
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        curl_setopt($ch, CURLOPT_USERPWD, "$email:$api_token");
        $result = curl_exec($ch);       
        curl_close($ch);
        $returnResult = json_decode($result);
        return $returnResult;
    }
}

$curl = new CURL();

$udata['id'] = 1;

$set_no = 2;

/* * **************** HOME PAGE DATA ************ */
$data['id'] = WEBSITE_ID;
$result = $curl->send_api($data, 'UhomePages/getDataBuyUserId');
if (!empty($result) && $result->code == 200) {
    $homePages = $result->UhomePages;
}
/* * **************** END HOME PAGE DATA ******** */


/* * **************** User Data get ************ */
$udata['websiteId'] = WEBSITE_ID;
$result = $curl->send_api($udata, 'Users/GetUserByWebsiteId');

if (!empty($result) && $result->code == 200) {
    $user_data = $result->Users;

    $cityes = $curl->send_api(array(), 'Cities/getCity/'.$user_data->city_id);
    if($cityes->code == 200)
    {
        $city_name = $cityes->Cities->city;
    }

    $firm = $user_data->firm;

    if($user_data->template_id)
    {
        $Templates = $curl->send_api(array(), 'Templates/getTemplateDetail/'.$user_data->template_id);
        if($Templates->Templates->set_no){
            $set_no = $Templates->Templates->set_no;
        }
    }
}

/* * ********  get All settings ***** */
$settings_data = array();
$setting['is_deleted'] = 0;
$setting['websiteId'] = WEBSITE_ID;

$settings_data = $curl->send_api($setting, 'Usettings/getSettingById');

$settings = array();

if (!empty($settings_data) && $settings_data->code == 200) {
    $settings = $settings_data->Usettings;
}
/* * ******** End  get All settings*** */


/****Get about us data*** */
$about_data = array();
$data['websiteId'] = WEBSITE_ID;
$about_data = $curl->send_api($data, 'Uaboutus/index');
/****End Get about us data*** */

/* * ********  Testimonals  ***** */
$testimonal_data = array();
/*$testimonals_array['is_deleted'] = 0;
$testimonals_array['status'] = 1;
$testimonals_array['websiteId'] = WEBSITE_ID;*/
 $testimonalsarray = array(
    'conditions' => ['Utestimonials.is_deleted' => 0,'Utestimonials.status' => 1, 'Utestimonials.websiteId' => WEBSITE_ID],
    'contain' => ['states', 'cities'],
    'fields' => array(),
    'select' => array(),
    'get' => 'all',
    'order' => array('Utestimonials.id' => 'desc'),
    );

$testimonal_data = $curl->send_api($testimonalsarray, 'Utestimonials/indexAll');


$testimonals = array();
if (!empty($testimonal_data) && $testimonal_data->code == 200) {
    $testimonals = $testimonal_data->Utestimonials;
}
/* * ******** End  Testimonals*** */


/* * ******Get Timeslots ****** * */
$data['status'] = 1;
$data['websiteId'] = WEBSITE_ID;
$resulttime = $curl->send_api($data, 'Timeslot/getTimeSlot');
$timeslots = array();
if (!empty($resulttime) && $resulttime->code == 200) {
    $timeslots = $resulttime->Timeslot;
}
/* * ******End Timeslots********* */

/* * ******** Get menu ***** */
$menu_data['status'] = 1;
$menu_data['websiteId'] = WEBSITE_ID;

$menu_datas = $curl->send_api($menu_data, 'UmenuSettings/getActiveAllMenus');


$menus = array();

if (!empty($menu_datas) && $menu_datas->code == 200) {
    $menus = $menu_datas->UmenuSettings;
}

//get addresses
$data['websiteId'] = WEBSITE_ID;
$branchAddresses = $curl->send_api($data, 'UbranchAddress/index');
if (!empty($result) && $result->code == 200) {
    $addresses = $branchAddresses->UbranchAddress;
}

function sendemails($to, $msg, $from, $subject, $sender_name) {
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= 'From: <sanjay@technostacks.com>' . "\r\n";  
    $default_subject = 'From My Contact Form';
    $name_not_specified = 'Please type a valid name';
    $message_not_specified = 'Please type a vaild message';
    $email_was_sent = 'Send message complete!';
    $server_not_configured = 'Sorry, mail server not configured';

    if (empty($sender_name)) {
        $errors[] = $name_not_specified;
    }

    if (empty($msg)) {
        $errors[] = $message_not_specified;
    }
    $subject = (!empty($subject)) ? $subject : $default_subject;
    $message = "    Name: $sender_name <br>  Message: $msg <br>";
    $result = array();
    if(empty($errors)) {
        if (mail($to, $subject, $message,$headers)) {
            $result['message'] = $email_was_sent;
        } else {
            $errors[] = $server_not_configured;
            $result['message'] = implode('<br>', $errors );
        }
    } else {
    $result['message'] = implode('<br>', $errors );
    }
    return $result;
}

?>