<?php 
   require_once('header.php');
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
<style type="text/css">
   .sc_columns .sc_column_item_inner {
   height: 100%;
   }
   .img_icon{
   margin: 0 60px;
   padding: 0;
   width: 60px;
   }
</style>
<div class="page_top_wrap page_top_title page_top_breadcrumbs" style="background:url(<?php echo API_URL . 'geturl/uploads/icon/' . $settings_icon; ?>) no-repeat 59% 49%;max-height: 250px;background-size: cover;" >
   <div class="content_wrap">
      <div class="breadcrumbs">
         <a class="breadcrumbs_item home" href="index.php">Home</a>
         <span class="breadcrumbs_delimiter"></span>
         <span class="breadcrumbs_item current">Services</span>
      </div>
      <h1 class="page_title">Services</h1>
   </div>
</div>
<div class="">
   <section class="grey_section">
      <div class="container">
         <div class="row">
            <div class="content_wrap">
               <div class="sc_under_title sc_section aligncenter column-3_5" data-animation="animated fadeInUp normal">
                  <?php echo substr($settings_content,0,400); ?>
               </div>
               <div class="columns_wrap sc_columns d-flex flex-wrap" data-animation="animated fadeInUp normal">
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
                  <div class="column-1_4 sc_column_item">
                     <div class="sc_column_item_inner">
                        <div class="sc_section d-flex flex-column justify-spacebetween">
                           <div class="flex-1">
                              <span class="sc_icon style_2 sc_icon_shape_none sc_icon_bg_custom"><img src="<?php echo API_URL . 'geturl/uploads/icon/' . $icon; ?>" class="img_icon" ></span>
                              <h5 class="sc_title sc_align_left"><?php echo $name ;?></h5>
                              <?php echo strip_tags(substr($page_content,0,100));?>
                           </div>
                           <a href="services_detail.php?slug=<?php echo $page->page_slug;?>" class="sc_button button-hover sc_button_square sc_button_style_clear sc_button_bg_link sc_button_size_mini  sc_button_iconed inherit" data-text="Learn more">Learn more</a>

                        </div>
                     </div>
                  </div>
                  <?php } ?>
               </div>
            </div>
         </div>
      </div>
   </section>
</div>
<?php require_once('footer.php');?>

