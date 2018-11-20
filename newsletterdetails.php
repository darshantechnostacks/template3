<?php
require_once('header.php');
$curl = new CURL();

/* * ******** Get Details ***** */
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
?>
<div class="sub-page-banner">
    <div class="banner-img">
        <?php if (empty($coverImage)) { ?>
            <img src="img/ebook-banner.png" class="img-responsive"  style="max-height: 250px;background-size: cover;"/>
        <?php } else { ?>
            <img src="<?php echo API_URL ?>geturl/uploads/feature_photo/<?php echo $coverImage; ?>" class="img-responsive" style="width:100%;max-height: 250px;background-size: cover;" />
        <?php } ?>
    </div>
    <div class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2>newsletter</h2>
                </div>
            </div>
        </div>
    </div>
    <a href="newsletters.php"></a>
</div>
<div class="about-section mb1">
    <div class="container">

         <?php if (isset($data) && !empty($data)) { ?>
                                <?php if($data->isedit == 1){?>
                                     <h3 class="font-22 font-medium mb1">
                                        <span class="sc_title_icon sc_title_icon_top  sc_title_icon_small icon-book-2"></span><?php echo!empty($data->title) ? $data->title : ""; ?>
                                    </h3>
                                    <?php if (isset($data->featured_image) && !empty($data->featured_image)) { ?>
                                        <img alt="<?php echo $data->title; ?>" src="<?php echo API_URL ?>geturl/uploads/feature_photo/<?php echo $data->featured_image; ?>" style="max-height:350px;">
                                    <?php } ?>
                                    <div class="font-16 text-justify">
                                        <p><?php echo !empty($data->content) ? $data->content : ""; ?></p>
                                    </div>
                              <?php   }else{  ?>
                                      <h3 class="font-22 font-medium mb1">
                                        <span class="sc_title_icon sc_title_icon_top  sc_title_icon_small icon-book-2"></span><?php echo!empty($data->Newsletters->title) ? $data->Newsletters->title : ""; ?>
                                    </h3>
                                    <?php if (isset($data->Newsletters->featured_image) && !empty($data->Newsletters->featured_image)) { ?>
                                        <img alt="<?php echo $data->Newsletters->title; ?>" src="<?php echo API_URL ?>geturl/uploads/feature_photo/<?php echo $data->Newsletters->featured_image; ?>" style="max-height:350px;">
                                    <?php } ?>
                                     <div class="font-16 text-justify">
                                        <p><?php echo !empty($data->Newsletters->content) ? $data->Newsletters->content : ""; ?></p>
                                    </div>
                               <?php  } ?>
                                
                                   
                                <?php } else { ?>
                                    <h2>No data found.</h2>
                                <?php } ?>
                                    
                       
    </div>
</div>

<?php require_once('footer.php'); ?>	

