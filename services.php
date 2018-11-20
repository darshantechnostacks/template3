<?php require_once('header.php');
 $curl = new CURL();
   
   /********** Get pages ******/
   $row['websiteId'] = WEBSITE_ID;
   
   $result = $curl->send_api($row,'Uservices/getParentServicesAll');
   
   $pages = array();
   
   if($result->code == 200)
   {
   	$pages = $result->Uservices;
   }
   
   $settings = $pages->setting;
   
   if(!empty($settings) && $settings->edit_status == 0)
   {
      $settings_content = $settings->service->page_content;	
   	$settings_icon = $settings->service->icon;	
   }
   else
   {
   	$settings_content = isset($settings->page_content)?$settings->page_content:"";	
   	$settings_icon = isset($settings->icon)?$settings->icon:'';
   }
//img/service-banner.png   
   ?>
    <div class="sub-page-banner mb1">
        <div class="banner-img">
            <?php if(!empty($settings_icon)){ ?>
            <img src="<?php echo API_URL . 'geturl/uploads/icon/' . $settings_icon; ?>" class="img-responsive" style="max-height: 250px;background-size: cover;" />
            <?php }else{ ?>
            <img src="img/service-banner.png" class="img-responsive" style="max-height: 250px;background-size: cover;" />
            <?php } ?>
        </div>
        <div class="page-title">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2>SERVICES</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="about-section mb1">
        <div class="container">
            <div class="font-16 mb4 font-light"><?php echo $settings_content; ?></div>
            <div class="row services-inner">
                
                <?php
                   foreach($pages->services as $page){
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

                     $row['websiteId'] = WEBSITE_ID;
                     $row['parentId'] = $page->id;
                     $result = $curl->send_api($row,'Uservices/getServiceById');
                     
                     $link = '';
                     if(count($result->Uservices)> 0)
                     {
                        $link = 'services_sub.php?slug='.$page->page_slug;
                     }
                     else
                     {
                        $link = 'services_detail.php?slug='.$page->page_slug;
                     }

                     ?>
                
                
                <div class="col-md-4 col-sm-6 mb2">
                    <div class="inner-box clearfix">
                        <div class="icon-block">
                            <i class=" icon mb-3"><img src="<?php echo !empty($icon)? API_URL . 'geturl/uploads/icon/' . $icon :"img/services-icon.png"; ?>" class="img-responsive" /></i>
                        </div>
                        <div class="content">
                            <div class="title-block">
                                <a href="<?php echo $link;?>">  <h2 class="title"><?php echo $name ;?></h2></a>
                            </div>
                            <p class="mb1">
                                <?php echo strip_tags(substr($page_content,0,100));?>
                            </p>
                            <a href="<?php echo $link;?>" class="btn-link font-regular font-13">Read More >></a>
                        </div>

                    </div>
                </div>
                  
                  <?php } ?>
                
            </div>
        </div>
    </div>
    <?php require_once('footer.php'); ?>