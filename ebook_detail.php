<?php
require_once('header.php');
$curl = new CURL();
$id = $_REQUEST['id'];
$websiteId = WEBSITE_ID;
$request = array(
    'conditions' => ['Uebook.is_deleted' => 0, 'Uebook.websiteId' => $websiteId, 'Uebook.status' => 1, 'Uebook.id' => $id],
    'contain' => ['ebook'],
    'fields' => array(),
    'select' => array(),
    'get' => 'all',
    'order' => array('Uebook.id' => 'DESC'),
);

$result = $curl->send_api($request, 'Uebook/index');

if ($result->code == 200) {
    $book = isset($result->Uebook) ? $result->Uebook[0] : '';
}
if ($book->is_edit == 0) {
    $title = isset($book->Ebook->title) ? $book->Ebook->title : '';
    $image = isset($book->Ebook->cover_image) ? COVER_URL.$book->Ebook->cover_image : '';
    $description = isset($book->Ebook->description) ? $book->Ebook->description : '';
    $file_attach = isset($book->Ebook->file_attach) ? $book->Ebook->file_attach : '';
} else {
    $title = isset($book->title) ? $book->title : '';
    $image = isset($book->cover_image) ? COVER_URL.$book->cover_image : '';
    $description = isset($book->description) ? $book->description : '';
    $file_attach = isset($book->file_attach) ? FILE_URL.$book->file_attach : '';
}
?>

<div class="sub-page-banner mb3">
    <div class="banner-img">
        <img src="img/financial-calculator-banner.png" class="img-responsive" />
    </div>
    <div class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Ebook</h2>
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

<div class="container">
    <div class="row">
        <div class="card" style="width: 18rem;">
            <img class="card-img-top" src="<?= $image ?>" alt="<?=$title?>">
            <div class="card-body">
                <h5 class="card-title"><?= $title ?></h5>
                <p class="card-text"><?= $description ?></p>
                <a href="<?= $file_attach ?>" class="btn btn-danger">Download</a>
            </div>
        </div>
    </div>
</div>


<?php require_once('footer.php'); ?>
