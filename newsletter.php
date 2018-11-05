<?php
require_once('header.php');
$curl = new CURL();
$request = array();

$request = array(
    'conditions' => ['Unewsletters.is_deleted' => 0, 'Unewsletters.websiteId' => WEBSITE_ID, 'Unewsletters.is_setting' => 0],
    'contain' => ['newsletters'],
    'fields' => array(),
    'select' => array(),
    'get' => 'all',
    'order' => array('Unewsletters.id' => 'desc'),
    'limit' => '3'
);

$result = $curl->send_api($request, 'Unewsletters/index');
$tags = '';
$page = array();

if ($result->code == 200) {
    $newslettesr = isset($result->Unewsletters[0]) ? $result->Unewsletters : '';
}

$newslettesSetting = array();
//get settings details
$requestSetting = array(
    'conditions' => ['Unewsletters.is_deleted' => 0, 'Unewsletters.websiteId' => WEBSITE_ID, 'Unewsletters.is_setting' => 1],
    'contain' => ['newsletters'],
    'fields' => array(),
    'select' => array(),
    'get' => 'all',
    'order' => array('Unewsletters.id' => 'desc'),
    'limit' => '1'
);

$resultSetting = $curl->send_api($requestSetting, 'Unewsletters/index');

if ($resultSetting->code == 200) {
    $newslettesSetting = isset($resultSetting->Unewsletters[0]) ? $resultSetting->Unewsletters[0] : '';
}
if($newslettesSetting->isedit === 1){
    $coverImage = isset($newslettesSetting->featured_image) ? FEATURE_PHOTO.$newslettesSetting->featured_image : '';
}else{
    $coverImage = isset($newslettesSetting->Newsletters->featured_image) ? FEATURE_PHOTO.$newslettesSetting->Newsletters->featured_image : '';
}
?>

<div class="sub-page-banner mb3">
    <div class="banner-img">
        <?php
            if(!empty($coverImage)){
                echo "<img src='$coverImage' class='img-responsive' />";
            } else {
                echo "<img src='img/newsletter-banner.png' class='img-responsive' />";
            }
        ?>
    </div>
    <div class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>NEWSLETTER</h2>
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
        <div class="row mb2">
            <div class="col-md-8 col-md-offset-2">
                <p class="text-center font-22"><?= isset($newslettesSetting->content) ? $newslettesSetting->content : '' ?></p>
            </div>
        </div>
    </div>
</div>
<div class="newsletter-section container-fluid">

    <?php
    if (!empty($newslettesr)) {
        $i = 0;
        foreach ($newslettesr as $key => $value) {
            if ($value->isedit == 1) {
                $slug = isset($value->slug) ? $value->slug : '';
                $title = isset($value->title) ? $value->title : '';
                $content = isset($value->content) ? $value->content : '';
                $image = isset($value->featured_image) ? FEATURE_PHOTO.$value->featured_image : '';
            } else {
                $slug = isset($value->Newsletters->slug) ? $value->Newsletters->slug : '';
                $title = isset($value->Newsletters->title) ? $value->Newsletters->title : '';
                $content = isset($value->Newsletters->content) ? $value->Newsletters->content : '';
                $image = isset($value->Newsletters->featured_image) ? FEATURE_PHOTO.$value->Newsletters->featured_image : '';
            }
            $pull_class = '';
            $light_color = '';
            if($key % 2 != 0){
                $pull_class = 'col-md-pull-6';
                $light_color = 'light-color';
            }
            ?>
            <div class="row row-eq-height">
                <div class="col-md-6 <?= $pull_class ?>">
                    <?php
                        if(!empty($image)){
                            echo "<img src='$image' class='img-responsive' />";
                        } else {
                            echo "<img src='img/newsletter-img.png' class='img-responsive' />";
                        }
                    ?>
                </div>
                <div class="col-md-6 content-block <?= $pull_class. ' ' .$light_color ?> ">
                    <div class="text-center">
                        <p><?= strip_tags(substr($content,0,250)).'...' ?></p>
                        <a href="newsletterdetails.php?slug=<?= $slug ?>" class="btn">Read More</a>
                    </div>
                </div>
            </div>
            <?php
            $lastid = ++$i;
        }
        ?>
        <input type="hidden" id="totrecord" value="<?php echo isset($lastid) ? $lastid : 0; ?>" />
    <?php } ?>
</div>
<?php if(count($newslettesr)>2){ ?>
    <div class="sc_contact_form_item sc_contact_form_button loadmorebtndiv" style="text-align: center">
        <div class="squareButton sc_button_size sc_button_style_global global">
            <button type="submit" name="contact_submit" id="loadmore" class="sc_button button-hover sc_button_square sc_button_style_red sc_button_size_mini contact_form_submit" data-text="Click Here">Load More</button>
        </div>
    </div>
<?php } ?>

<?php require_once('footer.php') ?>
