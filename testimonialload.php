<?php

require_once('config.php');

$testimoniallist['lastid'] = ($_POST['lastid']);
$testimoniallist['websiteId'] = WEBSITE_ID;

$testimonialAlllist = (array)$curl->send_api($testimoniallist, 'Utestimonials/loadTestimonials');

$messg = '';
$lastid = '';
$testimonialDet = array();
$testimonialDet = !empty($testimonialAlllist['Utestimonials']) ? $testimonialAlllist['Utestimonials'] : '';

$totpost = count($testimonialDet);
$data = array();
$i = 4;
if (!empty($testimonialDet)) {
    foreach ($testimonialDet as $key => $value) {


        $messg .= '<div class="d-flex margin_bottom_small testimonial-container xs-flex-column">
                    <div class="clearfix">
                        <div class="row">
                            <div class="col-sm-4">
                    <div class="align-items-center d-flex flex-shrink-0">';
        $avtar = !empty($value->photo) && isset($value->photo) ? $value->photo : "default.png";

        $messg .= '<img class="person-pic" src="' . API_URL . 'geturl/uploads/photo/' . $avtar .
            '" alt="" style="width:200px;height: auto;" /> 
                    </div>
                    </div>
                            </div>
                            ';
        $messg .= '<div class="col-sm-8"><div class="d-flex flex-column flex-grow-1 padding_bottom_mini padding_left_mini padding_right_mini padding_top_mini">
                        <div class="feedback justify-content-center d-flex flex-column flex-grow-1">
                            <blockquote class="margin_bottom_small margin_top_small">';

        if ($value->type == 0) {

            //$messg .= str_replace('<p>', '', $value->description);
            $messg .= str_replace("{company_name}", $homePages->firm_name, ($value->description));
        } else {

            $messg .= '<iframe src="' . $value->video . '" frameborder="0"
                                            allowfullscreen="" style="width:350px;min-height: 250px;height: 250px;"></iframe>';
        }
        $messg .= '</blockquote>
                            <div class="center-block user-rating" data-rate="' . $value->ratings . '"></div>
                        </div>
                        <div class="flex-shrink-0 person-name text-center text-muted"><i class="">';

        $messg .= '<strong>
                                    ' . $value->name . ',</strong> ' . $value->designation . '</i>
                            <p><i>' . $value->firm_name . ' , ' . isset($value->Cities->city) ? $value->Cities->city : ''
        . ' , ' . isset($value->States->state_name) ? $value->States->state_name : '' . '</i></p>
                        </div>
                    </div>
                    </div>
                        </div>
                    </div>
                </div>';


        $i++;
    }
}


if (!empty($testimonialDet)) {
    $messg .= '<br/><div class="clearfix"></div>';
} else {
    $messg .= '';
}
$data['message'] = $messg;
$data['last_id'] = $totpost;

echo json_encode($data);
exit;
?>

