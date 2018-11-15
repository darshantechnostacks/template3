<?php
require_once('header.php');

//get inactive details
$requtaxdue = array();
$requtaxdue = array(
    'conditions' => ['Utaxduedates.is_deleted' => 0, 'Utaxduedates.websiteId' => WEBSITE_ID ],
    'contain' => [],
    'fields' => array(),
    'select' => array(),
    'get' => 'all',
    'order' => array('Utaxduedates.id' => 'desc'),
);

$resultUtaxdue = $curl->send_api($requtaxdue, 'Utaxduedates/index');
$listid = array();
if(!empty($resultUtaxdue) && $resultUtaxdue->Utaxduedates){
    foreach ($resultUtaxdue->Utaxduedates as $key => $value){
     $listid[] =   $value->taxduedate_id;
    }
}

//get Tax Due Dates
$reqtaxdue = array();
$reqtaxdue = array(
    'conditions' => ['Taxduedates.is_deleted' => 0, 'Taxduedates.status' => 1, 'Taxduedates.due_date >' => date('Y-m-d')],
    'contain' => ['taxduedatescategories'],
    'fields' => array(),
    'select' => array(),
    'get' => 'all',
    'order' => array('Taxduedates.due_date' => 'asc'),
        //'group'=>['MONTH(Taxduedates.due_date)'],
);

$resultTaxdue = $curl->send_api($reqtaxdue, 'Taxduedates/index');

//initlization
$taxduedateslist = array();
if (!empty($resultTaxdue) && ($resultTaxdue->code == 200) && $resultTaxdue->Taxduedates) {
    $taxduedateslist = $resultTaxdue->Taxduedates;
} else {
    $taxduedateslist = array();
}
$month = array();
?>
<header id="loadHeader" class="top_panel_wrap bg_tint_light" data-active="Tax Due Dates"></header>
<div class="page_top_wrap page_top_title page_top_breadcrumbs" style="background:url(<?php echo API_URL; ?>geturl/uploads/feature_photo/taxduedates_default.png) no-repeat 59% 49%;max-height: 250px;background-size: cover;">
    <div class="content_wrap">
        <div class="breadcrumbs">
            <a class="breadcrumbs_item home" href="index.php">Home</a>
            <span class="breadcrumbs_delimiter"></span>
            <span class="breadcrumbs_item current">Tax Due Dates</span>
        </div>
        <h1 class="page_title">Tax Due Dates</h1>
    </div>
</div>
<div class="container padding_bottom_small padding_top_small">


    <?php
    $listArray = array();
    if (!empty($taxduedateslist)) {
        foreach ($taxduedateslist as $key => $value) {

            if(!in_array($value->id, $listid)){
            $monthName = date('F', strtotime($value->due_date));

            if (!in_array($monthName, $month)) {
                $month[] = $monthName;
                $listArray[$monthName][$key]['due_date'] = $value->due_date;
                $listArray[$monthName][$key]['category_name'] = $value->Taxduedatescategories->category_name;
                $listArray[$monthName][$key]['contents'] = $value->contents;
            } else {
                $listArray[$monthName][$key]['due_date'] = $value->due_date;
                $listArray[$monthName][$key]['category_name'] = $value->Taxduedatescategories->category_name;
                $listArray[$monthName][$key]['contents'] = $value->contents;
            }
        }
        }
        
        
        ?>



    <?php
    }
    if (!empty($listArray)) {
        foreach ($listArray as $key => $value) {
            
            if (in_array($key, $month)) {
                ?>
                <h4 class="fig_border sc_align_left sc_title"><?php echo $key; ?></h4>    
                <?php
                if(!empty($value)){
                    foreach($value as $list){
                        ?>
                <h5><?php echo date('F d',strtotime($list['due_date'])); ?></h5>
                <p class="text-justify margin_bottom_mini"><?php echo  '<strong>'.$list['category_name'].' - </strong>'. str_replace('<p>','',$list['contents']); ?> </p>
                        
                    <?php }
                }
                
                ?>
            <?php } ?>
           
    <?php }
}
?>





</div>
<div id="loadFooter"></div>
<div class="overlay" style="display: none;"></div>
<div class="loadingLoader" style="display: none;">
    <img src="images/loader.gif">
</div>

<?php require_once('footer.php'); ?>   





