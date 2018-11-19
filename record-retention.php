<?php 
    require_once('header.php'); 
    // $about_data = array();
    $data['websiteId'] = WEBSITE_ID;

    $request = array(
    'conditions' => ['is_deleted' => 0,'status'=>1,'is_setting'=>0],
    'fields' => array(),
    'select' => array(),
    'get' => 'all',
    'order' => array('id' => 'desc')

    );
    $RecordRetention = $curl->send_api($request, 'RecordRetention/index');
    if($RecordRetention->code == 200)
    {
        $recordretention = $RecordRetention->RecordRetention;
    }


    $request = array(
    'conditions' => ['is_deleted' => 0,'status'=>1,'is_setting'=>1],
    'fields' => array(),
    'select' => array(),
    'get' => 'list',
    'order' => array('id' => 'desc')

    );
    $RSetting = $curl->send_api($request, 'RecordRetention/index');
    $images = $description = '';
    if($RSetting->code == 200)
    {
        $RSetting = $RSetting->RecordRetention;
        if(count($RSetting) > 0)
        {
            $images = isset($RSetting[0]->photo) ? $RSetting[0]->photo  :'';
            $description = isset($RSetting[0]->description) ? $RSetting[0]->description  :'';
        }
    }
    
    /*if (!empty($Uretention) && $Uretention->code == 200) {
        $taxcenter_data = $Uretention->UtaxCenter;

        $images = isset($taxcenter_data->image) ? $Uretention->image  :'';
        $description = isset($taxcenter_data->description) ? $Uretention->description  :'';
        $is_edit = isset($taxcenter_data->is_edit) ? $taxcenter_data->is_edit  :'';
        
        if($is_edit == 0)
        {
            $images = isset($taxcenter_data->TaxCenter->image) ? $taxcenter_data->TaxCenter->image  :'';
            $description = isset($taxcenter_data->TaxCenter->description) ? $taxcenter_data->TaxCenter->description  :'';
        }
    }*/
?>
    <div class="page_top_wrap page_top_title page_top_breadcrumbs" style="background:url(<?php echo API_URL ?>geturl/uploads/photo/<?php echo $images; ?>) no-repeat 59% 49%;max-height: 250px;background-size: cover;">
        <div class="content_wrap">
            <div class="breadcrumbs">
                <a class="breadcrumbs_item home" href="index.php">Home</a>
                <span class="breadcrumbs_delimiter"></span>
                <span class="breadcrumbs_item current">Record Retention</span>
            </div>
            <h1 class="page_title">Record Retention</h1>
        </div>
    </div>
    <center><h4 class="page_title"><?php echo $description;?></h4></center>
        <div class="page_content_wrap margin_bottom_mini padding_bottom_mini padding_left_mini padding_right_mini padding_top_mini">
            <ul>    
            <?php 
            foreach($recordretention  as $row){?>
                <li class="margin_bottom_mini"><strong><?php echo $row->title;?></strong>
                <p class="margin_bottom_mini margin_top_none"><?php echo $row->description;?> </p>
                </li>
           <?php }?>
           </ul>
        </div>
<?php require_once('footer.php'); ?> 