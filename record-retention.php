<?php
require_once('header.php');
// $about_data = array();
$data['websiteId'] = WEBSITE_ID;

$request = array(
    'conditions' => ['is_deleted' => 0, 'status' => 1, 'is_setting' => 0],
    'fields' => array(),
    'select' => array(),
    'get' => 'all',
    'order' => array('id' => 'desc')

);
$RecordRetention = $curl->send_api($request, 'RecordRetention/index');
if ($RecordRetention->code == 200) {
    $recordretention = $RecordRetention->RecordRetention;
}


$request = array(
    'conditions' => ['is_deleted' => 0, 'status' => 1, 'is_setting' => 1],
    'fields' => array(),
    'select' => array(),
    'get' => 'list',
    'order' => array('id' => 'desc')

);
$RSetting = $curl->send_api($request, 'RecordRetention/index');
$images = $description = '';
if ($RSetting->code == 200) {
    $RSetting = $RSetting->RecordRetention;
    if (count($RSetting) > 0) {
        $images = isset($RSetting[0]->photo) ? PHOTO_URL . $RSetting[0]->photo : '';
        $description = isset($RSetting[0]->description) ? $RSetting[0]->description : '';
    }
}
?>
<div class="sub-page-banner mb3">
    <div class="banner-img">
        <?php
        if (!empty($images)) {
            echo '<img src="' . $images . '" class="img-responsive" />';
        } else {
            echo '<img src="img/record_retention_banner.jpeg" class="img-responsive" />';
        }
        ?>
    </div>
    <div class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Record Retention</h2>
                </div>
            </div>
        </div>
    </div>
    <ul class="top-contact-info">
        <li><i class="icon-mobile"></i><?= isset($homePages->firm_phone) ? $homePages->firm_phone : "" ?></li>
        <li><i class="icon-email"></i> <a
                    href="mailtto:<?= isset($homePages->firm_email) ? $homePages->firm_email : "" ?>"><?= isset($homePages->firm_email) ? $homePages->firm_email : "" ?></a>
        </li>
    </ul>
</div>
<center><h4><?= $description ?></h4></center>
<div class="container">
    <?php
    foreach ($recordretention as $row) {
        ?>
        <p class="font-14 mb1 font-medium"><strong><?= isset($row->title) ? $row->title : '' ?></strong></p>
        <p class="font-14 mb1 font-light"><?= isset($row->description) ? $row->description : '' ?></p>
    <?php } ?>
</div>

<div class="jumbotron mb0 text-center">
    <div class="container">
        <p class="text-uppercase font-16 mb1">Schedule your appointment</p>
        <div class="calendar_box" id="btn_apt" style="">
            <div id="datepicker1"></div>
        </div>
    </div>
</div>
<div class="bg-half-dark-white">
    <div class="container">
        <div class="row d-flex flex-wrap">
            <div class="bg-white col-md-8 col-xs-12">
                <h3 class="font-18 font-medium mb2 text-uppercase">contact us</h3>
                <form class="contact_1" method="post" id="frmcontactus">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="font-14 font-medium">First Name</label>
                                <div class="">
                                    <input type="text" class="form-control" name="username" id="contact_form_username">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="font-14 font-medium">Email Address</label>
                                <div class="">
                                    <input type="text" class="form-control" name="email" id="contact_form_email">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="font-14 font-medium">WebSite</label>
                                <div class="">
                                    <input type="text" class="form-control" name="form_website" id="contact_form_website">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group mb0">
                                <label class="font-14 font-medium">Your Message</label>
                                <div class="">
                                    <textarea id="contact_form_message" class="form-control" name="message"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb2 mt3">
                        <div class="col-md-8">
                            <button type="submit" name="contact_submit"
                                    class="btn btn-pink font-regular btn-small contact_form_submit"
                                    data-text="Send Message">Send Message
                            </button>
                        </div>

                    </div>
                </form>
            </div>

            <div class="col-md-4 col-xs-12 bg-orange text-white">
                <h3 class="font-18 font-medium mb1 text-uppercase">newsletter</h3>
                <p class="mb4 font-14 font-medium">Subscribe to your monthly newsletter</p>

                <form method="POST" name="frmsubscription" id="frmsubscription">
                    <div class="clearfix">
                        <div class="form-group">
                            <label for="first_name" class="font-regular">Enter First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" />
                        </div>
                        <div class="form-group">
                            <label for="last_name" class="font-regular">Enter Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" />
                        </div>
                        <div class="form-group">
                            <label for="subemail" class="font-regular">Enter Your Email</label>
                            <input type="text" class="form-control" id="subemail" name="subemail" />
                        </div>
                        <div class="form-group">
                        <input type="submit" class="btn btn-pink"
                               title="Submit" id="subscribe_button" value="Subscribe"
                               name="subscribe">
                        </div>
                    </div>
                </form>
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
                }
                else {
                    var message = '<div class="flash-message"><div class="alert alert-danger" id="danger-alert"><button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i></button>Failed to book Appointments,try again. </div></div>';
                }
                jQuery('#message').html(message);

            }
        });
    });
</script>
