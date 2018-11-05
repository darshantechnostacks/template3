<?php

require_once('config.php');
$last_id = (isset($_POST['lastid'])) ? $_POST['lastid'] : 0;

$request = array(
    'conditions' => ['Unewsletters.is_deleted' => 0, 'Unewsletters.websiteId' => WEBSITE_ID,'Unewsletters.is_setting' =>0 ],
    'contain' => ['newsletters'],
    'fields' => array(),
    'select' => array(),
    'get' => 'all',
    'order' => array('Unewsletters.id' => 'desc'),
    "limit"=>3,
    "offset"=>$last_id,
);

$newsletterAlllist = (array) $curl->send_api($request, 'Unewsletters/index');

$messg = '';
$lastid = '';
$newsletterDet = array();
$newsletterDet = !empty($newsletterAlllist['Unewsletters']) ? $newsletterAlllist['Unewsletters'] : '';

$totpost = count($newsletterDet);
$data = array();

if (!empty($newsletterDet)) {
    foreach ($newsletterDet as $key => $value) {
        if ($value->isedit == 1) {
            $slug = isset($value->slug) ? $value->slug : '';
            $title = isset($value->title) ? $value->title : '';
            $content = isset($value->content) ? $value->content : '';
            $image = isset($value->featured_image) ? FEATURE_PHOTO.$value->featured_image : '';
        } else {
            $slug = isset($value->Newsletters->slug) ? $value->Newsletters->slug : '';
            $title = isset($value->Newsletters->title) ? $value->Newsletters->title : '';
            $content = isset($value->Newsletters->content) ? $value->Newsletters->content : '';
            $image = isset($value->Newsletters->featured_image) ? FEATURE_PHOTO.$value->Newsletters->featured_image : '';
        }
        $pull_class = '';
        $light_color = '';
        if($key % 2 != 0){
            $pull_class = 'col-md-pull-6';
            $light_color = 'light-color';
        }

        $messg .= "<div class='row row-eq-height'>";
        $messg .= "<div class='col-md-6 <?= $pull_class ?>'>";
	        if(!empty($image)){
	            $messg .= "<img src='$image' class='img-responsive' />";
	        } else {
                $messg .= "<img src='img/newsletter-img.png' class='img-responsive' />";
	        }
        $messg .= "</div>";
        $messg .= "<div class='col-md-6 content-block ".$pull_class."  ".$light_color." '>";
        $messg .= "<div class='text-center'>";
        $messg .= "<p>";
        $messg .= strip_tags(substr($content,0,250)).'...';
        $messg .= "</p>";
        $messg .= "<a href='newsletterdetails.php?slug=".$slug."' class='btn'>Read More</a>";
        $messg .= "</div>";
        $messg .= "</div>";
        $messg .= "</div>";

    }

}
if (!empty($newsletterDet)) {
    $messg .='<br/><div class="clearfix"></div>';
}else{
    $messg ='<div>No Record Found</div>';
}

$data['message'] = $messg;

$data['last_id'] = $totpost;
echo json_encode($data);
exit;
?>
