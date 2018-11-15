<?php
require_once('header.php');
$bannerImage = '';
//get setting details
$setting = array();
$settingReq = array(
    'conditions' => ['Utaxcuts.is_deleted' => 0, 'Utaxcuts.is_setting' => 1, 'Utaxcuts.websiteId' => WEBSITE_ID],
    'contain' => ['taxcuts'],
    'fields' => array(),
    'select' => array(),
    'get' => 'all',
    'order' => array('Utaxcuts.id' => 'desc'),
    'limit'=>1,
);

$resultSettings = $curl->send_api($settingReq, 'Utaxcuts/index');
if($resultSettings->code == 200 && !empty($resultSettings->Utaxcuts)){
    $settingDetails = $resultSettings->Utaxcuts[0];
}else{
    $settingDetails = $resultSettings->Utaxcuts;
}
if(!empty($settingDetails)){
    if($settingDetails->isedit == 1){
       $bannerImage = $settingDetails->featured_image;
       $defaultContent = $settingDetails->page_content;
    }else{
       $bannerImage = $settingDetails->Taxcuts->featured_image;   
       $defaultContent = $settingDetails->Taxcuts->contents;
    }
    
}else{
 $bannerImage = '';   
 $defaultContent='';
}


//get inactive details
$requtaxdue = array();
$requtaxdue = array(
    'conditions' => ['Utaxcuts.is_deleted' => 0, 'Utaxcuts.is_setting' => 0, 'Utaxcuts.websiteId' => WEBSITE_ID],
    'contain' => [],
    'fields' => array(),
    'select' => array(),
    'get' => 'all',
    'order' => array('Utaxcuts.id' => 'desc'),
);

$resultUtaxcuts = $curl->send_api($requtaxdue, 'Utaxcuts/index');

$listid = array();
if (!empty($resultUtaxcuts) && $resultUtaxcuts->Utaxcuts) {
    foreach ($resultUtaxcuts->Utaxcuts as $key => $value) {
        $listid[] = $value->taxcut_id;
    }
}


//get Tax Cuts
$reqtaxdue = array();
$reqtaxdue = array(
    'conditions' => ['Taxcuts.is_deleted' => 0, 'Taxcuts.status' => 1],
    'contain' => ['taxcutscategories'],
    'fields' => array(),
    'select' => array(),
    'get' => 'all',
    'order' => array('Taxcuts.id' => 'desc'),
);

$resultTaxcuts = $curl->send_api($reqtaxdue, 'Taxcuts/index');

//initlization
$taxcutslist = array();
if (!empty($resultTaxcuts) && ($resultTaxcuts->code == 200) && $resultTaxcuts->Taxcuts) {
    $taxcutslist = $resultTaxcuts->Taxcuts;
} else {
    $taxcutslist = array();
}
$category = array();

?>

<div class="page_top_wrap page_top_title page_top_breadcrumbs" style="background:url(<?php echo API_URL; ?>geturl/uploads/feature_photo/<?php echo $bannerImage; ?>) no-repeat 59% 49%;max-height: 250px;background-size: cover;">
    <div class="content_wrap">
        <div class="breadcrumbs">
            <a class="breadcrumbs_item home" href="index.php">Home</a>
            <span class="breadcrumbs_delimiter"></span>
            <span class="breadcrumbs_item current">Tax Cuts & Jobs Act</span>
        </div>
        <h1 class="page_title">Tax Cuts and Jobs Act</h1>
    </div>
</div>

<?php
$listArray = array();
$categoryContent = array();

if (!empty($taxcutslist)) {
    foreach ($taxcutslist as $key => $value) {

        if (!in_array($value->id, $listid)) {


            $categoryName = $value->Taxcutscategories->name;
            if (!in_array($value->Taxcutscategories->name, $categoryContent)) {
                $categoryContent[$value->Taxcutscategories->name] = $value->Taxcutscategories->contents;
            }


            if (!in_array($categoryName, $category)) {
                $category[] = $categoryName;
                $listArray[$categoryName][$key]['title'] = $value->title;
                $listArray[$categoryName][$key]['page_slug'] = $value->page_slug;
                $listArray[$categoryName][$key]['contents'] = $value->contents;
                $listArray[$categoryName][$key]['category_name'] = $value->Taxcutscategories->name;
                $listArray[$categoryName][$key]['category_contents'] = $value->Taxcutscategories->contents;
            } else {
                $listArray[$categoryName][$key]['title'] = $value->title;
                $listArray[$categoryName][$key]['page_slug'] = $value->page_slug;
                $listArray[$categoryName][$key]['contents'] = $value->contents;
                $listArray[$categoryName][$key]['category_name'] = $value->Taxcutscategories->name;
                $listArray[$categoryName][$key]['category_contents'] = $value->Taxcutscategories->contents;
            }
        }
    }
}

?>

<div class="page_content_wrap padding_top_middle padding_bottom_middle">
    <div class="align-items-start content_wrap d-flex flex-wrap justify-spacebetween">
        <div class="content">
            <div>
                <section class="margin_bottom_mini">
<!--                    <img alt="Ten Facts You Might Not Know About Stamp Duty" src="images/750x422.png" class="margin_bottom_mini">-->
                    <h3 class="info-text">The Tax Cuts and Jobs Act</h3>
                    <?php echo $defaultContent; ?>
                </section>
                <section class="grey_section margin_bottom_small padding_bottom_mini padding_left_mini padding_right_mini padding_top_mini">
                    <p class="margin_bottom_mini text-center">KEY PROVISIONS OF THE TAX CUTS AND JOBS ACT</p>
                    <ul class="job-act-list center-block text-center">
                        <?php if(!empty($category)) {
                            for($i=0;$i<count($category);$i++){
                            ?>
                        <li class="sc_highlight sc_highlight_style_3"><a href="#dv<?php echo str_replace(' ', '', strtolower($category[$i]));?>" class="font-size-16"><?php echo $category[$i]; ?></a></li>
                        <?php } } ?>
                        
                    </ul>
                </section>

<?php
if (!empty($listArray)) {
    foreach ($listArray as $key => $value) {

        if (in_array($key, $category)) {
            ?>
                <section id="dv<?php echo str_replace(' ', '', strtolower($key)); ?>" class="grey_section margin_bottom_small padding_bottom_mini padding_left_mini padding_right_mini padding_top_mini">
                                <p class="info-text"><?php echo $key; ?></p>
                                <p class="margin_bottom_mini"><?php echo isset($categoryContent[$key]) ? $categoryContent[$key] : "" ?></p>
            <?php
            if (!empty($value)) {
                foreach ($value as $list) {
                    ?>
                                        <div class="margin_bottom_mini padding_bottom_mini padding_left_mini padding_right_mini padding_top_mini white_section">
                                            <h5>
                                                <a href="tax-cuts-and-jobs-act-details.php?id=<?php echo $list['page_slug']; ?>"><?php echo $list['title']; ?></a>
                                            </h5>
                                            <p><?php echo substr(strip_tags($list['contents']), 2, 250); ?></p>
                                            <p>
                                                <a href="tax-cuts-and-jobs-act-details.php?id=<?php echo $list['page_slug']; ?>">Read More »</a>
                                            </p>
                                        </div>

                    <?php
                }
            }
            ?>
                            </section>
                            <?php } ?>

                        <?php
                    }
                }
                ?>
            </div>
        </div>
        <div class="sidebar widget_area bg_tint_light sidebar_style_light" role="complementary">
            <aside class="widget widget_categories new news-subscribe-sidebar">
                <h5 class="widget_title text-center">Subscribe to our Newsletter</h5>
                <form id="frmsubscription" name="frmsubscription" method="POST" action="#">
                    <div class="label_over margin_bottom_small">
                        <input type="text" name="first_name" id="first_name" placeholder="First Name *" required>
                    </div>
                    <div class="label_over margin_bottom_small">
                        <input type="text" name="last_name" id="last_name" placeholder="Last Name *" required>
                    </div>
                    <div class="label_over margin_bottom_small">
                        <input type="email" id="subemail" name="subemail" placeholder="Email *" required>
                    </div>


                    <div class="squareButton sc_button_size sc_button_style_global global">
                        <button type="submit" id="submitnsubscription" name="subscribe_submit" class="" >Submit</button>
                    </div>
                </form>
            </aside>
        </div>
    </div>
</div>


<!-- Ajax loader-->
<div class="overlay" style="display: none;">
</div>
<div class="loadingLoader" style="display: none;">
    <img src="images/loader.gif">
</div>
<!-- End Ajax loader-->
<?php require_once('footer.php'); ?>  

<script type='text/javascript'>


    $(document).ready(function () {
        $(document).on('click', '.job-act-list a', function () {
            $('html,body').animate({
                scrollTop: $($(this).attr('href')).offset().top - $('.top_panel_fixed .top_panel_wrap').outerHeight()
            }, 500);
        });

    });
</script>