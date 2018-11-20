<?php
require_once('header.php');
$slug = isset($_GET['id']) ? $_GET['id'] : '';


$bannerImage = '';
//get setting details
$setting = array();
$settingReq = array(
    'conditions' => ['Utaxcuts.is_deleted' => 0, 'Utaxcuts.is_setting' => 1, 'Utaxcuts.websiteId' => WEBSITE_ID],
    'contain' => ['taxcuts'],
    'fields' => array(),
    'select' => array(),
    'get' => 'all',
    'order' => array('Utaxcuts.id' => 'desc'),
    'limit' => 1,
);

$resultSettings = $curl->send_api($settingReq, 'Utaxcuts/index');
if ($resultSettings->code == 200 && !empty($resultSettings->Utaxcuts)) {
    $settingDetails = $resultSettings->Utaxcuts[0];
} else {
    $settingDetails = $resultSettings->Utaxcuts;
}
if (!empty($settingDetails)) {
    if ($settingDetails->isedit == 1) {
        $bannerImage = isset($settingDetails->featured_image) ? FEATURE_PHOTO . $settingDetails->featured_image : '';
        $defaultContent = $settingDetails->page_content;
    } else {
        $bannerImage = isset($settingDetails->Taxcuts->featured_image) ? FEATURE_PHOTO . $settingDetails->Taxcuts->featured_image : '';
        $defaultContent = $settingDetails->Taxcuts->contents;
    }
} else {
    $bannerImage = '';
    $defaultContent = '';
}


//get Tax Cuts
$reqtaxdue = array();
$reqtaxdue = array(
    'conditions' => ['Taxcuts.is_deleted' => 0, 'Taxcuts.is_setting' => 0, 'Taxcuts.status' => 1, 'Taxcuts.page_slug' => $slug],
    'contain' => ['taxcutscategories'],
    'fields' => array(),
    'select' => array(),
    'get' => 'all',
    'order' => array('Taxcuts.id' => 'desc'),
    'limit' => 1
);

$resultTaxcuts = $curl->send_api($reqtaxdue, 'Taxcuts/index');

//initlization
$taxcutslist = array();
if (!empty($resultTaxcuts) && ($resultTaxcuts->code == 200) && $resultTaxcuts->Taxcuts) {
    $taxcutslist = $resultTaxcuts->Taxcuts[0];
} else {
    $taxcutslist = array();
}
$category = array();
?>
<div class="sub-page-banner mb3">
    <div class="banner-img">
        <?php
        if (!empty($bannerImage)) {
            echo "<img src='$bannerImage' class='img-responsive' />";
        } else {
            echo '<img src="img/tax_cut_banner.jpeg" class="img-responsive" />';
        }
        ?>
    </div>
    <div class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>TAX CUTS & JOB ACTS</h2>
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

<div class="page_content_wrap padding_top_middle padding_bottom_middle">
    <div class="align-items-start content_wrap d-flex flex-wrap justify-spacebetween">
        <div class="container">
            <?php
            if (!empty($taxcutslist)) {
                ?>
                <h3 class="font-medium mb2"><?= $taxcutslist->title ?></h3>
                <p class="font-16 mb2 font-light text-justify"><?= $taxcutslist->contents ?></p>
            <?php } else { ?>
                <h1>No Record Found.</h1>
            <?php } ?>
        </div>
    </div>
</div>

<div class="newsletter-sec text-white">
    <div class="container">
        <div class="row d-flex align-items-center flex-wrap text-white">
            <div class="col-md-6 col-xs-12">
                <h3 class="font-medium mb1 mt0 text-uppercase">newsletter</h3>
                <p class="mb0 font-16 font-medium">Subscribe to your monthly newsletter</p>
            </div>
            <div class="col-md-6 col-xs-12">
                <form method="POST" name="frmsubscription" id="frmsubscription">
                    <div class="clearfix">
                        <div class="form-group">
                            <label for="first_name" class="font-regular">Enter First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name"/>
                        </div>
                        <div class="form-group">
                            <label for="last_name" class="font-regular">Enter Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name"/>
                        </div>
                        <div class="form-group">
                            <label for="subemail" class="font-regular">Enter Your Email</label>
                            <input type="text" class="form-control" id="subemail" name="subemail"/>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-pink"
                                   title="Submit" id="subscribe_button" value="Subscribe"
                                   name="subscribe">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Ajax loader-->
<!-- End Ajax loader-->
<?php require_once('footer.php'); ?>

<script type='text/javascript'>


    $(document).ready(function () {
        $(document).on('click', '.job-act-list a', function () {
            $('html,body').animate({
                scrollTop: $($(this).attr('href')).offset().top - $('.top_panel_fixed .top_panel_wrap').outerHeight()
            }, 500);
        });

    });
</script>