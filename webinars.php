<?php require_once('header.php');
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

<div class="sub-page-banner">
        <div class="banner-img">
            <?php if(!empty($final_webinars['banner_image'])) {?>
            <img src="<?php echo API_URL ?>geturl/uploads/cover/<?php echo $final_webinars['banner_image']; ?>" class="img-responsive" style="max-height: 250px;background-size: cover;" />
            <?php }else{ ?>
            <img src="img/webinar-banner.png" class="img-responsive" />    
            <?php } ?>
        </div>
        <div class="page-title text-center">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2>WEBINAR</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="about-section mb1">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php echo $final_webinars['banner_content']; ?>
                </div>
                
                <div class="col-md-offset-2 col-md-8">
                    <ul class="listing-section">
                <?php
                        if (!empty($final_webinars)) {
                            if (count($final_webinars) > 0 && !empty($final_webinars)) {
                                foreach($final_webinars as $webinars) { 
									if($webinars['url'] != '')	{

																				
										if($webinars['type'] == 'vimeo' ){
											$arr_vimeo_id = explode('/',$webinars['url']);													
											$videoId = $arr_vimeo_id[3];
											$imag_src = getVimeoVideoThumbnailByVideoId($videoId,'large');
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
					
                         <li>
                             <div class="img-block" style="width:350px;">
                                <a href="#"><img src="<?php echo $imag_src; ?>" class="img-responsive" style="width:350px;" /></a>
                                
                            </div>
                            <div class="content-block">
                                <button style="margin-top:8px;" type="button" class="btn btn-primary video-btn" data-toggle="modal" data-src="<?php echo $play_video; ?>" data-target="#myModal"> Play</button>	
                            </div>
                        </li>
                        
                                    
                                <?php
                                }
                            }
						}
					}
                        ?>
                        
                    </ul>
                </div>
            </div>
            
        </div>
    </div>
    
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" style="padding-left: 10px;">&times;</span>
        </button>   
			<div class="embed-responsive embed-responsive-16by9">
			<iframe class="embed-responsive-item" src="" id="video"  allowscriptaccess="always">></iframe>
			</div>
      </div>
    </div>
  </div>
</div> 	

<?php include_once('footer.php'); ?>

<script type="text/javascript">
$(document).ready(function() {
	var videoSrc;  
	$('.video-btn').click(function() {
		videoSrc = $(this).attr("data-src");
	});
	
	$('#myModal').on('shown.bs.modal', function (e) {
	$("#video").attr('src',videoSrc + "?modestbranding=1&rel=0&controls=0&showinfo=0&html5=1&autoplay=1" ); 
	
})
	$('#myModal').on('hide.bs.modal', function (e) {
		$("#video").attr('src',videoSrc); 
	}) 
});
</script>