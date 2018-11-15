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
<style type="text/css">
   .sc_columns .sc_column_item_inner {
   height: 100%;
   }
   .img_icon {
   margin: 0 60px;
   padding: 0;
   width: 60px;
   }

   .details img {
   height: 200px;
   float: left;
   margin-right: 26px;
   }
   .margin-bottom-2 {
   margin-bottom: 2rem !important;
   }
   .details p {
   font-size: 14px;
   text-align: justify;
   }
   .category-navigation {
   /* box-shadow: 1px 20px 30px 4px #e5eaff; */
   padding: 0px;
   float: right;
   }
   .details {
   float: left;
   padding-right: 15px;
   padding-left: 15px;
   }
   .cat-nav-header {
   background: black;
   color: white;
   text-align: center;
   border-radius: 14px;
   margin-bottom: 15px;
   }
   .cat-nav-header h3 {
   font-size: 20px;
   padding: 11px;
   margin: 0px;
   color: white;
   }
   .cat-content {
   background: #000;
   color: white;
   padding: 0px 0px 3px 1px;
   }
   .cat-content h5 {
   background: #da0513;
   padding: 16px;
   text-align: center;
   color: white;
   font-weight: bold;
   }
   .cat-content ul {
   padding: 2px;
   font-size: 16px;
   list-style: none;
   }
   .cat-content li {
   padding: 10px;
   text-align: center;
   }
   .cat-content li:hover,
   .cat-content li a:hover {
   background: #da0513;
   color: white;
   }
   .cat-footer {
   background: black;
   color: white;
   text-align: center;
   padding: 8px 19px 56px;
   margin-top: 26px;
   border-radius: 15px;
   }
   .cat-footer h3 {
   font-size: 20px;
   color: white;
   }
   .cat-footer input {
   border: none;
   padding: 5px;
   width: 100%;
   margin-bottom: 4px;
   border-radius: 5px;
   }
   .submit_btn {
   background: #da0513;
   padding: 8px 29px;
   margin-top: 5%;
   clear: both;
   position: relative;
   top: 17px;
   color: white;
   font-weight: bold;
   }
   .section {
   padding: 5px 80px!important;
   }
   .submit_btn:hover {
   color: white !important;
   }
</style>
<div class="page_top_wrap page_top_title page_top_breadcrumbs" style="background:url(<?php echo API_URL . 'geturl/uploads/icon/' . $settings_icon; ?>) no-repeat 59% 49%;max-height: 250px;background-size: cover;">
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
            <div class="col-xs-12 margin-bottom-2">
               <h3 class="blackFont animated fadeInUp"> <?php echo $pages->name; ?></h3>
               <div class="column-6_9 details">
                  <?php echo $page_detail_content; ?>
               </div>
               <!-- <div class="column-1_4 category-navigation"> -->
                  <!-- <div class="cat-content">
                     <h5>Services</h5>
                     <ul>
                        <li>
                           <a href="services-category.html">Service 1</a>
                        </li>
                        <li>
                           <a href="services-category.html">Service 1</a>
                        </li>
                        <li>
                           <a href="services-category.html">Service 1</a>
                        </li>
                        <li>
                           <a href="services-category.html">Service 1</a>
                        </li>
                        <li>
                           <a href="services-category.html">Service 1</a>
                        </li>
                        <li>
                           <a href="services-category.html">Service 1</a>
                        </li>
                     </ul>
                  </div -->>
                  <!-- <div class="cat-footer">
                     <h3>Contact</h3>
                     <input type="text" placeholder="Name">
                     <input type="text" placeholder="Email">
                     <br>
                     <a href="#" class="submit_btn" role="button">Submit</a>
                  </div> -->
               <!-- </div> -->
            </div>
         </div>
      </div>
   </section>
   <!-- <section class="grey_section">
      <div class="container">
         <div class="row">
            <div class="sc_contact_form sc_contact_form_standard">
               <h2 class="sc_contact_form_title">Contact Us Today</h2>
               <div class="sc_contact_form contact_form_1">
                  <form class="contact_1" method="post" action="contact-form.php">
                     <div class="sc_contact_form_info">
                        <div class="sc_contact_form_item sc_contact_form_field label_over">
                           <input type="text" name="username" id="contact_form_username" placeholder="Name *">
                        </div>
                        <div class="sc_contact_form_item sc_contact_form_field label_over">
                           <input type="text" name="email" id="contact_form_email" placeholder="Email *">
                        </div>
                        <div class="sc_contact_form_item sc_contact_form_field label_over">
                           <input type="text" name="form_website" id="contact_form_website" placeholder="Website">
                        </div>
                     </div>
                     <div class="message sc_contact_form_item sc_contact_form_message label_over">
                        <textarea  id="contact_form_message" class="textAreaSize" name="message" placeholder="Message *"></textarea>
                     </div>
                     <div class="sc_contact_form_item sc_contact_form_button">
                        <div class="squareButton sc_button_size sc_button_style_global global">
                           <button type="submit" name="contact_submit" class="sc_button button-hover sc_button_square sc_button_style_red sc_button_size_mini contact_form_submit" data-text="Send Message">Send Message</button>
                        </div>
                     </div>
                     <div class="result sc_infobox"></div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </section> -->
</div>
<!-- /.container -->
</div>
<?php require_once( 'footer.php');?>

