<?php require_once('header.php'); 
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
  
   if(!empty($page_setting) && $page_setting->edit_status == 0)
   {
      $settings_icon = $page_setting->service->icon;   
   }
   else
   {
      $settings_icon = isset($page_setting->icon)?$page_setting->icon:"";
   }
   
?>
    <div class="sub-page-banner mb4">
        <div class="banner-img">
            <img src="<?php echo !empty($settings_icon)? API_URL . 'geturl/uploads/icon/' . $settings_icon:"img/service_inner-banner.png"; ?>" class="img-responsive" style="max-height: 250px;background-size: cover;" />
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

    <div class="clearfix mb4">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                     <h3 > <?php echo $pages->name; ?></h3>
                     <div class="font-16">  <?php echo $page_detail_content; ?></div>
                </div>
            </div>
        </div>
    </div>

   <?php require_once ('footer.php'); ?>