<?php
require_once('header.php');
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
        $bannerImage = !empty($settingDetails->featured_image) ? FEATURE_PHOTO . $settingDetails->featured_image : '';
        $defaultContent = $settingDetails->page_content;
    } else {
        $bannerImage = !empty($settingDetails->Taxcuts->featured_image) ? FEATURE_PHOTO . $settingDetails->Taxcuts->featured_image : '';
        $defaultContent = $settingDetails->Taxcuts->contents;
    }

} else {
    $bannerImage = '';
    $defaultContent = '';
}


//get inactive details
$requtaxdue = array();
$requtaxdue = array(
    'conditions' => ['Utaxcuts.is_deleted' => 0, 'Utaxcuts.is_setting' => 0, 'Utaxcuts.websiteId' => WEBSITE_ID],
    'contain' => [],
    'fields' => array(),
    'select' => array(),
    'get' => 'all',
    'order' => array('Utaxcuts.id' => 'desc'),
);

$resultUtaxcuts = $curl->send_api($requtaxdue, 'Utaxcuts/index');

$listid = array();
if (!empty($resultUtaxcuts) && $resultUtaxcuts->Utaxcuts) {
    foreach ($resultUtaxcuts->Utaxcuts as $key => $value) {
        $listid[] = $value->taxcut_id;
    }
}


//get Tax Cuts
$reqtaxdue = array();
$reqtaxdue = array(
    'conditions' => ['Taxcuts.is_deleted' => 0, 'Taxcuts.status' => 1],
    'contain' => ['taxcutscategories'],
    'fields' => array(),
    'select' => array(),
    'get' => 'all',
    'order' => array('Taxcuts.id' => 'desc'),
);

$resultTaxcuts = $curl->send_api($reqtaxdue, 'Taxcuts/index');


//initlization
$taxcutslist = array();
if (!empty($resultTaxcuts) && ($resultTaxcuts->code == 200) && $resultTaxcuts->Taxcuts) {
    $taxcutslist = $resultTaxcuts->Taxcuts;
} else {
    $taxcutslist = array();
}
$category = array();
?>
<div class="sub-page-banner mb3">

        <?php
        if (!empty($bannerImage)) {
            echo '<div class="banner-img" style="background-image: url('.$bannerImage.')">';
            echo "</div>";
        } else {
            echo '<div class="banner-img" style="background-image: url(img/tax_cut_banner.jpeg)">';
            echo "</div>";
        }
        ?>
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
<div class="container">
<?= $defaultContent ?>
</div>

<div class="clearfix mb4">
    <div class="container">

        <?php
        $listArray = array();
        $categoryContent = array();

        if (!empty($taxcutslist)) {
            foreach ($taxcutslist as $key => $value) {

                if (!in_array($value->id, $listid)) {


                    $categoryName = $value->Taxcutscategories->name;
                    if (!in_array($value->Taxcutscategories->name, $categoryContent)) {
                        $categoryContent[$value->Taxcutscategories->name] = $value->Taxcutscategories->contents;
                    }


                    if (!in_array($categoryName, $category)) {
                        $category[] = $categoryName;
                        $listArray[$categoryName][$key]['title'] = $value->title;
                        $listArray[$categoryName][$key]['page_slug'] = $value->page_slug;
                        $listArray[$categoryName][$key]['contents'] = $value->contents;
                        $listArray[$categoryName][$key]['category_name'] = $value->Taxcutscategories->name;
                        $listArray[$categoryName][$key]['category_contents'] = $value->Taxcutscategories->contents;
                    } else {
                        $listArray[$categoryName][$key]['title'] = $value->title;
                        $listArray[$categoryName][$key]['page_slug'] = $value->page_slug;
                        $listArray[$categoryName][$key]['contents'] = $value->contents;
                        $listArray[$categoryName][$key]['category_name'] = $value->Taxcutscategories->name;
                        $listArray[$categoryName][$key]['category_contents'] = $value->Taxcutscategories->contents;
                    }
                }
            }
            foreach ($listArray as $key => $value) {
                echo '<h3 class="font-medium mb2">' . $key . '</h3>';
                echo '<p class="font-16 mb2 font-light text-justify">' . $categoryContent[$key] . '</p>';

                foreach ($value as $val) {
                    ?>
                    <a href="tax-cuts-and-jobs-act-details.php?id=<?= $val['page_slug']; ?>">
                        <h3 class="font-medium mb2"><?= $val['title'] ?></h3>
                    </a>
                    <p class="font-16 mb2 font-light text-justify"><?= $val['contents'] ?></p>
                    <?php
                }
            }
        } else {
            echo ' <h1>No Record Found.</h1>';
        }
        ?>
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