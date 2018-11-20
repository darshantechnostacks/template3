<?php
require_once('header.php');
$curl = new CURL();
$websiteId = WEBSITE_ID;
$request = array(
    'conditions' => ['Uebook.is_deleted' => 0, 'Uebook.websiteId' => $websiteId, 'Uebook.status' => 1],
    'contain' => ['ebook'],
    'fields' => array(),
    'select' => array(),
    'get' => 'all',
    'order' => array('Uebook.id' => 'DESC'),
);

$result = $curl->send_api($request, 'Uebook/index');

if ($result->code == 200) {
    $Ebook = isset($result->Uebook) ? $result->Uebook : '';
}
$final_ebook = array();
if (count($Ebook) > 0) {
    $banner_image = '';
    $banner_description = '';
    $title = '';
    $image = '';
    foreach ($Ebook as $book) {
        if ($book->is_edit == 0) {
            if ($book->is_setting == 1) {
                $banner_image = $book->Ebook->cover_image;
                $banner_description = $book->Ebook->description;
            } else {
                $title = $book->Ebook->title;
                $image = $book->Ebook->cover_image;
                $final_ebook['data'][] = array('title' => $title, 'image' => $image, 'id' => $book->id);
            }
        } else {
            if ($book->is_setting == 1) {
                $banner_image = $book->cover_image;
                $banner_description = $book->description;
            } else {
                $title = $book->title;
                $image = $book->cover_image;
                $final_ebook['data'][] = array('title' => $title, 'image' => $image, 'id' => $book->id);
            }
        }
    }
    $final_ebook['banner_image'] = $banner_image;
    $final_ebook['banner_content'] = $banner_description;
    //img/ebook-banner.png
}
?>
<div class="sub-page-banner">
    <div class="banner-img">
        <?php if (!empty($final_ebook['banner_image'])) { ?>
            <img src="<?php echo API_URL ?>geturl/uploads/cover/<?php echo $final_ebook['banner_image']; ?>" class="img-responsive" style="max-height: 250px;background-size: cover;" />
        <?php } else { ?>
            <img src="img/ebook-banner.png" class="img-responsive" />
        <?php } ?>
    </div>
    <div class="page-title text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>E-book</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="about-section mb1">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <?php echo $final_ebook['banner_content']; ?>

                <ul class="listing-section">
                    <?php
                    if (count($final_ebook['data']) > 0) {
                        foreach ($final_ebook['data'] as $single_book) {
                            ?>
                            <li>
                                <div class="img-block">
                                    <a href="ebook_detail.php?id=<?php echo $single_book['id']; ?>"><img src="<?php echo API_URL ?>geturl/uploads/cover/<?php echo $single_book['image']; ?>" class="img-responsive" /></a>
                                </div>
                                <div class="content-block">
                                    <a href="ebook_detail.php?id=<?php echo $single_book['id']; ?>"><?php echo $single_book['title']; ?></a>
                                    <p> &nbsp;</p>
                                </div>
                            </li>
                            
                        <?php
                        }
                    } else {
                        ?>
                        
                                    <h4 class="sc_team_item_title">
                                        No Data Found.
                                    </h4>
                        
<?php } ?>


                </ul>
            </div>
        </div>

    </div>
</div>
<?php require_once('footer.php'); ?>    
