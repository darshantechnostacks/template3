<?php
require_once('header.php');

//get inactive details
$requtaxdue = array();
$requtaxdue = array(
    'conditions' => ['Utaxduedates.is_deleted' => 0, 'Utaxduedates.websiteId' => WEBSITE_ID],
    'contain' => [],
    'fields' => array(),
    'select' => array(),
    'get' => 'all',
    'order' => array('Utaxduedates.id' => 'desc'),
);

$resultUtaxdue = $curl->send_api($requtaxdue, 'Utaxduedates/index');
$listid = array();
if (!empty($resultUtaxdue) && $resultUtaxdue->Utaxduedates) {
    foreach ($resultUtaxdue->Utaxduedates as $key => $value) {
        $listid[] = $value->taxduedate_id;
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
$image = FEATURE_PHOTO . 'taxduedates_default.png';
?>
<div class="sub-page-banner mb3">
    <div class="banner-img">
        <img src="<?= $image ?>" class="img-responsive"/>
    </div>
    <div class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Tax Due Dates</h2>
                    <h4>We love what we do and we’re good at it!</h4>
                </div>
            </div>
        </div>
    </div>
    <ul class="top-contact-info">
        <li><i class="icon-mobile"></i><?= isset($homePages->firm_phone) ? $homePages->firm_phone : "" ?></li>
        <li><i class="icon-mobile"></i> <a
                    href="mailtto:<?= isset($homePages->firm_email) ? $homePages->firm_email : "" ?>"><?= isset($homePages->firm_email) ? $homePages->firm_email : "" ?></a>
        </li>
    </ul>
</div>
<?php
$listArray = array();
if (!empty($taxduedateslist)) {
    foreach ($taxduedateslist as $key => $value) {

        if (!in_array($value->id, $listid)) {
            $monthName = date('F Y', strtotime($value->due_date));
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
            <div class="container">
                <div class="row">
                    <div class="panel-heading tax-head">
                        <h4><?= $key ?></h4>
                    </div>
                    <div class="panel-body">
                        <?php
                        if (!empty($value)) {
                            foreach ($value as $list) {
                                ?>
                                <div class="col-sm-3"><h5><?= date('F d', strtotime($list['due_date'])); ?></h5></div>
                                <div class="col-sm-9">
                                    <p class="text-justify"><?= '<strong>' . $list['category_name'] . ' - </strong>' . str_replace('<p>', '', $list['contents']); ?> </p>
                                </div>
                            <?php }
                        }
                        ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    <?php }
}
?>
<?php require_once('footer.php'); ?>   





