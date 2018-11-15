<?php
require_once('header.php');
$curl = new CURL();
$websiteId = WEBSITE_ID;
$request = array(
			'conditions' => ['Uebook.is_deleted' => 0,'Uebook.websiteId' => $websiteId,'Uebook.status' => 1],
			'contain' => ['ebook'],
			'fields' => array(),
			'select' => array(),
			'get' => 'all',
			'order' => array('Uebook.id'=>'DESC'),
			);
           
$result = $curl->send_api($request, 'Uebook/index');

if ($result->code == 200) {
    $Ebook = isset($result->Uebook) ? $result->Uebook : '';
}
$final_ebook = array();
if(count($Ebook) > 0)
{	
	$banner_image = '';
	$banner_description = '';
	$title = '';
	$image = '';
	foreach($Ebook as $book)
	{
		if($book->is_edit == 0)
		{
			if($book->is_setting == 1){
				$banner_image = $book->Ebook->cover_image;
				$banner_description = $book->Ebook->description;
			} else {
				$title = $book->Ebook->title; 
				$image = $book->Ebook->cover_image; 
				$final_ebook['data'][] = array('title' => $title,'image' => $image,'id' => $book->id);
			}
		}else{
			if($book->is_setting == 1)
			{
				$banner_image = $book->cover_image;
				$banner_description = $book->description;

			} else {
				$title = $book->title; $image = $book->cover_image;
				$final_ebook['data'][] = array('title' => $title,'image' => $image ,'id' => $book->id);
			}
		}
	}
	$final_ebook['banner_image'] = $banner_image;
	$final_ebook['banner_content'] = $banner_description;
}

?>
<style>
.white-bg {
	border:1px solid #ccc !important;
	background:#fff !important;
}
.file-input .input-group {
    display: table-cell !important;
}
.ui-state-active, .ui-widget-content .ui-state-active, .ui-widget-header .ui-state-active {
    border: 1px solid #2694e8;
    background: none;
    font-weight: normal;
    color: unset;
}
.header-banner {
	background: url(images/header-bg.jpg) no-repeat 59% 49%;
	max-height: 250px;
}
.header-banner h2 {
	/* color: white; */
	text-align: center;
}
.height-align {
	padding: 14px;
}
.sc_title{
	padding-bottom: 0px;
}
.sc_team_item:hover img {
	filter: grayscale(5%);
	transform: rotate(1deg);
	transition-duration:0.6s;
}
.sc_team_item  img {
	filter: grayscale(70%);
}
</style>
<div class="clearfix"></div>
<!-- <div class="page_top_wrap page_top_title page_top_breadcrumbs" style="">
    <div class="content_wrap">
        <div class="breadcrumbs">
            <a class="breadcrumbs_item home" href="index.html">Home</a>
            <span class="breadcrumbs_delimiter"></span>
            <span class="breadcrumbs_item current">Ebook</span>
        </div>
        <h1 class="page_title">Ebook</h1>
    </div>
</div> -->
<div class="header-banner" style="background:url(<?php echo API_URL ?>geturl/uploads/cover/<?php echo $final_ebook['banner_image']; ?>) no-repeat 59% 49%;max-height: 250px;background-size: cover;">
	<div class="container height-align">
		<div class="row">
			<h2 class="sc_title sc_align_center fig_border text-center">E-Books</h2>			
		</div>
	</div>
</div>	
<div class="page_content_wrap">
				<section class="">
					<div class="container" style="padding-top:0px;">
						<div class="row">
							<div class="sc_undertitle  margin_top_small margin_bottom_middle aligncenter"><?php echo $final_ebook['banner_content']; ?></div>
							<div class="content_wrap">
								<div class="sc_team sc_team_style_1">
									<div class="columns_wrap">
									<?php if(count($final_ebook['data']) > 0) {
										foreach($final_ebook['data'] as $single_book){ ?>
										<div class="column-1_3">
											<div class="sc_team_item sc_team_item_1">
												<div class="sc_team_item_avatar">
													<img alt="<?php echo $single_book['image']; ?>" src="<?php echo API_URL ?>geturl/uploads/cover/<?php echo $single_book['image']; ?>" style="width:356px;height:234px;">
												</div>
												<div class="sc_team_item_info">
													<h4 class="sc_team_item_title">
														<a href="ebook_detail.php?id=<?php echo $single_book['id'];?>" title="Terri Roberts"><?php echo $single_book['title']; ?></a>
													</h4>
												</div>
											</div>
										</div>
									<?php }} else { ?>
										<div class="column-1_3">
											<div class="sc_team_item sc_team_item_1">
												
												<div class="sc_team_item_info">
													<h4 class="sc_team_item_title">
														No Data Found.
													</h4>
												</div>
											</div>
										</div>
									<?php } ?>
									</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>

			</div>
<div class="overlay" style="display: none;"></div>
<div class="loadingLoader" style="display: none;">
    <img src="images/loader.gif">
</div>
<?php require_once('footer.php'); ?>
