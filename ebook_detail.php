<?php
require_once('header.php');
$curl = new CURL();
$id = $_REQUEST['id'];
$websiteId = WEBSITE_ID;
$request = array(
    'conditions' => ['Uebook.is_deleted' => 0,'Uebook.websiteId' => $websiteId,'Uebook.status' => 1,'Uebook.id' => $id],
    'contain' => ['ebook'],
    'fields' => array(),
    'select' => array(),
    'get' => 'all',
    'order' => array('Uebook.id'=>'DESC'),
);

$result = $curl->send_api($request, 'Uebook/index');

if ($result->code == 200) {
    $book = isset($result->Uebook) ? $result->Uebook[0] : '';
}
if($book->is_edit == 0)
{
    $title = $book->Ebook->title;
    $image = $book->Ebook->cover_image;
    $description = $book->Ebook->description;
    $file_attach = $book->Ebook->file_attach;
}else{
    $title = $book->title; $image = $book->cover_image;
    $description = $book->description;
    $file_attach = $book->file_attach;
}
?>