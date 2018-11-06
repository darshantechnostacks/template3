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
                $description = $book->Ebook->description;
                $final_ebook['data'][] = array('title' => $title, 'description' => $description, 'image' => $image, 'id' => $book->id);
            }
        } else {
            if ($book->is_setting == 1) {
                $banner_image = $book->cover_image;
                $banner_description = $book->description;
            } else {
                $title = $book->title;
                $image = $book->cover_image;
                $description = $book->description;
                $final_ebook['data'][] = array('title' => $title, 'description' => $description, 'image' => $image, 'id' => $book->id);
            }
        }
    }
    $final_ebook['banner_image'] = $banner_image;
    $final_ebook['banner_content'] = $banner_description;
}
?>

    <div class="sub-page-banner mb3">
        <div class="banner-img">
            <img src="<?= isset($final_ebook['banner_image']) ? COVER_URL . $final_ebook['banner_image'] : 'img/e-book-banner.png' ?>"
                 class="img-responsive"/>
        </div>
        <div class="page-title">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2>E-book</h2>
                        <h4>We love what we do and we’re good at it!</h4>
                    </div>
                </div>
            </div>
        </div>
        <ul class="top-contact-info">
            <li><i class="icon-mobile"></i><?= isset($homePages->firm_phone) ? $homePages->firm_phone : "" ?></li>
            <li><i class="icon-email"></i> <a
                        href="mailtto:<?= isset($homePages->firm_email) ? $homePages->firm_email : "" ?>"><?= isset($homePages->firm_email) ? $homePages->firm_email : "" ?></a>
            </li>
        </ul>
    </div>

    <div class="clearfix mb4">
        <div class="container">
            <div class="row">
                <div class="col-md-offset-1 col-md-10">
                    <ul class="listing-section">
                        <?php
                        foreach ($final_ebook['data'] as $single_book) {
                            ?>
                            <li>
                                <div class="img-block">
                                    <a href="#"><img
                                                src="<?= isset($single_book['image']) ? COVER_URL.$single_book['image'] : 'img/ebook.png' ?>"
                                                class="img-responsive"></a>
                                </div>
                                <div class="content-block">
                                    <a href="#"
                                       class="listing-title"><?= isset($single_book['title']) ? $single_book['title'] : '' ?></a>
                                    <p><?= isset($single_book['description']) ? $single_book['description'] : '' ?></p>
                                    <a href="ebook_detail.php?id=<?= $single_book['id'] ?>" class="btn btn-pink font-13 font-medium btn-small">MORE DETAILS</a>
                                </div>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

<?php require_once('footer.php') ?>