<?php
require_once('header.php');

$curl = new CURL();

/* * ******** Get pages ***** */
$row['id'] = isset($_GET['id']) ? $_GET['id'] : '';
$row['websiteId'] = WEBSITE_ID;
$row['apost_categorie_id'] = 1;

$result = $curl->send_api($row, 'Aposts/getBlogById');

$page = array();

if ($result->code == 200) {
    $blog = isset($result->Aposts[0]) ? $result->Aposts[0] : '';
}
/* * *******  End get pages ******** */
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
<div class="clearfix mb3 mt3">
    <div class="container">
        <div class="row">
            <?php if (isset($blog) && !empty($blog)) { ?>
                <div class="col-md-offset-1 blog-detail col-md-10">
                    <div class="clearfix mb3">
                        <div class="pull-left title">
                            <h3 class="font-medium"><?= isset($blog->title) ? $blog->title : '' ?></h3>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="">
                                <div class="mb1 img-block">
                                    <?php if (isset($blog->featured_image) && !empty($blog->featured_image)) { ?>
                                    <a href="blogdeatails.php?id=<?php echo $blog->id; ?>"><img src="<?php echo API_URL ?>geturl/uploads/feature_photo/<?php echo $blog->featured_image; ?>" class="img-responsive" style="max-height: 155px;"/></a>
                                    <?php } else { ?>
                                        <a class="hover_icon_link inited" href="blogdeatails.php?id=<?php echo $blog->id; ?>">
                                            <a href="blogdeatails.php?id=<?php echo $blog->id; ?>"><img alt="<?php echo $blog->title; ?>" src="images/default-blog.jpg" class="img-responsive" style="max-height: 155px;"></a>
                                        </a>
                                    <?php } ?>
                                </div>
                                <div class="clearfix mb2">
                                    <ul class="blog-info">
                                        <li><?php echo date("M d, Y", strtotime($blog->created)) ?></li>
                                        <li>Category: <a href="#"><?php echo isset($blog->blogs_category->category_name) ? $blog->blogs_category->category_name : '' ?></a></li>
                                        <li>Auth : <?php echo isset($blog->uteam->name) ? $blog->uteam->name : 'Admin'; ?></li>
                                    </ul>
                                </div>
                                <div class="mb2">
                                    <?php
                                    if (isset($blog->content)) {
                                        echo $text = $blog->content;
                                    }
                                    ?>
                                </div>
                                <div class="tag-block">
                                    <h3 class="font-20 font-medium">Tags</h3>
                                    <ul class="tag-list">
                                        <?php
                                        if (isset($blog->tags)) {
                                            $tags = explode(',', $blog->tags);
                                            foreach ($tags as $tag) {
                                                ?>
                                                <li>   <a href="#" title="<?= $tag ?>"><?= $tag ?></a></li>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<?php require_once ('footer.php'); ?>