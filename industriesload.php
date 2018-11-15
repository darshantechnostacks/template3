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
    $messg .= '<div class="columns_wrap sc_columns" data-animation="animated fadeInUp normal" style="margin-top:25px;">';
    foreach ($resultDet as $key => $value) {


        $messg .= '<div class="column-1_4 sc_column_item">
                                    <div class="sc_column_item_inner">
                                        <div class="sc_section">';
        if ($value->isedit == 1) {
            $messg .= '<h5 class="sc_title sc_align_left">' . substr(trim($value->title), 0, 15) . '</h5>';
            //substr(trim($value->page_content), 0, 250);
             $details = str_replace("{company_name}", $homePages->firm_name, substr(trim($value->page_content), 0, 250));
            $messg .= '<a href="industriesdetails.php?slug='.$value->page_slug.'" class="sc_button button-hover sc_button_square sc_button_style_clear sc_button_bg_link sc_button_size_mini  sc_button_iconed inherit" data-text="Learn more">Learn more</a>';
        } else {
              $messg .= '<h5 class="sc_title sc_align_left">' . substr(trim($value->Industries->title), 0, 15) . '</h5>';
           // substr(trim($value->Industries->industriecontents[$set_no-1]->contents), 0, 250);
            $details = str_replace("{company_name}", $homePages->firm_name, substr(trim($value->Industries->industriecontents[$set_no-1]->contents), 0, 250));
            $messg .= '<a href="industriesdetails.php?slug='.$value->page_slug.'" class="sc_button button-hover sc_button_square sc_button_style_clear sc_button_bg_link sc_button_size_mini  sc_button_iconed inherit" data-text="Learn more">Learn more</a>';
        }

        $messg.='</div>
                                    </div>
                                </div>';
    }
    $messg .= '</div>';
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
