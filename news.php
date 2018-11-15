<?php
require_once('header.php');

$websiteId['websiteId'] = WEBSITE_ID;
$uBlogsStatus = $curl->send_api($websiteId,'UblogStatus/index');
$uBlogsStatusIds = array();
foreach ($uBlogsStatus->UblogStatus as $item){
    $uBlogsStatusIds[] = $item->aposts_id;
}

$tags = '';
$page = array();

$news = isset($news) ? $news : '';
?>

<div class="page_top_wrap page_top_title page_top_breadcrumbs">
    <div class="content_wrap">
        <div class="breadcrumbs">
            <a class="breadcrumbs_item home" href="index.php">Home</a>
            <span class="breadcrumbs_delimiter"></span>
            <span class="breadcrumbs_item current">News</span>
        </div>
        <h1 class="page_title">Our News </h1>
    </div>
</div>

<div class="page_content_wrap">
    <div class="content_wrap">
        <div class="content addblog">
            <?php
            if (!empty($news)) {
                $i = 0;
                foreach ($news as $key => $value) {
                    if(!in_array($value->id, $uBlogsStatusIds)){
                        ?>
                        <article class="post_item post_item_excerpt post has-post-thumbnail">
                            <div class="post_featured">
                                <div class="post_thumb" data-image="images/1150x752.png" data-title="<?php echo $value->title; ?>">
                                    <?php if (isset($value->featured_image) && !empty($value->featured_image)) { ?>
                                        <a class="hover_icon_link inited" href="blogdeatails.php?id=<?php echo $value->id; ?>">
                                            <img style="height:280px;" alt="<?php echo $value->title; ?>" src="<?php echo API_URL ?>geturl/uploads/feature_photo/<?php echo $value->featured_image; ?>">
                                            <div class="img-hover">
                                                <span class="hover_icon"> </span>
                                            </div>
                                        </a>
                                    <?php } else { ?>
                                        <a class="hover_icon_link inited" href="blogdeatails.php?id=<?php echo $value->id; ?>">
                                            <img alt="<?php echo $value->title; ?>" src="images/default-blog.jpg">
                                        </a>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="post_content clearfix">
                                <h3 class="post_title">
                                    <?php
                                    $title = $value->title;
                                    if(strlen($title) > 50)
                                    {
                                        $title =  substr($title, 0, 50). ' ...';
                                    }
                                    $dt = strtotime($value->created);   ?>
                                    <a href="blogdeatails.php?id=<?php echo $value->id; ?>" title="<?php echo $title; ?>">
                                        <span class="post_icon icon-book-2"> </span>
                                        <?php echo $title; ?></a>
                                </h3>
                                <div class="post_info">
                                <span class="post_info_item post_info_posted">
                                    <a  class="post_info_date" title="<?php echo date('M j , Y',$dt);?>"><?php echo date('M j , Y',$dt);?></a>
                                </span>
                                  
                                </div>
                                <div class="post_descr">
                                    <p><?php
                                        $content =  $value->content;
                                        if(strlen( $content) > 100)
                                        {
                                            $content =  substr($content, 0, 100). ' ...';
                                        }
                                        echo $content;
                                        ?></p>
                                    <a href="newsdeatails.php?id=<?php echo $value->id; ?>" class="sc_button button-hover sc_button_square sc_button_style_red sc_button_size_mini" data-text="More Info" title="More Info">More Info</a>
                                </div>
                            </div>
                        </article>
                        <?php
                        $lastid = ++$i;
                    }
                } ?>
                <input type="hidden" id="totblog" value="<?php echo isset($lastid) ? $lastid : 0; ?>" />

            <?php } else { ?>
                <h3 class="text-center">No Data Found.</h3>
            <?php } ?>
            <div class="sc_contact_form_item sc_contact_form_button loadmorebtndiv" style="text-align: center">
                <div class="squareButton sc_button_size sc_button_style_global global">
                    <button type="submit" name="contact_submit" id="loadblog" class="sc_button button-hover sc_button_square sc_button_style_red sc_button_size_mini contact_form_submit" data-text="Click Here">Load More</button>
                </div>
            </div>
            <div class="clearfix"></div>

        </div>
    </div>
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
    jQuery('#loadblog').on('click', function () {

        var post_url = 'newsload.php';
        jQuery.ajax({
            url: post_url,
            data: {lastid: $('#totblog').val(),cat_id:0,tags:''},
            type: 'post',
            dataType: 'json',
            beforeSend: function () {
                //  jQuery("#loading-image").show();
                jQuery('.loadingLoader').show();
                jQuery('.overlay').show();
            },
            success: function (data) {
                var x = jQuery('#totblog').val();
                var y = data.last_id;
                var tot = +x + +y;

                if(data.message == '' || y < 3){
                    $('.loadmorebtndiv').hide();
                }

                jQuery('#totblog').val(tot);
                jQuery('.addblog').append(data.message);

                jQuery(".loadingLoader").hide();
                jQuery('.overlay').hide();
            }
        });
    });
</script>
<script>
    var el = $('body');
    el.removeClass('sidebar_show sidebar_hide');
</script>