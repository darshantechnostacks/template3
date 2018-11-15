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

if ($result->code == 200) {
    $newslettesr = isset($result->Unewsletters[0]) ? $result->Unewsletters : '';
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

if ($resultSetting->code == 200) {
    $newslettesSetting = isset($resultSetting->Unewsletters[0]) ? $resultSetting->Unewsletters[0] : '';
}
?>
<style>
    .sc_team_item:hover {
        transform: scale(1.03);
        transition-duration: 0.6s;
    }
    .sc_team_item_avatar{
        float: left;	
    }

    .sc_team_style_1 .sc_team_item_info {
        padding:3.4em 5.8em 3.3em;
    }
    .sc_team_item_avatar{
        width: 240px;
    }
    .sc_team_item_info{}
    .sc_team{
        margin: 30px;
    }
    .sc_team_item {
        width: 100%;
    }
    .column-3{
        width:100% ;
    }
    .readmore a {
        padding-right: 6px;
    }
    .readmore {
        margin-top: 15px;
    }
    @keyframes bounceAlpha {
        0% {opacity: 1; transform: translateX(0px) scale(1);}
        25%{opacity: 0; transform:translateX(10px) scale(0.9);}
        26%{opacity: 0; transform:translateX(-10px) scale(0.9);}
        55% {opacity: 1; transform: translateX(0px) scale(1);}
    }
    .bounceAlpha {
        animation-name: bounceAlpha;
        animation-duration:1.4s;
        animation-iteration-count:infinite;
        animation-timing-function:linear;
    }

    .arrow.primera.bounceAlpha {
        animation-name: bounceAlpha;
        animation-duration:1.4s;
        animation-delay:0.2s;
        animation-iteration-count:infinite;
        animation-timing-function:linear;
    }

    .round:hover .arrow{
        animation-name: bounceAlpha;
        animation-duration:1.4s;
        animation-iteration-count:infinite;
        animation-timing-function:linear;
    }
    .round:hover .arrow.primera{
        animation-name: bounceAlpha;
        animation-duration:1.4s;
        animation-delay:0.2s;
        animation-iteration-count:infinite;
        animation-timing-function:linear;
    }
</style>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<?php

if($newslettesSetting->isedit === 1){
     $coverImage = $newslettesSetting->featured_image;
    
}else{
     $coverImage = $newslettesSetting->Newsletters->featured_image;
    
}

?>

<div class="page_top_wrap page_top_title page_top_breadcrumbs" style="background:url(<?php echo API_URL ?>geturl/uploads/feature_photo/<?php echo $coverImage; ?>) no-repeat 59% 49%;max-height: 250px;background-size: cover;" >
    <div class="content_wrap">
        <div class="breadcrumbs">
            <a class="breadcrumbs_item home" href="index.php">Home</a>
            <span class="breadcrumbs_delimiter"></span>
            <span class="breadcrumbs_item current">Newsletters</span>
        </div>
        <h1 class="page_title">Newsletters</h1>
    </div>
</div>

<div class="page_content_wrap">
    <section class="advisor_section">
        <div class="container">
            <div class="row">
                <div class="content_wrap">
                    <div class="margin_bottom_small">
                        <p><?php echo $newslettesSetting->content; ?></p>


                    </div>
                    <div class="sc_team sc_team_style_1">
                        <div class="sc_columns columns_wrap addblog">

<?php
if (!empty($newslettesr)) {
    $i = 0;
    foreach ($newslettesr as $key => $value) {
        ?>

                                    <div class="column-3 margin_top_small">
                                        <div class="sc_team_item sc_team_item_1 odd first">
                                            <div class="sc_team_item_info">
                                                <h4 class="sc_team_item_title">
        <?php if ($value->isedit == 1) { ?>
                                                        <a href="newsletterdetails.php?slug=<?php echo trim($value->slug); ?>" title="<?php echo $value->title; ?>"><?php echo $value->title; ?></a>
                                                    <?php } else { ?>
                                                        <a href="newsletterdetails.php?slug=<?php echo trim($value->Newsletters->slug); ?>" title="<?php echo $value->Newsletters->title; ?>"><?php echo $value->Newsletters->title; ?></a>
                                                    <?php } ?>
                                                </h4>
                                                <!--                                        <div class="sc_team_item_position">Tax Advisor</div>-->
        <?php if ($value->isedit == 1) { ?>
                                                    <div class="sc_team_item_description"><?php echo substr($value->content, 0, 250); ?>
                                                    </div>
        <?php } else { ?>
                                                    <div class="sc_team_item_description"><?php echo substr($value->Newsletters->content, 0, 250); ?>
                                                    </div>
        <?php } ?>

                                                <div class="readmore round">
        <?php if ($value->isedit == 1) { ?>
                                                        <a href="newsletterdetails.php?slug=<?php echo trim($value->slug); ?>" >Read More</a><i class="fa fa-long-arrow-right arrow"></i>
                                                    <?php } else { ?>
                                                        <a href="newsletterdetails.php?slug=<?php echo trim($value->Newsletters->slug); ?>" >Read More</a><i class="fa fa-long-arrow-right arrow"></i>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

        <?php
        $lastid = ++$i;
    }
    ?>
                                <input type="hidden" id="totrecord" value="<?php echo isset($lastid) ? $lastid : 0; ?>" />
                            <?php } ?>   

                            <div class="clsnewsletters column-3">

                            </div>
                            <div class="clearfix"></div>
                            <br/>
                            <?php if(count($newslettesr)>2){ ?>
                            <div class="sc_contact_form_item sc_contact_form_button loadmorebtndiv" style="text-align: center">
                                <div class="squareButton sc_button_size sc_button_style_global global">
                                    <button type="submit" name="contact_submit" id="loadmore" class="sc_button button-hover sc_button_square sc_button_style_red sc_button_size_mini contact_form_submit" data-text="Click Here">Load More</button>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>





<div class="overlay" style="display: none;">
</div>

<div class="loadingLoader" style="display: none;">
    <img src="images/loader.gif">
</div>

<?php require_once('footer.php'); ?>	
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script type="text/javascript">
    jQuery('.select2').select2();

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