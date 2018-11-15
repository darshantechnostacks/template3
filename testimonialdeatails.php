<?php 
	require_once('header.php');

	//p($testimonals);
	/*********  End get pages *********/
	
?>
	<div class="page_top_wrap page_top_title page_top_breadcrumbs">
		<div class="content_wrap">
			<div class="breadcrumbs">
				<a class="breadcrumbs_item home" href="index.php">Home</a>
				<span class="breadcrumbs_delimiter"></span>
				<span class="breadcrumbs_item current"><?php echo $testimonals[0]->name;?></span>
			</div>
			<h1 class="page_title"><?php echo $testimonals[0]->name;?></h1>
		</div>
	</div>
	<div class="page_content_wrap">
		<section class="custom_columns">
			<div class="container">
				<div class="row">
					<div class="content_wrap">
						<div class="columns_wrap sc_columns">
                                                    <?php if (isset($testimonals)&& !empty($testimonals)){ ?>
                                                    <?php if(isset($testimonals[0]->photo) && !empty($testimonals[0]->photo)){ ?>
                                                     <img alt="<?php echo $testimonals[0]->name; ?>" src="<?php echo API_URL ?>geturl/uploads/photo/<?php echo $testimonals[0]->photo; ?>">
                                                    <?php } ?>
                                                     <h2><?php echo $testimonals[0]->name;?></h2>
														<?php echo $testimonals[0]->description;?>
                                                    <?php }else{ ?>
                                                     <h2>No data found.</h2>
                                                    <?php } ?>
						</div>
					</div>	
				</div>
			</div>		
		</section>
	</div>
<?php require_once('footer.php');?>				
			