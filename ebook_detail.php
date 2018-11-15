
<?php
require_once('header.php');
$curl = new CURL();
$id = $_REQUEST['id'];
$websiteId = WEBSITE_ID;
$request = array(
			'conditions' => ['Uebook.is_deleted' => 0,'Uebook.websiteId' => $websiteId,'Uebook.status' => 1,'Uebook.id' => $id],
			'contain' => ['ebook'],
			'fields' => array(),
			'select' => array(),
			'get' => 'all',
			'order' => array('Uebook.id'=>'DESC'),
			);
           
$result = $curl->send_api($request, 'Uebook/index');

if ($result->code == 200) {
    $book = isset($result->Uebook) ? $result->Uebook[0] : '';
}
if($book->is_edit == 0)
{			
    $title = $book->Ebook->title; 
    $image = $book->Ebook->cover_image;
    $description = $book->Ebook->description;
    $file_attach = $book->Ebook->file_attach;
}else{
    $title = $book->title; $image = $book->cover_image;
    $description = $book->description;
    $file_attach = $book->file_attach;
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
<div class="page_top_wrap page_top_title page_top_breadcrumbs" style="">
    <div class="content_wrap">
        <div class="breadcrumbs">
            <a class="breadcrumbs_item home" href="index.html">Home</a>
            <span class="breadcrumbs_delimiter"></span>
            <span class="breadcrumbs_item current">Ebook</span>
        </div>
        <h1 class="page_title">Ebook</h1>
    </div>
</div>
<!-- <div class="header-banner">
	<div class="container height-align">
		<div class="row">
			<h2 class="sc_title sc_align_center fig_border text-center">E-Books</h2>			
		</div>
	</div>
</div>	 -->
<div class="page_content_wrap">
				<section class="">
					<div class="container" style="padding-top:0px;">
						<div class="row">
							
							<div class="content_wrap">
								<div class="sc_team sc_team_style_1">
									<div class="columns_wrap">
										<div class="column-1_3">
											<div class="sc_team_item sc_team_item_1">
												<div class="sc_team_item_avatar">
													<img alt="<?php echo $image; ?>" src="<?php echo API_URL ?>geturl/uploads/cover/<?php echo $image; ?>" style="width:356px;height:234px;">
												</div>
											</div>
                                        </div>
                                       
                                        
											<div>
                                                <h3 class="sc_team_item_title text-center"><?php echo $title; ?></h3>
                                                <p><?php echo $description; ?></p>
                                                <center><a href="<?php echo API_URL ?>geturl/uploads/file/<?php echo $file_attach; ?>" download> <button style="margin-top: 33px;">Download Book</button></a></center>
											</div>
										
									</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>
<?php require_once('footer.php'); ?>
