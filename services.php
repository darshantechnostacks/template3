<?php
require_once('header.php');

$curl = new CURL();

/********** Get pages ******/
$row['websiteId'] = WEBSITE_ID;

$result = $curl->send_api($row, 'Uservices/getParentServicesAll');

$pages = array();

if ($result->code == 200) {
    $pages = $result->Uservices;
}
$settings_content = '';
$settings_icon = '';
if(!empty($pages->setting)){
    $settings = $pages->setting;
    if ($settings->edit_status == 0) {
        $settings_content = $settings->service->page_content;
        $settings_icon = $settings->service->icon;
    } else {
        $settings_content = $settings->page_content;
        $settings_icon = $settings->icon;
    }
}

?>
<div class="sub-page-banner mb3">
    <div class="banner-img">
        <img src="<?= isset($settings_icon) ? ICON_URL.$settings_icon : 'img/service-banner.png' ?>" class="img-responsive"/>
    </div>
    <div class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>ACCOUNTING</h2>
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
<div class="clearfix mb4">
    <div class="container">
        <p class="font-16 mb4 font-light">
            <?= isset($settings_content) ? $settings_content : '' ?>
        </p>

        <div class="row mb2 services-inner">

            <?php
            foreach ($pages->services as $service){
                if($service->edit_status == 0)
                {
                    $page_content = $service->service->services_content[$set_no-1]->content;
                    $page_content = str_replace('{company_name}', '<b>'.$firm.'</b>', $page_content);
                    $page_content = str_replace('{city_name}', '<b>'.$city_name.'</b>', $page_content);

                    // $page_content = $page->service->page_content;
                    $icon = $service->service->icon;
                    $name = $service->service->name;
                }
                else
                {
                    $page_content = $service->page_content;
                    $icon = $service->icon;
                    $name = $service->name;
                }

                $row['websiteId'] = WEBSITE_ID;
                $row['parentId'] = $service->id;
                $result = $curl->send_api($row,'Uservices/getServiceById');

                $link = '';
                if(count($result->Uservices)> 0)
                {
                    $link = 'services_sub.php?slug='.$service->page_slug;
                }
                else
                {
                    $link = 'services_detail.php?slug='.$service->page_slug;
                }
                ?>
                <div class="col-md-4 col-sm-6 mb2">
                    <div class="inner-box clearfix">
                        <div class="icon-block">
                            <i class=" icon mb-3"><img src="<?= isset($icon) ? ICON_URL.$icon : 'img/services-icon.png' ?>" class="img-responsive"/></i>
                        </div>
                        <div class="content">
                            <div class="title-block">
                                <h2 class="title"><?= $name ?></h2>
                            </div>
                            <p><?= strip_tags(substr($page_content,0,100)) ?></p>
                            <a href="<?= $link ?>" class="btn-link">Read More >></a>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>
<?php require_once('footer.php'); ?>

