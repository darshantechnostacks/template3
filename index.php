<?php
require_once('header.php');

/* * ******* Get Banner data ******** */
$datas['websiteId'] = WEBSITE_ID;
$banners = $curl->send_api($datas, 'Ubanners/getActiveBanner');
$banner = array();
if (!empty($banners) && $banners->code == 200) {
    $banner = $banners->Ubanners;
}
/* * ******* End Get Banner data ******** */
/* * ********  getAllServices ***** */
$services_data = array();
$services_data['websiteId'] = WEBSITE_ID;

$services_datas = $curl->send_api($services_data, 'Uservices/getAllServices');
$services = array();

if (!empty($services_datas) && $services_datas->code == 200) {
    $services = $services_datas->Uservices;
}
/* * ******** End  getAllServices*** */

/* * ******Get Blogs********* */
$blog['is_deleted'] = 0;
$blog['apost_categorie_id'] = 1;
$blog['status'] = 1;
$blog['cat_id'] = 0;
$blog['tags'] = '';
$blog['websiteId'] = WEBSITE_ID;

$blogs_data = $curl->send_api($blog, 'Aposts/getBlogs');
$blogs = array();
if (!empty($blogs_data) && $blogs_data->code == 200) {
    $blogs = $blogs_data->Aposts;
}

/* * ******End Blogs********* */

/* * *****  getUserByLogo **** */

$alogos = array();
if (!empty($homePages->membership_certification)) {
    $alogos_data['id'] = $homePages->membership_certification;
    $alogos = $curl->send_api($alogos_data, 'Alogos/getUserByLogo');
}
/* * ************  End getUserByLogo ************** */


/* * ***Get News******** */
$blogNews['is_deleted'] = 0;
$blogNews['apost_categorie_id'] = 2;
$blogNews['status'] = 1;
$blogNews['websiteId'] = WEBSITE_ID;

$news_data = $curl->send_api($blogNews, 'Aposts/getNews');

$news = array();
if (!empty($news_data) && $news_data->code == 200) {
    $news = $news_data->Aposts;
}
/* * ***End News******** */
?>

<div class="top-slider-outer">
    <ul class="top-slider">
        <?php
        if (count($banner) > 0) {
            foreach ($banner as $banner_value) {
               
                ?>
                <li>
                    <div class="image">
                        <img src="<?php echo API_URL . 'geturl/uploads/banner/' . $banner_value->banner; ?>" alt="<?php echo $banner_value->banner_title; ?>"/>
                    </div>

                    <div class="block row">
                        <div class="title col-sm-12">
                            <p class="mb2"> <?php echo $banner_value->banner_title; ?></p>
                            <p style="font-size: 20px;"><?php echo $banner_value->banner_desc;?></p>
                            <?php if(!empty($banner_value->button_link)){ ?>
                            <a href="<?php echo $banner_value->button_link; ?>" class="btn btn-orange btn-radius"><?php echo !empty($banner_value->button_name)?$banner_value->button_name:"MORE DETAIL" ?> </a>
                            <?php }?>
                        </div>
                    </div>
                </li>
                <?php
            }
        } else {
            ?>
            <li>
                <div class="image">
                    <img src="img/banner-bg.png" />
                </div>
                <div class="block row">
                    <div class="title col-sm-12">
                        <p class="mb2"> LOREM IPSUM DUMMY TEXT FOR PRINT</p>
                        <a href="#" class="btn btn-orange btn-radius">MORE DETAIL</a>
                    </div>
                </div>
            </li>
            <li>
                <div class="image">
                    <img src="img/banner-bg.png" />
                </div>
                <div class="block row">
                    <div class="title col-sm-12">
                        <p class="mb2"> LOREM IPSUM DUMMY TEXT FOR PRINT</p>
                        <a href="#" class="btn btn-orange btn-radius">MORE DETAIL</a>
                    </div>
                </div>
            </li>
        <?php } ?>
    </ul>
</div>

</div>

<div class="about-section mb1">
    <div class="container">
        <div class="row">
            <div class="col-md-4 text-center mb5">
                <div class="inline-block pos-relative">
                    <img src="img/about-img.png" class="img-responsive" />
                    <div class="box-line-title">
                        <span>About Us</span>
                    </div>
                </div>
            </div>

            <div class="col-md-7 col-md-offset-1">

                <p style="text-align: center;font-size: 16px;">Introduction of <b><?php echo isset($homePages->firm_name) ? $homePages->firm_name : ""; ?></b></p>

                <?php echo isset($homePages->about_your_company) ? substr($homePages->about_your_company, 0, 878) . '...' : "" ?><br>
                <center>    <a href="aboutus.php"> <BUTTON style="margin-top: 33px;" class="btn btn-radius btn-shadow btn-orange">Read More</BUTTON></a></center>


            </div>
        </div>

    </div>
</div>
<div class="services-section mb3">
    <div class="container">
        <div class="clearfix row mb3">
            <div class="col-md-offset-3 col-md-6">
                <h1 class="title mb2 text-center"><span>Services</span></h1>
                <p class="mb2 sub-title text-center">
                    <?php echo $settings->home_page_service_content; ?>
                </p>
            </div>
        </div>
        
        <?php 
        if (!empty($services)) { ?>
            <div class="row services-inner">
                <?php
                if (!empty($services)) {
                    $defIcon = array('icon-calculator', 'icon-moneybag', 'icon-moneypig', 'icon-gold2');
                    $i = 0;
                    foreach ($services as $service) {
                      
                        ?>
                        <div class="col-md-4 col-sm-6 mb2">
                            <div class="inner-box clearfix">
                                <div class="icon-block">
                                    
                                    
                                    <?php
                                    if ($service->edit_status == 0 && !empty($service->service->icon)) {?>
                                        <i class=" icon mb-3">  <img src="<?php echo API_URL . 'geturl/uploads/icon/' . $service->service->icon; ?>" class="img-responsive"/></i>
                                   <?php }else if( ($service->edit_status ==1) &&  ($service->icon != '')){ ?>
                                       <i class=" icon mb-3">  <img src="<?php echo API_URL . 'geturl/uploads/icon/' . $service->icon; ?>" class="img-responsive"/></i>
                                   <?php }else{?>
                                        <i class=" icon mb-3"><img src="img/services-icon.png" class="img-responsive"></i>
                                    <?php } ?>
                                </div>
                                <div class="content">
                                    <div class="title-block">
                                        <a href="services_detail.php?slug=<?php echo $service->page_slug; ?>"> <h2 class="title"><?php echo $service->name; ?></h2></a>
                                    </div>
                                    <?php
                                    if ($service->edit_status == 1) {
                                        echo substr($service->page_content, 0, 100);
                                    } else {
                                       echo  $page_detail_content = strip_tags(substr($service->service->services_content[$set_no-1]->content,0,100));
                                        //echo strip_tags(substr($service->service->page_content, 0, 100));
                                    }
                                    ?>

                                    <a href="services_detail.php?slug=<?php echo $service->page_slug; ?>" class="sc_button button-hover sc_button_square sc_button_style_clear sc_button_bg_link sc_button_size_mini  sc_button_iconed inherit" data-text="Learn more">Learn more</a>
                                </div>
                            </div>
                        </div>

                        <?php
                        $i++;

                        if ($i == 3) {
                            break;
                        }
                    }
                }
                ?>

            </div>
        <div class="row mb3">
                <div class="col-md-12 text-center">
                    <a href="services.php" class="btn btn-radius btn-shadow btn-orange">See More</a>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<div class="counter-section">
    <div class="counter-info-title-block mb3">
        <div class="container text-center">
            <h1 class="counter-title">Some Interesting Facts About Us</h1>
            <p class="counter-sub-title">   <?php echo $settings->home_page_counter_content; ?></p>
        </div>
    </div>
    <div class="container">
        <div class="row mb3">
            <div class="col-md-3-5 col-sm-6 col-xs-12 mb2 text-center">
                <div class="clearfix block text-center">
                    <?php if (is_numeric($homePages->no_of_clients)) { ?>
                        <p>No of clients</p>
                        <div class="icon-block">
                            <img src="images/ic_no_of_client.png" class="" />
                            <div class="content">
                                <h3><?php echo $homePages->no_of_clients; ?></h3>
                            </div>
                        </div>
                        <?php
                    } else {
                        $cnt1 = json_decode($homePages->no_of_clients);
                        ?>
                        <p><?php echo $cnt1->label; ?></p>
                        <div class="icon-block">
                            <img src="images/ic_no_of_client.png" class="" />
                            <div class="content">
                                <h3><?php echo $cnt1->value; ?></h3>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="col-md-3-5 col-sm-6 col-xs-12 mb2 text-center">
                <div class="clearfix block  text-center">
                  <?php if (is_numeric($homePages->no_of_employees)) { ?>
                        <p>No of Employee</p>
                        <div class="icon-block">
                            <img src="images/ic_no_of_emp.png" class="" />
                            <div class="content">
                                <h3><?php echo $homePages->no_of_employees; ?></h3>
                            </div>
                        </div>
                        <?php
                    } else {
                        $cnt1 = json_decode($homePages->no_of_employees);
                        ?>
                        <p><?php echo $cnt1->label; ?></p>
                        <div class="icon-block">
                            <img src="images/ic_no_of_emp.png" class="" />
                            <div class="content">
                                <h3><?php echo $cnt1->value; ?></h3>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="col-md-3-5 col-sm-6 col-xs-12 mb2 text-center">
                <div class="clearfix block text-center">
                    <?php if (is_numeric($homePages->client_reviews)) { ?>
                        <p>Client reviews</p>
                        <div class="icon-block">
                            <img src="images/ic_client_review.png" class="" />
                            <div class="content">
                                <h3><?php echo $homePages->client_reviews; ?></h3>
                            </div>
                        </div>
                        <?php
                    } else {
                        $cnt1 = json_decode($homePages->client_reviews);
                        ?>
                        <p><?php echo $cnt1->label; ?></p>
                        <div class="icon-block">
                            <img src="images/ic_client_review.png" class="" />
                            <div class="content">
                                <h3><?php echo $cnt1->value; ?></h3>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                </div>
                 <div class="col-md-3-5 col-sm-6 col-xs-12 mb2 text-center">
                     <div class="clearfix block text-center">
                <?php if (is_numeric($homePages->special_projects)) { ?>
                        <p>Special Project</p>
                        <div class="icon-block">
                            <img src="images/ic_projects.png" class="" />
                            <div class="content">
                                <h3><?php echo $homePages->special_projects; ?></h3>
                            </div>
                        </div>
                        <?php
                    } else {
                        $cnt1 = json_decode($homePages->special_projects);
                        ?>
                        <p><?php echo $cnt1->label; ?></p>
                        <div class="icon-block">
                            <img src="images/ic_projects.png" class="" />
                            <div class="content">
                                <h3><?php echo $cnt1->value; ?></h3>
                            </div>
                        </div>
                    <?php } ?>
                     </div>
            </div>
            <div class="col-md-3-5 col-sm-6 col-xs-12 mb2 text-center">
                <div class="clearfix block">
                    <?php if (is_numeric($homePages->serving_community_since)) { ?>
                        <p>Serving Community</p>
                        <div class="icon-block">
                            <img src="images/ic-community.png" class="" />
                            <div class="content">
                                <h3><?php echo $homePages->serving_community_since; ?></h3>
                            </div>
                        </div>
                        <?php
                    } else {
                        $cnt1 = json_decode($homePages->serving_community_since);
                        ?>
                        <p><?php echo $cnt1->label; ?></p>
                        <div class="icon-block">
                            <img src="images/ic-community.png" class="" />
                            <div class="content">
                                <h3><?php echo $cnt1->value; ?></h3>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="row mb2">
            <div class="col-md-12 text-center">
                <a href="aboutus.php" class="btn btn-radius btn-shadow btn-orange">More about it !</a>
            </div>
        </div>
    </div>
</div>
<?php if (!empty($blogs)) { ?>
    <div class="blog-section mb3">
        <div class="container">
            <h1 class="title text-center mb3">Blogs</h1>
            <div class="row mb3">
                <?php
                $jk = 0;
                foreach ($blogs as $key => $blog) {
                    ?>
                    <div class="col-md-4 col-sm-6 mb2">
                        <div class="blog-inner">
                            <div class="img-block text-center">
                                <?php if ($blog->featured_image != '') { ?>
                                    <img src="<?php echo API_URL ?>geturl/uploads/feature_photo/<?php echo $blog->featured_image; ?>" class="img-responsive full-width" style="width:356px;height:234px;"/>
                                <?php } else { ?>
                                    <img alt="<?php echo $blog->title; ?>" src="<?php echo API_URL ?>geturl/uploads/feature_photo/default.png" style="width:356px;height:234px;">
                                <?php } ?>

                            </div>
                            <div class="content">
                                <h3><?php echo $blog->title; ?></h3>
                                <?php echo substr($blog->content, 0, 170) . '...'; ?>
                            </div>
                            <div class="hover-title">
                                <a href="blogdeatails.php?id=<?php echo $blog->id; ?>">VIEW BLOG</a>
                            </div>
                        </div>
                    </div>
                    <?php
                    $jk++;
                    if ($jk == 3) {
                        break;
                    }
                }
                ?>

            </div>
            <div class="row mb3">
                <div class="col-md-12 text-center">
                    <a href="blogs.php" class="btn btn-radius btn-shadow btn-orange">See More</a>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<div class="schedule-section mb3">
    <div class="container">
        <div class="row">
            <div class="col-md-8 mb2">
                <h1 class="title">SCHEDULE A DEMO</h1>
                <h3>INSTRUCT HOW TO WORK</h3>
                <!-- <div class="mb3">
                    <a href="#" class="btn btn-orange btn-radius text-uppercase">Schedule a Demo</a>
                </div> -->
                <div class="font-16" style="color:white;">
                <?php 
                echo $settings->home_page_schedule_content; ?>
                </div>
            </div>
            <div class="col-md-4">
                <div id="datepicker"></div>
            </div>
        </div>
    </div>
</div>
<?php

if (!empty($alogos) && !empty($alogos->Alogos)) { ?>
    <div class="membership-section mb3">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="title mb3"><?php echo !empty($settings->logo_title)?$settings->logo_title:"Membership and Associations" ?></h1>
                    <div class=" clearfix text-center">
                        <ul class="membership-slider">
                            <?php
                            if (!empty($alogos)) {
                                if (count($alogos) > 0 && !empty($alogos->Alogos)) {
                                    foreach ($alogos->Alogos as $logo) {
                                        ?>
                                        <li><img src="<?php echo API_URL . 'geturl/uploads/logo/' . $logo->logo; ?>" alt="<?php echo $logo->logo; ?>" style="max-height:115px;width:204px;"></li>
                                        <?php
                                    }
                                }
                            }
                            ?>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<div class="news-section mb5">
    <div class="container mb5">
        <h1 class="title text-center mb3">News</h1>
        <p class="text-center">
            <?php echo $settings->home_page_news_content; ?>
        </p>
    </div>

    <div class="section mb2">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb2">
                    <?php
                    if (!empty($news)) {
                        
                        $i = 0;
                        ?>
                        <ul class="news-slider text-center">
                            <?php foreach ($news as $new) { ?>

                                <li class="clearfix">
                                    <div class="icon-block">
                                        <i class="icon-eye-2"></i>
                                    </div>
                                    <!--<?php //if ($new->featured_image != '') {  ?>
                                                        <img alt="////<?php //echo $new->title;   ?>" src="<?php //echo API_URL   ?>geturl/uploads/feature_photo/<?php //echo $new->featured_image;   ?>" style="width:356px;height:234px;">
                                    <?php //} else {  ?>
                                                        <img alt="////<?php //echo $new->title;  ?>" src="<?php //echo API_URL  ?>geturl/uploads/feature_photo/default.png" style="width:356px;height:234px;">
                                    <?php // }  ?>-->
                                    <div class="content">
                                        <a href="newsdeatails.php?id=<?php echo $new->id; ?>"><h3 class="title"><?php echo substr($new->title,0,50); ?></h3></a>
                                        <?php echo strip_tags(substr($new->content, 0, 60)); ?>
                                    </div>
                                </li>
                                <?php
                                $i++;
                                if ($i == 8) {
                                    break;
                                }
                            }
                        } else {
                            ?>
                       
                        <h3>Record not found.</h3>
                    <?php } ?>
 </ul>
                </div>
                <div class="col-md-6 mb2">
                    <div class="subscribe-block">
                        <div class="subscribe-icon">
                            <div class="inner-block">
                                <i class="icon-mail-alt"></i>
                            </div>
                        </div>
                        <div class="inner">
                            <h3>Subscribe to our newsletter</h3>

                            <div class="clearfix">
                                <div class="clearfix">
                                    <form class="cmxform form-horizontal" method="POST" name="frmsubscription" id="frmsubscription">
                                        <input type="text" name="first_name" id="first_name" class="txt-box" placeholder="First Name" required/>
                                        <input type="text" name="last_name" id="last_name" class="txt-box" placeholder="Last Name" required/>
                                        <input type="text" name="subemail" id="subemail" class="txt-box" placeholder="Email" required/>

                                        <input type="submit" class="btn-black btn"  title="Submit"  id="subscribe_button" value="Subscribe" name="subscribe">
                                    </form>
                                </div>
                                <!--                                <div class="clearfix remind-me">
                                                                    <label><input type="checkbox" /> Remind me </label>
                                                                </div>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="contact-section contact-section join-footer">
    <div class="container">
        <h1 class="title text-center mb3">Contact</h1>
        <p> <?php echo $settings->home_page_contact_content; ?></p>
            
        <div class="contact-block">
            <div class="contact-info-outer row clearfix">
                <div class="col-md-4 col-sm-4 col-xs-6 col-sm-offset-4 col-md-offset-4">
                    <a href="mailto:<?php echo isset($homePages->firm_email) ? $homePages->firm_email : ""; ?>" class="btn-block mb2 txt-mail"><i class="icon-mail"></i> <?php echo isset($homePages->firm_email) ? $homePages->firm_email : ""; ?></a>
                    <label class="btn-block mb2"><i class="icon-phone"></i> <?php echo isset($homePages->firm_phone) ? $homePages->firm_phone : ""; ?></label>
                    
                    <label class="btn-block"><i class="icon-location"></i> 
                    <?php
                        if (!empty($addresses)) {
                                        foreach ($addresses as $key => $address) {
                                            $fullAddr = $address->street_address_1 . ' ' . $address->street_address_2 . ' ' . $address->Cities->city . ' ' . $address->States->state_name . ' ' . $address->Cities->county . ' - ' . $address->zip_code;
                                            break;
                                        }
                                        echo $fullAddr;
                        }else{
                             echo isset($homePages->firm_address) ? ($homePages->firm_address.' '.$homePages->firm_address_2) : ""; ?><?php echo ($homePages->zip_code != '') ? " ".$homePages->zip_code : ''; 
                         }?>
    
                    
                    </label>
                    
                </div>

            </div>
            <div class="say-something-block">
                <h4>SAY SOMETHING</h4>
                <div class="clearfix">
                    <form id="frmcontactus" method="POST">
                        <input type="text" name="username" id="username" class="txt-box" placeholder="Name" required/>
                        <input type="text" name="email" id="email" class="txt-box" placeholder="Email Address" required/>
                        <textarea name="message" id="message" class="txt-box mb1" rows="5" placeholder="Message" required></textarea>
                        <input type="submit" class="btn-orange btn btn-block text-center"  title="Submit"  id="contactus_button" value="Send" >
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- model popup -->
<div class="modal fade"   id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel"></h4>
            </div>


            <div class="modal-body">

                <div id="appointment_message"></div>
                <form id="book_an_appointment">
                    <label> Choose your preferable time</label> 
                    <select class="form-control" id="time_slot" name="time_slot" onchange="settimeslot(this.value)">
                        <option value="">Select</option>
                        <?php foreach ($timeslots as $slot) { ?>
                            <option value="<?php echo $slot->id; ?>"><?php echo $slot->title; ?></option>
                        <?php } ?>
                    </select> 	
                    <br>

                    <input type="hidden" id="datep"  name="book_date"/>
                    <!-- <input type="hidden" value="" name="time_slot" id="time_slot" /> -->

                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" id="name" name="name" require class="form-control input-normal"   >
                        <span class="name_error error"></span>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" id="bk_email" name="email" require class="form-control input-normal"  >
                        <span class="bk_email_error error"></span>
                    </div>

                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" id="phone" name="phone" require class="form-control input-normal" >
                        <span class="phone_error error"></span>
                    </div>
                    <div class="form-group">
                        <label>Booking type</label>
                        <div class="radio-custom radio-success">
                            <input type="radio" value="1" name="booking_type" id="telephone">
                            <label for="telephone">Telephone</label>
                        </div>
                        <div class="radio-custom radio-success">
                            <input type="radio" value="2" name="booking_type" id="face-to-face">
                            <label for="face-to-face">Person</label>
                        </div>
                        <div class="radio-custom radio-success">
                            <input type="radio" value="3" name="booking_type" id="conference">
                            <label for="conference">Conference</label>
                        </div>
                        <span class="booking_type_error error"></span>
                    </div>

                    <div class="form-group">
                        <label>Comment</label>
                        <textarea name="information"  id="comment" require class="form-control input-normal">  </textarea>
                        <span class="comment_error error"></span>
                    </div>

                    <div class="modal-footer">
                        <input class="btn btn-primary submit_button"  disabled="disabled" value="Submit" type="submit">
                    </div>
                </form>	
            </div>
        </div>
    </div>
</div>
<!-- End Model-->
<!-- Model 2 -->
<div class="modal fade  " id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">            
            <div class="modal-body text-center" id="bkmessage">

            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true" type="button"> Ok</button>
            </div>
        </div>
    </div>
</div>

<?php require_once('footer.php'); ?>

<script>
    $(function () {
        $("#datepicker").datepicker({minDate: 0});
    });


    function settimeslot(valu) {
        jQuery('.submit_button').prop('disabled', false);
    }
    var $datePicker = jQuery("#datepicker");
    $datePicker.datepicker({
        minDate: 0,
        inline: true,
        altField: "#datep",
        onSelect: function () {

            jQuery('.submit_button').prop('disabled', true);
            jQuery('#myModal').modal();
            jQuery('#time_slot').val('');
            jQuery('#name').val('');
            jQuery('#bk_email').val('');
            jQuery('#phone').val('');
            jQuery('#comment').val('');

            var c_date = jQuery('#datep').val();

            jQuery('#exampleModalLabel').html('Appointments on ' + c_date)

        }
    });

    jQuery(document).ready(function () {

        jQuery(document).on('change', 'input:radio[id^="q_op_"]', function (event) {
            jQuery('.submit_button').prop('disabled', false);
            var value = jQuery(this).val();
            jQuery('#time_slot').val(value);
        });
    });

    function showDiv() {
        document.getElementById('btn_apt').style.display = "block";
        // jQuery('.button_appointment').click(function(){jQuery("#btn_apt").toggle();});
    }

    jQuery("#book_an_appointment").submit(function (event) {

        var name = jQuery('#name').val();
        var email = jQuery('#bk_email').val();
        var phone = jQuery('#phone').val();
        var comment = jQuery('#comment').val();
        $('.name_error').html('');
        $('.bk_email_error').html('');
        $('.phone_error').html('');
        $('.comment_error').html('');

        if (name == '')
        {
            $('.name_error').html('Please enter name');
            return false;
        }

        if (email == '')
        {
            $('.bk_email_error').html('Please enter email');
            return false;
        }

        if (phone == '')
        {
            $('.phone_error').html('Please enter phone');
            return false;
        }

        if (comment == '')
        {
            $('.comment_error').html('Please enter comment');
            return false;
        }

        event.preventDefault(); //prevent default action
        var post_url = 'bookappointments.php'; //get form action url
        var request_method = jQuery(this).attr("method"); //get form GET/POST method
        var form_data = jQuery(this).serialize() + "&type=add"; //Encode form elements for submission
        jQuery.ajax({
            url: post_url,
            data: form_data,
            type: 'post',
            beforeSend: function () {
                //  jQuery("#loading-image").show();
                jQuery('.loadingLoader').show();
                jQuery('.overlay').show();
            },
            success: function (data) {
                var obj = JSON.parse(data);
                document.getElementById("book_an_appointment").reset();
                //danger  success
                jQuery('#appointment_message').html('');

                jQuery(".loadingLoader").hide();
                jQuery('.overlay').hide();

                var message = '';
                var appointment_type = '<?php echo $settings->schedule_type; ?>';
                var datep = jQuery('#datep').val();
                var time_slot = jQuery('#time_slot').val();
                jQuery('#myModal').modal('hide');
                jQuery('#myModal2').modal('show');
                if (obj.code == 200)
                {

                    if (appointment_type == 'open_schedule') {
                        var message = '<div class="flash-message"><div class="alert" ><button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i></button>Your Appointments has been Successfully Booked on ' + datep + '  ' + time_slot + '<br> Thanks. </div></div>';
                    } else {
                        var message = '<div class="flash-message"><div class="alert" ><button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i></button>Thank you for Book Appointments.Your Appointments has been Recieved.we will Confirm you soon</div></div>';
                    }

                }
                else
                {
                    var message = '<div class="flash-message"><div class="alert alert-danger" id="danger-alert"><button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i></button>Failed to book Appointments,try again. </div></div>';

                }
                jQuery('#bkmessage').html(message);

            }
        });
    });

</script>