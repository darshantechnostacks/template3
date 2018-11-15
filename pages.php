<?php 
	require_once('header.php');

	$curl = new CURL();
	
	/********** Get pages ******/
	$row['slug'] = $_GET['slug'];
	$row['websiteId'] = WEBSITE_ID;

	$result = $curl->send_api($row,'Upages/getPageById');
	
	$page = array();
	
	if($result->code == 200)
	{
		$page = $result->Upages;
	}
	/*********  End get pages *********/
	if($page->edit_status == 0)
	{
		$page_content = $page->apage->page_content;	
	}
	else
	{
		$page_content = $page->page_content;	
	}
?>
	<div class="page_top_wrap page_top_title page_top_breadcrumbs">
		<div class="content_wrap">
			<div class="breadcrumbs">
				<a class="breadcrumbs_item home" href="index.php">Home</a>
				<span class="breadcrumbs_delimiter"></span>
				<span class="breadcrumbs_item current"><?php echo $page->title;?></span>
			</div>
			<h1 class="page_title"><?php echo $page->title;?></h1>
		</div>
	</div>
	<div class="page_content_wrap">
		<section class="custom_columns">
			<div class="container">
				<div class="row">
					<div class="content_wrap">
						<div class="columns_wrap sc_columns">
							<?php echo $page_content;?>
						</div>
					</div>	
				</div>
			</div>		
		</section>
	</div>
<?php require_once('footer.php');?>				
			