<?php
require_once('header.php');
$curl = new CURL();
$request = array();

$request = array(
    'conditions' => ['Umissionvisions.is_deleted' => 0, 'Umissionvisions.websiteId' => WEBSITE_ID, 'Umissionvisions.is_setting' => 0],
    'contain' => ['missionvisions', 'missionvisions.missionvisioncontent'],
    'fields' => array(),
    'select' => array(),
    'get' => 'all',
    'order' => array('Umissionvisions.id' => 'desc'),
    'limit' => '1'
);

$result = $curl->send_api($request, 'Umissionvisions/index');
if(!empty($result)){
    if(isset($result->Umissionvisions[0]) && ($result->Umissionvisions[0]->isedit == 1) ){
        $detailsContent = isset($result->Umissionvisions[0]) ?$result->Umissionvisions[0]->page_content :"";
    }else{
        $detailsContent = isset($result->Umissionvisions[0]) ?$result->Umissionvisions[0]->Missionvisions->missionvisioncontent[$set_no-1]->contents :"";

    }
}
//get setting information
$results = array();
//get settings details
$requestSetting = array(
    'conditions' => ['Umissionvisions.is_deleted' => 0, 'Umissionvisions.websiteId' => WEBSITE_ID, 'Umissionvisions.is_setting' => 1],
    'contain' => ['missionvisions'],
    'fields' => array(),
    'select' => array(),
    'get' => 'all',
    'order' => array('Umissionvisions.id' => 'desc'),
    'limit' => '1'
);

$results = $curl->send_api($requestSetting, 'Umissionvisions/index');

if ($results->code == 200) {
    $bannerSetting = isset($results->Umissionvisions[0]) ? $results->Umissionvisions[0] : '';
}

if (isset($bannerSetting->isedit) && $bannerSetting->isedit === 1) {
    $coverImage = isset($bannerSetting->featured_image) ? FEATURE_PHOTO.$bannerSetting->featured_image : "";
    $content = isset($bannerSetting->page_content) ? $bannerSetting->page_content : "";
} else {
    $coverImage = isset($bannerSetting->Missionvisions->featured_image) ? FEATURE_PHOTO.$bannerSetting->Missionvisions->featured_image : "";
    $content = isset($bannerSetting->Missionvisions->page_content) ? $bannerSetting->Missionvisions->page_content : "";
}

?>
<div class="sub-page-banner mb3">
    <div class="banner-img">
        <?php
            if(!empty($coverImage)){
                echo "<img src='$coverImage' class='img-responsive' />";
            } else {
                echo "<img src='img/mission-vision-banner.png' class='img-responsive' />";
            }
        ?>

    </div>
    <div class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>mission & vision</h2>
                    <h4>We love what we do and we’re good at it!</h4>
                </div>
            </div>
        </div>
    </div>
    <ul class="top-contact-info">
        <li><i class="icon-mobile"></i><?= isset($homePages->firm_phone) ? $homePages->firm_phone : "" ?></li>
        <li><i class="icon-mobile"></i> <a href="mailtto:<?= isset($homePages->firm_email) ? $homePages->firm_email : "" ?>"><?= isset($homePages->firm_email) ? $homePages->firm_email : "" ?></a></li>
    </ul>
</div>
<div class="clearfix mb4">
    <div class="container">
        <div class="row mb2">
            <div class="col-md-8 mb3">
                <h3 class="mission-title">Our Mission :</h3>
                <p class="font-22 text-justify">
                    <?= str_replace('{company_name}', $homePages->firm_name, $content) ?>
                </p>
                <p class="font-22 text-justify">
                    <?= str_replace('{company_name}', $homePages->firm_name, $detailsContent) ?>
                </p>
            </div>
        </div>
    </div>
</div>
<?php include_once('footer.php') ?>