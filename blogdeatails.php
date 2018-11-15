<?php
require_once('header.php');

$curl = new CURL();

/********** Get pages ******/
$row['id'] = isset($_GET['id']) ? $_GET['id'] : '';
$row['websiteId'] = WEBSITE_ID;
$row['apost_categorie_id'] = 1;

$result = $curl->send_api($row, 'Aposts/getBlogById');

$page = array();

if ($result->code == 200) {
    $blog = isset($result->Aposts[0]) ? $result->Aposts[0] : '';
}
/*********  End get pages *********/
?>
<div class="body_wrap">
    <div class="page_wrap">
        <div class="top_panel_fixed_wrap"></div>
        <header id="loadHeader" class="top_panel_wrap bg_tint_light" data-active="Blogs (List-Details)"></header>
        <div class="page_top_wrap page_top_title page_top_breadcrumbs" style="background:url('http://18.221.49.101/cpacake/geturl/uploads/feature_photo/1537364753_613913.jpg') no-repeat 59% 49%;max-height: 250px;background-size: cover;">
            <div class="content_wrap">
                <div class="breadcrumbs">
                    <a class="breadcrumbs_item home" href="index.php">Home</a>
                    <span class="breadcrumbs_delimiter"></span>
                    <a class="breadcrumbs_item home" href="blogs.php">Blog</a>
                    <span class="breadcrumbs_delimiter"></span>
                    <span class="breadcrumbs_item current">Blog Details</span>
                </div>
                <h1 class="page_title"><?= isset($blog->title) ? $blog->title : '' ?></h1>
            </div>
        </div>
        <div class="container padding_bottom_small padding_top_small">
        <?php if (isset($blog) && !empty($blog)) { ?>
            <article class="post_item post_item_single post has-post-thumbnail">
                <section class="post_featured blog-banner" style="background-image: url('<?= API_URL ?>geturl/uploads/feature_photo/<?= $blog->featured_image ?>')">
                    <img alt="<?= $blog->title ?>" src="<?= API_URL ?>geturl/uploads/feature_photo/<?= $blog->featured_image ?>">
                </section>
                <section class="center-block post_content">
                    <div class="post_info">
                            <span class="post_info_item post_info_posted">
                                <a class="post_info_date" title="<?= date("M d, Y", strtotime($blog->created)) ?>">
                                    <?= date("M d, Y", strtotime($blog->created)) ?></a>
                            </span>
                        <span class="post_info_item post_info_posted">Category : <?= isset($blog->blogs_category->category_name) ? $blog->blogs_category->category_name : '' ?></span>
                        <span class="post_info_item post_info_posted">Auth : <?= isset($blog->uteam->name) ? $blog->uteam->name : 'Admin' ?></span>
                    </div>
                    <p class="font-size-16 post-article text-justify">
                        <?php
                        if(isset($blog->content)){
                            $text = $blog->content;
                            $text=str_ireplace('<p>','',$text);
                            $text=str_ireplace('</p>','',$text);
                            echo "<span class='emph'>".strtoupper($text[0])."</span>".substr($text, 1);
                        }
                        ?>
                    <div class="margin_top_middle">
                        <label class="sc_title sc_align_center fig_border font-size-18">Tags</label>
                        <div class="blog-tags">
                            <?php
                                if(isset($blog->tags)){
                                    $tags = explode(',' ,$blog->tags);
                                    foreach ($tags as $tag){ ?>
                                        <a href="#" title="<?= $tag ?>"><?= $tag ?></a>
                                    <?php }
                                }
                            ?>
                        </div>
                    </div>
                </section>
            </article>
        <?php } else { ?>
            <h2>No data found.</h2>
        <?php } ?>
        </div>
        <div id="loadFooter"></div>
    </div>
</div>
<?php require_once('footer.php'); ?>
			