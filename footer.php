<footer class="footer_wrap bg_tint_dark footer_style_dark widget_area">
    <div class="content_wrap">
        <div class="columns_wrap with_padding">
            <aside class="column-1_4 widget widget_socials">
                <div class="widget_inner">
                    <div class="logo_descr">
                        <?php
                        if (!empty($about_data) && $about_data->code == 200) {
                            $aboutus = $about_data->Uaboutus;
                            echo strip_tags(substr($aboutus->description, 0, 450)) . '.... <a href="aboutus.php">Read more</a>';
                        }
                        ?>

                    </div>
                    <div class="sc_socials sc_socials_size_small">
                        <?php if (isset($settings->twitter_link) && !empty($settings->twitter_link)) { ?>
                            <div class="sc_socials_item">


                                <a href="<?php echo isset($settings->twitter_link) ? $settings->twitter_link : ""; ?>"
                                   target="_blank" class="social_icons social_tumblr icons">
                                    <span class="icon-tumblr"> </span>
                                    <span class="sc_socials_hover icon-tumblr"> </span>
                                </a>
                            </div>
                        <?php }
                        if (isset($settings->facebook_link) && !empty($settings->facebook_link)) { ?>
                            <div class="sc_socials_item">
                                <a href="<?php echo isset($settings->facebook_link) ? $settings->facebook_link : ""; ?>"
                                   target="_blank" class="social_icons social_facebook icons">
                                    <span class="icon-facebook"> </span>
                                    <span class="sc_socials_hover icon-facebook"> </span>
                                </a>
                            </div>
                        <?php }
                        if (isset($settings->google_link) && !empty($settings->google_link)) { ?>
                            <div class="sc_socials_item">
                                <a href="<?php echo isset($settings->google_link) ? $settings->google_link : ""; ?>"
                                   target="_blank" class="social_icons social_gplus icons">
                                    <span class="icon-gplus"> </span>
                                    <span class="sc_socials_hover icon-gplus"> </span>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </aside>
            <?php if (count($testimonals) > 0) {
                $count = count($testimonals);


                ?>
                <aside class="column-1_4 widget widget_text">
                    <h5 class="widget_title">Testimonials</h5>
                    <div class="textwidget">
                        <!-- <a href="testimonialdeatails.php?id=<?php echo $testimonals[$count - 1]->id; ?>" style="color: #787C81"> -->
                        <?php if ($testimonals[$count - 1]->video != "") {

                            //store the URL into a variable
                            $url = $testimonals[$count - 1]->video;

                            if (strpos($url, 'youtube') !== false) {
                                //store the URL into a variable

                                //extract the ID
                                preg_match(
                                    '/[\?\&]v=([^\?\&]+)/',
                                    $url,
                                    $matches
                                );

                                //set a custom width and height
                                $width = '640';
                                $height = '360';

                                //echo the embed code. You can even wrap it in a class
                                echo '<div class="youtube-article"><iframe class="dt-youtube" width="' . $width . '" height="' . $height . '" src="' . $url . '" frameborder="0" allowfullscreen></iframe></div>';
                                ?>
                                <em style="float: right"> - <?php echo $testimonals[$count - 1]->name; ?></em>
                                <?php
                            } else {
                                $vimeoUrl = (int)substr(parse_url($url, PHP_URL_PATH), 1);
                                //extract the ID


                                //set a custom width and height
                                $width = '640';
                                $height = '360';

                                //echo the embed code and wrap it in a class
                                echo '<div class="vimeo-article"><iframe src="https://player.vimeo.com/video/' . $vimeoUrl . '?title=0&amp;byline=0&amp;portrait=0&amp;badge=0&amp;color=ffffff" width="' . $width . '" height="' . $height . '" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>';
                                ?>


                                <em style="float: right"> - <?php echo $testimonals[$count - 1]->name; ?></em>

                            <?php }
                            ?>

                        <?php } else { ?>
                            <div class="testim"><?php echo str_replace("{company_name}", $homePages->firm_name, substr($testimonals[$count - 1]->description, 0, 250)); ?>
                                <br>
                                <br>
                                <img src="<?php echo API_URL ?>geturl/uploads/photo/<?php echo $testimonals[$count - 1]->photo; ?>"
                                     width="100" height="50">
                                <em style="float: right">- <?php echo $testimonals[$count - 1]->name; ?></em>
                                <br>
                                <br>
                            </div>
                        <?php } ?>
                        <!-- </a> -->


                    </div>

                    <a href="testimonials.php">View all</a>
                </aside>
            <?php } ?>
            <aside class="column-1_4 widget widget_text">
                <h5 class="widget_title">Contact Info</h5>
                <div class="textwidget">
                    <ul class="sc_list  sc_list_style_iconed">
                        <li class="sc_list_item">
                            <span class="sc_list_icon icon-home-1"> </span>
                            <?php
                            // echo "<pre>"; print_r($homePages);
                            echo isset($homePages->firm_address) ? substr($homePages->firm_address, 0, 50) . '...' : ""; ?>
                            <?php //echo ($homePages->state->state_name != '') ? $homePages->state->state_name.' ,' : ''; ?>
                            <span><?php //echo ($homePages->city->city != '') ? $homePages->city->city : ''; ?></span>
                            <span><?php echo ($homePages->zip_code != '') ? $homePages->zip_code : ''; ?></span>
                        </li>


                        <li class="sc_list_item">
                            <span class="sc_list_icon icon-smartphone"> </span><?php echo isset($homePages->firm_phone) ? $homePages->firm_phone : ""; ?>
                        </li>
                        <li class="sc_list_item">
                            <span class="sc_list_icon icon-mail-2"> </span>
                            <a class="footer_email"
                               href="mailto:<?php echo isset($homePages->firm_email) ? $homePages->firm_email : ""; ?>"><?php echo isset($homePages->firm_email) ? $homePages->firm_email : ""; ?></a>
                        </li>
                    </ul>
                </div>
            </aside>
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
<div class="copyright_wrap bottom_cont">
    <div class="content_wrap">
        <p><a href="#">CPA</a> © <?php echo date('Y'); ?> All Rights Reserved</p>
    </div>
</div>

</div>
</div>
<div id="preloader" class="preloader">
    <div class="preloader_image"></div>
</div>

<a href="#" class="scroll_to_top icon-up-2" title="Scroll to top"></a>

<div class="custom_html_section"></div>

<script type='text/javascript' src='js/vendor/jquery-1.11.3.min.js'></script>
<script type='text/javascript' src='js/vendor/jquery-migrate.min.js'></script>
<script type='text/javascript' src='js/vendor/revslider/rs-plugin/js/jquery.themepunch.tools.min.js'></script>
<script type='text/javascript' src='js/vendor/revslider/rs-plugin/js/jquery.themepunch.revolution.min.js'></script>

<script type='text/javascript' src='js/vendor/__packed.js'></script>
<script type='text/javascript' src='js/custom/_main.js'></script>
<script type='text/javascript' src='js/custom/core.utils.min.js'></script>
<script type='text/javascript' src='js/custom/core.init.min.js'></script>
<script type='text/javascript' src='js/custom/shortcodes.min.js'></script>

<script type='text/javascript' src='js/vendor/jquery.rateyo.min.js'></script>

<script type='text/javascript' src='js/vendor/datepicker.min.js'></script>
<script type='text/javascript' src='js/vendor/calculated-fields-form/js/jQuery.stringify.js'></script>
<script type='text/javascript' src='js/vendor/calculated-fields-form/js/jquery.validate.js'></script>
<script type='text/javascript' src='js/vendor/calculated-fields-form/js/fbuilder.js'></script>
<script src="js/owl.carousel.min.js"></script>
<script type='text/javascript' src='js/custom/bootstrap.min.js'></script>
<script type="text/javascript">

    jQuery(".allownumericwithoutdecimal").on("keypress keyup blur", function (event) {
        jQuery(this).val($(this).val().replace(/[^\d].+/, ""));
        if ((event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
    });
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
                jQuery('.loadingLoader').show();
                jQuery('.overlay').show();
            },
            success: function (data) {
                jQuery(".loadingLoader").hide();
                jQuery('.overlay').hide();
                //danger  success
                jQuery('#status_message').html('');

                var status = '';
                var ccolor = '';
                if (data.code == 200) {
                    status = 'success';
                    ccolor = 'color:green';
                }
                else {
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
                }, 2000); // <-- time in milliseconds
            }
        });
    });
    jQuery("#career_post").submit(function (event) {
        event.stopPropagation();
        event.preventDefault();
        var doc = $('#feature_photo').val();
        if (doc == '') {
            jQuery('#myModal3').modal('show');
            jQuery('#message3').html('Please Upload Valid Document');
            return false;
        } else {
            var post_url = 'career_post.php';
            var request_method = jQuery(this).attr("method");
            $form = $(event.currentTarget);
            var data = new FormData(this);
            jQuery.ajax({
                url: post_url,
                data: data,
                type: 'post',
                contentType: false,
                cache: false,
                processData: false,
                dataType: 'json',
                beforeSend: function () {
                    jQuery('.loadingLoader').show();
                    jQuery('.overlay').show();
                },
                success: function (data) {
                    $form.each(function () {
                        this.reset();
                    });
                    console.log(data);
                    document.getElementById("career_post").reset();

                    jQuery(".loadingLoader").hide();
                    jQuery('.overlay').hide();
                    var messages = '<div class="flash-message"> <strong> Thank You For Applying </strong></div>';
                    jQuery('#myModal3').modal('show');
                    jQuery('#message3').html(messages);
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                }
            });
        }
    });
    $('#clients-carousel').owlCarousel({
        loop: true,
        items: 4,
        margin: 30,
        autoplay: true,
        autoplayTimeout: 8500,
        smartSpeed: 450,
        responsive: {
            0: {
                items: 2
            },
            768: {
                items: 3
            },
            1170: {
                items: 5
            }
        }
    });

</script>
<?php $url = $_SERVER['REQUEST_URI'];
$urlLivechat = "'//".$_SERVER['HTTP_HOST']."/cpa-portal/livechat/php/app.php?widget-init.js&url=".$url."'";
?>
<script>
    var url = "<?php echo $url; ?>";
    (function(d,t,u,s,e){e=d.getElementsByTagName(t)[0];s=d.createElement(t);s.src=u;s.async=1;e.parentNode.insertBefore(s,e);})(document,'script',<?= $urlLivechat ?>);
</script>
</body>
</html>