<?php include_once('header.php');
$curl = new CURL();

/********** Get pages ******/
$row['id'] = isset($_GET['id']) ? $_GET['id'] : '';
$row['websiteId'] = WEBSITE_ID;
$row['apost_categorie_id'] = 1;

$result = $curl->send_api($row, 'Aposts/getBlogById');
//p($result);
$page = array();

if ($result->code == 200) {
    $blog = isset($result->Aposts[0]) ? $result->Aposts[0] : '';
}
/*********  End get pages *********/
?>
    <div class="clearfix mb3 mt3">
        <div class="container">
            <div class="row">
                <div class="col-md-offset-1 blog-detail col-md-10">
                    <div class="clearfix mb3">
                        <div class="pull-left title">
                            <h3 class="font-medium"><?= isset($blog->title) ? $blog->title : '' ?></h3>
                        </div>
                    </div>
                    <div class="row">
                        <?php if (isset($blog) && !empty($blog)) {
                            ?>
                        <div class="col-md-9">
                            <div class="blog-inner-border">
                                <div class="mb1 img-block">
                                    <?php
                                    $image = isset($value->featured_image) ? FEATURE_PHOTO . $blog->featured_image : '';
                                    if (!empty($image)) {
                                        echo "<img src='$image' class='img-responsive'/>";
                                    } else {
                                        echo "<img src='img/blog-inner-img.png' class='img-responsive'/>";
                                    }
                                    ?>
                                </div>
                                <div class="clearfix mb2">
                                    <ul class="blog-info">
                                        <li><?= date("M d, Y", strtotime($blog->created)) ?></li>
                                        <li>Category: <?= isset($blog->blogs_category->category_name) ? $blog->blogs_category->category_name : '' ?></li>
                                        <?php if(isset($blog->uteam->name)){ ?>
                                        <li>Auth : <?= $blog->uteam->name.' '.$blog->uteam->last_name  ?></li>
                                        <?php }  ?>
                                    </ul>
                                </div>
                                <p class="mb2"><?= isset($blog->content) ? $blog->content : '' ?></p>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="tag-block inner">
                                <h3 class="font-20 font-medium mb1">Tags</h3>
                                <ul class="tag-list">
                                    <?php
                                    if(isset($blog->tags)){
                                        $tags = explode(',' ,$blog->tags);
                                        foreach ($tags as $tag){ ?>
                                            <li><a href="#" title="<?= $tag ?>"><?= $tag ?></a></li>
                                        <?php }
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <?php } else { ?>
                            <h2>No data found.</h2>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<div id="loadFooter"></div>
<?php include_once('footer.php'); ?>
<script>
    $(function () {
        $("#datepicker").datepicker({ minDate: 0 });
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
