<?php
    //Local
    define('API_URL','http://192.168.0.158/cpa-cake/');
    define('EMAIL','test20@yopmail.com');
    define('API_TOKEN','1943869614813663c39abfaaf2f02e8cddf4e459');
    define('WEBSITE_ID','1be7c36b3c2561e800d9cf43cdc22ef1');

    //Live
//    define('API_URL','http://18.221.49.101/cpacake/');
//    define('EMAIL','dhrumil1@yopmail.com');
//    define('API_TOKEN','efe13fc665f5f82351d7db3a7202238facefbf66');
//    define('WEBSITE_ID','d4c132469b11d98e74461b0f48c0af04');

//define('API_URL','http://18.221.49.101/cpacake/');
//define('EMAIL','dhaval@yopmail.com');
//define('API_TOKEN','ccb79ed3b41e6b3ac73a3420fc6a952b173a01d5');
//define('WEBSITE_ID','931e53a63a665475929569e260a647c4');

    define('BANNER_URL', API_URL.'geturl/uploads/banner/');
    define('LOGO_URL', API_URL.'geturl/uploads/logo/');
    define('ICON_URL', API_URL.'geturl/uploads/icon/');
    define('FEATURE_PHOTO', API_URL.'geturl/uploads/feature_photo/');
    define('PHOTO_URL', API_URL.'geturl/uploads/photo/');



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

$set_no = 1;
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

$data['websiteId'] = WEBSITE_ID;
$about_data = $curl->send_api($data, 'Uaboutus/index');


$data['websiteId'] = WEBSITE_ID;
$branchAddresses = $curl->send_api($data, 'UbranchAddress/index');
if (!empty($result) && $result->code == 200) {
    $addresses = $branchAddresses->UbranchAddress;
}

/* * ******Get Blogs********* */
$blog['apost_categorie_id'] = 1;
$blog['limit'] = 3;
$blog['websiteId'] = WEBSITE_ID;

$blogs_data = $curl->send_api($blog, 'Aposts/getBlogs');
$blogs = array();
if (!empty($blogs_data) && $blogs_data->code == 200) {
    $blogs = $blogs_data->Aposts;
}

/* * ******End Blogs********* */


/* * **************** HOME PAGE DATA ************ */
$data['id'] = WEBSITE_ID;
$result = $curl->send_api($data, 'UhomePages/getDataBuyUserId');
if (!empty($result) && $result->code == 200) {
    $homePages = $result->UhomePages;
}
/* * **************** END HOME PAGE DATA ******** */
/* * **************** Blog Category Data ************ */
$data['id'] = WEBSITE_ID;
$result = $curl->send_api($data, 'BlogsCategory/index');
if (!empty($result) && $result->code == 200) {
    $blog_category = $result->BlogsCategory;
}

/* * **************** END Blog Category Data ******** */

/* * ********  getAllServices ***** */
$services_data = array();
$services_data['websiteId'] = WEBSITE_ID;

$services_datas = $curl->send_api($services_data, 'Uservices/getAllServices');
$services = array();

if (!EMPTY($services_datas) && $services_datas->code == 200) {
    $services = $services_datas->Uservices;
}
/* * ******** End  getAllServices*** */


/* * *****  getUserByLogo **** */

$alogos = array();
if (!empty($homePages->membership_certification)) {
    $alogos_data['id'] = $homePages->membership_certification;

    $alogos = $curl->send_api($alogos_data, 'Alogos/getUserByLogo');
}
/* * ************  End getUserByLogo ************** */


/* * ******* End Get Banner data ******** */

/* * ******** Get menu ***** */
$menu_data['status'] = 1;
$menu_data['websiteId'] = WEBSITE_ID;

$menu_datas = $curl->send_api($menu_data, 'UmenuSettings/getActiveAllMenus');


$menus = array();

if (!empty($menu_datas) && $menu_datas->code == 200) {
    $menus = $menu_datas->UmenuSettings;
}

/* * ******** Get industries ***** */

$Industries_array['websiteId'] = WEBSITE_ID;

$Industrie_data = $curl->send_api($Industries_array, 'Upages/getAllIndustriesMenus');
$industries_menu = array();
if (!empty($Industrie_data) && $Industrie_data->code == 200) {
    $industries_menu = $Industrie_data->Upages;
}

/* * ******** End Get menu*** */


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

/* * ***Get News******** */

$blogNews['apost_categorie_id'] = 2;
$blogNews['websiteId'] = WEBSITE_ID;
$blogNews['limit'] = 3;
$news_data = $curl->send_api($blogNews, 'Aposts/getNews');
$news = array();
if (!empty($news_data) && $news_data->code == 200) {
    $news = $news_data->Aposts;
}
//p($news);
/* * ***End News******** */

	/*****Get Team*********/
	$our_team_data = array();
	$our_team_data['umenu_id'] = 1;
	$our_team_data['websiteId'] = WEBSITE_ID;

	$our_team_datas = $curl->send_api($our_team_data, 'Uteams/getAllUteams');

	$our_teams = array();
	if(!empty($our_team_datas))
	{
		if ($our_team_datas->code == 200) {
			$our_teams = $our_team_datas->Uteams;
		}
	}
	/*****End Team*********/
        
function p($data) {
    echo '<pre>';
    print_r($data);
    exit;
}

/********** Get Calculator Category ******/
	
$request = array(
    'conditions' => ['status' => 1, 'is_deleted' => 0],
);

$calculator_data = $curl->send_api($request,'CalculatorCategory/index');	
$calculator_menu = array();
$calculator_res = array();
if(!empty($calculator_data))
{
    if($calculator_data->code == 200)
    {
        $calculator_menu = (array)$calculator_data->CalculatorCategory;
    }
    
    foreach($calculator_menu as $cal)
    {
        if($cal->parent_id == 0){
        $calculator_res[$cal->id]['id'] = $cal->id;
        $calculator_res[$cal->id]['name'] = $cal->category_name;
        }
        if($cal->parent_id != 0){
            $calculator_res[$cal->parent_id]['subdata'][] = $cal;
        }
        
    }
}

/********** End Get menu****/

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