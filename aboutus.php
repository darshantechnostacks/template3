<?php
    require_once('header.php');

    // $about_data = array();
    $data['websiteId'] = WEBSITE_ID;
    $settings_data = $curl->send_api($data, 'Uaboutus/GetSetting');

    
    $settings = array();
    if (!empty($about_data) && $about_data->code == 200) {
        $aboutus = $about_data->Uaboutus;
        $settings = $settings_data->Uaboutus;
        
    }
?>
<link href="css/ourteam.css" rel="stylesheet" />
    <div class="page_top_wrap page_top_title page_top_breadcrumbs" style="background:url(<?php echo API_URL . 'geturl/uploads/icon/' . $settings->image; ?>) no-repeat 59% 49%;max-height: 250px;background-size: cover;" >
        <div class="content_wrap">
            <div class="breadcrumbs">
                <a class="breadcrumbs_item home" href="index.php">Home</a>
                <span class="breadcrumbs_delimiter"></span>
                <span class="breadcrumbs_item current">About us</span>
            </div>
            <h1 class="page_title">About us</h1>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="content_wrap" style="border: none;margin-bottom:50px;">
                <div class="container">
                    <center>  <h3><?php echo strip_tags(substr($settings->description,0,100));?></h3> </center>
                </div>
                <div class="our-team animated fadeInUp">
                    <div class="container">
                        <div class="row">
                            <p><?php echo $aboutus->description;?></p>
                        </div>
                    </div>
                </div>
            </div>	
        </div>
    </div>
<?php require_once('footer.php'); ?>				
