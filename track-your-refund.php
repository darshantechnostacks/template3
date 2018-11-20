

<?php
require_once('header.php');

//get settings data

$curl = new CURL();
$request = array();

$request = array(
    'conditions' => ['Utracksrefunds.is_deleted' => 0, 'Utracksrefunds.websiteId' => WEBSITE_ID, 'Utracksrefunds.is_setting' => 1],
    'contain' => ['tracksrefunds'],
    'fields' => array(),
    'select' => array(),
    'get' => 'all',
    'order' => array('Utracksrefunds.id' => 'desc'),
    'limit' => '1'
);

$result = $curl->send_api($request, 'Utracksrefunds/index');
$settings = array();
$content = '';
$url = '';
$coverImage = '';
if (!empty($result) && $result->Utracksrefunds) {
    $settings = $result->Utracksrefunds[0];

    if (isset($settings) && $settings->isedit == 1) {
        $coverImage = isset($settings->featured_image)?$settings->featured_image:'';
        $url = $settings->url;
        $content = $settings->page_content;
    } else {
        $coverImage = isset($settings->Tracksrefunds->featured_image)?$settings->Tracksrefunds->featured_image:"";
        $url = $settings->Tracksrefunds->url;
        $content = $settings->Tracksrefunds->page_content;
    }
}



?>
<link href="css/map-style.css" rel="stylesheet">
<div class="sub-page-banner">
    <div class="banner-img">
        <img src="img/blog-banner.png" class="img-responsive" />
    </div>
    <div class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Track Your Refund</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="about-section mb1" style="margin-top:50px;">
    <div class="container">
            <div class="row">
    
    <p class="text-justify margin_bottom_mini"><?php echo $content;?></p>
    <a href="<?php echo $url; ?>" target="_blank" class="btn btn-orange btn-radius">Check your Federal Refund</a>
    <div class="" ">
    <iframe src="map.php" width="100%" height="100%" frameborder="0" scrolling="no"  style="min-height: 500px;"></iframe>
    </div>
            </div>
        </div>
</div>


<?php require_once('footer.php'); ?>				


</body>

</html>