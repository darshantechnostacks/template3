<?php
require_once('header.php');

$id = isset($_GET['id']) ? $_GET['id'] : '';

/** Get Team******* */
$our_team_data = array();
$our_team_data = array(
    'conditions' => ['is_deleted' => 0, 'websiteId' => WEBSITE_ID, 'status' => 1, 'team_type' => 'team', 'id' => $id],
    'contain' => [],
    'fields' => array(),
    'select' => array(),
    'get' => 'all',
    'order' => array('id' => 'desc'),
    'limit' => '1'
);

$our_team_datas = $curl->send_api($our_team_data, 'Uteams/indexAll');
$our_teams = array();
$cnt = 0;
if (!empty($our_team_datas)) {
    if ($our_team_datas->code == 200) {
        $our_teams = $our_team_datas->Uteams;
        $cnt = count($our_teams);
        if ($cnt == 1) {
            $our_teams = $our_team_datas->Uteams[0];
        }
    }
}
//p($our_teams);
/** End Team******* */
$coverImageUrl = "img/financial-calculator-banner.png";
?>
<link href="css/ourteam.css" rel="stylesheet"/>

<div class="sub-page-banner mb3">
    <div class="banner-img">
        <img src="<?= $coverImageUrl ?>" class="img-responsive"/>
    </div>
    <div class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>OUR TEAMS</h2>
                </div>
            </div>
        </div>
    </div>
    <ul class="top-contact-info">
        <li><i class="icon-mobile"></i><?= isset($homePages->firm_phone) ? $homePages->firm_phone : "" ?></li>
        <li><i class="icon-email"></i> <a
                    href="mailtto:<?= isset($homePages->firm_email) ? $homePages->firm_email : "" ?>"><?= isset($homePages->firm_email) ? $homePages->firm_email : "" ?></a>
        </li>
    </ul>
</div>

<div class="container">
    <div class="row">
        <div class="content_wrap" style="border: none;margin-bottom:50px;">
            <div class="container">
                <center><h2>OUR TEAM MEMBERS</h2></center>
            </div>
            <div class="our-team animated fadeInUp">
                <div class="container">
                    <div class="row">
                        <?php
                        if (!empty($our_teams)) {
                            $image = isset($our_teams->photo) ? PHOTO_URL . $our_teams->photo : '';
                            $name = isset($our_teams->name) ? $our_teams->name : '';
                            $designation = isset($our_teams->designation) ? $our_teams->designation : '';
                            $note = isset($our_teams->personal_notes) ? $our_teams->personal_notes : '';
                            ?>
                            <div class="container mt4 mb4">
                                <div class="col-sm-4 col-xs-12">
                                    <img src="<?= $image ?>" alt="<?= $name ?>"
                                         class="img-circle img-responsive team-mate-image"/>
                                </div>
                                <div class="col-sm-8 col-xs-12">
                                    <h2 class="font-medium"><?= $name ?></h2>
                                    <label class="font-16 font-light mb1"><?= $designation ?></label>
                                    <div class="mb1">
                                        <h3 class="font-18 font-medium text-uppercase">Education</h3>
                                        <p class="font-16 font-light"><?= !empty($our_teams->name_of_college) ? $our_teams->name_of_college : "" ?>
                                            - <?= !empty($our_teams->degree) ? $our_teams->degree : "" ?></p>
                                    </div>
                                    <div class="mb1">
                                        <h3 class="font-18 font-medium text-uppercase">Professional Membership</h3>
                                        <p class="font-16 font-light"><?= !empty($our_teams->professional_membership_label) ? $our_teams->professional_membership_label : "" ?>
                                            - <?= !empty($our_teams->professional_membership) ? $our_teams->professional_membership : "" ?></p>
                                    </div>

                                    <div class="mb1">
                                        <h3 class="font-18 font-medium text-uppercase">Industries Experties</h3>
                                        <p class="font-16 font-light"><?= !empty($our_teams->industry_expertise_label) ? $our_teams->industry_expertise_label : "" ?> </p>
                                    </div>
                                    <div class="mb1">
                                        <h3 class="font-18 font-medium text-uppercase">Community</h3>
                                        <p class="font-16 font-light">Current</p>
                                        <ul class="list-style-checkmark mb1">
                                            <li class="font-medium"><?= !empty($our_teams->community_label) ? $our_teams->community_label : "" ?> </li>
                                        </ul>
                                    </div>
                                    <div class="mb2">
                                        <h3 class="font-18 font-medium text-uppercase">Number of years experience</h3>
                                        <p class="font-16 font-light"><?= !empty($our_teams->number_of_experience) ? $our_teams->number_of_experience : "" ?>
                                            Years</p>
                                    </div>
                                    <div class="mb2">
                                        <h3 class="font-18 font-medium text-uppercase"></h3>
                                        <div class="font-16 font-light"><?= !empty($our_teams->personal_notes) ? $our_teams->personal_notes : "" ?></div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        } else {
                            ?>
                            <h3>No record found.</h3>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
