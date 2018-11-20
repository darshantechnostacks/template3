<?php
require_once('header.php');

    $data['websiteId'] = WEBSITE_ID;
    $settings_data = $curl->send_api($data, 'Uaboutus/GetSetting');
    $aboutsettings = array();
    if (!empty($about_data) && $about_data->code == 200) {
        $aboutus = $about_data->Uaboutus;
        $aboutsettings = $settings_data->Uaboutus;
        
    }
    
    $coverImageUrl = !empty($aboutsettings->image)? API_URL . 'geturl/uploads/icon/' . $aboutsettings->image:"img/about-banner.png";
?>
<div class="sub-page-banner">
        <div class="banner-img">
            <img src="<?php echo $coverImageUrl; ?>" class="img-responsive" style="max-height: 250px;background-size: cover; " />
        </div>
        <div class="page-title">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2>About us</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="about-section mb1">
        <div class="container">
            <div class="row">
<!--                <div class="col-md-4 text-center mb3">
                    <div class="inline-block pos-relative">
                        <img src="img/company-img.png" class="img-responsive" />
                        <div class="box-line-title">
                            <span>Company</span>
                        </div>
                    </div>
                </div>-->

<!--                <div class="col-md-7 col-md-offset-1">-->
                     <div class="col-md-12">
                         <p><?php echo strip_tags($aboutsettings->description);?></p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?php echo $aboutus->description;?>
                </div>
            </div>
        </div>
    </div>
   <?php require_once('footer.php'); ?>

   