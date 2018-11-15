

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

<div class="page_top_wrap page_top_title page_top_breadcrumbs" style="background:url(<?php echo API_URL ?>geturl/uploads/feature_photo/<?php echo $coverImage; ?>) no-repeat 59% 49%;max-height: 250px;background-size: cover;">
    <div class="content_wrap">
        <div class="breadcrumbs">
            <a class="breadcrumbs_item home" href="index.php">Home</a>
            <span class="breadcrumbs_delimiter"></span>
            <a class="breadcrumbs_item home" href="taxcenter.php">Tax Center</a>
            <span class="breadcrumbs_delimiter"></span>
            <span class="breadcrumbs_item current">Track Your Refund</span>
        </div>
        <h1 class="page_title">Track Your Refund</h1>
    </div>
</div>
<div class="container padding_top_small">
    <p class="text-justify margin_bottom_mini"><?php echo $content;?></p>
    <a href="<?php echo $url; ?>" target="_blank" class="sc_button_square_sm sc_button_style_red">Check your Federal Refund</a>

    <iframe src="map.php" width="100%" height="100%" frameborder="0"></iframe>

</div>
<?php require_once('footer.php'); ?>				


</body>

</html>