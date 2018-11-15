<?php require_once('header.php');

$id = isset($_GET['id']) ? $_GET['id'] : '';
$settingGuideCategory = $curl->send_api(array(), 'guideCategory/GetSetting');
$settingGuide = isset($settingGuideCategory->GuideCategory) ? $settingGuideCategory->GuideCategory : '';

$request = array(
    'conditions' => array('(GuideCategory.status = 1)'),
    'id' => array('GuideCategory.id = "' . $id . '"'),
    'contain' => array('SubCategories'),
    'fields' => array(),
    'select' => array(),
    'order' => array('GuideCategory.id' => 'desc'),
);
$guideCategory = $curl->send_api($request, 'guideCategory/index');
//p($guideCategory);
$resultGuideCategory = isset($guideCategory->GuideCategory) ? $guideCategory->GuideCategory[0] : '';
$subCategory = isset($resultGuideCategory->sub_categories) ? $resultGuideCategory->sub_categories : '';

$guidBanner = !empty($settingGuide->banner) ? $settingGuide->banner : '1537364753_613913.jpg';
$guideDescription = !empty($resultGuideCategory->description) ? $resultGuideCategory->description : '';
$guideName = !empty($resultGuideCategory->name) ? $resultGuideCategory->name : '';
?>
    <header id="loadHeader" class="top_panel_wrap bg_tint_light" data-active="Tax Guide"></header>
    <div class="page_top_wrap page_top_title page_top_breadcrumbs"
         style="background:url(<?= API_URL ?>/geturl/uploads/feature_photo/<?= $guidBanner ?>) no-repeat 59% 49%;max-height: 250px;background-size: cover;">
        <div class="content_wrap">
            <div class="breadcrumbs">
                <a class="breadcrumbs_item home" href="index.php">Home</a>
                <span class="breadcrumbs_delimiter"></span>
                <a class="breadcrumbs_item home" href="tax-guide.php">Tax Center</a>
                <span class="breadcrumbs_delimiter"></span>
                <span class="breadcrumbs_item current">Tax Guide</span>
            </div>
            <h1 class="page_title"><?= $guideName ?></h1>
        </div>
    </div>
    <div class="container padding_bottom_small padding_top_small">
        <div class="align-items-start content_wrap d-flex flex-wrap justify-spacebetween">
            <div class="content">
                <p><?= $guideDescription ?></p>
                <div class="d-flex flex-wrap row">
                    <?php
                    foreach ($subCategory as $category) {
                        ?>
                        <div class="col-md-6 col-sm-4 col-xs-12 margin_bottom_mini">
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

            <div id="sidebar" class="sidebar widget_area bg_tint_light sidebar_style_light" role="complementary">
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
                        <button type="submit" id="submitnsubscription" name="subscribe_submit"
                                class="sc_button button-hover sc_button_square sc_button_style_red sc_button_size_mini"
                                data-text="Submit">Submit
                        </button>
                    </div>
                </aside>
            </div>
        </div>
    </div>
    <div id="loadFooter"></div>
    <div class="overlay" style="display: none;">
    </div>
    <div class="loadingLoader" style="display: none;">
        <img src="images/loader.gif">
    </div>
<?php require_once('footer.php'); ?>