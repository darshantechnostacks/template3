<?php
require_once('header.php');
$curl = new CURL();
$request = array();

$request = array(
    'conditions' => ['Uindustries.is_deleted' => 0, 'Uindustries.websiteId' => WEBSITE_ID, 'Uindustries.is_setting' => 0],
    'contain' => ['industries', 'industries.industriecontents'],
    'fields' => array(),
    'select' => array(),
    'get' => 'all',
    'order' => array('Uindustries.id' => 'desc'),
    //   'limit' => '4'
);

$result = $curl->send_api($request, 'Uindustries/index');

$tags = '';
$page = array();

if ($result->code == 200) {
    $industries = isset($result->Uindustries[0]) ? $result->Uindustries : '';
}

$newslettesSetting = array();
//get settings details
$requestSetting = array(
    'conditions' => ['Uindustries.is_deleted' => 0, 'Uindustries.websiteId' => WEBSITE_ID, 'Uindustries.is_setting' => 1],
    'contain' => ['industries'],
    'fields' => array(),
    'select' => array(),
    'get' => 'all',
    'order' => array('Uindustries.id' => 'desc'),
    'limit' => '1'
);

$resultSetting = $curl->send_api($requestSetting, 'Uindustries/index');

if ($resultSetting->code == 200) {
    $bannerSetting = isset($resultSetting->Uindustries[0]) ? $resultSetting->Uindustries[0] : '';
}

if (isset($bannerSetting->isedit) && $bannerSetting->isedit === 1) {
    $coverImage = $bannerSetting->featured_image;
    $content = $bannerSetting->page_content;
} else {
    $coverImage = $bannerSetting->Industries->featured_image;
    $content = $bannerSetting->Industries->page_content;
}

?>

<div class="sub-page-banner mb3">
    <div class="banner-img">
        <img src="<?= isset($coverImage) ? FEATURE_PHOTO . $coverImage : 'img/industrie-banner.png' ?>"
             class="img-responsive"/>
    </div>
    <div class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>INDUSTRIES</h2>
                    <h4>We love what we do and we’re good at it!</h4>
                </div>
            </div>
        </div>
    </div>
    <ul class="top-contact-info">
        <li><i class="icon-mobile"></i><?= isset($homePages->firm_phone) ? $homePages->firm_phone : "" ?></li>
        <li><i class="icon-email"></i> <a
                    href="mailtto:<?= isset($homePages->firm_email) ? $homePages->firm_email : "" ?>"><?= isset($homePages->firm_email) ? $homePages->firm_email : "" ?></a>
        </li>
    </ul>
</div>
<div class="clearfix mb4">
    <div class="container">
        <p class="font-16 mb4 font-light"><?= isset($content) ? $content : '' ?></p>
        <div class="row mb2 services-inner">

            <?php
                foreach ($industries as $key => $value){
                    $page_slug = $value->page_slug;
                    if($value->isedit == 1){
                        $title = isset($value->title) ? $value->title : '';
                        $page_content = isset($value->page_content) ? $value->page_content : '';
                        $image = isset($value->featured_image) ? FEATURE_PHOTO.$value->featured_image : '';
                    } else {
                        $title = isset($value->Industries->title) ? $value->Industries->title : '';
                        $page_content = isset($value->Industries->industriecontents[$set_no-1]->contents) ? $value->Industries->industriecontents[$set_no-1]->contents : '';
                        $image = isset($value->Industries->featured_image) ? FEATURE_PHOTO.$value->Industries->featured_image : '';
                    }
                    ?>
                    <div class="col-md-4 col-sm-6 mb2">
                        <div class="inner-box clearfix">
                            <div class="icon-block">
                                <i class=" icon mb-3">
                                    <?php
                                        if(!empty($image)){
                                            echo "<img src='$image' class='img-responsive'/>";
                                        } else {
                                            echo "<img src='img/services-icon.png' class='img-responsive'/>";
                                        }
                                    ?>
                                </i>
                            </div>
                            <div class="content">
                                <div class="title-block">
                                    <h2 class="title"><?= substr(trim($title), 0, 15) ?></h2>
                                </div>
                                <p><?= str_replace("{company_name}", $homePages->firm_name, substr(trim($page_content), 0, 250)) ?></p>
                                <a href="industriesdetails.php?slug=<?= $page_slug ?>" class="btn-link">Read More >></a>
                            </div>
                        </div>
                    </div>
            <?php
                }
            ?>
        </div>
    </div>
</div>
