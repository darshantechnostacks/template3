<?php
require_once ('header.php');

$curl = new CURL();
$request = array();

$request = array(
    'conditions' => ['Uindustries.is_deleted' => 0, 'Uindustries.websiteId' => WEBSITE_ID, 'Uindustries.is_setting' => 0],
    'contain' => ['industries', 'industries.industriecontents'],
    'fields' => array(),
    'select' => array(),
    'get' => 'all',
    'order' => array('Uindustries.id' => 'desc'),
        //   'limit' => '4'
);

$result = $curl->send_api($request, 'Uindustries/index');

$tags = '';
$page = array();
$industries = array();
if ($result->code == 200) {
    $industries = isset($result->Uindustries[0]) ? $result->Uindustries : '';
}

$newslettesSetting = array();
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
//img/industrie-banner.png
?>


<div class="sub-page-banner mb4">
    <div class="banner-img">
        <img src="<?php echo API_URL ?>geturl/uploads/feature_photo/<?php echo $coverImage; ?>" class="img-responsive" />
    </div>
    <div class="page-title text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>INDUSTRIES</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="clearfix mb4">
    <div class="container">
        <div class="font-16 mb4 font-light">
            <?php echo $content; ?>
        </div>
        <div class="row services-inner">
            <?php
            if (!empty($industries) && isset($industries)) {
                $i = 0;
                foreach ($industries as $key => $value) {
                    ?>

                    <div class="col-md-4 col-sm-6 mb2">
                        <div class="inner-box clearfix">
                            <div class="icon-block">
                                <i class=" icon mb-3"><img src="img/services-icon.png" class="img-responsive" /></i>
                            </div>
                            <div class="content">
                                <div class="title-block">
                                    <?php if ($value->isedit == 1) { ?>
                                        <h2 class="title"><?php echo substr(trim($value->title), 0, 15); ?></h2>
                                    <?php } else { ?>
                                        <h2 class="title"><?php echo substr(trim($value->title), 0, 15); ?></h2>
                                    <?php } ?>

                                </div>
                                <p class="mb1">
                                    <?php 
                                     if ($value->isedit == 1) { 
                                         echo $details = str_replace("{company_name}", $homePages->firm_name, substr(trim($value->page_content), 0, 250));                                          
                                         }else{
                                          echo $details = str_replace("{company_name}", $homePages->firm_name, substr(trim($value->Industries->industriecontents[$set_no - 1]->contents), 0, 250)); 
                                     }
                                    ?>
                                    
                                </p>
                                <a href="industriesdetails.php?slug=<?php echo $value->page_slug ?>" class="btn-link font-regular font-13">Read More >></a>
                            </div>

                        </div>
                    </div>

                    <?php
                    $lastid = ++$i;
                }
            } else {
                ?>
                <h3>No record found.</h3>
            <?php } ?>
            <input type="hidden" id="totrecord" value="<?php echo isset($lastid) ? $lastid : 0; ?>" />

            


        </div>
        <div class="clsloadmore">

        </div>
    </div>
</div>

<?php require_once ('footer.php'); ?>

<script type="text/javascript">
    jQuery('.select2').select2();
    jQuery('#loadmore').on('click', function () {

        var post_url = 'industriesload.php';
        jQuery.ajax({
            url: post_url,
            data: {lastid: $('#totrecord').val(), cat_id: 0, tags: ''},
            type: 'post',
            dataType: 'json',
            beforeSend: function () {
                //  jQuery("#loading-image").show();
                jQuery('.loadingLoader').show();
                jQuery('.overlay').show();
            },
            success: function (data) {
                var x = jQuery('#totrecord').val();
                var y = data.last_id;
                var tot = +x + +y;

                if (data.message == '' || y < 3) {
                    $('.loadmorebtndiv').hide();
                }

                jQuery('#totrecord').val(tot);
                //jQuery('.addblog').append(data.message);
                jQuery('.clsloadmore').append(data.message);
                jQuery(".loadingLoader").hide();
                jQuery('.overlay').hide();
            }
        });
    });



</script>