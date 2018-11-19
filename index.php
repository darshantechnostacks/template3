<?php require_once('header.php');
$labels = array('no_of_clients' => 'images/ic_no_of_client.png',
    'no_of_employees' => 'images/ic_no_of_emp.png',
    'special_projects' => 'images/ic_client_review.png',
    'serving_community_since' => 'images/ic_projects.png',
    'client_reviews' => 'images/ic-community.png');
?>
<style>
    .classpadding-10{margin-bottom: 10px !important;}
    .btnjoin{
        background-color: black !important;
        padding: 0 2.214em !important;
    width: auto !important;
    margin: -5px !important;
    }
    .btnjoin:hover{
        background-color: #ce0315 !important;
    color: #fff !important;
    }
</style>

<section id="mainslider_1" class="slider_wrap slider_fullwide slider_engine_revo slider_alias_homepage1">
    <div id="rev_slider_1_wrapper" class="rev_slider_wrapper fullwidthbanner-container">
        <div id="rev_slider_1" class="rev_slider fullwidthabanner">
            <ul>
                <?php
                if (count($banner) > 0) {
                    foreach ($banner as $banner_value) {
                        ?>	
                        <!-- SLIDE  -->
                        <li data-transition="random" data-slotamount="7" data-masterspeed="650"  data-saveperformance="off" >
                            <!-- MAIN IMAGE -->
                            <img src="<?php echo API_URL . 'geturl/uploads/banner/' . $banner_value->banner; ?>"  alt="home1_slide1"  data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat">
                            <!-- LAYERS -->
                            <!-- LAYER NR. 1 -->
                            <div class="tp-caption adviserbigblack tp-fade tp-resizeme" 
                                 data-x="47" 
                                 data-y="115"  
                                 data-speed="850" 
                                 data-start="700" 
                                 data-easing="Power3.easeInOut" 
                                 data-splitin="none" 
                                 data-splitout="none" 
                                 data-elementdelay="0.1" 
                                 data-endelementdelay="0.1" 
                                 data-end="7500" 
                                 data-endspeed="1000" 
                                 >
                                     <?php echo $banner_value->banner_title; ?>
                            </div>

                            <!-- LAYER NR. 2 -->
                            <div class="tp-caption adviserminigrey lfl tp-resizeme" 
                                 data-x="47" 
                                 data-y="245"  
                                 data-speed="1000" 
                                 data-start="1300" 
                                 data-easing="Power3.easeInOut" 
                                 data-splitin="none" 
                                 data-splitout="none" 
                                 data-elementdelay="0.1" 
                                 data-endelementdelay="0.1" 
                                 data-end="7500" 
                                 data-endspeed="1000" 
                                 >
                                     <?php echo $banner_value->banner_desc; ?>
                            </div>

                            <!-- LAYER NR. 3 -->
                            <div class="tp-caption adviserbtn sfb tp-resizeme" 
                                 data-x="47" 
                                 data-y="320"  
                                 data-speed="800" 
                                 data-start="2000" 
                                 data-easing="Power3.easeInOut" 
                                 data-splitin="none" 
                                 data-splitout="none" 
                                 data-elementdelay="0.1" 
                                 data-endelementdelay="0.1" 
                                 data-end="7500" 
                                 data-endspeed="1000" 
                                 >
                                <?php if(!empty($banner_value->button_link)){ ?>
                                <a href='<?php echo $banner_value->button_link; ?>' class='sc_button button-hover sc_button_square sc_button_style_red' data-text="<?php echo !empty($banner_value->button_name) ?$banner_value->button_name:"Read More"; ?>"><?php echo !empty($banner_value->button_name) ?$banner_value->button_name:"Read More"; ?></a> 
                                <?php } ?>
                                
                            </div>
                        </li>
                    <?php
                    }
                } else {
                    ?>

                    <li data-transition="random" data-slotamount="7" data-masterspeed="650"  data-saveperformance="off" >
                        <!-- MAIN IMAGE -->
                        <img src="images/1529560713_393246.jpg"  alt="home1_slide1"  data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat">
                        <!-- LAYERS -->
                        <!-- LAYER NR. 1 -->
                        <div class="tp-caption adviserbigblack tp-fade tp-resizeme" 
                             data-x="47" 
                             data-y="115"  
                             data-speed="850" 
                             data-start="700" 
                             data-easing="Power3.easeInOut" 
                             data-splitin="none" 
                             data-splitout="none" 
                             data-elementdelay="0.1" 
                             data-endelementdelay="0.1" 
                             data-end="7500" 
                             data-endspeed="1000" 
                             >
                            Choosing a financial 
                        </div>

                        <!-- LAYER NR. 2 -->
                        <div class="tp-caption adviserminigrey lfl tp-resizeme" 
                             data-x="47" 
                             data-y="245"  
                             data-speed="1000" 
                             data-start="1300" 
                             data-easing="Power3.easeInOut" 
                             data-splitin="none" 
                             data-splitout="none" 
                             data-elementdelay="0.1" 
                             data-endelementdelay="0.1" 
                             data-end="7500" 
                             data-endspeed="1000" 
                             >
                            Providing Best SERVICES with QUALITY 
                        </div>

                        <!-- LAYER NR. 3 -->
                        <div class="tp-caption adviserbtn sfb tp-resizeme" 
                             data-x="47" 
                             data-y="320"  
                             data-speed="800" 
                             data-start="2000" 
                             data-easing="Power3.easeInOut" 
                             data-splitin="none" 
                             data-splitout="none" 
                             data-elementdelay="0.1" 
                             data-endelementdelay="0.1" 
                             data-end="7500" 
                             data-endspeed="1000" 
                             >
                            <a href='#' class='sc_button button-hover sc_button_square sc_button_style_red' data-text="More Info">More Info</a> 
                        </div>
                    </li>
<?php } ?>
                <!-- SLIDE  -->
            </ul>
        </div>
    </div>
</section>

<div class="">

    <section class="grey_section">
        <div class="container">
            <div class="row">
                <div class="content_wrap">
                    <h2 class="sc_title sc_align_center aligncenter fig_border">About us</h2>
                    <p style="text-align: center;font-size: 16px;">Introduction of <b><?php echo isset($homePages->firm_name) ? $homePages->firm_name : ""; ?></b></p>
                    <div class="sc_under_title sc_section aligncenter column-3_5" data-animation="animated fadeInUp normal">
<?php echo isset($homePages->about_your_company) ? substr($homePages->about_your_company,0,250).'...' : "" ?><br>
<center>    <a href="aboutus.php"> <BUTTON style="margin-top: 33px;">Read More</BUTTON></a></center>
                    </div>

                    <div class="columns_wrap sc_columns" data-animation="animated fadeInUp normal">
                        <?php
                        $defIcon = array('icon-calculator', 'icon-moneybag', 'icon-moneypig', 'icon-gold2');
                        $i = 0;
                        foreach ($services as $service) {
                            ?>
                            <div class="column-1_4 sc_column_item">
                                <div class="sc_column_item_inner">
                                    <div class="sc_section">
                                        <?php if ($service->edit_status == 0 && !empty($service->service->icon)) {?>
                                        <img src="<?php echo API_URL . 'geturl/uploads/icon/' . $service->service->icon; ?>" />
                                        <?php }else if( ($service->edit_status ==1) &&  ($service->icon != '')){ ?>
                                        <img src="<?php echo API_URL . 'geturl/uploads/icon/' . $service->icon; ?>" />
                                        <?php }else{ ?>
                                        <span class="sc_icon style_2 <?php echo $defIcon[$i]; ?> sc_icon_shape_none sc_icon_bg_custom"></span>
                                         <?php } ?>
                                        
                                        <h5 class="sc_title sc_align_left"><?php echo $service->name; ?></h5>
                                        <?php
                                        if ($service->edit_status == 1) {
                                            echo substr($service->page_content, 0, 100);
                                        } else {
                                            echo strip_tags(substr($service->service->page_content, 0, 100));
                                        }
                                        ?>
                                        <a href="services.php?slug=<?php echo $service->page_slug; ?>" class="sc_button button-hover sc_button_square sc_button_style_clear sc_button_bg_link sc_button_size_mini  sc_button_iconed inherit" data-text="Learn more">Learn more</a>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $i++;
                            if ($i == 4) {
                                break;
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="no_padding custom_columns">
        <div class="container" style="width:100%;">
            <div class="row">
                <div class="column-1_3 blue_section" style="padding-right: 0px;">
                    <div class="sc_section bg_tint_dark fixed_height_1">
                        <div class="sc_section_container">
                            <h3 class="sc_title sc_align_left fig_border_white margin_bottom_small" data-animation="animated fadeInUp normal">Some Interesting Facts About Us</h3>
                            <div class="sc_section" data-animation="animated fadeInUp normal">We deliver only premium quality comprehensive financial services to our clients. This is one of the highest priorities of our company.</div>
                        </div>
                    </div>
                </div>
                <div class="column-2_3 no_padding bg_section_2">
                    <div class="sc_section bg_tint_dark fixed_height_1">
                        <div class="sc_section_overlay">
                            <div class="sc_section_container">
                                <div class="columns_wrap sc_columns padding text-center" data-animation="animated fadeInUp normal">
                                    <?php
                                    foreach ($labels as $name => $img) {
                                        if (!is_numeric($homePages->$name)) {
                                            $values = json_decode($homePages->$name);
                                            ?>
                                            <div class="column-1_5 sc_column_item">
                                                <figure class="sc_image margin_bottom_mini sc_image_shape_square">
                                                    <div>
                                                        <img src="<?= $img ?>" alt=""/>
                                                    </div>
                                                    <figcaption>
                                                        <span class="inherit"></span>
                                                    </figcaption>
                                                </figure>
                                                <div class="sc_skills sc_skills_counter" data-type="counter"
                                                     data-subtitle="Skills">
                                                    <div class="sc_skills_item sc_skills_style_1">
                                                        <div class="sc_skills_count"></div>
                                                        <div class="sc_skills_total" data-start="0"
                                                             data-stop="<?= $values->value ?>" data-step="13"
                                                             data-max="<?= $values->value ?>" data-speed="38"
                                                             data-duration="<?= $values->value ?>"
                                                             data-ed="">0
                                                        </div>
                                                        <div class="sc_skills_info">
                                                            <div class="sc_skills_label"><?= $values->label ?></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        } else {
                                            ?>
                                            <div class="column-1_5 sc_column_item">
                                                <figure class="sc_image margin_bottom_mini sc_image_shape_square">
                                                    <div>
                                                        <img src="<?= $img ?>" alt=""/>
                                                    </div>
                                                    <figcaption>
                                                        <span class="inherit"></span>
                                                    </figcaption>
                                                </figure>
                                                <div class="sc_skills sc_skills_counter" data-type="counter"
                                                     data-subtitle="Skills">
                                                    <div class="sc_skills_item sc_skills_style_1">
                                                        <div class="sc_skills_count"></div>
                                                        <div class="sc_skills_total" data-start="0"
                                                             data-stop="<?= $homePages->$name; ?>" data-step="13"
                                                             data-max="<?= $homePages->$name; ?>" data-speed="38"
                                                             data-duration="<?= $homePages->$name; ?>"
                                                             data-ed="">0
                                                        </div>
                                                        <div class="sc_skills_info">
                                                            <div class="sc_skills_label">
                                                            <?= ucwords(str_replace('_', ' ', $name)) ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    }?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CLIENTS -->
    <section class="grey_section">
        <div class="container">
            <div class="row">
                <div class="content_wrap">
                    <h2 class="sc_title sc_align_center aligncenter fig_border">News</h2>
                    <div class="columns_wrap sc_columns" data-animation="animated fadeInUp normal">
                        <?php
                        $i = 0;
                        if (!empty($news)) {
                            foreach ($news as $new) {
                                ?>
                                <div class="column-1_3 sc_column_item">
                                    <div class="sc_column_item_inner">
                                        <div class="sc_section">
<?php if ($new->featured_image != '') { ?>
                                                        <img alt="<?php echo $new->title; ?>" src="<?php echo API_URL ?>geturl/uploads/feature_photo/<?php echo $new->featured_image; ?>" style="width:356px;height:234px;">
                                                    <?php } else { ?>
                                                        <img alt="<?php echo $new->title; ?>" src="<?php echo API_URL ?>geturl/uploads/feature_photo/default.png" style="width:356px;height:234px;">
        <?php }
        ?>
                                            <h5 class="sc_title sc_align_left"><?php echo $new->title; ?></h5>
        <?php echo strip_tags(substr($new->content, 0, 60)); ?><br/>
                                            <a href="newsdeatails.php?id=<?php echo $new->id; ?>" class="sc_button button-hover sc_button_square sc_button_style_clear sc_button_bg_link sc_button_size_mini  sc_button_iconed inherit" data-text="Learn more">Learn more</a>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                $i++;

                                if ($i == 4) {
                                    break;
                                }
                            }
                        }
                        ?>
                    </div>
                    <?php if (!empty($news)) { ?>

                        <center>    <a href="news.php"> <BUTTON style="margin-top: 33px;">View All</BUTTON></a></center>
<?php } ?>
                </div>
            </div>
        </div>
    </section>
    
    <?php if(!empty($alogos) && !empty($alogos->Alogos)){ ?>
    <section class="clients wow fadeInUp" data-wow-duration="300ms" data-wow-delay="450ms">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <h2 class="sc_title sc_align_center aligncenter content_wrap margin_bottom_middle fig_border">Membership and Certification</h2>


                    <div id="clients-carousel" class="owl-carousel">
                        <?php
                        if (!empty($alogos)) {
                            if (count($alogos) > 0 && !empty($alogos->Alogos)) {
                                foreach ($alogos->Alogos as $logo) {
                                    ?>
                                    <div class="item">
                                        <img src="<?php echo API_URL . 'geturl/uploads/logo/' . $logo->logo; ?>" alt="<?php echo $logo->logo; ?>" style="height:115px;width:204px;">
                                    </div>
                                <?php
                                }
                            }
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </section> 
    <?php } if (!empty($blogs)) { ?>
    
    <section class="with_isotope">
        <div class="container">
            <div class="row">
                <div class="content_wrap" data-animation="animated fadeInUp normal">
                    <div class="sc_section aligncenter">TIPS, NEWS AND VIDEOS</div>
                    <h2 class="sc_title sc_align_center aligncenter content_wrap margin_bottom_middle fig_border">Your Money Advice Blog</h2>
                    <div class="sc_blogger layout_classic_3 template_masonry sc_blogger_horizontal">
                        <div class="isotope_wrap" data-columns="3">
                            <?php
                            
                                $jk = 0;
                                foreach ($blogs as $key => $blog) {
                                    ?>

                                    <div class="isotope_item isotope_item_classic isotope_item_classic_3 isotope_column_3">
                                        <div class="post_featured">
                                            <div class="post_thumb" data-image="<?php echo API_URL ?>geturl/uploads/feature_photo/<?php echo $blog->featured_image; ?>" data-title="<?php echo $blog->title; ?>">
                                                <a class="hover_icon_link" href="blogdeatails.php?id=<?php echo $blog->id; ?>">
                                                    <?php if ($blog->featured_image != '') { ?>
                                                    <img alt="<?php echo $blog->title; ?>" src="<?php echo API_URL ?>geturl/uploads/feature_photo/<?php echo $blog->featured_image; ?>" style="width:356px;height:234px;">
        <?php } else { ?>
                                                        <img alt="<?php echo $blog->title; ?>" src="<?php echo API_URL ?>geturl/uploads/feature_photo/default.png" style="width:356px;height:234px;">
        <?php }
        ?>
                                                    <div class="img-hover">
                                                        <span class="hover_icon"></span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="post_content isotope_item_content">
                                            <h4 class="post_title"><a href="blogdeatails.php?id=<?php echo $blog->id; ?>"><?php echo $blog->title; ?></a></h4>
                                            <div class="post_info">
                                                <span class="post_info_item post_info_posted">
                                                    <a href="#" class="post_info_date"> <?php echo date('F d, Y', strtotime($blog->created)); ?></a>
                                                </span>
                                            </div>
                                            <div class="post_descr">
                                                <p><?php echo substr($blog->content, 0, 170).'...'; ?></p>
                                                <a href="blogdeatails.php?id=<?php echo $blog->id; ?>" class="sc_button button-hover sc_button_square sc_button_style_clear sc_button_bg_link sc_button_size_small" data-text="Learn more">Learn more</a>
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
                        <center>
                            <a href="blogs.php">
                                <BUTTON style="margin-top: 33px;">View All</BUTTON>
                            </a>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } ?>

    <section class="blue_section">
        <div class="container">
            <div class="bg_tint_dark aligncenter">
                <div class="sc_section_overlay">
                    <div class="row">
                        <div class="column-2_4 blue_section">

                            <h2 class="sc_title sc_align_center" data-animation="animated fadeInUp normal">Keep Yourself Posted</h2>
                            <div class="aligncenter column-2_5" data-animation="animated fadeInUp normal">
                                <h6 class="sc_title">Sign up to receive featured articles from finance experts, products updates, and more from Adviser</h6>
                            </div>

                            <div class="aligncenter margin_top_middle">
                                <div class="aligncenter sc_emailer_opened">
                                    <form class="cmxform form-horizontal" method="POST" name="frmsubscription" id="frmsubscription">
                                        <div class="form-group required">
                                            <label class="control-label col-lg-3 ">First Name </label>
                                            <div class="col-lg-9">
                                                <input type="text" name="first_name" class="form-control sc_emailer_input" required>
                                            </div>
                                        </div>
                                        <div class="form-group required">
                                            <label class="control-label col-lg-3 ">Last Name </label>
                                            <div class="col-lg-9">
                                                <input type="text" name="last_name" class="form-control sc_emailer_input" required>
                                            </div>
                                        </div>
                                        <div class="form-group required">
                                            <label class="control-label col-lg-3 ">Email </label>
                                            <div class="col-lg-9">
                                                <input type="email" name="subemail" class="form-control sc_emailer_input" required>
                                            </div>
                                        </div>
                                        <input type="submit" class="btn bt-info" style="background: black;" title="Submit"  id="subscribe_button" value="Join Us Today" name="subscribe">
                                    </form>
                                </div>
                            </div>
                            <div id="status_message"></div>
                        </div>
                        <div class="column-2_4 no_padding ">
                            <h2 class="sc_title sc_align_center" data-animation="animated fadeInUp normal">SCHEDULE A <span>DEMO</span> </h2>                    
                            <div class="aligncenter column-2_5" data-animation="animated fadeInUp normal">
                                <h6 class="sc_title">TO INSTRUCT HOW TO WORK!</h6>

                                <div  class="calendar_box" id="btn_apt" style="">
                                    <div id="datepicker1"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>

<div class="modal fade  " id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">            
            <div class="modal-body text-center" id="message">

            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true" type="button"> Ok</button>
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
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" id="email" name="email" require class="form-control input-normal"  >
                    </div>

                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" id="phone" name="phone" require class="form-control input-normal" >
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
                    </div>

                    <div class="form-group">
                        <label>Comment</label>
                        <textarea name="information"  id="comment" require class="form-control input-normal">  </textarea>
                    </div>


                    <div class="modal-footer">
                        <input class="btn btn-primary submit_button"  disabled="disabled" value="Submit" type="submit">
                    </div>
                </form>	
            </div>
        </div>
    </div>
</div>
<!-- Ajax loader-->
<div class="overlay" style="display: none;">
</div>
<div class="loadingLoader" style="display: none;">
    <img src="images/loader.gif">
</div>
<!-- End Ajax loader-->

<?php require_once('footer.php'); ?>				
<script type='text/javascript' src='js/custom/bootstrap.min.js'></script>

<script>
                        function settimeslot(valu) {
                            jQuery('.submit_button').prop('disabled', false);
                        }
                        var $datePicker = jQuery("#datepicker1");
                        $datePicker.datepicker({
                            minDate: 0,
                            inline: true,
                            altField: "#datep",
                            onSelect: function () {

                                jQuery('.submit_button').prop('disabled', true);
                                jQuery('#myModal').modal();
                                jQuery('#time_slot').val('');
                                jQuery('#name').val('');
                                jQuery('#email').val('');
                                jQuery('#phone').val('');
                                jQuery('#comment').val('');

                                var c_date = jQuery('#datep').val();

                                jQuery('#exampleModalLabel').html('Appointments on ' + c_date)
                                /*var post_url = 'bookappointments.php'; //get form action url
                                 var request_method = jQuery(this).attr("method"); //get form GET/POST method
                                 var form_data = jQuery(this).serialize(); //Encode form elements for submission
                                 jQuery.ajax({
                                 url: post_url,
                                 data: {"_token": "{{ csrf_token() }}", c_date: c_date},
                                 type: 'post', 
                                 beforeSend: function () {
                                 //  jQuery("#loading-image").show();
                                 jQuery('.loadingLoader').show();
                                 jQuery('.overlay').show();
                                 },
                                 success: function (data) {
                                 var obj = JSON.parse(data);
                                 for (var i = 1; i <= 6; i++)
                                 {
                                 jQuery("#l_op_" + i).css('pointer-events', 'auto');
                                 jQuery("#l_op_" + i).attr("disabled", false);
                                 }
                                 
                                 jQuery.each(obj, function (key, val) {
                                 jQuery("#l_op_" + val).css('pointer-events', 'none');
                                 jQuery("#l_op_" + val).attr("disabled", true);
                                 });
                                 
                                 jQuery(".loadingLoader").hide();
                                 jQuery('.overlay').hide();
                                 }
                                 });*/
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
                            var email = jQuery('#email').val();
                            var phone = jQuery('#phone').val();
                            var comment = jQuery('#comment').val();
                            if (name == '')
                            {
                                alert('Please enter name');
                                return false;
                            }

                            if (email == '')
                            {
                                alert('Please enter email');
                                return false;
                            }

                            if (phone == '')
                            {
                                alert('Please enter phone');
                                return false;
                            }

                            if (comment == '')
                            {
                                alert('Please enter comment');
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
                                        
                                        if(appointment_type == 'open_schedule') {
                                            var message = '<div class="flash-message"><div class="alert" ><button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i></button>Your Appointments has been Successfully Booked on '+datep +'  '+time_slot+'<br> Thanks. </div></div>';
                                        } else {
                                            var message = '<div class="flash-message"><div class="alert" ><button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i></button>Thank you for Book Appointments.Your Appointments has been Recieved.we will Confirm you soon</div></div>';
                                        }
                                        
                                       
                                        // var message = '<div class="flash-message"><div class="alert alert-success" id="success-alert"><button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i></button>Appointments book has been successfully</div></div>';
                                        // jQuery('#appointment_message').html(message);
                                        // setTimeout(function () {
                                        //     jQuery('#close_button').click();
                                        // }, 4000);

                                    }
                                    else
                                    {
                                        var message = '<div class="flash-message"><div class="alert alert-danger" id="danger-alert"><button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i></button>Failed to book Appointments,try again. </div></div>';
                                        // jQuery('#appointment_message').html(message);
                                        // setTimeout(function () {
                                        //     jQuery('#close_button').click();
                                        // }, 5000);
                                    }
                                    jQuery('#message').html(message);

                                }
                            });
                        });
</script>