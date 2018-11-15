<?php require_once('header.php'); ?>
    <div class="page_content_wrap">
        <section class="">
            <div class="container">
                <div class="row">
                    <div class="content_wrap" data-animation="animated fadeInUp normal">
                        <div class="columns_wrap sc_columns aligncenter">
                            <div class="column-1_3 sc_column_item">
                                <span class="sc_icon style_2 icon-email2 sc_icon_shape_none sc_icon_bg_custom link_color"></span>
                                <div class="margin_top_mini">
                                    <p>
                                        <a href="mailto:<?php echo $homePages->firm_email; ?>"><?php echo $homePages->firm_email; ?></a>
                                    </p>
                                </div>
                            </div>
                            <div class="column-1_3 sc_column_item">
                                <span class="sc_icon style_2 icon-telephone sc_icon_shape_none sc_icon_bg_custom link_color"> </span>
                                <div class="margin_top_mini">
                                    <p><?php echo $homePages->firm_phone; ?>
                                </div>
                            </div>
                            <div class="column-1_3 sc_column_item">
                                <span class="sc_icon style_2 icon-location-1 sc_icon_shape_none sc_icon_bg_custom link_color"> </span>
                                <div class="margin_top_mini">
                                    <p><?php echo $homePages->firm_address; ?><?php //echo ($homePages->state->state_name != '') ? $homePages->state->state_name.' ,' : ''; ?>
                                        <span><?php //echo ($homePages->city->city != '') ? $homePages->city->city : ''; ?></span>
                                        <span><?php echo ($homePages->zip_code != '') ? $homePages->zip_code : ''; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="grey_section">
            <div class="container">
                <div class="row">
                    <div class="sc_contact_form sc_contact_form_standard">
                        <h2 class="sc_contact_form_title">Contact Us Today</h2>
                        <div class="sc_contact_form contact_form_1">
                            <form class="contact_1" method="post" action="contact-form.php">
                                <div class="sc_contact_form_info">
                                    <div class="sc_contact_form_item sc_contact_form_field label_over">
                                        <input type="text" name="username" id="contact_form_username"
                                               placeholder="Name *">
                                    </div>
                                    <div class="sc_contact_form_item sc_contact_form_field label_over">
                                        <input type="text" name="email" id="contact_form_email" placeholder="Email *">
                                    </div>
                                    <div class="sc_contact_form_item sc_contact_form_field label_over">
                                        <input type="text" name="form_website" id="contact_form_website"
                                               placeholder="Website">
                                    </div>
                                </div>
                                <div class="message sc_contact_form_item sc_contact_form_message label_over">
                                    <textarea id="contact_form_message" class="textAreaSize" name="message"
                                              placeholder="Message *"></textarea>
                                </div>
                                <div class="sc_contact_form_item sc_contact_form_button">
                                    <div class="squareButton sc_button_size sc_button_style_global global">
                                        <button type="submit" name="contact_submit"
                                                class="sc_button button-hover sc_button_square sc_button_style_red sc_button_size_mini contact_form_submit"
                                                data-text="Send Message">Send Message
                                        </button>
                                    </div>
                                </div>

                                <!-- <div class="result sc_infobox"></div> -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div id="map" style="height: 400px;"></div>

<?php require_once('footer.php'); ?>

<script>
    function initMap() {
        var address = <?= isset($addresses) ? json_encode($addresses) : '' ?>;
        // console.log(address);
        var myLatLng;
        jQuery.each(address, function( index, value ) {
            myLatLng = {
                lat: parseFloat(value.latitude),
                lng: parseFloat( value.longitude)
            };
        });

        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 4,
            center: myLatLng
        });
        var marker;
        jQuery.each(address, function( index, value ) {
            var address1, address2, city, state, country, pincode;
                if(value.street_address_1 != 'Null'){
                    address1 = value.street_address_1;
                }
                if(value.street_address_2 != 'Null'){
                    address2 = value.street_address_2;
                }
                if(value.Cities.city != 'Null'){
                    city = value.Cities.city;
                }
                if(value.States.state_name != 'Null'){
                    state = value.States.state_name;
                }
                if(value.Cities.county != 'Null'){
                    country = value.Cities.county;
                }
                if(value.zip_code != 'Null'){
                    pincode = value.zip_code;
                }


            var titleDetais =
                "Address : " + address1 + ", " + address2 + ", " + city + ", " + state + ", " + country + ", " + pincode;

            marker = new google.maps.Marker({
                position: new google.maps.LatLng(parseFloat(value.latitude), parseFloat( value.longitude)),
                map: map,
                title: titleDetais
            });
        });
    }
</script>


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBa0XKgzJB_erM0hBHbdrjaFB_KQMuRoDY&callback=initMap"
        async
        defer></script>
