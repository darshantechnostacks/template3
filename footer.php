<!-- Ajax loader-->
<div class="overlay" style="display: none;">
</div>
<div class="loadingLoader" style="display: none;">
    <img src="img/loader.gif">
</div>
<!-- End Ajax loader-->

<footer class="footer-section">
    <div class="container">
        <div class="inner">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="row">
                        <div class="col-md-4 col-sm-6 mb2">
                            <p class="mb2">
                                <?php
                                if (!empty($about_data) && $about_data->code == 200) {
                                    $aboutus = $about_data->Uaboutus;
                                    echo strip_tags(substr(isset($aboutus->description) ? $aboutus->description : '',0,450)).'.... <a href="about.php">Read more</a>';
                                }
                                ?>
                            </p>
                            <div class="clearfix">
                                <ul class="footer-social-link">
                                    <?php
                                    $links = array('twitter_link' => 'icon-tumblr',
                                        'facebook_link' => 'icon-facebook',
                                        'google_link' => 'icon-gplus');
                                    foreach ($links as $link => $class){
                                        if(!empty($settings->$link)){
                                            ?>
                                            <li><a href="<?= isset($settings->$link) ? $settings->$link : '' ?>"><i class="<?= isset($class) ? $class : '' ?>"></i></a></li>
                                    <?php
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 mb2 footer-testimonal">
                            <h4>Testimonals</h4>

                            <?php
                            $testimonial = end($testimonals);
                            if(!empty($testimonial->video)){
                                $width = '640';
                                $height = '360';
                            if (strpos($testimonial->video, 'youtube') !== false) {
                                echo '<div class="youtube-article"><iframe class="dt-youtube" width="' .$width. '" height="'.$height.'" src="'.$url.'" frameborder="0" allowfullscreen></iframe></div>';
                            } else {
                                $vimeoUrl =   (int) substr(parse_url($testimonial->video, PHP_URL_PATH), 1);
                                echo '<div class="vimeo-article"><iframe src="https://player.vimeo.com/video/'.$vimeoUrl.'?title=0&amp;byline=0&amp;portrait=0&amp;badge=0&amp;color=ffffff" width="'.$width.'" height="'.$height.'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>';
                            }
                            } else {
                                $firm_name = isset($homePages->firm_name) ? $homePages->firm_name : '';
                                $testimonial_desc = isset($testimonial->description) ? $testimonial->description : '';
                                ?>
                                <p class="mb2"><?= str_replace("NAME OF THE FIRM", $firm_name, $testimonial_desc) ?></p>
                            <?php
                            }
                            $testimonial_photo = isset($testimonial->photo) ? PHOTO_URL.$testimonial->photo : 'img/dammy-user-icon.png';
                            ?>
                            <p class="mb1"><span><img src="<?= $testimonial_photo ?>" /></span> <span>-<?= isset($testimonial->name) ? $testimonial->name : '' ?></span></p>
                            <a href="#">View All Testimonials</a>
                        </div>
                        <div class="col-md-4 col-sm-12 mb2">
                            <h4>Contact Info</h4>
                            <ul class="footer-contact-info">
                                <li class="clearfix">
                                    <i class="icon-home-1"></i>
                                    <label><?= isset($homePages->firm_address)?substr($homePages->firm_address,0,50).'...':"" ?> <?= !empty($homePages->zip_code) ? $homePages->zip_code : '' ?></label>
                                </li>
                                <li class="clearfix">
                                    <i class="icon-mobile-1"></i>
                                    <label><?= isset($homePages->firm_phone)?$homePages->firm_phone:"" ?></label>
                                </li>
                                <li class="clearfix">
                                    <i class="icon-mail"></i>
                                    <label><a href="mailto:<?= isset($homePages->firm_email)?$homePages->firm_email:"" ?>"><?= isset($homePages->firm_email)?$homePages->firm_email:"" ?></a></label>
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
<?php
$url = $_SERVER['REQUEST_URI'];
$select2Css = '';
if (strpos($url, 'track_refund.php') !== false) {
    $select2Css = "<script src='https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js'></script>";
}
?>
<?= isset($select2Css) ? $select2Css : '' ?>

<script>
    $(function () {
        $("#datepicker").datepicker({ minDate: 0 });
    });
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
        adaptiveHeight: true
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
            success: function (data) {
                //danger  success
                jQuery('#status_message').html('');

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