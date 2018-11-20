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
    
  if(!empty($images)){
        $coverImageUrl =  API_URL .'geturl/uploads/photo/'. $images; 
  }else{
      $coverImageUrl =  'img/text-center-banner.png'; 
  }
?>
    

<div class="sub-page-banner">
    <div class="banner-img">
        <img src="<?php echo $coverImageUrl; ?>" class="img-responsive" style="max-height: 250px;background-size: cover; " />
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
</div>
<div class="container padding_top_mini mt4">
    <center><h4 class="page_title"><?php echo $description;?></h4></center>
        <div class="page_content_wrap margin_bottom_mini padding_bottom_mini padding_left_mini padding_right_mini padding_top_mini">
            <?php 
            foreach($recordretention  as $row){?>
                <p class="margin_bottom_mini"><strong><?php echo $row->title;?></strong></p>
                <p class="margin_bottom_mini margin_top_none"><?php echo $row->description;?> </p>
           <?php }?>
        </div>
</div>
<div class="mt4"></div>
<?php require_once('footer.php'); ?> 