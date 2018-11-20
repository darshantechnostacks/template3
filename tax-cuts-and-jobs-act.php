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
    'conditions' => ['Taxcuts.is_deleted' => 0, 'Taxcuts.status' => 1,'Taxcutscategories.is_deleted'=>0,'Taxcutscategories.status'=>1],
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
}
?>
<div class="clearfix mb4 mt4">
    <div class="container">
        <div class=""><?php echo $defaultContent; ?></div>

        <?php
        if (!empty($listArray)) {
            foreach ($listArray as $key => $value) {

                if (in_array($key, $category)) {
                    ?>

                    <h2><?php echo $key; ?></h2>
                    <div class="font-17 font-light"><?php echo isset($categoryContent[$key]) ? $categoryContent[$key] : "" ?></div>
                    <?php if (!empty($value)) { ?>
                        <ul class="listing-true-icon">
                        <?php foreach ($value as $list) {
                            ?>
                                <li class="mb2">
                                    <a href="tax-cuts-and-jobs-act-details.php?id=<?php echo $list['page_slug']; ?>"> <h3 class="font-17 font-medium"><?php echo $list['title']; ?></h3></a>
                                    <p class="font-14 font-light"><?php echo substr(strip_tags($list['contents']), 2, 250); ?></p>
                                </li>



                <?php } ?>
                        </ul>
                        <?php } ?>

                <?php } ?>

                <?php
            }
        }else{ ?>
            <h2>No record found.</h2>
        <?php }  ?>

    </div>
</div>

<?php require_once('footer.php'); ?>
 