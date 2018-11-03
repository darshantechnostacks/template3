<?php
require_once('header.php');
// $about_data = array();
$data['websiteId'] = WEBSITE_ID;
$taxcenter = $curl->send_api($data, 'UtaxCenter/GetSetting/');

if (!empty($taxcenter) && $taxcenter->code == 200) {
    $taxcenter_data = $taxcenter->UtaxCenter;

    $images = isset($taxcenter_data->image) ? ICON_URL.$taxcenter_data->image  :'';
    $description = isset($taxcenter_data->description) ? $taxcenter_data->description  :'';
    $is_edit = isset($taxcenter_data->is_edit) ? $taxcenter_data->is_edit  :'';

    if($is_edit == 0)
    {
        $images = isset($taxcenter_data->TaxCenter->image) ? ICON_URL.$taxcenter_data->TaxCenter->image  :'';
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

<div class="sub-page-banner mb3">
    <div class="banner-img">
        <?php
            if(!empty($images)){
                echo "<img src='$images' class='img-responsive' />";
            } else {
                echo "<img src='img/tax-center-banner.png' class='img-responsive' />";
            }
        ?>

    </div>
    <div class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>TAX CENTER</h2>
                    <h4>We love what we do and we’re good at it!</h4>
                </div>
            </div>
        </div>
    </div>
    <ul class="top-contact-info">
        <li><i class="icon-mobile"></i><?= isset($homePages->firm_phone) ? $homePages->firm_phone : "" ?></li>
        <li><i class="icon-mobile"></i> <a href="mailtto:<?= isset($homePages->firm_email) ? $homePages->firm_email : "" ?>"><?= isset($homePages->firm_email) ? $homePages->firm_email : "" ?></a></li>
    </ul>
</div>
<div class="clearfix mb1">
    <div class="container">
        <p class="font-16 mb4 font-light"><?= substr($description,0,75) ?></p>
        <div class="row mb2 services-inner">
            <a href="calculator.php?slug=/1taxable-vs-tax-deferred-calculator">
                <div class="col-md-4 col-sm-6 mb2">
                    <div class="inner-box clearfix">
                        <div class="icon-block">
                            <i class=" icon mb-3"><img src="img/services-icon.png" class="img-responsive" /></i>
                        </div>
                        <div class="content">
                            <div class="title-block">
                                <h2 class="title">Individual Tax Calculator</h2>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                incididunt ut labore
                                et dolore magna aliqua.</p>
                        </div>
                    </div>
                </div>
            </a>
            <a href="track-your-refund.php" class="col-sm-4 col-xs-12 grid-link margin_bottom_mini padding_bottom_mini padding_top_mini">
                <div class="col-md-4 col-sm-6 mb2">
                    <div class="inner-box clearfix">
                        <div class="icon-block">
                            <i class=" icon mb-3"><img src="img/services-icon.png" class="img-responsive" /></i>
                        </div>
                        <div class="content">
                            <div class="title-block">
                                <h2 class="title">Track Your Refund</h2>
                            </div>
                            <p><?= substr(strip_tags($details), 0,250) ?></p>
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
                            <h2 class="title">client forms & organizer</h2>
                        </div>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>

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
                            <h2 class="title">tax due dates</h2>
                        </div>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>

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
                            <h2 class="title">tax guide</h2>
                        </div>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>

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
                            <h2 class="title">sales tax resources</h2>
                        </div>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>

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
                            <h2 class="title">record retention</h2>
                        </div>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>

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
                            <h2 class="title">tax tips</h2>
                        </div>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>

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
                            <h2 class="title">sales tax forms</h2>
                        </div>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once('footer.php'); ?>
