<?php require_once ('header.php');
$id = isset($_GET['id']) && !empty($_GET['id']) ?$_GET['id']:"";
/* * ***Get Team******** */
$our_team_data = array();
$our_team_data = array(
    'conditions' => ['is_deleted' => 0, 'websiteId' => WEBSITE_ID, 'status' => 1,'team_type'=>'partner','id'=>$id],
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
if (!empty($our_team_datas->Uteams)) {
    if ($our_team_datas->code == 200 && !empty($our_team_datas->Uteams)) {
        $our_teams = $our_team_datas->Uteams[0];
        $cnt = count($our_teams);
    }
}

/* * ***End Team******** */


?>

<div class="page_top_wrap page_top_title page_top_breadcrumbs" style="margin-bottom: 50px;">
        <div class="content_wrap">
            <div class="breadcrumbs">
                <a class="breadcrumbs_item home" href="index.php">Home</a>
                <span class="breadcrumbs_delimiter"></span>
                <a class="breadcrumbs_item home" href="our-proprietor.php">Our Proprietor</a>
                <span class="breadcrumbs_delimiter"></span>
                <span class="breadcrumbs_item current">Our Proprietor Details</span>
            </div>
            <h1 class="page_title">Our Proprietor Details</h1>
        </div>
    </div>
    <div class="container mt4 mb4">
        <?php if (!empty($our_team_datas->Uteams)) { ?>
        <div class="col-sm-4 col-xs-12">
            <img src="<?php echo API_URL ?>geturl/uploads/photo/<?php echo !empty($our_teams->photo)?$our_teams->photo:""; ?>" alt="Team mate" class="img-circle img-responsive team-mate-image" />
        </div>
        <div class="col-sm-8 col-xs-12">
            <h2 class="font-medium"><?php echo !empty($our_teams->name)?$our_teams->name:"" ?></h2>
            <label class="font-16 font-light mb1"><?php echo !empty($our_teams->designation)?$our_teams->designation:"" ?></label>
            <div class="mb1">
                <h5 class="font-18 font-medium text-uppercase">Education</h5>
                <p class="font-16 font-light"><?php echo !empty($our_teams->name_of_college)?$our_teams->name_of_college:""  ?> - <?php echo !empty($our_teams->degree)?$our_teams->degree:""  ?></p>
                
            </div>
            <div class="mb1">
                <h5 class="font-18 font-medium text-uppercase">Professional Membership</h5>
                <p class="font-16 font-light"><?php echo !empty($our_teams->professional_membership_label)?$our_teams->professional_membership_label:""  ?> - <?php echo !empty($our_teams->professional_membership)?$our_teams->professional_membership:""  ?></p>
            </div>

            <div class="mb1">
                <h5 class="font-18 font-medium text-uppercase">Industries Experties</h5>
                <p class="font-16 font-light"><?php echo !empty($our_teams->industry_expertise_label)?$our_teams->industry_expertise_label:""  ?> </p>
               
            </div>
            <div class="mb1">
                <h5 class="font-18 font-medium text-uppercase">Community</h5>
                <p class="font-16 font-light">Current</p>
                <ul class="list-style-checkmark mb1">
                    <li class="font-medium"><?php echo !empty($our_teams->community_label)?$our_teams->community_label:""  ?> </li>
                </ul>

            </div>
            <div class="mb2">
                <h5 class="font-18 font-medium text-uppercase">Number of years experience</h5>
                <p class="font-16 font-light"><?php echo !empty($our_teams->number_of_experience)?$our_teams->number_of_experience:""  ?> Years</p>
            </div>
            
             <div class="mb2">
                <h5 class="font-18 font-medium text-uppercase"></h5>
                <div class="font-16 font-light"><?php echo !empty($our_teams->personal_notes)?$our_teams->personal_notes:""  ?></div>
            </div>
        </div>
        <?php }else{ ?>
        <h3>No record found.</h3>
        <?php }?>
    </div>

  <?php require_once ('footer.php'); ?>