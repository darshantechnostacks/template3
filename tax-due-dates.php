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
<div class="sub-page-banner">
    <div class="banner-img">
        <img src="<?php echo API_URL; ?>geturl/uploads/feature_photo/taxduedates_default.png" class="img-responsive" style="max-height: 250px;background-size: cover;width: 100%; " />
    </div>
    <div class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Tax Due Dates</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container" style="margin-top:50px;">


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
                <h3 ><?php echo $key; ?></h3>    
                <?php
                if(!empty($value)){
                    foreach($value as $list){
                        ?>
                <h5><?php echo date('F d',strtotime($list['due_date'])); ?></h5>
                <div class="font-16"><?php echo  '<strong>'.$list['category_name'].' - </strong>'. str_replace('<p>','',$list['contents']); ?> </div>
                        
                    <?php }
                }
                
                ?>
            <?php } ?>
           
    <?php }
}
?>
<br/><br/>
</div>

<?php require_once('footer.php'); ?>   





