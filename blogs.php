<?php
require_once('header.php');
$curl = new CURL();

$websiteId['websiteId'] = WEBSITE_ID;
$uBlogsStatus = $curl->send_api($websiteId, 'UblogStatus/index');
$uBlogsStatusIds = array();
foreach ($uBlogsStatus->UblogStatus as $item) {
    $uBlogsStatusIds[] = $item->aposts_id;
}

$tags = '';
$page = array();

$blogs = isset($blogs) ? $blogs : '';
//p($blogs);
$singleArr = array();
?>
<div class="sub-page-banner mb3">
    <div class="banner-img">
        <img src="img/blog-banner.png" class="img-responsive"/>
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
    <ul class="top-contact-info">
        <li><i class="icon-mobile"></i><?= isset($homePages->firm_phone) ? $homePages->firm_phone : "" ?></li>
        <li><i class="icon-mobile"></i> <a
                    href="mailtto:<?= isset($homePages->firm_email) ? $homePages->firm_email : "" ?>"><?= isset($homePages->firm_email) ? $homePages->firm_email : "" ?></a>
        </li>
    </ul>
</div>
<div class="clearfix mb1">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-1 col-md-10">
                <div class="row">
                    <div class="col-md-3">
                        <div class="category-block">
                            <div class="panel panel-default">
                                <select onchange="getBlogSeach($(this).val(),'');" name="cat" id="cat"
                                        class="form-control">
                                    <option value="0">All Category</option>
                                    <?php
                                    if (count($blog_category) > 0) {
                                        foreach ($blog_category as $category) {
                                            if ($category->status == 1) {
                                                ?>
                                                <option class="level-0"
                                                        value="<?php echo $category->id; ?>"><?php echo $category->category_name; ?></option>
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
                                        $i = 0;
                                        $arr_tags = array();
                                        foreach ($blogs as $key => $blog_value) {
                                            $arr_tags[] = explode(',', $blog_value->tags);
                                            ?>
                                            <li>
                                                <a href="blogdetails.php?id=<?= $blog_value->id; ?>"
                                                   title="<?= $blog_value->title ?>"><?= $blog_value->title ?></a>
                                            </li>
                                        <?php }
                                        foreach ($arr_tags as $items) {
                                            foreach ($items as $item) {
                                                if (!in_array($item, $singleArr)) {
                                                    if (!empty($item)) {
                                                        $singleArr[] = $item;
                                                    }
                                                }
                                            }
                                        }
                                    } ?>
                                </ul>
                            </div>

                            <div class="tag-block">
                                <h3 class="font-20 font-medium">Tags</h3>
                                <ul class="tag-list">
                                    <?php
                                    foreach ($singleArr as $tag) {
                                        ?>
                                        <li><a onclick="getBlogSeach(0,this.title);" class="tags"
                                               title="<?= $tag ?>"><?= $tag ?></a></li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <ul class="blog-listing addblog">
                            <?php
                            if (!empty($blogs)) {
                                $i = 0;
                                foreach ($blogs as $key => $value) {
                                    if (!in_array($value->id, $uBlogsStatusIds)) {
                                        ?>
                                        <li class="clearfix">
                                            <div class="img-block">
                                                <a href='blogdetails.php?id=<?= $value->id ?>'>
                                                    <?php
                                                    $blog_content = isset($value->content) ? $value->content : '';
                                                    $image = isset($value->featured_image) ? FEATURE_PHOTO . $value->featured_image : '';
                                                    if (!empty($image)) {
                                                        echo "<img src='$image' class='img-responsive'/>";
                                                    } else {
                                                        echo "<img src='img/blog-img.png' class='img-responsive'/>";
                                                    }
                                                    ?>
                                                </a>
                                            </div>
                                            <div class="content-block">
                                                <a href="blogdetails.php?id=<?= $value->id ?>"
                                                   class="title"><?= isset($value->title) ? $value->title : '' ?></a>
                                                <p><?= strip_tags(substr($blog_content, 0, 100) . '...') ?></p>
                                                    <?php
                                                    $dt = strtotime($value->created);
                                                    ?>
                                                    <?= date("M d, Y", strtotime($value->created)) ?>
                                                    | <b>Category :</b> <?= isset($value->blogs_category->category_name) ? $value->blogs_category->category_name : '' ?>
                                                    <?php if (isset($value->uteam->name)) { ?>
                                                    | <b>Auth :</b> <?= $value->uteam->name . ' ' . $value->uteam->last_name ?>
                                                    <?php } ?>
                                                <br/>
                                                <a href="blogdetails.php?id=<?= $value->id ?>" class="read-more">Read
                                                    more</a>
                                            </div>
                                        </li>
                                        <?php
                                        $lastid = ++$i;
                                    }
                                } ?>
                                <input type="hidden" id="totblog" value="<?php echo isset($lastid) ? $lastid : 0; ?>"/>
                            <?php } else { ?>
                                <h3 class="text-center">No Data Found.</h3>
                            <?php } ?>
                        </ul>
                    </div>
                    <button type="submit" name="contact_submit" id="loadblog"
                            class="btn btn-pink align-content-center"
                            data-text="Click Here">Load More
                    </button>
                </div>

            </div>
        </div>
    </div>
</div>
<?php require_once('footer.php'); ?>
<script>
    $(function () {
        $("#datepicker").datepicker({minDate: 0});
    });
    $('.news-slider').slick({
        centerMode: false,
        slidesToShow: 3,
        arrows: false,
        slidesToScroll: 3,
        dots: true,
        adaptiveHeight: true,
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    arrows: false,
                    centerMode: false,
                    slidesToShow: 2,
                    slidesToScroll: 2,
                }
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: false,
                    centerMode: false,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            }
        ]
    });
    $('.membership-slider').slick({
        centerMode: false,
        slidesToShow: 5,
        arrows: false,
        slidesToScroll: 5,
        dots: true,
        adaptiveHeight: true,
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    arrows: false,
                    centerMode: false,
                    slidesToShow: 3,
                    slidesToScroll: 3,
                }
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: false,
                    centerMode: false,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            }
        ]
    });

    $('.top-slider').slick({
        centerMode: false,
        slidesToShow: 1,
        arrows: true,
        slidesToScroll: 1,
        dots: false,
        adaptiveHeight: true
    })
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script type="text/javascript">
    jQuery('.select2').select2();

    function getBlogSeach(cat_id, title) {
        var post_url = 'blogload.php';
        jQuery.ajax({
            url: post_url,
            // data: {lastid: $('#totblog').val(),cat_id:cat_id,tags:title},
            data: {lastid: 0, cat_id: cat_id, tags: title},
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

                if (data.message == '' || y < 3) {
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
            data: {lastid: $('#totblog').val(), cat_id: 0, tags: ''},
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

                if (data.message == '' || y < 3) {
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