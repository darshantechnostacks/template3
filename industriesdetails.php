<?php
require_once('header.php');

$curl = new CURL();

/* * ******** Get pages ***** */
$id = isset($_GET['slug']) ? $_GET['slug'] : '';

$request = array(
    'conditions' => ['Uindustries.is_deleted' => 0, 'Uindustries.page_slug' => $id, 'Uindustries.websiteId' => WEBSITE_ID],
    'contain' => ['industries', 'industries.industriecontents'],
    'fields' => array(),
    'select' => array(),
    'get' => 'all',
    'order' => array('Uindustries.id' => 'desc'),
    "limit" => 1,
);

$result = $curl->send_api($request, 'Uindustries/index');

$data = array();

if ($result->code == 200) {
    $data = isset($result->Uindustries[0]) ? $result->Uindustries[0] : '';
}

$resultSetting = array();
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
    $coverImage = FEATURE_PHOTO.$bannerSetting->featured_image;
    $content = $bannerSetting->page_content;
} else {
    $coverImage = FEATURE_PHOTO.$bannerSetting->Industries->featured_image;
    $content = $bannerSetting->Industries->page_content;
}

if($data->isedit == 1){
    $title = isset($data->title) ? $data->title : '';
    $page_content = isset($data->page_content) ? $data->page_content : '';
    $image = isset($data->featured_image) ? $data->featured_image : '';
} else {
    $title = isset($data->Industries->title) ? $data->Industries->title : '';
    $page_content = isset($data->Industries->industriecontents[$set_no-1]->contents) ? $data->Industries->industriecontents[$set_no-1]->contents : '';
    $image = isset($data->Industries->featured_image) ? $data->Industries->featured_image : '';

}
/* * *******  End get pages ******** */
?>
<div class="sub-page-banner mb3">
    <div class="banner-img">
        <?php
            if(!empty($coverImage)){
                echo "<img src='$coverImage' class='img-responsive' />";
            } else {
                echo "<img src='img/industrie-inner-banner.png' class='img-responsive' />";
            }
        ?>

    </div>
    <div class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4><?= $title ?></h4>
                    <h2>INDUSTRY</h2>
                </div>
            </div>
        </div>
    </div>
    <ul class="top-contact-info">
        <li><i class="icon-mobile"></i><?= isset($homePages->firm_phone) ? $homePages->firm_phone : "" ?></li>
        <li><i class="icon-mobile"></i> <a
                href="mailtto:<?= isset($homePages->firm_email) ? $homePages->firm_email : "" ?>"><?= isset($homePages->firm_email) ? $homePages->firm_email : "" ?></a>
        </li>
    </ul>
</div>
<div class="clearfix mb4">
    <div class="container">
        <div class="row">
            <div class="col-md-4 text-center mb3">
                <div class="inline-block pos-relative">
                    <?php
                        if(!empty($image)){
                            echo "<img src='$image' class='img-responsive'>";
                        } else {
                            echo "<img src='img/real-estate-img.png' class='img-responsive'>";
                        }
                    ?>
                    <div class="box-line-title small">
                        <span><?= $title ?></span>
                    </div>
                </div>
            </div>

            <div class="col-md-7 col-md-offset-1">
                <p class="font-13"><?= $page_content ?></p>
            </div>
        </div>
    </div>
</div>


<?php require_once('footer.php'); ?>