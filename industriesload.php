<?php

require_once('config.php');
$last_id = (isset($_POST['lastid'])) ? $_POST['lastid'] : 0;

$request = array(
    'conditions' => ['Uindustries.is_deleted' => 0, 'Uindustries.websiteId' => WEBSITE_ID, 'Uindustries.is_setting' => 0],
    'contain' => ['industries', 'industries.industriecontents'],
    'fields' => array(),
    'select' => array(),
    'get' => 'all',
    'order' => array('Uindustries.id' => 'desc'),
    "limit" => 4,
    "offset" => $last_id,
);

$resultlist = (array) $curl->send_api($request, 'Uindustries/index');

$messg = '';
$lastid = '';
$resultDet = array();
$resultDet = !empty($resultlist['Uindustries']) ? $resultlist['Uindustries'] : '';

$totpost = count($resultDet);
$data = array();

if (!empty($resultDet)) {
 
    foreach ($resultDet as $key => $value) {
        $messg .= '<div class="col-md-4 col-sm-6 mb2">
                                    <div class="inner-box clearfix">
                                        <div class="icon-block">
                                        <i class=" icon mb-3"><img src="img/services-icon.png" class="img-responsive" /></i>
                                        </div>
                    <div class="content">
                        <div class="title-block">';
        if ($value->isedit == 1) {
            $messg .= '<h2 class="title">' . substr(trim($value->title), 0, 15) . '</h2> </div>';
            //substr(trim($value->page_content), 0, 250);
            
        $messg.='<p class="mb1">';     $details = str_replace("{company_name}", $homePages->firm_name, substr(trim($value->page_content), 0, 250));
        $messg.='</p">';
            $messg .= '<a href="industriesdetails.php?slug='.$value->page_slug.'" class="btn-link font-regular font-13" data-text="Learn more">Read More >></a>';
        } else {
              $messg .= '<h2 class="title">' . substr(trim($value->Industries->title), 0, 15) . '</h2>';
           // substr(trim($value->Industries->industriecontents[$set_no-1]->contents), 0, 250);
          $messg .= '<p class="mb1">';  
          $details = str_replace("{company_name}", $homePages->firm_name, substr(trim($value->Industries->industriecontents[$set_no-1]->contents), 0, 250));
          $messg .= '</p>';
            $messg .= '<a href="industriesdetails.php?slug='.$value->page_slug.'" class="btn-link font-regular font-13" data-text="Learn more">Read More >></a>';
        }

        $messg.='</div>
                                    </div>
                                </div>';
    }
    
}
if (!empty($resultDet)) {
    $messg .='<br/><div class="clearfix"></div>';
} else {
    $messg = '<div>No Record Found</div>';
}

$data['message'] = $messg;

$data['last_id'] = $totpost;
echo json_encode($data);
exit;
?>		
