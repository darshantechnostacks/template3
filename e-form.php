<?php
require_once('header.php');

$settingEForm = $curl->send_api(array(), 'eForm/GetSetting');
$settingEFormResult = !empty($settingEForm->EForm) ? $settingEForm->EForm : '';

$eFormBanner = !empty($settingEFormResult->cover_image) ? FEATURE_PHOTO . $settingEFormResult->cover_image : 'http://18.221.49.101/cpacake/geturl/uploads/feature_photo/1537364753_613913.jpg';
$eFormDescription = !empty($settingEFormResult->description) ? $settingEFormResult->description : '';

$request = array(
    'conditions' => array('(status = 1)'),
    'contain' => array(),
    'fields' => array(),
    'select' => array(),
    'order' => array('id' => 'desc'),
);
$eFormCategory = $curl->send_api($request, 'eFormCategory/index/');
$resultGuideCategory = !empty($eFormCategory->EFormCategory) ? $eFormCategory->EFormCategory : '';

$requestEForm = array(
    'conditions' => array('EForm.status = 1'),
    'contain' => array(),
    'fields' => array(),
    'select' => array(),
    'order' => array('EForm.id' => 'desc'),
);
$eForm = $curl->send_api($requestEForm, 'eForm/index/');
$resultEForm = !empty($eForm->EForm) ? $eForm->EForm : '';


$listid = array();
if (!empty($eForm) && $eForm->EForm) {
    foreach ($eForm->EForm as $key => $value) {
        $listid[] = $value->category_id;
    }
}

?>
    <header id="loadHeader" class="top_panel_wrap bg_tint_light" data-active="E-file authorization"></header>
    <div class="page_top_wrap page_top_title page_top_breadcrumbs"
         style="background:url(<?= $eFormBanner ?>) no-repeat 59% 49%;max-height: 250px;background-size: cover;">
        <div class="content_wrap">
            <div class="breadcrumbs">
                <a class="breadcrumbs_item home" href="index.php">Home</a>
                <span class="breadcrumbs_delimiter"></span>
                <a class="breadcrumbs_item home" href="resources.php">Resources</a>
                <span class="breadcrumbs_delimiter"></span>
                <span class="breadcrumbs_item current">E-file authorization</span>
            </div>
            <h1 class="page_title">E-file authorization</h1>
        </div>
    </div>
<?php
$category = array();
$listArray = array();
$categoryContent = array();

if (!empty($resultEForm)) {
    foreach ($resultEForm as $key => $value) {

        if (in_array($value->category_id, $listid)) {
            $categoryName = $value->e_form_category->name;
            if (!in_array($value->e_form_category->name, $categoryContent)) {
                $categoryContent[$value->e_form_category->name] = $value->e_form_category->name;
            }
            if (!in_array($categoryName, $category)) {
                $category[] = $categoryName;
                $listArray[$categoryName][$key]['title'] = $value->title;
                $listArray[$categoryName][$key]['pdf_file'] = $value->pdf_file;
                $listArray[$categoryName][$key]['cover_image'] = $value->cover_image;

            } else {
                $listArray[$categoryName][$key]['title'] = $value->title;
                $listArray[$categoryName][$key]['pdf_file'] = $value->pdf_file;
                $listArray[$categoryName][$key]['cover_image'] = $value->cover_image;
            }
        }
    }
    $i = 1;
    foreach ($listArray as $key => $value) {
        if ($i % 2 != 0) {
            ?>
            <div class="container padding_bottom_small padding_top_small">
                <h2 class="sc_title sc_align_center aligncenter fig_border">Download the latest E-Forms below</h2>
                <h4 class="text-center margin_bottom_small"><?= $key ?></h4>
                <div class="d-flex flex-wrap row">
                    <?php
                    foreach ($value as $val) {
                        ?>
                        <div class="col-md-4 col-sm-6 col-xs-12 margin_bottom_mini">
                            <a href="<?= PDF_URL . $val['pdf_file'] ?>" download="<?= PDF_URL . $val['pdf_file'] ?>"
                               class="adv-card-grey adv-card d-flex flex-column margin_bottom_mini">
                                <div class="video-thumb d-flex align-items-center justify-content-center"
                                     style="background-image: url(<?= FEATURE_PHOTO . $val['cover_image'] ?>);"></div>
                                <div class="adv-card-content flex-grow-1">
                                    <span class="adv-card-title text-center"><?= $val['title'] ?></span>
                                </div>
                            </a>
                        </div>
                        <?php
                    } ?>
                </div>
            </div>
            <?php
        } else {
            ?>
            <div class="grey_section">
                <div class="container padding_bottom_small padding_top_small">
                    <h4 class="text-center margin_bottom_small">Individual Forms</h4>
                    <div class="d-flex flex-wrap row">
                        <?php
                        foreach ($value as $val) {
                            ?>
                            <div class="col-md-4 col-sm-6 col-xs-12 margin_bottom_mini">
                                <a href="<?= PDF_URL . $val['pdf_file'] ?>" download="<?= PDF_URL . $val['pdf_file'] ?>" class="adv-card d-flex flex-column margin_bottom_mini">
                                    <div class="video-thumb d-flex align-items-center justify-content-center"
                                         style="background-image: url(<?= FEATURE_PHOTO . $val['cover_image'] ?>);"></div>
                                    <div class="adv-card-content flex-grow-1">
                                        <span class="adv-card-title"><?= $val['title'] ?></span>
                                    </div>
                                </a>
                            </div>
                            <?php
                        } ?>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
        <?php
        $i = $i + 1;
    }
} else {
    echo '<div class="container">';
    echo ' <h1>No Record Found.</h1>';
    echo '</div>';
}
?>