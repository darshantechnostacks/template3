<?php
require_once('header.php');

/* * ***Get Team******** */
$our_team_data = array();
$our_team_data = array(
    'conditions' => ['is_deleted' => 0, 'websiteId' => WEBSITE_ID, 'status' => 1,'team_type'=>'partner'],
    'contain' => [],
    'fields' => array(),
    'select' => array(),
    'get' => 'all',
    'order' => array('id' => 'desc'),
    //'limit' => '1'
);

$our_team_datas = $curl->send_api($our_team_data, 'Uteams/indexAll');
$our_teams = array();
$cnt = 0;
if (!empty($our_team_datas)) {
    if ($our_team_datas->code == 200) {
        $our_teams = $our_team_datas->Uteams;
         $cnt = count($our_teams);
         if($cnt == 1){
             $our_teams = $our_team_datas->Uteams[0];
         }
    }
}
/* * ***End Team******** */

?>
<link href="css/ourteam.css" rel="stylesheet" />

<div class="page_top_wrap page_top_title page_top_breadcrumbs" style="margin-bottom: 50px;">
        <div class="content_wrap">
            <div class="breadcrumbs">
                <a class="breadcrumbs_item home" href="index.php">Home</a>
                <span class="breadcrumbs_delimiter"></span>
                <span class="breadcrumbs_item current">Our Proprietor</span>
            </div>
            <h1 class="page_title">Our Proprietor</h1>
        </div>
    </div>

        <div class="container">
            <div class="row">
                <div class="content_wrap" style="border: none;margin-bottom:50px;">
                    <div class="container">
                        <center>  <h2>Our Proprietor</h2></center>
                    </div>


                    <div class="our-team animated fadeInUp">
                        <div class="container">
                            <div class="row">
                                <?php
                                if (!empty($our_teams)) {
                                    if($cnt>1){
                                    foreach ($our_teams as $key => $value) {
                                        
                                        ?>
                                <a href="our-proprietor-details.php?id=<?php echo $value->id; ?>">
                                        <div class="column">
                                            <div class="card">
                                                <img src="<?php echo API_URL ?>geturl/uploads/photo/<?php echo $value->photo; ?>" alt="Jane" style="width:100%">
                                                    <h2><?php echo $value->name; ?></h2>
                                                    <p class="title"><?php echo $value->designation; ?></p>
                                                    <p><?php echo substr($value->personal_notes,0,80); ?></p>
                                            </div>
                                        </div> 
                                </a>
                                    <?php
                                    }
                                    }else{ ?>
                                        <div class="container mt4 mb4">
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
    </div>
                                    <?php }
                                }else{ ?>
                                     <h3>No record found.</h3>
                                <?php } ?>
                            </div>
                        </div>
                    </div>


                </div>	
            </div>
        </div>		
    </section>
    <br/>
    <br/>
</div>
<?php require_once('footer.php'); ?>				
