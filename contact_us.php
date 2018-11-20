<?php require_once('header.php');
$data['websiteId'] = WEBSITE_ID;
$about_data = $curl->send_api($data, 'Uaboutus/index');


$data['websiteId'] = WEBSITE_ID;
$branchAddresses = $curl->send_api($data, 'UbranchAddress/index');
if (!empty($result) && $result->code == 200) {
    $addresses = $branchAddresses->UbranchAddress;
}

?>
<style>
    .address-info {
    border-bottom: 1px solid #f08a38;
    margin: 20px 0px 20px 0px;
}
</style>

    
    <div class="sub-page-banner mb3">
        <div class="banner-img">
            <img src="img/contact-us-banner.png" class="img-responsive" />
        </div>
        <div class="page-title text-center">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2>CONTACT US</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="clearfix mb4">
        <div class="container">
            <div class="row mb2">
                <div class="col-md-8">
                    <h3 class="font-18 font-medium mb2">GET IN TOUCH</h3>
                    <form id="frmcontactus" method="POST">
                    <div class="row">
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="font-17 font-medium">Name</label>
                                <div class="">
                                    <input type="text" name="username" id="username" class="form-control" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="font-17 font-medium">Email Address</label>
                                <div class="">
                                    <input type="email" name="email" id="email" class="form-control" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="font-17 font-medium">Phone Number</label>
                                <div class="">
                                    <input type="tel" class="form-control" required/>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="font-17 font-medium">Your Message</label>
                                <div class="">
                                    <textarea name="message" id="message" class="form-control" rows="8"></textarea>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row mt3">
                        <div class="col-md-8">
                            
                            <button class="btn btn-small btn-orange" id="contactus_button">Send</button>
                        </div>

                    </div>
                    </form>
                </div>
                <div class="col-md-3 col-md-offset-1">
                    <h3 class="font-18 font-medium mb3">Address</h3>
                    <div class="clearfix">
                        <?php  if(!empty($addresses)){ 
      foreach ($addresses as $key => $address){
          $fullAddr = $address->street_address_1 .' <br/>'.$address->street_address_2.' <br/>'.$address->Cities->city.' '.$address->States->state_name.' '.$address->Cities->county.' - '.$address->zip_code;
                            ?>
                        <ul class="address-info">
                            <li>
                                <i class="icon-location"></i>
                                <label><?php echo $fullAddr; ?></label>
                            </li>
                            <li>
                                <i class="icon-phone"></i>
                                <label><?php echo $homePages->firm_phone; ?></label>
                            </li>
                            <li>
                                <i class="icon-mail"></i>
                                <label><a href="mailto:<?php echo $homePages->firm_email; ?>"> <?php echo $homePages->firm_email; ?></a></label>
                            </li>
                            
                        </ul>
                        
      <?php } }else{ ?>
                            
                        <ul class="address-info">
                            <li>
                                <i class="icon-location"></i>
                                <label><?php echo $homePages->firm_address .' '.$homePages->zip_code; ?></label>
                            </li>
                            <li>
                                <i class="icon-phone"></i>
                                <label><?php echo $homePages->firm_phone; ?></label>
                            </li>
                            <li>
                                <i class="icon-mail"></i>
                                <label><a href="mailto:<?php echo $homePages->firm_email; ?>"> <?php echo $homePages->firm_email; ?></a></label>
                            </li>
                            
                        </ul>
                        
                        <?php } ?>
                       
                    </div>
                </div>
            </div>

        </div>

    </div>
    <div class="clearfix map-section">
         <div id="map" style="height: 400px;"></div>
         
<!--        <img src="img/contact-map.png" class="img-responsive" />-->
    </div>
    <?php require_once ('footer.php'); ?>

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