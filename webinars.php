<?php
require_once('header.php');
error_reporting(0);
$curl = new CURL();


$websiteId = WEBSITE_ID;
$request = array(
    'conditions' => ['Uwebinars.is_deleted' => 0, 'Uwebinars.status' => 1, 'Uwebinars.websiteId' => $websiteId],
    'contain' => ['webinars'],
    'order' => array('Uwebinars.id' => 'DESC'),
);

$result = $curl->send_api($request, 'Uwebinars/index');

if ($result->code == 200) {
    $webinars = isset($result->Uwebinars) ? $result->Uwebinars : '';
}
$final_webinars = array();
$banner_image = '';
$banner_description = '';
$type = '';
if (count($webinars) > 0) {

    foreach ($webinars as $web) {
        if ($web->is_edit == 0) {

            if ($web->is_setting == 1) {
                $banner_image = $web->Webinars->cover_image;
                $banner_description = $web->Webinars->description;
            } else {
                $url = $web->Webinars->url;
                $type = $web->Webinars->url_type;
                $final_webinars[] = array('url' => $url, 'type' => $type);
            }
        } else {
            if ($web->is_setting == 1) {
                $banner_image = $web->cover_image;
                $banner_description = $web->description;
            } else {
                $url = $web->url;
                $type = $web->url_type;
                $final_webinars[] = array('url' => $url, 'type' => $type);
            }
        }

    }
    $final_webinars['banner_image'] = $banner_image;
    $final_webinars['banner_content'] = $banner_description;
}

function getVimeoVideoThumbnailByVideoId($id = '', $thumbType = 'medium')
{
    $id = trim($id);
    if ($id == '') {
        return FALSE;
    }
    $apiData = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$id.php"));
    if (is_array($apiData) && count($apiData) > 0) {
        $videoInfo = $apiData[0];
        switch ($thumbType) {
            case 'small':
                return $videoInfo['thumbnail_small'];
                break;
            case 'large':
                return $videoInfo['thumbnail_large'];
                break;
            case 'medium':
                return $videoInfo['thumbnail_medium'];
            default:
                break;
        }
    }
    return FALSE;
}

$banner = isset($final_webinars['banner_image']) ? COVER_URL . $final_webinars['banner_image'] : '';
?>


<div class="sub-page-banner mb3">
    <div class="banner-img">
        <?php
        if (!empty($banner)) {
            echo "<img src='$banner' class='img-responsive' />";
        } else {
            echo "<img src='img/webinar-banner.png' class='img-responsive' />";
        }
        ?>
    </div>
    <div class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>WEBINAR</h2>
                    <h4>We love what we do and we’re good at it!</h4>
                </div>
            </div>
        </div>
    </div>
    <ul class="top-contact-info">
        <li><i class="icon-mobile"></i><?= isset($homePages->firm_phone) ? $homePages->firm_phone : "" ?></li>
        <li><i class="icon-mobile"></i> <a
                    href="mailtto:<?= isset($homePages->firm_email) ? $homePages->firm_email : "" ?>"><?= isset($homePages->firm_email) ? $homePages->firm_email : "" ?></a>
        </li>
    </ul>
</div>

<div class="clearfix mb4">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-1 col-md-10">
                    <?php
                    if (!empty($final_webinars)) {
                        if (count($final_webinars) > 0 && !empty($final_webinars)) {
                            foreach ($final_webinars as $webinars) {
                                if ($webinars['url'] != '') {
                                    if ($webinars['type'] == 'vimeo') {
                                        $arr_vimeo_id = explode('/', $webinars['url']);
                                        $videoId = $arr_vimeo_id[3];
                                        $imag_src = getVimeoVideoThumbnailByVideoId($videoId, 'medium');
                                        $play_video = 'https://player.vimeo.com/video/' . $videoId;
                                    } else {
                                        if (strpos($webinars['url'], '=') !== false) {
                                            $arr_youtube_id = explode('=', $webinars['url']);
                                            $videoId = $arr_youtube_id[1];
                                        } else {
                                            $arr_youtube_id = explode('/', $webinars['url']);
                                            $videoId = end($arr_youtube_id);
                                        }
                                        $imag_src = 'https://img.youtube.com/vi/' . $videoId . '/mqdefault.jpg';
                                        $play_video = $webinars['url'];
                                    }
                                    ?>
                                    <div class="col-md-3">
                                        <div class="thumbnail">
                                            <a href="" class="video-btn" data-toggle="modal" data-src="<?= $play_video ?>"
                                               data-target="#myModal">
                                                <img src="<?= $imag_src ?>" class="img-responsive">
                                            </a>
                                        </div>
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


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="" id="video" allowscriptaccess="always"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once('footer.php'); ?>
<script>
    $(document).ready(function () {
        var videoSrc;
        $('.video-btn').click(function () {
            videoSrc = $(this).attr("data-src");
        });
        console.log(videoSrc);
        $('#myModal').on('shown.bs.modal', function (e) {
            $("#video").attr('src', videoSrc + "?modestbranding=1&rel=0&controls=0&showinfo=0&html5=1&autoplay=1");

        })
        $('#myModal').on('hide.bs.modal', function (e) {
            $("#video").attr('src', videoSrc);
        })
    });
</script>

