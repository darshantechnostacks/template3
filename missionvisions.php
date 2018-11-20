<?php 
require_once('header.php');
$curl = new CURL();
$request = array();

$request = array(
    'conditions' => ['Umissionvisions.is_deleted' => 0, 'Umissionvisions.websiteId' => WEBSITE_ID, 'Umissionvisions.is_setting' => 0],
    'contain' => ['missionvisions', 'missionvisions.missionvisioncontent'],
    'fields' => array(),
    'select' => array(),
    'get' => 'all',
    'order' => array('Umissionvisions.id' => 'desc'),
    'limit' => '1'
);

$result = $curl->send_api($request, 'Umissionvisions/index');
if(!empty($result)){
    if(isset($result->Umissionvisions[0]) && ($result->Umissionvisions[0]->isedit == 1) ){
        $detailsContent = isset($result->Umissionvisions[0]) ?$result->Umissionvisions[0]->page_content :"";
    }else{
        $detailsContent = isset($result->Umissionvisions[0]) ?$result->Umissionvisions[0]->Missionvisions->missionvisioncontent[$set_no-1]->contents :"";
       
    }
}
//get setting information
$results = array();
//get settings details
$requestSetting = array(
    'conditions' => ['Umissionvisions.is_deleted' => 0, 'Umissionvisions.websiteId' => WEBSITE_ID, 'Umissionvisions.is_setting' => 1],
    'contain' => ['missionvisions'],
    'fields' => array(),
    'select' => array(),
    'get' => 'all',
    'order' => array('Umissionvisions.id' => 'desc'),
    'limit' => '1'
);

$results = $curl->send_api($requestSetting, 'Umissionvisions/index');

if ($results->code == 200) {
    $bannerSetting = isset($results->Umissionvisions[0]) ? $results->Umissionvisions[0] : '';
}

if (isset($bannerSetting->isedit) && $bannerSetting->isedit === 1) {
    $coverImage = $bannerSetting->featured_image;
    $content = $bannerSetting->page_content;
} else {
    $coverImage = isset($bannerSetting->Missionvisions->featured_image)?$bannerSetting->Missionvisions->featured_image:"";
    $content = isset($bannerSetting->Missionvisions->page_content)?$bannerSetting->Missionvisions->page_content:"";
}

?>
    <div class="sub-page-banner">
        <div class="banner-img">
            <?php if(!empty($coverImage)){?>
            <img src="<?php echo API_URL ?>geturl/uploads/feature_photo/<?php echo $coverImage; ?>" class="img-responsive" style="max-height: 250px;background-size: cover;" />
            <?php }else{ ?>
                <img src="img/vision-mission-banner.png" class="img-responsive" style="max-height: 250px;background-size: cover;" />
            <?php } ?>
            
        </div>
        <div class="page-title">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h4>Mission Visions</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="about-section mb1">
        <div class="container">
            <div class="row ">
                <div class="col-md-12">
                         <?php echo str_replace('{company_name}', $homePages->firm_name, $content); ?><br/>
                         <?php echo str_replace('{company_name}', $homePages->firm_name, $detailsContent); ?>
                </div>
            </div>
            
        </div>
    </div>
    <?php require_once('footer.php'); ?>

   