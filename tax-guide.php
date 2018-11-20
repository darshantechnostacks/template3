<?php require_once('header.php');

$settingGuideCategory = $curl->send_api(array(), 'guideCategory/GetSetting');
$settingGuide = !empty($settingGuideCategory->GuideCategory) ? $settingGuideCategory->GuideCategory : '';

$request = array(
    'conditions' => array('(GuideCategory.pid = 0 or GuideCategory.pid is NULL)', '(GuideCategory.status = 1)'),
    'contain' => array(),
    'fields' => array(),
    'select' => array(),
    'order' => array('GuideCategory.id' => 'desc'),
);
$guideCategory = $curl->send_api($request, 'guideCategory/index');
$resultGuideCategory = !empty($guideCategory->GuideCategory) ? $guideCategory->GuideCategory : '';

$guidBanner = !empty($settingGuide->banner) ? FEATURE_PHOTO . $settingGuide->banner : '';
$guideDescription = !empty($settingGuide->description) ? $settingGuide->description : '';
?>
    <div class="sub-page-banner mb3">
        <div class="banner-img">
            <?php
            if (!empty($guidBanner)) {
                echo "<img src='$guidBanner' class='img-responsive' />";
            } else {
                echo '<img src="img/tax_guide_banner.jpeg" class="img-responsive" />';
            }
            ?>
        </div>
        <div class="page-title">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Tax Guide</h2>
                    </div>
                </div>
                <h1 class="page_title"><?= $guideName ?></h1>
            </div>
        </div>
        <ul class="top-contact-info">
            <li><i class="icon-mobile"></i><?= isset($homePages->firm_phone) ? $homePages->firm_phone : "" ?></li>
            <li><i class="icon-email"></i> <a
                        href="mailtto:<?= isset($homePages->firm_email) ? $homePages->firm_email : "" ?>"><?= isset($homePages->firm_email) ? $homePages->firm_email : "" ?></a>
            </li>
        </ul>
    </div>
    <div class="clearfix mb4">
        <div class="container">
            <p class="font-16 mb4 font-light"><?= $guideDescription ?></p>
            <div class="d-flex flex-wrap row">
                <?php
                foreach ($resultGuideCategory as $category) {
                    $name = !empty($category->name) ? $category->name : '';
                    $description = !empty($category->description) ? $category->description : '';
                    ?>
                    <div class="col-md-4 col-sm-6 mb2">
                        <a href="tax-guide-inner.php?id=<?= $category->id ?>"
                           class="grid-link link-overlay border border-orange" data-overlay="View">
                            <div class="content">
                                <h3 class="title mb1 mt0 font-medium"><?= $name ?></h3>
                                <p class="mb0 font-regular">
                                    <?= substr($description, 0, 100) . ' ...' ?>
                                </p>
                            </div>
                        </a>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
<?php require_once('footer.php'); ?>