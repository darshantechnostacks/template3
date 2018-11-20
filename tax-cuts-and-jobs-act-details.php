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

if (!empty($bannerImage)) {
    $coverImageUrl = API_URL . 'geturl/uploads/feature_photo/' . $bannerImage;
} else {
    $coverImageUrl = 'img/tax_cut_banner.jpeg';
}
?>

<div class="sub-page-banner">
    <div class="banner-img">
        <img src="<?php echo $coverImageUrl; ?>" class="img-responsive" style="max-height: 250px;background-size: cover;width: 100%; " />
    </div>
    <div class="page-title text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Tax Cuts & Job Acts</h2>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="clearfix mb4 mt4">
    <div class="container">
       <?php
            if (!empty($taxcutslist)) {
                ?>
                <h2 ><?php echo $taxcutslist->title; ?></h2>
                <div class="font-14 font-light">  <?php echo $taxcutslist->contents; ?></div>
            <?php } else { ?>
                <h1>No Record Found.</h1>
            <?php } ?>

    </div>
</div>

<?php require_once('footer.php'); ?>
 