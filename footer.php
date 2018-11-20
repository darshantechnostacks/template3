<!-- Ajax loader-->
<div class="overlay" style="display: none;">
</div>
<div class="loadingLoader" style="display: none;">
    <img src="images/loader.gif">
</div>
<!-- End Ajax loader-->
<footer class="footer-section">
    <div class="container">
        <div class="inner">
            <div class="row">
                <div class="col-md-12 col-sm-8">
                    <div class="row">
                        <div class="col-md-4 col-sm-6 mb2">
                            <!--                                <div class="footer-logo mb2">
                                                                <img src="img/logo-white.png" class="img-responsive" />
                                                            </div>-->
                            <p class="mb2">
                            <p style="text-align: left;font-size: 16px;">Introduction of <b><?php echo isset($homePages->firm_name) ? $homePages->firm_name : ""; ?></b></p>
                                <?php
                                if (!empty($about_data) && $about_data->code == 200) {
                                    $aboutus = $about_data->Uaboutus;
                                    echo strip_tags(substr($aboutus->description, 0, 450)) . '.... <a href="aboutus.php">Read more</a>';
                                }
                                ?>
                            </p>
                            <div class="clearfix">
                                <ul class="footer-social-link">
                                    <?php if (isset($settings->twitter_link) && !empty($settings->twitter_link)) { ?>
                                        <li><a href="<?php echo isset($settings->twitter_link) ? $settings->twitter_link : ""; ?>" target="_blank"><i class="icon-twitter"></i></a></li>

                                    <?php } if (isset($settings->facebook_link) && !empty($settings->facebook_link)) { ?>
                                        <li><a href="<?php echo isset($settings->facebook_link) ? $settings->facebook_link : ""; ?>" target="_blank"><i class="icon-facebook"></i></a></li>
                                    <?php } if (isset($settings->google_link) && !empty($settings->google_link)) { ?>
                                        <li><a href="<?php echo isset($settings->google_link) ? $settings->google_link : ""; ?>" target="_blank"><i class="icon-gplus"></i></a></li>
                                    <?php } ?>

                                </ul>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 mb2 footer-testimonal">
                            <h4>Testimonals</h4>
                            <?php
                            if (count($testimonals) > 0) {
                                //set a custom width and height
                                $width = '640';
                                $height = '360';

                                $count = count($testimonals);
                                if ($testimonals[$count - 1]->video != "") {
                                    $url = $testimonals[$count - 1]->video;
                                    if (strpos($url, 'youtube') !== false) {
                                        echo '<div class="youtube-article"><iframe class="dt-youtube" width="' . $width . '" height="' . $height . '" src="' . $url . '" frameborder="0" allowfullscreen></iframe></div>';
                                        ?>
                                        <em style="float: right"> - <?php echo $testimonals[$count - 1]->name; ?></em>
                                        <?php
                                    }else{
                                          $vimeoUrl =   (int) substr(parse_url($url, PHP_URL_PATH), 1);
                                          echo '<div class="vimeo-article"><iframe src="https://player.vimeo.com/video/'.$vimeoUrl.'?title=0&amp;byline=0&amp;portrait=0&amp;badge=0&amp;color=ffffff" width="'.$width.'" height="'.$height.'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>';
                                          ?>
                                          
                                        <em style="float: right"> - <?php echo $testimonals[$count -1]->name; ?></em>
                                        <?php 
                                          
                                    }
                                } else { ?>
                                    <p class="mb2"><?php  echo  str_replace("{company_name}", $homePages->firm_name, substr($testimonals[$count -1]->description,0,250)) ; ?></p>
                                    <p class="mb1"><span><img src="<?php echo API_URL ?>geturl/uploads/photo/<?php echo $testimonals[$count -1]->photo; ?>" width="100" height="50" /></span> <span>-<?php echo $testimonals[$count -1]->name; ?></span></p>
                                <?php } ?>
                            <?php } ?>
                            
                            <a href="testimonials.php">View All Testimonials</a>
                        </div>
                        <div class="col-md-4 col-sm-12 mb2">
                            <h4>Contact Info</h4>
                            <ul class="footer-contact-info">
                                <li class="clearfix">
                                    <i class="icon-home-1"></i>
                                     <?php
                                    if (!empty($addresses)) {
                                        foreach ($addresses as $key => $address) {
                                            $fullAddr = $address->street_address_1 . ' <br/>' . $address->street_address_2 . ' <br/>' . $address->Cities->city . ' ' . $address->States->state_name . ' ' . $address->Cities->county . ' - ' . $address->zip_code;
                                            break;
                                        }?>
                                        <label><?php echo $fullAddr; ?></label>
                                    <?php }else{?>
                                        <label><?php echo isset($homePages->firm_address) ? ($homePages->firm_address . ' ' . $homePages->firm_address_2 . ' ' . $homePages->zip_code) : ""; ?></label>
                                    <?php } ?>
                                    
                                </li>
                                <li class="clearfix">
                                    <i class="icon-mobile-1"></i>
                                    <label><?php echo isset($homePages->firm_phone)?$homePages->firm_phone:"";?></label>
                                </li>
                                <li class="clearfix">
                                    <i class="icon-mail"></i>
                                    <label><a href="mailto:<?php echo isset($homePages->firm_email)?$homePages->firm_email:"";?>"><?php echo isset($homePages->firm_email)?$homePages->firm_email:"";?></a></label>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</footer>
<div class="modal fade  " id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">            
					<div class="modal-body text-center" id="message3">

					</div>
					<div class="modal-footer">
						<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true" type="button"> Ok</button>
					</div>
				</div>
			</div>
		</div>
<!-- Bootstrap core JavaScript
================================================== -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/menu.js"></script>
<script src="js/slick.js"></script>
<script src="js/jquery-ui.js"></script>
<!-- <script src="js/owl.carousel.min.js"></script> -->
<script src="js/__packed.js"></script>
 <script type='text/javascript' src='js/jquery.rateyo.min.js'></script>
<!--<script type='text/javascript' src='js/_main.js'></script>
<script src="js/shortcodes.min.js"></script>-->
<script>
    
    $('.news-slider').slick({
        centerMode: false,
        slidesToShow: 3,
        arrows: false,
        slidesToScroll: 3,
        dots: true,
        adaptiveHeight: true,
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    arrows: false,
                    centerMode: false,
                    slidesToShow: 2,
                    slidesToScroll: 2,
                }
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: false,
                    centerMode: false,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            }
        ]
    });
    $('.membership-slider').slick({
        centerMode: false,
         autoplay: true,
        slidesToShow: 5,
        arrows: false,
        slidesToScroll: 5,
        dots: true,
        adaptiveHeight: true,
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    arrows: false,
                    centerMode: false,
                    slidesToShow: 3,
                    slidesToScroll: 3,
                }
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: false,
                    centerMode: false,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            }
        ]
    });

    $('.top-slider').slick({
        centerMode: false,
        slidesToShow: 1,
        arrows: true,
        slidesToScroll: 1,
        dots: false,
        adaptiveHeight: false
    })
    
    //subscriptions
     jQuery("#frmsubscription").submit(function (event) {
        event.preventDefault(); 

        var post_url = 'emailsubscriber.php';
        var request_method = jQuery(this).attr("method"); 
        var form_data = jQuery(this).serialize(); 
        var email = jQuery('#subemail').val();
        jQuery.ajax({
        url: post_url,
                data: form_data,
                type: 'post',
                dataType: 'json',
                beforeSend: function () {
                                    //  jQuery("#loading-image").show();
                                    jQuery('.loadingLoader').show();
                                    jQuery('.overlay').show();
                                },
                success: function (data) {
                    //danger  success
                    jQuery('#status_message').html('');
 					jQuery(".loadingLoader").hide();
                    jQuery('.overlay').hide();

                    var status = '';
                    var ccolor = '';
                    if (data.code == 200)
                    {
                    status = 'success';
                            ccolor = 'color:green';
                    }
                    else
                    {
                    status = 'danger';
                            ccolor = 'color:red';
                    }
                    var messages = '<div class="flash-message" style=' + ccolor + '><div class="alert alert-' + status + '" id="' + status + '-alert"> <strong> ' + data.message + '</strong></div></div>';
					jQuery('#myModal3').modal('show');
					jQuery('#message3').html(messages);
					// jQuery('#status_message').html(messages);
                    setTimeout(function () {
                        jQuery('#status_message').fadeOut('slow');
                        jQuery('#status_message').html('');
                        jQuery('#subemail').val('');
                        jQuery('#first_name').val('');
                        jQuery('#last_name').val('');
                    }, 2000); // <-- time in milliseconds
                }
        });
    });
    
    //contact us
     jQuery("#frmcontactus").submit(function (event) {
        event.preventDefault(); 

        var post_url = 'contact-form.php';
        var request_method = jQuery(this).attr("method"); 
        var form_data = jQuery(this).serialize(); 
       // var email = jQuery('#subemail').val();
        jQuery.ajax({
        url: post_url,
                data: form_data,
                type: 'post',
                dataType: 'json',
                beforeSend: function () {
                                    //  jQuery("#loading-image").show();
                                    jQuery('.loadingLoader').show();
                                    jQuery('.overlay').show();
                                },
                success: function (data) {
                    //danger  success
                    jQuery('#status_message').html('');
 					jQuery(".loadingLoader").hide();
                    jQuery('.overlay').hide();

                    var status = '';
                    var ccolor = '';
                    if (data.code == 200)
                    {
                    status = 'success';
                            ccolor = 'color:green';
                    }
                    else
                    {
                    status = 'danger';
                            ccolor = 'color:red';
                    }
                    var messages = '<div class="flash-message" style=' + ccolor + '><div class="alert alert-' + status + '" id="' + status + '-alert"> <strong> ' + data.message + '</strong></div></div>';
					jQuery('#myModal3').modal('show');
					jQuery('#message3').html(messages);
					// jQuery('#status_message').html(messages);
                    setTimeout(function () {
                        jQuery('#status_message').fadeOut('slow');
                        jQuery('#status_message').html('');
                        jQuery('#email').val('');
                        jQuery('#username').val('');
                        jQuery('#message').val('');
                    }, 2000); // <-- time in milliseconds
                }
        });
    });


      
    
</script>
</body>
</html>