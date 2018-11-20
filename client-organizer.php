<?php 
    require_once('header.php'); 
    
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
?>
    <div class="sub-page-banner mb4">
        <div class="banner-img">
            <img src="<?php echo API_URL ?>geturl/uploads/document/<?php echo $images; ?>" class="img-responsive" style="max-height: 250px;background-size: cover;width: 100%; " />
        </div>
        <div class="page-title text-center">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Client Form</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="clearfix mb4">
        <div class="container">
            <div class="row">
                <div class="col-md-5 text-center mb3">
                    <div class="inline-block pos-relative">
                        <img src="img/client_form_side_image.jpeg" class="img-responsive" width="220" />
                        <div class="box-line-title" style="max-width: 190px;">
                            <span>Client Organizer</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <p class="font-14 mb1 font-light"><?php echo $description; ?></p>
                </div>
            </div>
            <div class="row">
            <?php  if(count($clientforms) > 0){ foreach($clientforms as $client_form){?>
                <div class="col-md-4">
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
    </div>
<?php require_once('footer.php'); ?>    