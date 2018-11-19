<?php
require_once('header.php');
$curl = new CURL();

$websiteId['websiteId'] = WEBSITE_ID;
$uBlogsStatus = $curl->send_api($websiteId,'UblogStatus/index');
$uBlogsStatusIds = array();
foreach ($uBlogsStatus->UblogStatus as $item){
    $uBlogsStatusIds[] = $item->aposts_id;
}

$tags = '';
$page = array();

$blogs = isset($blogs) ? $blogs : '';
$singleArr = array();
$cnt = 0;
?>

<div class="page_top_wrap page_top_title page_top_breadcrumbs">
    <div class="content_wrap">
        <div class="breadcrumbs">
            <a class="breadcrumbs_item home" href="index.php">Home</a>
            <span class="breadcrumbs_delimiter"></span>
            <span class="breadcrumbs_item current">Blog</span>
        </div>
        <h1 class="page_title">Our Blog </h1>
    </div>
</div>

<div class="page_content_wrap">
    <div class="content_wrap">
        <div class="content addblog">
            <?php
            if (!empty($blogs)) {
                $cnt = count($blogs);
                $i = 0;
                foreach ($blogs as $key => $value) {
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
                                    <span class="post_info_item post_info_posted">Category : <?php echo isset($value->blogs_category->category_name) ? $value->blogs_category->category_name : '' ?></span>
                                    <span class="post_info_item post_info_posted">Auth : <?php echo isset($value->uteam->name) ? $value->uteam->name : 'Admin' ?></span>
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
                                    <a href="blogdeatails.php?id=<?php echo $value->id; ?>" class="sc_button button-hover sc_button_square sc_button_style_red sc_button_size_mini" data-text="More Info" title="More Info">More Info</a>
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
            <?php } if($cnt>2){ ?>
            <div class="sc_contact_form_item sc_contact_form_button loadmorebtndiv" style="text-align: center">
                <div class="squareButton sc_button_size sc_button_style_global global">
                    <button type="submit" name="contact_submit" id="loadblog" class="sc_button button-hover sc_button_square sc_button_style_red sc_button_size_mini contact_form_submit" data-text="Click Here">Load More</button>
                </div>
            </div>
            <?php } ?>
            <div class="clearfix"></div>

        </div>
        <div class="sidebar widget_area bg_tint_light sidebar_style_light" role="complementary">

            <aside class="widget widget_categories">
                <h5 class="widget_title">Categories dropdown</h5>
                <label class="screen-reader-text" for="cat">Categories dropdown</label>
                <select onchange="getBlogSeach($(this).val(),'');" name="cat" id="cat" class="postform select2">
                    <option value="0">All Category</option>
                    <?php
                    if(count($blog_category)>0)
                    {
                        foreach($blog_category as $category)
                        {
                            if($category->status ==  1) {
                                ?>
                                <option class="level-0" value="<?php echo $category->id;?>"><?php echo $category->category_name;?></option>
                                <?php
                            }
                        }
                    }
                    ?>

                </select>
            </aside>

            <aside class="widget widget_recent_entries">
                <h5 class="widget_title">Recent Posts</h5>
                <ul>
                    <?php
                    if (!empty($blogs)) {
                        $i = 0;
                        $arr_tags = array();
                        foreach ($blogs as $key => $blog_value) {
                            $arr_tags[] = explode(',', $blog_value->tags);
                            ?>
                            <li>
                                <a href="blogdeatails.php?id=<?php echo $blog_value->id; ?>" title="<?php echo $blog_value->title; ?>"><?php echo $blog_value->title; ?></a>
                            </li>
                        <?php }
                        foreach ($arr_tags as $items){
                            foreach ($items as $item){
                                if(!in_array($item, $singleArr)){
                                    if(!empty($item)){
                                        $singleArr[] = $item;
                                    }
                                }
                            }
                        }
                    }?>

                </ul>
            </aside>
            <aside class="widget widget_tag_cloud">
                <h5 class="widget_title">Tags</h5>
                <div class="tagcloud">
                    <?php
                    foreach($singleArr as $tag) {
                        ?>
                        <a onclick="getBlogSeach(0,this.title);" class="tags" title="<?php echo $tag;?>"><?php echo $tag; ?></a>
                    <?php } ?>
                </div>
            </aside>

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

    function getBlogSeach(cat_id,title)
    {
        var post_url = 'blogload.php';
        jQuery.ajax({
            url: post_url,
            // data: {lastid: $('#totblog').val(),cat_id:cat_id,tags:title},
            data: {lastid: 0,cat_id:cat_id,tags:title},
            type: 'post',
            dataType: 'json',
            beforeSend: function () {
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
                jQuery('.addblog').empty();
                jQuery('.tagcloud').empty();
                jQuery('.tagcloud').append(data.tags_msg);
                jQuery('.addblog').append(data.message);

                jQuery(".loadingLoader").hide();
                jQuery('.overlay').hide();
            }
        });
    }
    jQuery('#loadblog').on('click', function () {

        var post_url = 'blogload.php';
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
                console.log(data);
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