<?php
require_once('header.php');
?>
<div class="clearfix"></div>
    <div class="page_top_wrap page_top_title page_top_breadcrumbs">
        <div class="content_wrap">
            <div class="breadcrumbs">
                <a class="breadcrumbs_item home" href="index.html">Home</a>
                <span class="breadcrumbs_delimiter"></span>
                <span class="breadcrumbs_item current">Calculator</span>
            </div>
            <h1 class="page_title"> Calculator</h1> 
            <!-- <h1 class="page_title"><?php echo $_GET['name']; ?></h1> -->
        </div>
    </div>
    <div class="container">
        <div class="row">
                <div class="our-team animated fadeInUp">
                        <div class="row">
                        <?php 
                            if(isset($_GET['slug']))
                            {
                                require_once('calculator/'.$_GET['slug'].'.php'); 
                            }
                        ?>
                    </div>
                </div>
        </div>
    </div>	
</div>
<?php require_once('footer.php'); ?>