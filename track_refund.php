<?php
require_once('header.php');

//get settings data

$curl = new CURL();
$request = array();


$tracksreq = array();
$tracksreq = array(
    'conditions' => ['Tracksrefunds.is_deleted' => 0,'Tracksrefunds.status' => 1,  'Tracksrefunds.is_setting' => 0],
    'contain' => ['states'],
    'fields' => array(),
    'select' => array(),
    'get' => 'all',
    'order' => array('Tracksrefunds.id' => 'desc'),

);

$Trdetails = $curl->send_api($tracksreq, 'Tracksrefunds/index');
$statArray = array();
$trlist = array();
if (!empty($Trdetails) && $Trdetails->Tracksrefunds) {
    $trlist = $Trdetails->Tracksrefunds;
    $statArray['default']['borderColor'] = '#9CA8B6';
    $statArray['default']['lakesFill'] = '#ACE9FC';
    $statArray['default']['lakesOutline'] = '#9CA8B6';
    $statArray['default']['namesColor'] = '#919191';
    $statArray['default']['mapShadow'] = '#7a7a7a';
    $kk=1;
    foreach($trlist as $key => $value){
        $statArray['st_'.$kk]['hover'] = $value->States->state_name;
        $statArray['st_'.$kk]['url'] = $value->url;
        $statArray['st_'.$kk]['target'] = "new_window";
        $statArray['st_'.$kk]['upColor'] = "#ffffff";
        $statArray['st_'.$kk]['overColor'] = "#f37f72";
        $statArray['st_'.$kk]['downColor'] = "#ce0315";
        $statArray['st_'.$kk]['enable'] =true;
        $statArray['st_'.$kk]['iso'] = "iso_".$value->States->state_code;
        $kk++;
    }
}

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
        $coverImage = isset($settings->featured_image) ? $settings->featured_image : '';
        $url = $settings->url;
        $content = $settings->page_content;
    } else {
        $coverImage = isset($settings->Tracksrefunds->featured_image) ? $settings->Tracksrefunds->featured_image : "";
        $url = $settings->Tracksrefunds->url;
        $content = $settings->Tracksrefunds->page_content;
    }
}


?>

    <div class="sub-page-banner mb3">
        <div class="banner-img">
            <img src='img/service-banner.png' class="img-responsive"/>
        </div>
        <div class="page-title">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Track Your Refund</h2>
                        <h4>We love what we do and we’re good at it!</h4>
                    </div>
                </div>
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
            <p class="text-justify margin_bottom_mini"><?php echo $content; ?></p>
            <!--    <a href="-->
            <?php //echo $url; ?><!--" target="_blank" class="sc_button_square_sm sc_button_style_red">Check your Federal Refund</a>-->
            <div class="form-group text-center col-lg-offset-4 col-lg-4">
                <select name="map_url" id="map_url" class="form-control select2" onchange="getMap($(this).val());">
                    <option value="">Select State</option>
                    <?php
                    foreach ($statArray as $key => $state){
                        if($key != 'default'){
                            echo "<option value='".$state['url']."'>".$state['hover']."</option>";
                        }
                    }
                    ?>
                </select>
            </div>
        </div>
    </div>


<?php require_once('footer.php'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>
    jQuery('.select2').select2();
    function getMap(map_url) {
        openInNewTab(map_url);
    }
    function openInNewTab(url) {
        var win = window.open(url, '_blank');
        win.focus();
    }
</script>
