<?php

require_once('config.php');
$newslist['websiteId'] = WEBSITE_ID;
$newslist['lastid'] = (isset($_POST['lastid'])) ? $_POST['lastid'] : '0';
$newslist['cat_id'] = (isset($_POST['cat_id'])) ? $_POST['cat_id'] : '0';
$newslist['tags'] = (isset($_POST['tags'])) ? $_POST['tags'] : '';
$newslist['apost_categorie_id'] = '2';

$news_data = $curl->send_api($newslist, 'Aposts/getBlogs');
$news = array();
if (!empty($news_data) && $news_data->code == 200) {
    $news = $news_data->Aposts;
}

$tags = '';
$messg = '';
$lastid = '';
$tags_msg = '';


$websiteId['websiteId'] = WEBSITE_ID;
$uNewsStatus = $curl->send_api($websiteId, 'UblogStatus/index');
$uNewsStatusIds = array();
foreach ($uNewsStatus->UblogStatus as $item) {
    $uNewsStatusIds[] = $item->aposts_id;
}

$totpost = count($news);
$data = array();
$i = 0;
foreach ($news as $key => $value) {
    if (!in_array($value->id, $uNewsStatusIds)) {
        $messg .= "<li class='clearfix'>";
        $messg .= "<div class='img-block'>";
        $messg .= "<a href='newsdetails.php?id=" . $value->id . "'>";

        $blog_content = isset($value->content) ? $value->content : '';
        $image = isset($value->featured_image) ? FEATURE_PHOTO . $value->featured_image : '';
        if (!empty($image)) {
            $messg .= "<img src='$image' class='img-responsive' style='height: 154px; min-width: 200px;'/>";
        } else {
            $messg .= "<img src='img/blog-img.png' class='img-responsive' style='height: 154px; min-width: 200px;'/>";
        }

        $messg .= "</a>";
        $messg .= "</div>";
        $messg .= "<div class='content-block'>";
        $messg .= "<a href='newsdetails.php?id=" . $value->id . "' class='title'>";
        $messg .= isset($value->title) ? $value->title : '';
        $messg .= "</a>";
        $messg .= "<p>";
        $messg .= strip_tags(substr($blog_content, 0, 100) . '...');
        $messg .= "</p>";
        $dt = strtotime($value->created);
        $messg .= date('M d, Y', strtotime($value->created));

        if (isset($value->blogs_category->category_name)) {
            $messg .= "| <b>Category :</b> " . $value->blogs_category->category_name;
        }

        $messg .= "| <b>Category :</b> " . isset($value->blogs_category->category_name) ? $value->blogs_category->category_name : '';
        if (isset($value->uteam->name)) {
            $messg .= "| <b>Auth :</b> " . $value->uteam->name . ' ' . $value->uteam->last_name;
        }
        $messg .= "<br/>";
        $messg .= "<a href='newsdetails.php?id=" . $value->id . "' class='read-more'>Read more</a>";
        $messg .= "</div>";
        $messg .= "</li>";
    }
    $lastid = ++$i;
}

if (!empty($news)) {
    $messg .= '<br/><div class="clearfix"></div>';
} else {
    $messg = '<div><h3 class="text-center">No Data Fount</h3></div>';
}
$data['message'] = $messg;

$data['last_id'] = $totpost;
echo json_encode($data);
exit;
?>
