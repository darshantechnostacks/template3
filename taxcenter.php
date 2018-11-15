<?php 
    require_once('header.php'); 
    // $about_data = array();
    $data['websiteId'] = WEBSITE_ID;
    $taxcenter = $curl->send_api($data, 'UtaxCenter/GetSetting/');
   
    if (!empty($taxcenter) && $taxcenter->code == 200) {
        $taxcenter_data = $taxcenter->UtaxCenter;

        $images = isset($taxcenter_data->image) ? $taxcenter_data->image  :'';
        $description = isset($taxcenter_data->description) ? $taxcenter_data->description  :'';
        $is_edit = isset($taxcenter_data->is_edit) ? $taxcenter_data->is_edit  :'';
       
        if($is_edit == 0)
        {
            $images = isset($taxcenter_data->TaxCenter->image) ? $taxcenter_data->TaxCenter->image  :'';
            $description = isset($taxcenter_data->TaxCenter->description) ? $taxcenter_data->TaxCenter->description  :'';
        }
        
    }
    //get tracks & Refunds data
    $request = array();

$request = array(
    'conditions' => ['Utracksrefunds.is_deleted' => 0, 'Utracksrefunds.websiteId' => WEBSITE_ID, 'Utracksrefunds.is_setting' => 1],
    'contain' => ['Tracksrefunds'],
    'fields' => array(),
    'select' => array(),
    'get' => 'all',
    'order' => array('Utracksrefunds.id' => 'desc'),
    'limit' => '1'
);

$result = $curl->send_api($request, 'Utracksrefunds/index');
$details = '';

if(!empty($result) && !empty($result->Utracksrefunds[0]) && !empty($result->Utracksrefunds[0]->tracksrefund)){
   $details  = $result->Utracksrefunds[0]->tracksrefund->page_content;
   
}

    
?>
    <div class="page_top_wrap page_top_title page_top_breadcrumbs" style="background:url(<?php echo API_URL . 'geturl/uploads/icon/' . $images; ?>) no-repeat 59% 49%;max-height: 250px;background-size: cover;">
        <div class="content_wrap">
            <div class="breadcrumbs">
                <a class="breadcrumbs_item home" href="#!">Home</a>
                <span class="breadcrumbs_delimiter"></span>
                <a class="breadcrumbs_item home" href="resources.html">Resources</a>
                <span class="breadcrumbs_delimiter"></span>
                <span class="breadcrumbs_item current">Tax Center</span>
            </div>
            <h1 class="page_title">Tax Center</h1>
        </div>
    </div>
    <div class="page_content_wrap margin_bottom_mini padding_bottom_mini padding_left_mini padding_right_mini padding_top_mini">
        <p class="margin_bottom_mini"><?php echo substr($description,0,75);?></p>
        <div class="d-flex flex-wrap">
            <a href="calculator.php?slug=/1taxable-vs-tax-deferred-calculator" class="col-sm-4 col-xs-12 grid-link margin_bottom_mini padding_bottom_mini padding_top_mini">
                <div class="d-flex justify-spacebetween">
                    <div class="margin_right_mini">
                        <i class="fa fa-user-circle-o fa-3x"></i>
                    </div>
                    <div>
                        <h4 class="normal">Individual Tax Calculator</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                            incididunt ut labore
                            et dolore magna aliqua.</p>
                    </div>
                </div>
            </a>
            <a href="track-your-refund.php" class="col-sm-4 col-xs-12 grid-link margin_bottom_mini padding_bottom_mini padding_top_mini">
                <div class="d-flex justify-spacebetween">
                    <div class="margin_right_mini">
                        <i class="fa fa-user-circle-o fa-3x"></i>
                    </div>
                    <div>
                        <h4 class="normal">Track Your Refund</h4>
                        <p><?php echo substr(strip_tags($details), 0,250); ?></p>
                    </div>
                </div>
            </a>
            <a href="" class="col-sm-4 col-xs-12 grid-link margin_bottom_mini padding_bottom_mini padding_top_mini">
                <div class="d-flex justify-spacebetween">
                    <div class="margin_right_mini">
                        <i class="fa fa-user-circle-o fa-3x"></i>
                    </div>
                    <div>
                        <h4 class="normal">Tax Rates</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                            incididunt ut labore
                            et dolore magna aliqua.</p>
                    </div>
                </div>
            </a>
            <a href="" class="col-sm-4 col-xs-12 grid-link margin_bottom_mini padding_bottom_mini padding_top_mini">
                <div class="d-flex justify-spacebetween">
                    <div class="margin_right_mini">
                        <i class="fa fa-user-circle-o fa-3x"></i>
                    </div>
                    <div>
                        <h4 class="normal">Tax Due Dates</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                            incididunt ut labore
                            et dolore magna aliqua.</p>
                    </div>
                </div>
            </a>
            <a href="" class="col-sm-4 col-xs-12 grid-link margin_bottom_mini padding_bottom_mini padding_top_mini">
                <div class="d-flex justify-spacebetween">
                    <div class="margin_right_mini">
                        <i class="fa fa-user-circle-o fa-3x"></i>
                    </div>
                    <div>
                        <h4 class="normal">Tax Guide</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                            incididunt ut labore
                            et dolore magna aliqua.</p>
                    </div>
                </div>
            </a>
            <a href="" class="col-sm-4 col-xs-12 grid-link margin_bottom_mini padding_bottom_mini padding_top_mini">
                <div class="d-flex justify-spacebetween">
                    <div class="margin_right_mini">
                        <i class="fa fa-user-circle-o fa-3x"></i>
                    </div>
                    <div>
                        <h4 class="normal">Sales tax resources</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                            incididunt ut labore
                            et dolore magna aliqua.</p>
                    </div>
                </div>
            </a>
            <a href="" class="col-sm-4 col-xs-12 grid-link margin_bottom_mini padding_bottom_mini padding_top_mini">
                <div class="d-flex justify-spacebetween">
                    <div class="margin_right_mini">
                        <i class="fa fa-user-circle-o fa-3x"></i>
                    </div>
                    <div>
                        <h4 class="normal">Record retention</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                            incididunt ut labore
                            et dolore magna aliqua.</p>
                    </div>
                </div>
            </a>
            <a href="" class="col-sm-4 col-xs-12 grid-link margin_bottom_mini padding_bottom_mini padding_top_mini">
                <div class="d-flex justify-spacebetween">
                    <div class="margin_right_mini">
                        <i class="fa fa-user-circle-o fa-3x"></i>
                    </div>
                    <div>
                        <h4 class="normal">Tax tips</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                            incididunt ut labore
                            et dolore magna aliqua.</p>
                    </div>
                </div>
            </a>
            <a href="" class="col-sm-4 col-xs-12 grid-link margin_bottom_mini padding_bottom_mini padding_top_mini">
                <div class="d-flex justify-spacebetween">
                    <div class="margin_right_mini">
                        <i class="fa fa-user-circle-o fa-3x"></i>
                    </div>
                    <div>
                        <h4 class="normal">State Tax Forms</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                            incididunt ut labore
                            et dolore magna aliqua.</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
<?php require_once('footer.php'); ?> 