<?php require_once('header.php');

$settingGuideCategory = $curl->send_api(array(),'guideCategory/GetSetting');
$settingGuide = !empty($settingGuideCategory->GuideCategory) ? $settingGuideCategory->GuideCategory : '';

$request = array(
    'conditions' => array('(GuideCategory.pid = 0 or GuideCategory.pid is NULL)', '(GuideCategory.status = 1)'),
    'contain' => array(),
    'fields' => array(),
    'select' => array(),
    'order' => array('GuideCategory.id' => 'desc'),
);
$guideCategory = $curl->send_api($request,'guideCategory/index');
$resultGuideCategory = !empty($guideCategory->GuideCategory) ? $guideCategory->GuideCategory : '';

$guidBanner = !empty($settingGuide->banner) ? $settingGuide->banner : '';
$guideDescription = !empty($settingGuide->description) ? $settingGuide->description : '';

if(!empty($guidBanner)){
$bannerImage = API_URL.'geturl/uploads/feature_photo/'.$guidBanner;
}else{
    $bannerImage = 'img/tax_guide_banner.jpeg';
}
?>
    
    <div class="sub-page-banner mb4">
        <div class="banner-img">
            <img src="<?php echo $bannerImage; ?>" class="img-responsive" style="max-height: 250px;background-size: cover;width: 100%; "/>
        </div>
        <div class="page-title text-center">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Tax Guide</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<div class="mb1">
        <div class="container">
            <div class="font-16 mb4 font-light"><?php echo $guideDescription; ?></div>
            <div class="d-flex flex-wrap row">
                 <?php
            foreach ($resultGuideCategory as $category){
                    ?>
                <div class="col-md-4 col-sm-6 mb2">
                     <a href="tax-guide-inner.php?id=<?= $category->id ?>" class="grid-link link-overlay border border-orange" data-overlay="View">
                    <div class="inner-box clearfix">
                        
                        <div class="content">
                            <div class="title-block">
                                <h2 class="title"><?= !empty($category->name) ? $category->name : '' ?></h2>
                            </div>
                            <div class="mb0 font-regular">
                               <?= !empty($category->description) ?  (substr($category->description, 0,100))  : '' ?>
                            </div>
                        </div>
                    </div>
                     </a>
                </div>
            <?php }?>
                
            </div>
        </div>
</div>
    
    
<?php require_once('footer.php'); ?>