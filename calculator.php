<?php
require_once('header.php');
?>
<div class="clearfix"></div>
    <div class="sub-page-banner mb3">
        <div class="banner-img">
            <img src="img/financial-calculator-banner.png" class="img-responsive" />
        </div>
        <div class="page-title">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2>CALCULATOR</h2>
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
            <div class="our-team animated fadeInUp">
                    <div class="row">
                    <?php
                        if(isset($_GET['slug']) && file_exists('calculator/'.$_GET['slug'].'.php'))
                        {
                            require_once('calculator/'.$_GET['slug'].'.php');
                        } else {
                            echo "<h3>No Record Found</h3>";
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>	
</div>
<?php require_once('footer.php'); ?>