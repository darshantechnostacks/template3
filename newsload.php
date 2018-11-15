<?php

require_once('config.php');
$newslist['websiteId'] = WEBSITE_ID;
$newslist['lastid'] = (isset($_POST['lastid'])) ? $_POST['lastid'] : '0';
$newslist['cat_id'] = (isset($_POST['cat_id'])) ? $_POST['cat_id'] : '0';
$newslist['tags'] = (isset($_POST['tags'])) ? $_POST['tags'] : '';
$newslist['apost_categorie_id'] = '2';

$news_data = $curl->send_api($newslist, 'Aposts/getNews');
$news = array();
if (!empty($news_data) && $news_data->code == 200) {
    $news = $news_data->Aposts;
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

$totpost = count($news);
$data = array();
$i = 0;
foreach ($news as $key => $value) {
    if (!in_array($value->id, $uBlogsStatusIds)) {
        $messg = "<article class='post_item post_item_excerpt post has-post-thumbnail'>";
        $messg .= "<div class='post_featured'>";
        $messg .= "<div class='post_thumb' data-image='images/1150x752.png' data-title='" . $value->title . "'>";
        if (isset($value->featured_image) && !empty($value->featured_image)) {
            $messg .= "<a class='hover_icon_link inited' href='blogdeatails.php?id=" . $value->id . "'>";
        }
        $messg .= "<img style='height:280px;' alt='" . $value->title . "'
                 src='" . API_URL . "geturl/uploads/feature_photo/" . $value->featured_image . "'>";
        $messg .= "<div class='img-hover'>";
        $messg .= "<span class='hover_icon'> </span>";
        $messg .= "</div>";
        $messg .= "</a>";
    } else {
        $messg .= "<a class='hover_icon_link inited' href='blogdeatails.php?id=" . $value->id . "'>";
        $messg .= "<img alt='" . $value->title . "' src='images/default-blog.jpg'>";
        $messg .= "</a>";
    }
    $messg .= "</div>";
    $messg .= "</div>";
    $messg .= "<div class='post_content clearfix'>";
    $messg .= "<h3 class='post_title'>";
    $title = $value->title;
    if (strlen($title) > 50) {
        $title = substr($title, 0, 50) . ' ...';
    }
    $dt = strtotime($value->created);
    $messg .= "<a href='blogdeatails.php?id=" . $value->id . "' title='" . $title . "'>";
    $messg .= "<span class='post_icon icon-book-2'> </span>";
    $messg .= $title;
    $messg .= "</a>";
    $messg .= "</h3>";
    $messg .= "<div class='post_info'>";
    $messg .= "<span class='post_info_item post_info_posted'>";
    $messg .= "<a class='post_info_date'
               title='" . date("M j , Y", $dt) . "'>";
    $messg .= date('M j , Y', $dt);
    $messg .= "</a>";
    $messg .= "</span>";
    // $messg .= "<span class='post_info_item post_info_posted'>Category : ";
    // $messg .= isset($value->blogs_category->category_name) ? $value->blogs_category->category_name : '';
    // $messg .= "</span>";
    // $messg .= "<span class='post_info_item post_info_posted'>Auth : ";
    // $messg .= isset($value->uteam->name) ? $value->uteam->name : 'Admin';
    // $messg .= "</span>";
    $messg .= "</div>";
    $messg .= "<div class='post_descr'>";
    $messg .= "<p>";

    $content = $value->content;
    if (strlen($content) > 100) {
        $content = substr($content, 0, 100) . ' ...';
    }
    $messg .= $content;

    $messg .= "</p>";
    $messg .= "<a href='blogdeatails.php?id=" . $value->id . "' class='sc_button button-hover sc_button_square sc_button_style_red sc_button_size_mini' data-text='More Info' title='More Info'>";
    $messg .= "More Info";
    $messg .= "</a>";
    $messg .= "</div>";
    $messg .= "</div>";
    $messg .= "</article>";

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
