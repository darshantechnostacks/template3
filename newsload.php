<?php

require_once('config.php');
$bloglist['websiteId'] = WEBSITE_ID;
$bloglist['lastid'] = (isset($_POST['lastid'])) ? $_POST['lastid'] : '0';
$bloglist['cat_id'] = (isset($_POST['cat_id'])) ? $_POST['cat_id'] : '0';
$bloglist['tags'] = (isset($_POST['tags'])) ? $_POST['tags'] : '';
$bloglist['apost_categorie_id'] = '2';

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
if($totpost>0){
foreach ($blogs as $key => $value) {
    if (!in_array($value->id, $uBlogsStatusIds)) {

        $messg .= "<li class='clearfix'>
                                    <div class='img-block'>";
        if (isset($value->featured_image) && !empty($value->featured_image)) {
            $messg .= " <a href='newsdetails.php?id=" . $value->id . "'><img src='" . API_URL . "geturl/uploads/feature_photo/" . $value->featured_image . "' class='img-responsive' style='max-height: 155px;min-height: 155px;width: 100%;'/></a>";
        } else {
            $messg .= " <a href='newsdetails.php?id=" . $value->id . "'><img src='images/default-blog.jpg' class='img-responsive' style='max-height: 155px;min-height: 155px;width: 100%;'/></a>";
        }
        $dt = strtotime($value->created);
        $messg .= "</div>
                                    <div class='content-block'>
                                        <a href='newsdetails.php?id=" . $value->id . "' class='title'>" . $value->title . "</a>";
        $messg .= "<div class='post_info'>";
        $messg .= "<span class='post_info_item post_info_posted'>";
        $messg .= "<a class='post_info_date'
               title='" . date("M j , Y", $dt) . "'>";
        $messg .= date('M j , Y', $dt);
        $messg .= "</a>";
        $messg .= "</span>";
        if(isset($value->uteam->name) && !empty($value->uteam->name)) {
        $messg .= "<span class='post_info_item post_info_posted'>Auth : ";
        $messg .= isset($value->uteam->name) ? $value->uteam->name : '';
        $messg .= "</span>";
        }
        $messg .= "</div>";
        $content = $value->content;
        if (strlen($content) > 100) {
            $content = substr($content, 0, 100) . ' ...';
        }
        $messg .= $content;
        $messg .= "<a href='newsdetails.php?id=" . $value->id . "' class='read-more'>Read more</a>
                                    </div>
                                </li>";

        $lastid = ++$i;
        }
    }
}
    if (!empty($blogs)) {
        $messg .= '<br/><div class="clearfix"></div>';
    } else {
        $messg = '<div><h3 class="text-center">No Data Found.</h3></div>';
    }
    $data['message'] = $messg;

    $data['last_id'] = $totpost;
    echo json_encode($data);
    exit;
    ?>		
