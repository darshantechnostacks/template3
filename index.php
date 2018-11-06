<?php require_once('header.php');
/* * ******* Get Banner data ******** */
$datas['websiteId'] = WEBSITE_ID;
$banners = $curl->send_api($datas, 'Ubanners/getActiveBanner');
$banner = array();
if (!empty($banners) && $banners->code == 200) {
    $banner = $banners->Ubanners;
    $labels = array('no_of_clients' => 'img/ic_no_of_client.png',
        'no_of_employees' => 'img/ic_no_of_emp.png',
        'special_projects' => 'img/ic_client_review.png',
        'serving_community_since' => 'img/ic_projects.png',
        'client_reviews' => 'img/ic-community.png');
}
?>
<div class="top-slider-outer">
    <ul class="top-slider">
        <?php if (count($banner) > 0) {
            foreach ($banner as $banner_value) {
                ?>
                <li>
                    <div class="image">
                        <img src="<?= BANNER_URL . $banner_value->banner ?>"/>
                    </div>
                    <div class="block row">
                        <div class="title col-sm-12">
                            <p class="mb2"> <?= $banner_value->banner_title ?></p>
                            <?php
                            if (!empty($banner_value->button_link)) { ?>
                                <a href="<?= $banner_value->button_link ?>"
                                   class="btn btn-pink btn-radius"><?= !empty($banner_value->button_name) ? $banner_value->button_name : 'More Info' ?></a>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </li>
                <?php
            }
        } else {
            ?>
            <li>
                <div class="image">
                    <img src="img/banner-bg.png"/>
                </div>
                <div class="block row">
                    <div class="title col-sm-12">
                        <p class="mb2"> LOREM IPSUM DUMMY TEXT FOR PRINT</p>
                        <a href="#" class="btn btn-pink btn-radius">MORE DETAIL</a>
                    </div>
                </div>
            </li>
            <li>
                <div class="image">
                    <img src="img/banner-bg.png"/>
                </div>
                <div class="block row">
                    <div class="title col-sm-12">
                        <p class="mb2"> LOREM IPSUM DUMMY TEXT FOR PRINT</p>
                        <a href="#" class="btn btn-pink btn-radius">MORE DETAIL</a>
                    </div>
                </div>
            </li>
        <?php } ?>
    </ul>
    <ul class="top-contact-info">
        <li><i class="icon-mobile"></i><?= isset($homePages->firm_phone) ? $homePages->firm_phone : "" ?></li>
        <li><i class="icon-email"></i> <a
                    href="mailtto:<?= isset($homePages->firm_email) ? $homePages->firm_email : "" ?>"><?= isset($homePages->firm_email) ? $homePages->firm_email : "" ?></a>
        </li>
    </ul>
</div>

<div class="about-section mb5">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1 class="title"><span>About Us</span></h1>
                <p class="sub-title mb2">Introduction of
                    <span><?php echo isset($homePages->firm_name) ? $homePages->firm_name : ""; ?></span></p>
                <p class="mb2"><?= isset($homePages->about_your_company) ? substr($homePages->about_your_company, 0, 500) . '...' : "" ?></p>
                <a href="aboutus.php" class="btn btn-radius btn-pink">Read More</a>
            </div>
        </div>
    </div>
</div>

<div class="services-section mb1">
    <div class="container">

        <div class="clearfix row mb3">
            <div class="col-md-offset-3 col-md-6">
                <h1 class="title mb2 text-center"><span>Services</span></h1>
                <p class="mb2 sub-title text-center">
                    <?= strip_tags(substr(isset($settings->home_page_service_content) ? $settings->home_page_service_content : '', 0, 60)) ?>
                </p>
            </div>
        </div>

        <div class="row mb2 services-inner home">
            <?php
            $i = 0;
            foreach ($services as $key => $service) {
                ?>
                <div class="col-md-3 col-sm-6 mb2">
                    <div class="inner-box clearfix">
                        <?php
                        $service_page_slug = isset($service->page_slug) ? $service->page_slug : '';
                        if ($service->edit_status == 0) {
                            $image = isset($service->service->icon) ? ICON_URL.$service->service->icon : '';
                            $content = isset($service->service->page_content) ? strip_tags(substr($service->service->page_content,0,100)) : '';
                            $name = isset($service->service->name) ? $service->service->name : '';
                        } else {
                            $image = isset($service->icon) ? ICON_URL.$service->icon : '';
                            $content = isset($service->page_content) ? strip_tags(substr($service->page_content,0,60)).'...' : '';
                            $name = isset($service->name) ? $service->name : '';
                        }
                            ?>
                        <div class="icon-block">
                            <i class=" icon mb-3">
                                <?php
                                if(!empty($image)){
                                    echo "<img src='$image' class='img-responsive'/>";
                                } else {
                                    echo "<img src='img/banner-bg.png' class='img-responsive'/>";
                                }
                                ?>

                            </i>
                        </div>
                        <div class="content">
                            <div class="title-block">
                                <h2 class="title"><?= $name ?></h2>
                            </div>
                            <p><?= $content ?></p>
                            <a href="services.php?slug=<?= $service_page_slug ?>" class="btn-link">Read More >></a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div class="row mb2">
            <div class="col-md-12 text-center">
                <a href="services.php" class="btn btn-radius btn-pink">See More</a>
            </div>
        </div>
    </div>
</div>

<div class="counter-section">
    <div class="counter-info-title-block mb3">
        <div class="container text-center">
            <h1 class="counter-title">Some Interesting Facts About Us</h1>
            <h4 class="counter-sub-title">
                <?= isset($settings->home_page_counter_content) ? strip_tags($settings->home_page_counter_content) : '' ?>
            </h4>
        </div>
    </div>
    <div class="container">
        <div class="row mb3">
            <div class="col-md-1"></div>
            <?php
            $last = count($labels) - 1;
            $i = 0;
            foreach ($labels as $name => $img) {
                if (!is_numeric($homePages->$name)) {
                    $values = json_decode($homePages->$name);
                    ?>
                    <div class="col-md-2 col-sm-6 mb2 text-center">
                        <div class="clearfix block <?php if ($last != $i) {
                            echo "text-center";
                        } else {
                            echo "last";
                        } ?>">
                            <div class="icon-block">
                                <img src="<?= $img ?>" class=""/>
                            </div>
                            <div class="content">
                                <h3><?= $values->value ?></h3>
                            </div>
                            <p><?= $values->label ?></p>
                        </div>
                    </div>
                    <?php
                } else {
                    ?>
                    <div class="col-md-2 col-sm-6 mb2 text-center">
                        <div class="clearfix block <?php if ($last != $i) {
                            echo "text-center";
                        } else {
                            echo "last";
                        } ?>">
                            <div class="icon-block">
                                <img src="<?= $img ?>" class=""/>
                            </div>
                            <div class="content">
                                <h3><?= $homePages->$name ?></h3>
                            </div>
                            <p><?= ucwords(str_replace('_', ' ', $name)) ?></p>
                        </div>
                    </div>
                    <?php
                }
                $i = $i + 1;
            } ?>


        </div>
        <div class="row mb2">
            <div class="col-md-12 text-center">
                <a href="aboutus.php" class="btn btn-radius btn-shadow btn-pink">More about it !</a>
            </div>
        </div>
    </div>
</div>

<div class="blog-section mb3">
    <div class="container">
        <h1 class="title text-center mb3">Blog</h1>
        <div class="row mb3">
            <?php
            if (!empty($blogs)) {
                foreach ($blogs as $blog) { ?>
                    <div class="col-md-4 col-sm-6 mb2">
                        <div class="blog-inner">
                            <div class="img-block text-center">
                                <?php if (!empty($blog->featured_image)) { ?>
                                    <img src="<?= FEATURE_PHOTO . $blog->featured_image ?>"
                                         class="img-responsive full-width" style="height: 200px" />
                                <?php } else { ?>
                                    <img src="<?= FEATURE_PHOTO . 'default.png' ?>" class="img-responsive full-width" style="height: 200px" />
                                <?php } ?>
                            </div>
                            <div class="content">
                                <h3><?= $blog->title ?></h3>
                                <p><?php echo substr($blog->content, 0, 170) . '...'; ?></p>
                            </div>
                            <div class="hover-title">
                                <a href="#">VIEW BLOG</a>
                            </div>
                        </div>
                    </div>
                <?php }
            }
            ?>
        </div>
        <div class="row mb3">
            <div class="col-md-12 text-center">
                <a href="blogs.php" class="btn btn-radius btn-shadow btn-pink">See More</a>
            </div>
        </div>
    </div>
</div>

<div class="schedule-section mb3">
    <div class="container">
        <div class="row">
            <div class="col-md-8 mb2">
                <h1 class="title">SCHEDULE A DEMO</h1>
                <h3>INSTRUCT HOW TO WORK</h3>
                <p><?= isset($settings->home_page_schedule_content) ? $settings->home_page_schedule_content : '' ?></p>
            </div>
            <div class="col-md-4">
                <div id="datepicker1"></div>
            </div>
        </div>
    </div>
</div>

<div class="membership-section mb3">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="title mb3">Membership and Certification</h1>
                <div class=" clearfix text-center">
                    <ul class="membership-slider">
                        <?php
                        if (!empty($alogos->Alogos)) {
                            foreach ($alogos->Alogos as $logos) {
                                ?>
                                <li>
                                    <img src="<?= LOGO_URL . $logos->logo ?>"/>
                                </li>
                                <?php
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="news-section mb5">
    <div class="container mb5">
        <h1 class="title text-center mb3">News</h1>
        <p class="text-center">
            <?= isset($settings->home_page_news_content) ? $settings->home_page_news_content : '' ?>
        </p>
    </div>

    <div class="section mb2">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb2">
                    <ul class="news-slider text-center">
                        <?php
                        if (!empty($news)) {
                            foreach ($news as $new) {
                                ?>
                                <li class="clearfix">
                                    <div class="icon-block">
                                        <i class="icon-eye-2"></i>
                                    </div>
                                    <div class="content">
                                        <h3 class="title"><?= isset($new->title) ? $new->title : '' ?></h3>
                                        <p><?= strip_tags(substr(isset($new->content) ? $new->content : '', 0, 60)) ?></p>
                                    </div>
                                </li>
                                <?php
                            }
                        }
                        ?>
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
                                <form method="POST" name="frmsubscription" id="frmsubscription">
                                    <div class="clearfix">
                                        <input type="text" class="txt-box" name="first_name" placeholder="First Name"/>
                                        <input type="text" class="txt-box" name="last_name" placeholder="Last Name"/>
                                        <input type="text" class="txt-box" name="subemail" placeholder="Email Address"/>
                                        <input type="submit" class="btn-black btn"
                                               title="Submit" id="subscribe_button" value="Subscribe"
                                               name="subscribe">
                                    </div>
                                    <div class="clearfix remind-me">
                                        <label><input type="checkbox"/> Remind me </label>
                                    </div>
                                </form>
                            </div>
                            <div id="status_message"></div>
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
        <p><?= isset($settings->home_page_contact_content) ? $settings->home_page_contact_content : '' ?></p>
        <div class="contact-block">
            <div class="contact-info-outer row clearfix">
                <div class="col-md-4 col-sm-4 col-xs-6 col-sm-offset-4 col-md-offset-4">
                    <a href="mailto:<?= isset($homePages->firm_email) ? $homePages->firm_email : "" ?>"
                       class="btn-block mb2 txt-mail"><i class="icon-mail"></i>
                        <?= isset($homePages->firm_email) ? $homePages->firm_email : "" ?></a>
                    <label class="btn-block mb2"><i
                                class="icon-phone"></i> <?= isset($homePages->firm_phone) ? $homePages->firm_phone : "" ?>
                    </label>
                    <label class="btn-block"><i
                                class="icon-location"></i><?= isset($homePages->firm_address) ? substr($homePages->firm_address, 0, 50) . '...' : "" ?> <?= !empty($homePages->zip_code) ? $homePages->zip_code : '' ?>
                    </label>
                </div>
            </div>
            <div class="say-something-block">
                <h4>SAY SOMETHING</h4>
                <div class="clearfix">
                    <form class="contact_1" method="post" id="frmcontactus">
                        <input type="text" class="txt-box" name="username" id="contact_form_username"
                               placeholder="Name"/>
                        <input type="email" class="txt-box" name="email" id="contact_form_email"
                               placeholder="Email Address"/>
                        <textarea class="txt-box mb1" id="contact_form_message" name="message" rows="5"
                                  placeholder="Message"></textarea>
                        <button type="submit" name="contact_submit"
                                class="btn-pink btn btn-block text-center"
                                data-text="Send">Send
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
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


                    <input type="hidden" id="datep" name="book_date"/>
                    <!-- <input type="hidden" value="" name="time_slot" id="time_slot" /> -->

                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" id="name" name="name" require class="form-control input-normal">
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" id="email" name="email" require class="form-control input-normal">
                    </div>

                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" id="phone" name="phone" require class="form-control input-normal">
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
                        <textarea name="information" id="comment" require
                                  class="form-control input-normal">  </textarea>
                    </div>


                    <div class="modal-footer">
                        <input class="btn btn-primary submit_button" disabled="disabled" value="Submit" type="submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require_once('footer.php'); ?>
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
        if (name == '') {
            alert('Please enter name');
            return false;
        }

        if (email == '') {
            alert('Please enter email');
            return false;
        }

        if (phone == '') {
            alert('Please enter phone');
            return false;
        }

        if (comment == '') {
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
                if (obj.code == 200) {

                    if (appointment_type == 'open_schedule') {
                        var message = '<div class="flash-message"><div class="alert" ><button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i></button>Your Appointments has been Successfully Booked on ' + datep + '  ' + time_slot + '<br> Thanks. </div></div>';
                    } else {
                        var message = '<div class="flash-message"><div class="alert" ><button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i></button>Thank you for Book Appointments.Your Appointments has been Recieved.we will Confirm you soon</div></div>';
                    }


                    // var message = '<div class="flash-message"><div class="alert alert-success" id="success-alert"><button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i></button>Appointments book has been successfully</div></div>';
                    // jQuery('#appointment_message').html(message);
                    // setTimeout(function () {
                    //     jQuery('#close_button').click();
                    // }, 4000);

                }
                else {
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
