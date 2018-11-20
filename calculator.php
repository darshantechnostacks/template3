<?php
require_once('header.php');
?>
<div class="clearfix"></div>
    <div class="sub-page-banner mb4">
        <div class="banner-img">
            <img src="img/retirement-banner.png" class="img-responsive" />
        </div>
        <div class="page-title text-center">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Calculator</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="about-section mb1">
    <div class="container">
        <div class="row">
                <div class="col-md-12">
                       
                        <?php 
                            if(isset($_GET['slug']) && file_exists('calculator/'.$_GET['slug'].'.php'))
                            {


                                require_once('calculator/'.$_GET['slug'].'.php'); 

                            }else{?>

                            <center><h2>No record found.</h2></center>
                            <?php }
                        ?>
                    
                </div>
        </div>
    </div>	
</div>
</div>
<?php require_once('footer.php'); ?>