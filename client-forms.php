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
    'conditions' => ['is_deleted' => 0,'status'=>1,'type'=>2,'is_setting'=>0],
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
        <div class="page_top_wrap page_top_title page_top_breadcrumbs" style="background:url(<?php echo API_URL ?>geturl/uploads/document/<?php echo $images; ?>) no-repeat 59% 49%;max-height: 250px;background-size: cover;">
            <div class="content_wrap">
                <div class="breadcrumbs">
                    <a class="breadcrumbs_item home" href="index.php">Home</a>
                    <span class="breadcrumbs_delimiter"></span>
                    <span class="breadcrumbs_item current">Client Forms</span>
                </div>
                <h1 class="page_title">Client Forms</h1>
            </div>
        </div>
        <div class="page_content_wrap margin_bottom_small padding_bottom_small padding_left_small padding_right_small padding_top_small">
            <?php echo $description; ?>
            <br>
            <div class="row d-flex flex-wrap">
                <?php if(count($client_forms) > 0){ foreach($clientforms as $client_form){?>
                <div class="col-sm-6 col-xs-12 margin_bottom_small">
                    <a target="blank" href="<?php echo API_URL ?>geturl/uploads/document/<?php echo $client_form->document; ?>" class="d-flex file-list">
                        <div class="d-flex align-items-center file-icon padding_bottom_mini padding_left_mini padding_right_mini padding_top_mini">
                            <i class="fa fa-3x fa-file-pdf-o"></i>
                        </div>
                        <div class="file-content d-flex align-items-center flex-grow-1 padding_bottom_mini padding_left_mini padding_right_mini padding_top_mini">
                            <h5 class="margin_bottom_none font-size-16 file-title"><?php echo $client_form->title;?></h5>
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
<?php require_once('footer.php'); ?> 