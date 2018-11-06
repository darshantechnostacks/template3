<?php 
   require_once( 'header.php'); 
   $curl=new CURL(); 
   /********** Get pages ******/ 
   $row['websiteId']=WEBSITE_ID; 
   $row['slug']=$_GET['slug']; 
   $result=$curl->send_api($row,'Uservices/getPageById'); 
   $pages = array(); 
   if($result->code == 200) { $pages = $result->Uservices; }
   
   if($pages->edit_status == 0) {
    	
      $page_detail_content = $pages->service->services_content[$set_no-1]->content;
      $page_detail_content = str_replace('{company_name}', '<b>'.$firm.'</b>', $page_detail_content);
      $page_detail_content = str_replace('{city_name}', '<b>'.$city_name.'</b>', $page_detail_content);


      $page_detail_icon = $pages->service->icon; 
   } else { 
     	$page_detail_content = $pages->page_content; 
     	$page_detail_icon = $pages->icon; 
   } 

   $websiteId['websiteId'] = WEBSITE_ID;
   $pages_setting = $curl->send_api($websiteId,'Uservices/GetSetting');
   $page_setting = $pages_setting->Uservices;
   if($page_setting->edit_status == 0)
   {
      $settings_icon = $page_setting->service->icon;   
   }
   else
   {
      $settings_icon = $page_setting->icon;
   }

   ?>

<div class="sub-page-banner mb3">
    <div class="banner-img">
        <img src="<?= isset($settings_icon) ? ICON_URL.$settings_icon : 'img/service-inner-banner.png' ?>" class="img-responsive" />
    </div>
    <div class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4>Service </h4>
                    <h2><?= $pages->name ?></h2>
                </div>
            </div>
        </div>
    </div>
    <ul class="top-contact-info">
        <li><i class="icon-mobile"></i><?= isset($homePages->firm_phone) ? $homePages->firm_phone : "" ?></li>
        <li><i class="icon-email"></i> <a
                    href="mailtto:<?= isset($homePages->firm_email) ? $homePages->firm_email : "" ?>"><?= isset($homePages->firm_email) ? $homePages->firm_email : "" ?></a>
        </li>
    </ul>
</div>
<div class="clearfix mb4">
    <div class="container">
        <div class="row">
            <div class="col-md-4 text-center mb3">
                <div class="inline-block pos-relative">
                    <img src="<?= isset($page_detail_icon) ? ICON_URL.$page_detail_icon : 'img/real-estate-img.png' ?>" class="img-responsive">
                    <div class="box-line-title small">
                        <span><?= $pages->name ?></span>
                    </div>
                </div>
            </div>

            <div class="col-md-7 col-md-offset-1">
                <?= isset($page_detail_content) ? $page_detail_content : '' ?>
            </div>
        </div>
    </div>
</div>
<!-- /.container -->
<?php require_once( 'footer.php');?>

