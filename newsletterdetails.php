<?php
require_once('header.php');

$curl = new CURL();

/* * ******** Get pages ***** */
$id = isset($_GET['slug']) ? $_GET['slug'] : '';

$request = array(
    'conditions' => ['Unewsletters.is_deleted' => 0, 'Unewsletters.slug' => $id, 'Unewsletters.websiteId' => WEBSITE_ID],
    'contain' => ['newsletters'],
    'fields' => array(),
    'select' => array(),
    'get' => 'all',
    'order' => array('Unewsletters.id' => 'desc'),
    "limit" => 1,
);

$result = $curl->send_api($request, 'Unewsletters/index');

$data = array();

if ($result->code == 200) {
    $data = isset($result->Unewsletters[0]) ? $result->Unewsletters[0] : '';
}

$newslettesSetting = array();
//get settings details
$requestSetting = array(
    'conditions' => ['Unewsletters.is_deleted' => 0, 'Unewsletters.websiteId' => WEBSITE_ID,'Unewsletters.is_setting'=>1],
    'contain' => ['newsletters'],
    'fields' => array(),
    'select' => array(),
    'get' => 'all',
    'order' => array('Unewsletters.id' => 'desc'),
    'limit' => '1'
);

$resultSetting = $curl->send_api($requestSetting, 'Unewsletters/index');

if ($resultSetting->code == 200) {
    $newslettesSetting = isset($resultSetting->Unewsletters[0]) ? $resultSetting->Unewsletters[0] : '';
}

 if($newslettesSetting->isedit === 1){
     $coverImage = $newslettesSetting->featured_image;
    
}else{
     $coverImage = $newslettesSetting->Newsletters->featured_image;
    
}

/* * *******  End get pages ******** */
?>
<div class="page_top_wrap page_top_title page_top_breadcrumbs" style="background:url(<?php echo API_URL ?>geturl/uploads/feature_photo/<?php echo $coverImage; ?>) no-repeat 59% 49%;max-height: 250px;background-size: cover;" >
    <div class="content_wrap">
        <div class="breadcrumbs">
            <a class="breadcrumbs_item home" href="index.php">Home</a>
            <span class="breadcrumbs_delimiter"></span>
            <a class="breadcrumbs_item home" href="newsletters.php">Newsletters</a>
            <span class="breadcrumbs_delimiter"></span>
            <span class="breadcrumbs_item current">Newsletter Details</span>
        </div>
        <h1 class="page_title">Our Newsletters </h1>
    </div>
</div>

<div class="page_content_wrap">

        <section class="">
            <div class="container" style="padding-top:0px;">
                <div class="row">
                    <div class="content_wrap">
                        
                        <article class="post_item post_item_single_team team has-post-thumbnail">
                            
                            <section class="post_content">
                                <?php if (isset($data) && !empty($data)) { ?>
                                <?php if($data->isedit == 1){?>
                                     <h2 class="sc_title sc_title_iconed ">
                                        <span class="sc_title_icon sc_title_icon_top  sc_title_icon_small icon-book-2"></span><?php echo!empty($data->title) ? $data->title : ""; ?>
                                    </h2>
                                    <?php if (isset($data->featured_image) && !empty($data->featured_image)) { ?>
                                        <img alt="<?php echo $data->title; ?>" src="<?php echo API_URL ?>geturl/uploads/feature_photo/<?php echo $data->featured_image; ?>" style="height:350px;width:100%">
                                    <?php } ?>
                                    <div class="team_education_description">
                                        <p><?php echo !empty($data->content) ? $data->content : ""; ?></p>
                                    </div>
                              <?php   }else{  ?>
                                     <h2 class="sc_title sc_title_iconed ">
                                        <span class="sc_title_icon sc_title_icon_top  sc_title_icon_small icon-book-2"></span><?php echo!empty($data->Newsletters->title) ? $data->Newsletters->title : ""; ?>
                                    </h2>
                                    <?php if (isset($data->Newsletters->featured_image) && !empty($data->Newsletters->featured_image)) { ?>
                                        <img alt="<?php echo $data->Newsletters->title; ?>" src="<?php echo API_URL ?>geturl/uploads/feature_photo/<?php echo $data->Newsletters->featured_image; ?>" style="height:350px;width:100%">
                                    <?php } ?>
                                    <div class="team_education_description">
                                        <p><?php echo !empty($data->Newsletters->content) ? $data->Newsletters->content : ""; ?></p>
                                    </div>
                               <?php  } ?>
                                
                                   
                                <?php } else { ?>
                                    <h2>No data found.</h2>
                                <?php } ?>

                                
                            </section>
                        </article>
                    </div>
                </div>
            </div>
        </section>

    

</div>



<?php require_once('footer.php'); ?>				
