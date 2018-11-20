<?php
require_once('header.php');

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
//img/text-center-banner.png
?>
    <div class="sub-page-banner mb1">
        <div class="banner-img">
            <?php if(!empty($images)){ ?>
            <img src="<?php echo API_URL . 'geturl/uploads/icon/' . $images; ?>" class="img-responsive" style="max-height: 250px;background-size: cover;" />
            <?php }else{ ?>
<img src="img/text-center-banner.png" class="img-responsive" style="max-height: 250px;background-size: cover;" />                
            <?php }?>
        </div>
        <div class="page-title text-center">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2>TAX CENTER</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="about-section mb1">
        <div class="container">
            <p class="font-16 mb4 font-light"><?php echo substr($description,0,75);?></p>

            <div class="row services-inner">
                <a href="calculator.php?slug=/1taxable-vs-tax-deferred-calculator">
                <div class="col-md-4 col-sm-6 mb2">
                    <div class="inner-box clearfix">
                        <div class="icon-block">
                            <i class=" icon mb-3"><img src="img/services-icon.png" class="img-responsive" /></i>
                        </div>
                        <div class="content">
                            <div class="title-block">
                                <a href="calculator.php?slug=/1taxable-vs-tax-deferred-calculator"><h2 class="title">INDIVIDUAL TAX CALCULATOR</h2></a>
                            </div>
                            <p class="mb1">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                            </p>
                        </div>

                    </div>
                </div>
                </a>
                <a href="track-your-refund.php">
                <div class="col-md-4 col-sm-6 mb2">
                    <div class="inner-box clearfix">
                        <div class="icon-block">
                            <i class=" icon mb-3"><img src="img/services-icon.png" class="img-responsive" /></i>
                        </div>
                        <div class="content">
                            <div class="title-block">
                                <h2 class="title">TRACK YOUR REFUND</h2>
                            </div>
                            <p class="mb1">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                            </p>
                        </div>

                    </div>
                </div>
            </a>
                <div class="col-md-4 col-sm-6 mb2">
                    <div class="inner-box clearfix">
                        <div class="icon-block">
                            <i class=" icon mb-3"><img src="img/services-icon.png" class="img-responsive" /></i>
                        </div>
                        <div class="content">
                            <div class="title-block">
                                <h2 class="title">TAX RATES</h2>
                            </div>
                            <p class="mb1">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                            </p>
                        </div>

                    </div>
                </div>
                <div class="col-md-4 col-sm-6 mb2">
                    <div class="inner-box clearfix">
                        <div class="icon-block">
                            <i class=" icon mb-3"><img src="img/services-icon.png" class="img-responsive" /></i>
                        </div>
                        <div class="content">
                            <div class="title-block">
                                <h2 class="title">TAX DUE DATES</h2>
                            </div>
                            <p class="mb1">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                            </p>
                        </div>

                    </div>
                </div>
                <div class="col-md-4 col-sm-6 mb2">
                    <div class="inner-box clearfix">
                        <div class="icon-block">
                            <i class=" icon mb-3"><img src="img/services-icon.png" class="img-responsive" /></i>
                        </div>
                        <div class="content">
                            <div class="title-block">
                                <h2 class="title">TAX GUIDE</h2>
                            </div>
                            <p class="mb1">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                            </p>
                        </div>

                    </div>
                </div>
                <div class="col-md-4 col-sm-6 mb2">
                    <div class="inner-box clearfix">
                        <div class="icon-block">
                            <i class=" icon mb-3"><img src="img/services-icon.png" class="img-responsive" /></i>
                        </div>
                        <div class="content">
                            <div class="title-block">
                                <h2 class="title">SALES TAX RESOURCES</h2>
                            </div>
                            <p class="mb1">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                            </p>
                        </div>

                    </div>
                </div>

                <div class="col-md-4 col-sm-6 mb2">
                    <div class="inner-box clearfix">
                        <div class="icon-block">
                            <i class=" icon mb-3"><img src="img/services-icon.png" class="img-responsive" /></i>
                        </div>
                        <div class="content">
                            <div class="title-block">
                                <h2 class="title">RECORD RETENTION</h2>
                            </div>
                            <p class="mb1">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                            </p>
                        </div>

                    </div>
                </div>
                <div class="col-md-4 col-sm-6 mb2">
                    <div class="inner-box clearfix">
                        <div class="icon-block">
                            <i class=" icon mb-3"><img src="img/services-icon.png" class="img-responsive" /></i>
                        </div>
                        <div class="content">
                            <div class="title-block">
                                <h2 class="title">TAX TIPS</h2>
                            </div>
                            <p class="mb1">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                            </p>
                        </div>

                    </div>
                </div>
                <div class="col-md-4 col-sm-6 mb2">
                    <div class="inner-box clearfix">
                        <div class="icon-block">
                            <i class=" icon mb-3"><img src="img/services-icon.png" class="img-responsive" /></i>
                        </div>
                        <div class="content">
                            <div class="title-block">
                                <h2 class="title">STATE TAX FORMS</h2>
                            </div>
                            <p class="mb1">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
   <?php require_once ('footer.php'); ?>