<?php require_once('header.php');
$addresses = isset($addresses) ? $addresses : '';
//p($addresses);
//die;
?>
<div class="clearfix contact-us-section">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h4 class="font-22 font-medium">GET IN TOUCH</h4>
                <div class="row mb3">
                    <?php
                        foreach ($addresses as $address){
                            $address1 = isset($address->street_address_1) ? $address->street_address_1.', ' : '';
                            $address2 = isset($address->street_address_2) ? $address->street_address_2.', ' : '';
                            $city = isset($address->Cities->city) ? $address->Cities->city.', ' : '';
                            $state = isset($address->States->state_name) ? $address->States->state_name.', ' : '';
                            $country = isset($address->Cities->county) ? $address->Cities->county.', ' : '';
                            $zip_code = isset($address->zip_code) ? $address->zip_code : '';
                            $full_address = $address1.$address2."<br/>".$city.$state.$country.$zip_code;
                            ?>
                            <div class="col-md-6">
                                <h5 class="font-17 font-medium txt-white"><?= isset($country) ? $country : '' ?> <small class="font-regular txt-white"></small></h5>
                                <ul class="address-info">
                                    <li>
                                        <i class="icon-location"></i>
                                        <label><?= isset($full_address) ? $full_address : '' ?></label>
                                    </li>
                                </ul>
                            </div>
                            <?php
                        }
                    ?>
                </div>

                <div class="contact-outer-block flex-box">
                    <div class="col-md-5 col-sm-6 contact-us-block">
                        <div class="inner">
                            <h5 class="font-22 font-medium txt-white mb3">CONTACT US</h5>
                            <p class="font-18 font-medium txt-white">Have Project on your mind ? Drop your details here</p>
                            <ul class="address-info">
                                <li>
                                    <i class="icon-phone"></i>
                                    <label class="txt-white font-light"><?= isset($homePages->firm_phone) ? $homePages->firm_phone : "" ?></label>
                                </li>
                                <li>
                                    <i class="icon-mail"></i>
                                    <label><a href="mailto:<?= isset($homePages->firm_email) ? $homePages->firm_email : "" ?>"> <?= isset($homePages->firm_email) ? $homePages->firm_email : "" ?></a></label>
                                </li>

                            </ul>
                        </div>
                    </div>

                    <div class="col-md-7 col-sm-6 contact-form">
                        <div class="inner">
                            <form method="post" id="frmcontactus">
                                <h5 class="font-22 font-medium">Contact Form</h5>
                                <div class="form-group">
                                    <label>Full Name</label>
                                    <input type="text" name="username" id="contact_form_username"
                                       placeholder="Full Name"/>
                                </div>
                                <div class="form-group">
                                    <label>E-mail</label>
                                    <input type="email" name="email" id="contact_form_email"
                                           placeholder="E-mail"/>
                                </div>
                                <div class="form-group">
                                    <label>Write your require,ment</label>
                                    <textarea id="contact_form_message" name="message" rows="4"
                                              placeholder="Start Typing"></textarea>
                                </div>
                                <button type="submit" name="contact_submit"
                                        class="btn btn-pink btn-small font-medium text-uppercase"
                                        data-text="Send Now">Send Now
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once('footer.php'); ?>