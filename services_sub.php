<?php require_once('header.php'); 
$curl = new CURL();
   /********** Get pages ******/
   $row['websiteId'] = WEBSITE_ID;
   $row['slug']=$_GET['slug'];
   $result = $curl->send_api($row,'Uservices/getSubPageById');
   
   $pages = array();
   if($result->code == 200)
   {
   	$pages = $result->Uservices;
   }

   $page_detail = $pages->service_page;
   if($page_detail->edit_status == 0)
   {
      $page_detail_content = $page_detail->service->page_content; 
      $page_detail_icon = $page_detail->service->icon;   
   }
   else
   {
      $page_detail_content = $page_detail->page_content; 
      $page_detail_icon = $page_detail->icon;
   }


   $websiteId['websiteId'] = WEBSITE_ID;
   $pages_setting = $curl->send_api($websiteId,'Uservices/GetSetting');
   $page_setting = $pages_setting->Uservices;
   if($page_setting->edit_status == 0)
   {
      $settings_content = $page_setting->service->page_content; 
      $settings_icon = $page_setting->service->icon;   
   }
   else
   {
      $settings_content = $page_setting->page_content; 
      $settings_icon = $page_setting->icon;
   }
   
?>

    <div class="sub-page-banner mb1">
        <div class="banner-img">
            <img src="<?php echo !empty($settings_icon)? API_URL . 'geturl/uploads/icon/' . $settings_icon:"img/service_inner-banner.png"; ?>" class="img-responsive" />
        </div>
        <div class="page-title">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Services</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="about-section mb1">
        <div class="container">
 <div class="font-16 mb4 font-light"><?php echo $settings_content; ?></div>
 
            <div class="row services-inner">
                
                 <?php foreach($pages->services as $page){
                     /*********  End get pages *********/
                     if($page->edit_status == 0)
                     {
                        $page_content = $page->service->services_content[$set_no-1]->content;
                        $page_content = str_replace('{company_name}', '<b>'.$firm.'</b>', $page_content);
                        $page_content = str_replace('{city_name}', '<b>'.$city_name.'</b>', $page_content);

                     	// $page_content = $page->service->page_content;	
                     	$icon = $page->service->icon;	
                     	$name = $page->service->name;	
                     }
                     else
                     {
                     	$page_content = $page->page_content;	
                     	$icon = $page->icon;
                     	$name = $page->name;		
                     }
                     ?>
                <div class="col-md-4 col-sm-6 mb2">
                    <div class="inner-box clearfix">
                        <div class="icon-block">
                            <i class=" icon mb-3"><img src="<?php echo !empty($icon)? API_URL . 'geturl/uploads/icon/' . $icon:"img/services-icon.png"; ?>" class="img-responsive" /></i>
                        </div>
                        <div class="content">
                            <div class="title-block">
                                <h2 class="title"><?php echo $name ;?></h2>
                            </div>
                            <div class="mb1">
                             <?php echo strip_tags(substr($page_content,0,100));?>
                            </div>
                            <a href="services_detail.php?slug=<?php echo $page->page_slug;?>" class="btn-link font-regular font-13">Read More >></a>
                        </div>

                    </div>
                </div>
                  <?php } ?>
            </div>
        </div>
        <?php require_once('footer.php'); ?>
      