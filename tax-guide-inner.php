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

$guidBanner = !empty($settingGuide->banner) ? $settingGuide->banner : '';
$guideDescription = !empty($resultGuideCategory->description) ? $resultGuideCategory->description : '';
$guideName = !empty($resultGuideCategory->name) ? $resultGuideCategory->name : '';
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
            <div class="font-16  font-light"><?php echo  $guideDescription; ?></div>
            <h1 class="mb4"> <?= $guideName ?></h1>
                <div class="clearfix"></div>
            <div class="d-flex flex-wrap row">
               
                  <?php
            foreach ($subCategory as $category){
                    ?>
                <div class="col-md-4 col-sm-6 mb2">
                    <a href="tax-guide-inner.php?id=<?= $category->id ?>" class="grid-link link-overlay border border-orange" data-overlay="View">
                    <div class="inner-box clearfix">
                        
                        <div class="content">
                            <div class="title-block">
                                <h2 class="title"><?= !empty($category->name) ? $category->name : '' ?></h2>
                            </div>
                            <div class="mb0 font-regular">
                               <?= !empty($category->description) ?  $category->description  : '' ?>
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