<?php
require_once('header.php');

$curl = new CURL();

/* * ******** Get pages ***** */
$id = isset($_GET['slug']) ? $_GET['slug'] : '';

$request = array(
    'conditions' => ['Unewsletters.is_deleted' => 0, 'Unewsletters.slug' => $id, 'Unewsletters.websiteId' => WEBSITE_ID],
    'contain' => ['newsletters'],
    'fields' => array(),
    'select' => array(),
    'get' => 'all',
    'order' => array('Unewsletters.id' => 'desc'),
    "limit" => 1,
);

$result = $curl->send_api($request, 'Unewsletters/index');

$data = array();

if ($result->code == 200) {
    $data = isset($result->Unewsletters[0]) ? $result->Unewsletters[0] : '';
}

$newslettesSetting = array();
//get settings details
$requestSetting = array(
    'conditions' => ['Unewsletters.is_deleted' => 0, 'Unewsletters.websiteId' => WEBSITE_ID, 'Unewsletters.is_setting' => 1],
    'contain' => ['newsletters'],
    'fields' => array(),
    'select' => array(),
    'get' => 'all',
    'order' => array('Unewsletters.id' => 'desc'),
    'limit' => '1'
);

$resultSetting = $curl->send_api($requestSetting, 'Unewsletters/index');

if ($resultSetting->code == 200) {
    $newslettesSetting = isset($resultSetting->Unewsletters[0]) ? $resultSetting->Unewsletters[0] : '';
}

if ($newslettesSetting->isedit === 1) {
    $coverImage = isset($newslettesSetting->featured_image) ? FEATURE_PHOTO . $newslettesSetting->featured_image : '';

} else {
    $coverImage = isset($newslettesSetting->Newsletters->featured_image) ? FEATURE_PHOTO . $newslettesSetting->Newsletters->featured_image : '';

}

/* * *******  End get pages ******** */
?>

    <div class="sub-page-banner mb3">
        <div class="banner-img">
            <?php
            if (!empty($coverImage)) {
                echo "<img src='$coverImage' class='img-responsive' />";
            } else {
                echo "<img src='img/newsletter-banner.png' class='img-responsive' />";
            }
            ?>
        </div>
        <div class="page-title">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2>NEWSLETTER</h2>
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
    <div class="clearfix mb2">
        <div class="container">
            <div class="col-md-10 col-md-offset-1">
                <div class="row">
                    <?php
                    if (isset($data) && !empty($data)) {
                        if($data->isedit == 1){
                            $title = isset($data->title) ? $data->title : '';
                            $image = isset($data->featured_image) ? $data->featured_image : '';
                            $content = isset($data->content) ? $data->content : '';
                        } else {
                            $title = isset($data->Newsletters->title) ? $data->Newsletters->title : '';
                            $image = isset($data->Newsletters->featured_image) ? $data->Newsletters->featured_image : '';
                            $content = isset($data->Newsletters->content) ? $data->Newsletters->content : '';
                        }
                    }
                    ?>
                    <div class="col-md-8">
                        <h3 class="font-22 font-medium mb2"><?= $title ?></h3>
                        <p class="font-18 text-justify font-light"><?= $content ?></p>
                        <a href="#" class="btn btn-pink btn-small font-medium mt2 font-18">SUBSCRIBE NOW</a>
                    </div>
                    <div class="col-md-4 mt5">
                        <?php
                            if (!empty($image)){
                                echo "<img src='$image' class='img-responsive'/>";
                            } else {
                                echo "<img src='img/newsletter-inner-img.png' class='img-responsive'/>";
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php require_once('footer.php'); ?>