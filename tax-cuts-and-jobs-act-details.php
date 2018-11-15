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
        $bannerImage = $settingDetails->featured_image;
        $defaultContent = $settingDetails->page_content;
    } else {
        $bannerImage = $settingDetails->Taxcuts->featured_image;
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

<div class="page_top_wrap page_top_title page_top_breadcrumbs" style="background:url(<?php echo API_URL; ?>geturl/uploads/feature_photo/<?php echo $bannerImage; ?>) no-repeat 59% 49%;max-height: 250px;background-size: cover;">
    <div class="content_wrap">
        <div class="breadcrumbs">
            <a class="breadcrumbs_item home" href="index.php">Home</a>
            <span class="breadcrumbs_delimiter"></span>
            <a class="breadcrumbs_item home" href="tax-cuts-and-jobs-act.php">Tax Cuts & Jobs Act</a>
            <span class="breadcrumbs_delimiter"></span>
            <span class="breadcrumbs_item current">Tax Cuts & Jobs Act Details</span>
        </div>
        <h1 class="page_title">Tax Cuts and Jobs Act</h1>
    </div>
</div>
<div class="page_content_wrap padding_top_middle padding_bottom_middle">
    <div class="align-items-start content_wrap d-flex flex-wrap justify-spacebetween">
        <div class="content">
            <?php
            if (!empty($taxcutslist)) {
                ?>
                <h3 class="info-text"><?php echo $taxcutslist->title; ?></h3>
                <!--<label class="text-muted" title="December 18, 2017">December 18, 2017</label>-->
                <?php echo $taxcutslist->contents; ?>
            <?php } else { ?>
                <h1>No Record Found.</h1>
            <?php } ?>
            <div>
            </div>
        </div>
        <div class="sidebar widget_area bg_tint_light sidebar_style_light" role="complementary">
            <aside class="widget widget_categories new news-subscribe-sidebar">
                <h5 class="widget_title text-center">Subscribe to our Newsletter</h5>
                <form id="frmsubscription" name="frmsubscription" method="POST" action="#">
                    <div class="label_over margin_bottom_small">
                        <input type="text" name="first_name" id="first_name" placeholder="First Name *" required>
                    </div>
                    <div class="label_over margin_bottom_small">
                        <input type="text" name="last_name" id="last_name" placeholder="Last Name *" required>
                    </div>
                    <div class="label_over margin_bottom_small">
                        <input type="email" id="subemail" name="subemail" placeholder="Email *" required>
                    </div>


                    <div class="squareButton sc_button_size sc_button_style_global global">
                        <button type="submit" id="submitnsubscription" name="subscribe_submit" class="" >Submit</button>
                    </div>
                </form>
            </aside>
        </div>
    </div>
</div>


<!-- Ajax loader-->
<div class="overlay" style="display: none;">
</div>
<div class="loadingLoader" style="display: none;">
    <img src="images/loader.gif">
</div>
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