<?php
require_once('header.php');
$curl = new CURL();
$request = array();

$request = array(
    'conditions' => ['Unewsletters.is_deleted' => 0, 'Unewsletters.websiteId' => WEBSITE_ID, 'Unewsletters.is_setting' => 0],
    'contain' => ['newsletters'],
    'fields' => array(),
    'select' => array(),
    'get' => 'all',
    'order' => array('Unewsletters.id' => 'desc'),
    'limit' => '3'
);

$result = $curl->send_api($request, 'Unewsletters/index');
$tags = '';
$page = array();
$newslettesr = array();
if ($result->code == 200) {
    $newslettesr = isset($result->Unewsletters[0]) ? $result->Unewsletters : array();
}

$newslettesSetting = array();
//get settings details
$requestSetting = array(
    'conditions' => ['Unewsletters.is_deleted' => 0, 'Unewsletters.websiteId' => WEBSITE_ID, 'Unewsletters.is_setting' => 1],
    'contain' => ['newsletters'],
    'fields' => array(),
    'select' => array(),
    'get' => 'all',
    'order' => array('Unewsletters.id' => 'desc'),
    'limit' => '1'
);

$resultSetting = $curl->send_api($requestSetting, 'Unewsletters/index');
$newslettesSetting = array();

if ($resultSetting->code == 200 && !empty($resultSetting->Unewsletters)) {
    $newslettesSetting = isset($resultSetting->Unewsletters[0]) ? $resultSetting->Unewsletters[0] : array();
}
if (isset($newslettesSetting->isedit) && $newslettesSetting->isedit === 1 && !empty($newslettesSetting)) {
    $coverImage = $newslettesSetting->featured_image;
} else {
    $coverImage = isset($newslettesSetting->Newsletters->featured_image) && !empty($newslettesSetting->Newsletters->featured_image) ? $newslettesSetting->Newsletters->featured_image : "";
}
?>
<div class="sub-page-banner">
    <div class="banner-img">
        <?php if (empty($coverImage)) { ?>
            <img src="img/ebook-banner.png" class="img-responsive"  style="max-height: 250px;background-size: cover;"/>
        <?php } else { ?>
            <img src="<?php echo API_URL ?>geturl/uploads/feature_photo/<?php echo $coverImage; ?>" class="img-responsive" style="width:100%;max-height: 250px;background-size: cover;" />
        <?php } ?>
    </div>
    <div class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2>newsletter</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="about-section mb1">
    <div class="container">

        <div class="font-16 font-light text-justify mb2"><?php echo isset($newslettesSetting->content) ? $newslettesSetting->content : ""; ?></div>


        <?php
        if (!empty($newslettesr)) {
            $i = 0;
            foreach ($newslettesr as $key => $value) {
                ?>

               <h3 class="font-22 font-medium mb1">
                    <?php if ($value->isedit == 1) { ?>
                        <a href="newsletterdetails.php?slug=<?php echo trim($value->slug); ?>" title="<?php echo $value->title; ?>"><?php echo $value->title; ?></a>
                    <?php } else { ?>
                        <a href="newsletterdetails.php?slug=<?php echo trim($value->Newsletters->slug); ?>" title="<?php echo $value->Newsletters->title; ?>"><?php echo $value->Newsletters->title; ?></a>
                    <?php } ?>
                </h3>
                <!--                                        <div class="sc_team_item_position">Tax Advisor</div>-->
                <?php if ($value->isedit == 1) { ?>
                    <div class="font-16 text-justify"><?php echo substr($value->content, 0, 250); ?>
                    </div>
                <?php } else { ?>
                    <div class="font-16 text-justify"><?php echo substr($value->Newsletters->content, 0, 250); ?>
                    </div>
                <?php } ?>

                <div class="mt2 clearfix">
                    <?php if ($value->isedit == 1) { ?>
                        <a href="newsletterdetails.php?slug=<?php echo trim($value->slug); ?>" class="btn btn-orange btn-small font-medium mr1">Read More</a><i class="fa fa-long-arrow-right arrow"></i>
                    <?php } else { ?>
                        <a href="newsletterdetails.php?slug=<?php echo trim($value->Newsletters->slug); ?>" class="btn btn-orange btn-small font-medium mr1">Read More</a><i class="fa fa-long-arrow-right arrow"></i>
                    <?php } ?>
                </div>


                <?php
                $lastid = ++$i;
            }
            ?>
            <input type="hidden" id="totrecord" value="<?php echo isset($lastid) ? $lastid : 0; ?>" />
        <?php }else{ ?>  
            <h3>No record found.</h3>
        <?php }?>

            <div class="clsnewsletters column-3">

            </div>
            
    </div>
</div>

<?php require_once('footer.php'); ?>	

<script type="text/javascript">

    jQuery('#loadmore').on('click', function () {

        var post_url = 'newslettersload.php';
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
                jQuery('.clsnewsletters').append(data.message);
                jQuery(".loadingLoader").hide();
                jQuery('.overlay').hide();
            }
        });
    });



</script>