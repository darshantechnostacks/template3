<?php require_once('header.php'); 
$curl = new CURL();

/* * ******** Get pages ***** */
$id = isset($_GET['slug']) ? $_GET['slug'] : '';

$request = array(
    'conditions' => ['Uindustries.is_deleted' => 0, 'Uindustries.page_slug' => $id, 'Uindustries.websiteId' => WEBSITE_ID],
    'contain' => ['industries', 'industries.industriecontents'],
    'fields' => array(),
    'select' => array(),
    'get' => 'all',
    'order' => array('Uindustries.id' => 'desc'),
    "limit" => 1,
);

$result = $curl->send_api($request, 'Uindustries/index');

$data = array();

if ($result->code == 200) {
    $data = isset($result->Uindustries[0]) ? $result->Uindustries[0] : '';
}

$resultSetting = array();
//get settings details
$requestSetting = array(
    'conditions' => ['Uindustries.is_deleted' => 0, 'Uindustries.websiteId' => WEBSITE_ID, 'Uindustries.is_setting' => 1],
    'contain' => ['industries'],
    'fields' => array(),
    'select' => array(),
    'get' => 'all',
    'order' => array('Uindustries.id' => 'desc'),
    'limit' => '1'
);

$resultSetting = $curl->send_api($requestSetting, 'Uindustries/index');

if ($resultSetting->code == 200) {
    $bannerSetting = isset($resultSetting->Uindustries[0]) ? $resultSetting->Uindustries[0] : '';
}

if (isset($bannerSetting->isedit) && $bannerSetting->isedit === 1) {
    $coverImage = $bannerSetting->featured_image;
    $content = $bannerSetting->page_content;
} else {
    $coverImage = $bannerSetting->Industries->featured_image;
    $content = $bannerSetting->Industries->page_content;
}
//img/industrie-inner-banner.png
/* * *******  End get pages ******** */
?>

    <div class="sub-page-banner mb4">
        <div class="banner-img">
            <img src="<?php echo API_URL ?>geturl/uploads/feature_photo/<?php echo $coverImage; ?>" class="img-responsive" style="max-height: 250px;background-size: cover;" />
        </div>
        <div class="page-title">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h4>Industries Detail</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="clearfix mb4">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                     <?php if (isset($data) && !empty($data)) { ?>
                    <h2>
                     <?php 
                            if($data->isedit == 1){
                                echo strtoupper($data->title); 
                             }else{ 
                             echo strtoupper($data->Industries->title);
                            } ?>
                    </h2>
                     <div class="font-16">
                     <?php 
                            if($data->isedit == 1){
                             echo str_replace("{company_name}",$homePages->firm_name,$data->page_content); 
                             }else{
                                 echo str_replace("{company_name}",$homePages->firm_name,$data->Industries->industriecontents[$set_no-1]->contents); 
                             }?>
                     </div>
                     <?php }else{ ?>
                    <h3>No record found.</h3>
                     <?php } ?>
                    
                </div>
            </div>
        </div>
    </div>
<?php require_once ('footer.php'); ?>