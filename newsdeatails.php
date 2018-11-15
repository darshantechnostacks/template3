<?php
require_once('header.php');

$curl = new CURL();

/********** Get pages ******/
$row['id'] = isset($_GET['id']) ? $_GET['id'] : '';
$row['websiteId'] = WEBSITE_ID;
$row['apost_categorie_id'] = 2;

$result = $curl->send_api($row,'Aposts/getBlogById');

$page = array();

if($result->code == 200)
{
    $news = isset($result->Aposts[0])?$result->Aposts[0]:'';
}
/*********  End get pages *********/

?>
<div class="page_top_wrap page_top_title page_top_breadcrumbs" style="background:url('http://18.221.49.101/cpacake/geturl/uploads/feature_photo/1537364753_613913.jpg') no-repeat 59% 49%;max-height: 250px;background-size: cover;">
    <div class="content_wrap">
        <div class="breadcrumbs">
            <a class="breadcrumbs_item home" href="index.php">Home</a>
            <span class="breadcrumbs_delimiter"></span>
            <a class="breadcrumbs_item home" href="news.php">News</a>
            <span class="breadcrumbs_delimiter"></span>
            <span class="breadcrumbs_item current">News Details</span>
        </div>
        <h1 class="page_title"><?= isset($news->title) ? $news->title : '' ?></h1>
    </div>
</div>
<div class="container padding_bottom_small padding_top_small">
    <?php if (isset($news) && !empty($news)) { ?>
        <article class="post_item post_item_single post has-post-thumbnail">
            <section class="post_featured blog-banner" style="background-image: url('<?= API_URL ?>geturl/uploads/feature_photo/<?= $news->featured_image ?>')">
                <img alt="<?= $news->title ?>" src="<?= API_URL ?>geturl/uploads/feature_photo/<?= $news->featured_image ?>">
            </section>
            <section class="center-block post_content">
                <div class="post_info">
                    <span class="post_info_item post_info_posted">
                        <a class="post_info_date" title="<?= date("M d, Y", strtotime($news->created)) ?>">
                            <?= date("M d, Y", strtotime($news->created)) ?></a>
                    </span>
                   <!--  <span class="post_info_item post_info_posted">Category : <?= isset($news->blogs_category->category_name) ? $news->blogs_category->category_name : '' ?></span>
                    <span class="post_info_item post_info_posted">Auth : <?= isset($news->uteam->name) ? $news->uteam->name : 'Admin' ?></span> -->
                </div>
                <p class="font-size-16 post-article text-justify">
                    <?= isset($news->content) ? $news->content : '' ?>
            </section>
        </article>
    <?php } else { ?>
        <h2>No data found.</h2>
    <?php } ?>
</div>
<div id="loadFooter"></div>
<?php require_once('footer.php'); ?>
