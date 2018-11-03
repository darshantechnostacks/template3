<?php
require_once('header.php');

// $about_data = array();
$data['websiteId'] = WEBSITE_ID;
$settings_data = $curl->send_api($data, 'Uaboutus/GetSetting');


$settings = array();
if (!empty($about_data) && $about_data->code == 200) {
    $aboutus = $about_data->Uaboutus;
    $settings = $settings_data->Uaboutus;

}
?>

<div class="sub-page-banner mb3">
    <div class="banner-img">
        <img src="img/about-banner.png" class="img-responsive" />
    </div>
    <div class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>ABOUT US</h2>
                    <h4>We love what we do and we’re good at it!</h4>
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
<div class="about-section mb5">
    <div class="container mb4 pos-relative pb4">
        <div class="row">
            <div class="col-md-12">
                <p class="font-16 text-justify"><?= strip_tags(substr($settings->description,0,100)) ?></p>
                <p class="font-16 text-justify"><?= $aboutus->description ?></p>
            </div>
        </div>
    </div>
</div>