<?php
require_once('header.php');
error_reporting(0);
$curl = new CURL();


$websiteId = WEBSITE_ID;
 $request = array(
                'conditions' => ['Uwebinars.is_deleted' => 0,'Uwebinars.status' => 1 ,'Uwebinars.websiteId' => $websiteId],
                'contain' => ['webinars'],
                'order' => array('Uwebinars.id'=>'DESC'),
            );
           
$result = $curl->send_api($request, 'Uwebinars/index');

if ($result->code == 200) {
    $webinars = isset($result->Uwebinars) ? $result->Uwebinars : '';
}
$final_webinars = array();
$banner_image = '';
$banner_description = '';
$type = '';
if(count($webinars) > 0)
{
	
	foreach($webinars as $web)
	{
		if($web->is_edit == 0)
		{
			
			if($web->is_setting == 1){
				$banner_image = $web->Webinars->cover_image;
				$banner_description = $web->Webinars->description;
			} else {
				$url = $web->Webinars->url;   
				$type = $web->Webinars->url_type; 
				$final_webinars[] = array('url' => $url ,'type' => $type);
			} 
		} else {
			if($web->is_setting == 1){
				$banner_image = $web->cover_image;
				$banner_description = $web->description;
			} else {
				$url = $web->url; 
				$type = $web->url_type; 
				$final_webinars[] = array('url' => $url ,'type' => $type);
			}
		}
		
	}
	$final_webinars['banner_image'] = $banner_image;
	$final_webinars['banner_content'] = $banner_description;
}

function getVimeoVideoThumbnailByVideoId( $id = '', $thumbType = 'medium' ) {
	$id = trim( $id );
	if ( $id == '' ) {
		return FALSE;
	}
	$apiData = unserialize( file_get_contents( "http://vimeo.com/api/v2/video/$id.php" ) );
	if ( is_array( $apiData ) && count( $apiData ) > 0 ) {
		$videoInfo = $apiData[ 0 ];
		switch ( $thumbType ) {
			case 'small':
				return $videoInfo[ 'thumbnail_small' ];
				break;
			case 'large':
				return $videoInfo[ 'thumbnail_large' ];
				break;
			case 'medium':
				return $videoInfo[ 'thumbnail_medium' ];
			default:
				break;
		}
	}
	return FALSE;
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
body {margin:2rem;}

.modal-dialog {
      max-width: 800px;
      margin: 30px auto;
  }
.modal-body {
  position:relative;
  padding:0px;
}
.close {
  position:absolute;
  right:-30px;
  top:0;
  z-index:999;
  font-size:2rem;
  font-weight: normal;
  color:#fff;
  opacity:1;
}
</style>

<div class="header-banner" style="background:url(<?php echo API_URL ?>geturl/uploads/cover/<?php echo $final_webinars['banner_image']; ?>) no-repeat 59% 49%;max-height: 250px;background-size: cover;">
	<div class="container height-align">
		<div class="row">
			<h2 class="sc_title sc_align_center fig_border text-center">Webinars</h2>			
		</div>
	</div>
</div>
	
	<section class="clients wow fadeInUp" data-wow-duration="300ms" data-wow-delay="450ms">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <div class="sc_undertitle margin_top_small margin_bottom_middle aligncenter"><?php echo $final_webinars['banner_content']; ?></div>
                    <div id="clients-carousel" class="owl-carousel">
                        <?php
                        if (!empty($final_webinars)) {
                            if (count($final_webinars) > 0 && !empty($final_webinars)) {
                                foreach($final_webinars as $webinars) { 
									if($webinars['url'] != '')	{

																				
										if($webinars['type'] == 'vimeo' ){
											$arr_vimeo_id = explode('/',$webinars['url']);													
											$videoId = $arr_vimeo_id[3];
											$imag_src = getVimeoVideoThumbnailByVideoId($videoId,'medium');
											$play_video = 'https://player.vimeo.com/video/'.$videoId;
										} else {
											if (strpos($webinars['url'], '=') !== false) {
											$arr_youtube_id = explode('=',$webinars['url']);
											$videoId = $arr_youtube_id[1];
											} else {
												$arr_youtube_id = explode('/',$webinars['url']);
												$videoId = end($arr_youtube_id);
											}
											$imag_src = 'https://img.youtube.com/vi/'.$videoId.'/mqdefault.jpg';
											$play_video = $webinars['url'];
										}
                                    ?>
								
                                    <div class="item sc_team_item_avatar">
                                        <img style="height:200px;width:250px;" src="<?php echo $imag_src; ?>">
											<button style="margin-top:8px;" type="button" class="btn btn-primary video-btn" data-toggle="modal" data-src="<?php echo $play_video; ?>" data-target="#myModal"> Play</button>												
									</div>
                                <?php
                                }
                            }
						}
					}
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </section> 


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>   
			<div class="embed-responsive embed-responsive-16by9">
			<iframe class="embed-responsive-item" src="" id="video"  allowscriptaccess="always">></iframe>
			</div>
      </div>
    </div>
  </div>
</div> 	

<?php require_once('footer.php'); ?>
<script>
$(document).ready(function() {
	var videoSrc;  
	$('.video-btn').click(function() {
		videoSrc = $(this).attr("data-src");
	});
	console.log(videoSrc);
	$('#myModal').on('shown.bs.modal', function (e) {
	$("#video").attr('src',videoSrc + "?modestbranding=1&rel=0&controls=0&showinfo=0&html5=1&autoplay=1" ); 
	
})
	$('#myModal').on('hide.bs.modal', function (e) {
		$("#video").attr('src',videoSrc); 
	}) 
});
</script>
