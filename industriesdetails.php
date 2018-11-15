<?php
require_once('header.php');

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

/* * *******  End get pages ******** */
?>
<div class="page_top_wrap page_top_title page_top_breadcrumbs" style="background:url(<?php echo API_URL ?>geturl/uploads/feature_photo/<?php echo $coverImage; ?>) no-repeat 59% 49%;max-height: 250px;background-size: cover;" >
    <div class="content_wrap">
        <div class="breadcrumbs">
            <a class="breadcrumbs_item home" href="index.php">Home</a>
            <span class="breadcrumbs_delimiter"></span>
            <a class="breadcrumbs_item home" href="industries.php">Industries</a>
            <span class="breadcrumbs_delimiter"></span>
            <span class="breadcrumbs_item current">Industries Detail</span>
        </div>
        <h1 class="page_title">Industries Detail</h1>
    </div>
</div>

<div class="page_content_wrap">
    <div class="content_wrap">
        <div class="content1">
            <article class="post_item post_item_excerpt post has-post-thumbnail">
                <div class="post_content clearfix">
                    <?php if (isset($data) && !empty($data)) { ?>
                        <h3 class="post_title">
                            <span class="post_icon icon-book-2"> </span>
                             <?php 
                            if($data->isedit == 1){
                            ?>
                            <?php echo strtoupper($data->title); ?>
                            <?php }else{ 
                             echo strtoupper($data->Industries->title);
                            } ?>
                            
                        </h3>
                        <div class="post_info">
                            <span class="post_info_item post_info_posted">
                            </span>
                        </div>
                        <div class="post_descr">
                             <?php 
                            if($data->isedit == 1){
                             echo str_replace("{company_name}",$homePages->firm_name,$data->page_content); 
                             }else{
                                 echo str_replace("{company_name}",$homePages->firm_name,$data->Industries->industriecontents[$set_no-1]->contents); 
                             }?>
                          
                        </div>
                    <?php } ?>
                </div>
            </article>
        </div>
    </div>
</div>


<?php require_once('footer.php'); ?>				
