<?php

require_once('config.php');
$bloglist['websiteId'] = WEBSITE_ID;
$bloglist['lastid'] = (isset($_POST['lastid'])) ? $_POST['lastid'] : '0';
$bloglist['cat_id'] = (isset($_POST['cat_id'])) ? $_POST['cat_id'] : '0';
$bloglist['tags'] = (isset($_POST['tags'])) ? $_POST['tags'] : '';
$bloglist['apost_categorie_id'] = '1';

$blogs_data = $curl->send_api($bloglist, 'Aposts/getBlogs');
$blogs = array();
if (!empty($blogs_data) && $blogs_data->code == 200) {
    $blogs = $blogs_data->Aposts;
}

$tags = '';
$messg = '';
$lastid = '';
$tags_msg = '';


$websiteId['websiteId'] = WEBSITE_ID;
$uBlogsStatus = $curl->send_api($websiteId, 'UblogStatus/index');
$uBlogsStatusIds = array();
foreach ($uBlogsStatus->UblogStatus as $item) {
    $uBlogsStatusIds[] = $item->aposts_id;
}

$totpost = count($blogs);
$data = array();
$i = 0;
foreach ($blogs as $key => $value) {
    if (!in_array($value->id, $uBlogsStatusIds)) {
        $messg .= "<li class='clearfix'>";
        $messg .= "<div class='img-block'>";
        $messg .= "<a href='blogdetails.php?id=".$value->id."'>";

            $blog_content = isset($value->content) ? $value->content : '';
            $image = isset($value->featured_image) ? FEATURE_PHOTO . $value->featured_image : '';
            if (!empty($image)) {
                $messg .= "<img src='$image' class='img-responsive'/>";
            } else {
                $messg .= "<img src='img/blog-img.png' class='img-responsive'/>";
            }

        $messg .= "</a>";
        $messg .= "</div>";
        $messg .= "<div class='content-block'>";
        $messg .= "<a href='blogdetails.php?id=".$value->id."' class='title'>";
        $messg .= isset($value->title) ? $value->title : '';
        $messg .= "</a>";
        $messg .= "<p>";
        $messg .= strip_tags(substr($blog_content, 0, 100) . '...');
        $messg .= "</p>";
        $dt = strtotime($value->created);
        $messg .= date('M d, Y', strtotime($value->created));
        $messg .= "| <b>Category :</b> ".isset($value->blogs_category->category_name) ? $value->blogs_category->category_name : '';
        if (isset($value->uteam->name)) {
            $messg .= "| <b>Auth :</b> ".$value->uteam->name . ' ' . $value->uteam->last_name;
            }
        $messg .= "<br/>";
        $messg .= "<a href='blogdetails.php?id=".$value->id."' class='read-more'>Read more</a>";
        $messg .= "</div>";
        $messg .= "</li>";
    }
    $lastid = ++$i;
}

if (!empty($blogs)) {
    $messg .= '<br/><div class="clearfix"></div>';
} else {
    $messg = '<div><h3 class="text-center">No Data Fount</h3></div>';
}
$data['message'] = $messg;

$data['last_id'] = $totpost;
echo json_encode($data);
exit;
?>
