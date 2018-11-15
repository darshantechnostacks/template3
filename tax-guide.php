<?php require_once('header.php');

$settingGuideCategory = $curl->send_api(array(),'guideCategory/GetSetting');
$settingGuide = !empty($settingGuideCategory->GuideCategory) ? $settingGuideCategory->GuideCategory : '';

$request = array(
    'conditions' => array('(GuideCategory.pid = 0 or GuideCategory.pid is NULL', 'GuideCategory.status = 1)'),
    'contain' => array(),
    'fields' => array(),
    'select' => array(),
    'order' => array('GuideCategory.id' => 'desc'),
);
$guideCategory = $curl->send_api($request,'guideCategory/index');
$resultGuideCategory = !empty($guideCategory->GuideCategory) ? $guideCategory->GuideCategory : '';

$guidBanner = !empty($settingGuide->banner) ? $settingGuide->banner : '1537364753_613913.jpg';
$guideDescription = !empty($settingGuide->description) ? $settingGuide->description : '';
?>
    <header id="loadHeader" class="top_panel_wrap bg_tint_light" data-active="Tax Guide"></header>
    <div class="page_top_wrap page_top_title page_top_breadcrumbs"
         style="background:url(<?= API_URL ?>geturl/uploads/icon/<?= $guidBanner ?>) no-repeat 59% 49%;max-height: 250px;background-size: cover;">
        <div class="content_wrap">
            <div class="breadcrumbs">
                <a class="breadcrumbs_item home" href="index.php">Home</a>
                <span class="breadcrumbs_delimiter"></span>
                <span class="breadcrumbs_item current">Tax Guide</span>
            </div>
            <h1 class="page_title">Tax Guide</h1>
        </div>
    </div>
    <div class="container padding_top_mini">
        <p><?= $guideDescription ?></p>
        <div class="d-flex flex-wrap row">
            <?php
            foreach ($resultGuideCategory as $category){
                    ?>
                    <div class="col-sm-4 col-xs-12 margin_bottom_mini">
                        <a href="tax-guide-inner.php?id=<?= $category->id ?>"
                           class="grid-link border border-danger link-overlay margin_bottom_mini padding_left_mini padding_right_mini padding_bottom_mini padding_top_mini"
                           data-overlay="View">
                            <h4 class="normal"><?= !empty($category->name) ? $category->name : '' ?></h4>
                            <p><?= !empty($category->description) ? $category->description : '' ?></p>
                        </a>
                    </div>
                    <?php
                }
            ?>
        </div>
    </div>
    <div id="loadFooter"></div>
    <div class="overlay" style="display: none;"></div>
    <div class="loadingLoader" style="display: none;">
        <img src="images/loader.gif">
    </div>
<?php require_once('footer.php'); ?>