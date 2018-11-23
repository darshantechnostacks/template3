<?php
require_once('header.php');

$settingEForm = $curl->send_api(array(), 'eForm/GetSetting');
$settingEFormResult = !empty($settingEForm->EForm) ? $settingEForm->EForm : '';

$eFormBanner = !empty($settingEFormResult->cover_image) ? FEATURE_PHOTO . $settingEFormResult->cover_image : '';
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
    <div class="sub-page-banner mb3">
        <div class="banner-img">
            <?php
            if (!empty($eFormBanner)) {
                echo '<div class="banner-img" style="background-image: url(' . $eFormBanner . ')">';
                echo "</div>";
            } else {
                echo '<div class="banner-img" style="background-image: url(img/tax_cut_banner.jpeg)">';
                echo "</div>";
            }
            ?>
        </div>
        <div class="page-title">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2>E-file Authorization</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <?= $eFormDescription ?>
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

            } else {
                $listArray[$categoryName][$key]['title'] = $value->title;
                $listArray[$categoryName][$key]['pdf_file'] = $value->pdf_file;
            }
        }
    }

    foreach ($listArray as $key => $value) {
        ?>
        <div class="container mb3">
            <h2 class="font-medium"><?= $key ?></h2>
            <div class="row">
                <?php
                foreach ($value as $val) {
                    ?>
                    <div class="col-md-4 col-xs-12">
                        <a href="<?= PDF_URL . $val['pdf_file'] ?>" download="<?= PDF_URL . $val['pdf_file'] ?>"
                           class="d-flex file-list mb1">
                            <div class="align-items-center d-flex file-icon">
                                <i class="fa fa-3x fa-file-pdf-o"></i>
                            </div>
                            <div class="align-items-center d-flex file-content flex-grow-1">
                                <h5 class="margin_bottom_none font-medium font-size-16 file-title"><?= $val['title'] ?></h5>
                            </div>
                        </a>
                    </div>
                    <?php
                } ?>
            </div>
        </div>
        <?php
    }
} else {
    echo '<div class="container">';
    echo ' <h1>No Record Found.</h1>';
    echo '</div>';
}
?>


<?php require_once('footer.php') ?>