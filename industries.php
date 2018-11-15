<?php
require_once('header.php');
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
?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<?php
if (isset($bannerSetting->isedit) && $bannerSetting->isedit === 1) {
    $coverImage = $bannerSetting->featured_image;
    $content = $bannerSetting->page_content;
} else {
    $coverImage = $bannerSetting->Industries->featured_image;
    $content = $bannerSetting->Industries->page_content;
}

//$coverImage = $newslettesSetting->isedit == 0 ? $newslettesSetting->featured_image : $newslettesSetting->Newsletters->featured_image;
?>


<div class="page_top_wrap page_top_title page_top_breadcrumbs" style="background:url(<?php echo API_URL ?>geturl/uploads/feature_photo/<?php echo $coverImage; ?>) no-repeat 59% 49%;max-height: 250px;background-size: cover;" >
    <div class="content_wrap">
        <div class="breadcrumbs">
            <a class="breadcrumbs_item home" href="index.php">Home</a>
            <span class="breadcrumbs_delimiter"></span>
            <span class="breadcrumbs_item current">Industries</span>
        </div>
        <h1 class="page_title">Industries</h1>
    </div>
</div>

<div class="page_content_wrap" style="padding:0px 0px;">

    <section class="grey_section">
        <div class="container">
            <div class="row">
                <div class="content_wrap">
                    <div class="sc_under_title sc_section aligncenter column-3_5" data-animation="animated fadeInUp normal">
                        <?php echo $content; ?>
                    </div>

                    <?php
                    if (!empty($industries) && isset($industries)) {
                        $i = 0;
                        $k = 1;
                        ?>
                        <?php foreach ($industries as $key => $value) { ?>
                            <?php if ($k == 1) { ?>
                    <div class="columns_wrap sc_columns" data-animation="animated fadeInUp normal" style="margin-top:25px;">
                                <?php } ?>
                                <div class="column-1_4 sc_column_item">
                                    <div class="sc_column_item_inner">
                                        <div class="sc_section" style="height:300px;">
                                            <?php if ($value->isedit == 1) { ?>
                                            <h5 class="sc_title sc_align_left"><?php echo substr(trim($value->title), 0, 15); ?></h5>
                                            <?php
                                            //echo substr(trim($value->page_content), 0, 250);
                                              echo $details = str_replace("{company_name}", $homePages->firm_name, substr(trim($value->page_content), 0, 250));
                                            ?>
                                            <a href="industriesdetails.php?slug=<?php echo $value->page_slug ?>" class="sc_button button-hover sc_button_square sc_button_style_clear sc_button_bg_link sc_button_size_mini  sc_button_iconed inherit" data-text="Learn more">Learn more</a>
                                            <?php }else{ ?>
                                            
                                             <h5 class="sc_title sc_align_left"><?php echo substr(trim($value->Industries->title), 0, 15); ?></h5>
                                                <?php
                                                echo $details = str_replace("{company_name}", $homePages->firm_name, substr(trim($value->Industries->industriecontents[$set_no-1]->contents), 0, 250));
                                                ?>
                                                <a href="industriesdetails.php?slug=<?php echo $value->page_slug ?>" class="sc_button button-hover sc_button_square sc_button_style_clear sc_button_bg_link sc_button_size_mini  sc_button_iconed inherit" data-text="Learn more">Learn more</a>    
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <?php if ($k == 4) { ?>
                                </div>
                                <?php
                                $k=0;
                            }
                            $lastid = ++$i;
                            $k++;
                        }
                        ?>
                    <?php } ?>

                    <input type="hidden" id="totrecord" value="<?php echo isset($lastid) ? $lastid : 0; ?>" />

                </div>
                <div class="clsloadmore">

                </div>
                <div class="clearfix"></div>
                <!--                    <div class="sc_contact_form_item sc_contact_form_button loadmorebtndiv" style="text-align: center;margin-top: 25px;">
                                        <div class="squareButton sc_button_size sc_button_style_global global">
                                            <button type="submit" name="contact_submit" id="loadmore" class="sc_button button-hover sc_button_square sc_button_style_red sc_button_size_mini contact_form_submit" data-text="Click Here">Load More</button>
                                        </div>
                                    </div>-->

            </div>
        </div>
    </section>

</div>

<div class="overlay" style="display: none;"></div>
<div class="loadingLoader" style="display: none;">
    <img src="images/loader.gif">
</div>

<?php require_once('footer.php'); ?>	
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
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