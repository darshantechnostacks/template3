<?php

require_once('config.php');
$last_id = (isset($_POST['lastid'])) ? $_POST['lastid'] : 0;

$request = array(
    'conditions' => ['Unewsletters.is_deleted' => 0, 'Unewsletters.websiteId' => WEBSITE_ID,'Unewsletters.is_setting' =>0 ],
    'contain' => ['newsletters'],
    'fields' => array(),
    'select' => array(),
    'get' => 'all',
    'order' => array('Unewsletters.id' => 'desc'),
    "limit"=>3, 
    "offset"=>$last_id,
);

$newsletterAlllist = (array) $curl->send_api($request, 'Unewsletters/index');

$messg = '';
$lastid = '';
$newsletterDet = array();
$newsletterDet = !empty($newsletterAlllist['Unewsletters']) ? $newsletterAlllist['Unewsletters'] : '';

$totpost = count($newsletterDet);
$data = array();

if (!empty($newsletterDet)) {
    foreach ($newsletterDet as $key => $value) {
        

$messg .= '<div class="column-3 margin_top_small" style="margin-top:30px !important;"> 
                                <div class="sc_team_item sc_team_item_1 odd first">
                                    <div class="sc_team_item_info">
                                        <h4 class="sc_team_item_title">';
                                            if($value->isedit ==1){ 
                                            $messg .= '<a href="newsletterdetails.php?slug='.trim($value->slug). '" title="'. $value->title.'">'. $value->title.'</a>';
                                             }else{ 
                                            $messg .= '<a href="newsletterdetails.php?slug='.trim($value->Newsletters->slug).'" title="'. $value->Newsletters->title.'">'. $value->Newsletters->title.'</a>';
                                             } 
                                        $messg .= '</h4>';

  if($value->isedit ==1){ 
 $messg .= '<div class="sc_team_item_description">'. substr($value->content,0,250).' 
                                        </div>';
  }else{ 
$messg .= '<div class="sc_team_item_description">'. substr($value->Newsletters->content,0,250).'
                                        </div>';
 } 
                                        
                                        $messg .= '<div class="readmore round">';
                                              if($value->isedit ==1){ 
                                            $messg .= '<a href="newsletterdetails.php?slug='.  trim($value->slug).' " >Read More</a><i class="fa fa-long-arrow-right arrow"></i>';
                                            }else{
                                              $messg .= '<a href="newsletterdetails.php?slug='.trim($value->Newsletters->slug).'" >Read More</a><i class="fa fa-long-arrow-right arrow"></i>';
                                             } 
                                        $messg .= '</div>
                                    </div>
                                </div>
                            </div>';

      
    }
    
}
if (!empty($newsletterDet)) {
$messg .='<br/><div class="clearfix"></div>';
}else{
    $messg ='<div>No Record Found</div>';
}

$data['message'] = $messg;

$data['last_id'] = $totpost;
echo json_encode($data);
exit;
?>		
