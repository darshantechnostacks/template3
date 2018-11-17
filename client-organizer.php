<?php
require_once ('header.php');

 
    $request = array(
    'conditions' => ['is_deleted' => 0,'status'=>1,'is_setting'=>1],
    'fields' => array(),
    'select' => array(),
    'get' => 'all',
    'order' => array('id' => 'desc')

    );
    $client_forms_setting = $curl->send_api($request, 'ClientOrganizer/index');
    
    if($client_forms_setting->code == 200)
    {
        $client_formssetting = $client_forms_setting->ClientOrganizer;
        if(count($client_formssetting) > 0)
        {
            $images = isset($client_formssetting[0]->document) ? $client_formssetting[0]->document  :'';
            $description = isset($client_formssetting[0]->description) ? $client_formssetting[0]->description  :'';
        }
    }


    $request = array(
    'conditions' => ['is_deleted' => 0,'status'=>1,'type'=>1,'is_setting'=>0],
    'fields' => array(),
    'select' => array(),
    'get' => 'list',
    'order' => array('id' => 'desc')

    );

    $client_forms = $curl->send_api($request, 'ClientOrganizer/index');
   
    if($client_forms->code == 200)
    {
        $clientforms = $client_forms->ClientOrganizer;
    }
    
    $BannerImage = !empty($images)? API_URL.'geturl/uploads/document/'. $images:"img/client_organizer_header.jpeg";
    
?>

    <div class="sub-page-banner mb3">
        <div class="banner-img">
            <img src="<?php echo $BannerImage; ?>" class="img-responsive" style="max-height: 250px;background-size: cover;width: 100%; " />
        </div>
        <div class="page-title">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Client Organizer</h2>
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

    <div class="container mb2">
        <div class="row d-flex flex-wrap">
            
             <div class="font-14 mb1 font-light"><?php echo $description; ?></div>
               <?php  if(count($clientforms) > 0){ foreach($clientforms as $client_form){?>
            <div class="col-md-4 col-xs-12">
                <a target="blank" href="<?php echo API_URL ?>geturl/uploads/document/<?php echo $client_form->document; ?>" class="d-flex file-list mb1">
                        <div class="align-items-center d-flex file-icon">
                            <i class="fa fa-3x fa-file-pdf-o"></i>
                        </div>
                        <div class="align-items-center d-flex file-content flex-grow-1">
                            <h5 class="margin_bottom_none font-medium font-size-16 file-title"><?php echo $client_form->title;?></h5>
                        </div>
                    </a>
            </div>
             
             
             
             
             <?php } }else{?>
                        <div class="col-sm-12 col-xs-12 margin_bottom_small">
                            Record not found
                        </div>
                    <?php } ?>
            
            
        </div>
    </div>

    <?php require_once ('footer.php'); ?>