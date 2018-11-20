<?php
require_once('header.php');

$curl = new CURL();

/* * ******** Get pages ***** */
$row['id'] = isset($_GET['id']) ? $_GET['id'] : '';
$row['websiteId'] = WEBSITE_ID;
$row['apost_categorie_id'] = 2;

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
                    <h2>News Details</h2>
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
                                    <img src="<?php echo API_URL ?>geturl/uploads/feature_photo/<?php echo $blog->featured_image; ?>" class="img-responsive" style="max-height: 155px;"/>
                                    <?php } else { ?>
                                            <img alt="<?php echo $blog->title; ?>" src="images/default-blog.jpg" class="img-responsive" style="max-height: 155px;">
                                    <?php } ?>
                                </div>
                                <div class="clearfix mb2">
                                    <ul class="blog-info">
                                        <li><?php echo date("M d, Y", strtotime($blog->created)) ?></li>
                                        <?php if(isset($blog->uteam->name) && !empty($blog->uteam->name)) { ?>
                                        <li>Auth : <?php echo isset($blog->uteam->name) ? $blog->uteam->name : ''; ?></li>
                                        <?php } ?>
                                    </ul>
                                </div>
                                <div class="mb2">
                                    <?php
                                    if (isset($blog->content)) {
                                        echo $text = $blog->content;
                                    }
                                    ?>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            <?php }else{ ?>
            <h3>No record found.</h3>
            <?php } ?>
        </div>
    </div>
</div>

<?php require_once ('footer.php'); ?>