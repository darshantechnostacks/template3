<?php
require_once ('header.php');
$curl = new CURL();

$websiteId['websiteId'] = WEBSITE_ID;
$uBlogsStatus = $curl->send_api($websiteId, 'UblogStatus/index');

$uBlogsStatusIds = array();
foreach ($uBlogsStatus->UblogStatus as $item) {
    $uBlogsStatusIds[] = $item->aposts_id;
}

$tags = '';
$page = array();

/* * ******Get Blogs********* */
$blog['apost_categorie_id'] = 1;
$blog['limit'] = 3;
$blog['websiteId'] = WEBSITE_ID;

$blogs_data = $curl->send_api($blog, 'Aposts/getBlogs');
$blogs = array();
if (!empty($blogs_data) && $blogs_data->code == 200) {
    $blogs = $blogs_data->Aposts;
}

/* * ******End Blogs********* */

$blogs = isset($blogs) ? $blogs : '';

$singleArr = array();

/* * **************** Blog Category Data ************ */
$data['id'] = WEBSITE_ID;
$result = $curl->send_api($data, 'BlogsCategory/index');
if (!empty($result) && $result->code == 200) {
    $blog_category = $result->BlogsCategory;
}
$cntBlog = 0;
/* * **************** END Blog Category Data ******** */
?>
<div class="sub-page-banner">
    <div class="banner-img">
        <img src="img/blog-banner.png" class="img-responsive" />
    </div>
    <div class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Blog</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="clearfix mb1" style="margin-top: 50px;">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-1 col-md-10">
<!--                <div class="clearfix mb3">
                    <div class="blog-search-block">
                        <div class="search-inner">
                            <i class=""><img src="img/search-icon.png" /></i>
                            <input type="text" placeholder="Search Blog" />
                        </div>
                    </div>
                </div>-->
                <div class="row">
                    <div class="col-md-3">
                        <div class="category-block">
                            <div class="panel panel-default">
                                <select onchange="getBlogSeach($(this).val(), '');" name="cat" id="cat" class="postform form-control select2">
                                    <option value="0">All Category</option>
                                    <?php
                                    if (count($blog_category) > 0) {
                                        foreach ($blog_category as $category) {
                                            if ($category->status == 1) {
                                                ?>
                                                <option class="level-0" value="<?php echo $category->id; ?>"><?php echo $category->category_name; ?></option>
                                                <?php
                                            }
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="recent-block">
                                <h3 class="font-20 font-medium">Recent Post</h3>
                                <ul class="recent-post-list">
                                     <?php
                    if (!empty($blogs)) {
                        $cntBlog = count($blogs);
                        $i = 0;
                        $arr_tags = array();
                        foreach ($blogs as $key => $blog_value) {
                            $arr_tags[] = explode(',', $blog_value->tags);
                            ?>
                            <li>
                                <a href="blogdeatails.php?id=<?php echo $blog_value->id; ?>" title="<?php echo $blog_value->title; ?>"><?php echo substr($blog_value->title,0,20).'...'; ?></a>
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
                    }else{ ?>
                                  <li>No Post</li>
                    <?php }?>
                                </ul>
                            </div>
                            <div class="tag-block">
                                <h3 class="font-20 font-medium">Tags</h3>
                                <ul class="tag-list">
                                     <?php
                    foreach($singleArr as $tag) {
                        ?>
                                    <li><a onclick="getBlogSeach(0,this.title);"  title="<?php echo $tag;?>"><?php echo $tag; ?></a></li>
                    <?php } ?>
                        
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9 ">
                       <ul class="blog-listing addblog">  
                         <?php
            if (!empty($blogs)) {
                $i = 0;
                foreach ($blogs as $key => $value) {
                    if(!in_array($value->id, $uBlogsStatusIds)){
                          $dt = strtotime($value->created); 
                        ?>
                            <li class="clearfix">
                                <div class="img-block">
                                    <?php if (isset($value->featured_image) && !empty($value->featured_image)) { ?>
                                    <a href="blogdeatails.php?id=<?php echo $value->id; ?>"><img src="<?php echo API_URL ?>geturl/uploads/feature_photo/<?php echo $value->featured_image; ?>" class="img-responsive" style="max-height: 155px;width: 100%;min-height: 155px;"/></a>
                                    <?php } else { ?>
                                        <a class="hover_icon_link inited" href="blogdeatails.php?id=<?php echo $value->id; ?>">
                                            <a href="blogdeatails.php?id=<?php echo $value->id; ?>"><img alt="<?php echo $value->title; ?>" src="images/default-blog.jpg" class="img-responsive" style="max-height: 155px;min-height: 155px;width: 100%;"></a>
                                        </a>
                                    <?php } ?>
                                </div>
                                <div class="content-block">
                                    <a href="blogdeatails.php?id=<?php echo $value->id; ?>" class="title"><?php echo $value->title; ?></a>
                                    <div class="post_info">
                        <span class="post_info_item post_info_posted">
                            <a  class="post_info_date" title="<?php echo date('M j , Y',$dt);?>"><?php echo date('M j , Y',$dt);?></a>
                        </span>
                                    <span class="post_info_item post_info_posted">Category : <?php echo isset($value->blogs_category->category_name) ? $value->blogs_category->category_name : '' ?></span>
                                    <span class="post_info_item post_info_posted">Auth : <?php echo isset($value->uteam->name) ? $value->uteam->name : 'Admin' ?></span>
                                </div>
                                    <?php 
                                   
                                    $content =  $value->content;
                                        if(strlen( $content) > 100)
                                        {
                                            $content =  substr($content, 0, 100). ' ...';
                                        }
                                        echo $content;
                                        ?>
                                    
                                    
                                    <a href="blogdeatails.php?id=<?php echo $value->id; ?>" class="read-more">Read more</a>
                                </div>
                            </li>
                        
                        <?php
                        $lastid = ++$i;
                    }
                } ?>
                <input type="hidden" id="totblog" value="<?php echo isset($lastid) ? $lastid : 0; ?>" />

            <?php } else { ?>
                <h3 class="text-center">No Data Found.</h3>
            <?php } ?>
                  </ul>
                        <?php if($cntBlog>2){ ?>
                        <div class="sc_contact_form_item sc_contact_form_button loadmorebtndiv" style="text-align: center">
                <div class="squareButton sc_button_size sc_button_style_global global">
                    <button type="submit" name="contact_submit" id="loadblog" class=" btn btn-radius btn-shadow btn-orange  contact_form_submit" data-text="Click Here">Load More</button>
                </div>
            </div>
                        <?php }else{?>
                        <div style="margin-top: 100px;"></div>                
                        <?php } ?>
            <div class="clearfix"></div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once ('footer.php'); ?>
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>-->
<script type="text/javascript">
//    jQuery('.select2').select2();

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