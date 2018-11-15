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

?>


<?php
if (isset($bannerSetting->isedit) && $bannerSetting->isedit === 1) {
    $coverImage = $bannerSetting->featured_image;
    $content = $bannerSetting->page_content;
} else {
    $coverImage = isset($bannerSetting->Missionvisions->featured_image)?$bannerSetting->Missionvisions->featured_image:"";
    $content = isset($bannerSetting->Missionvisions->page_content)?$bannerSetting->Missionvisions->page_content:"";
}

?>

<div class="page_top_wrap page_top_title page_top_breadcrumbs" style="background:url(<?php echo API_URL ?>geturl/uploads/feature_photo/<?php echo $coverImage; ?>) no-repeat 59% 49%;max-height: 250px;background-size: cover;" >
        <div class="content_wrap">
            <div class="breadcrumbs">
                <a class="breadcrumbs_item home" href="index.php">Home</a>
                <span class="breadcrumbs_delimiter"></span>
                <span class="breadcrumbs_item current">Mission Visions</span>
            </div>
            <h1 class="page_title">Mission Visions</h1>
        </div>
    </div>

<!-- content -->
<div class="page_content_wrap" style="padding:0px 0px;">

    <section class="white_section">
        <div class="container">
            <div class="row">
                <div class="content_wrap">
                    <div class="sc_under_title normal animated fadeInUp">
                        <?php echo str_replace('{company_name}', $homePages->firm_name, $content); ?>
                    </div>

                    
                    <div class="columns_wrap sc_columns" data-animation="animated fadeInUp normal" style="margin-top:25px;">
                        <?php echo str_replace('{company_name}', $homePages->firm_name, $detailsContent); ?>
                    </div>
                    

                </div>
              
                <div class="clearfix"></div>
              

            </div>
        </div>
    </section>

</div>

<!-- end -->

        	
    </section>
    <br/>
    <br/>
</div>
<?php require_once('footer.php'); ?>				
