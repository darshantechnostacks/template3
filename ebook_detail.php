
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
//get setting details
$requestSet = array(
			'conditions' => ['Uebook.is_deleted' => 0,'Uebook.websiteId' => $websiteId,'Uebook.is_setting' => 1],
			'contain' => ['ebook'],
			'fields' => array(),
			'select' => array(),
			'get' => 'all',
			'order' => array('Uebook.id'=>'DESC'),
                        'limit'=>1,
			);
           
$resultsetting = $curl->send_api($requestSet, 'Uebook/index');
if($resultsetting->code == 200 && !empty($resultsetting->Uebook)){
    $dataUebook = $resultsetting->Uebook[0];
    if($dataUebook->is_edit == 0){
        $coverImage = API_URL.'geturl/uploads/cover/'.$dataUebook->Ebook->cover_image;
    }else{
        $coverImage =  API_URL.'geturl/uploads/cover/'.$dataUebook->cover_image;;
    }
            
}else{
    $coverImage = 'img/ebook-banner.png';
}


//$final_ebook['banner_image'] = $banner_image;
?>

<div class="clearfix"></div>
<div class="sub-page-banner">
    <div class="banner-img">
        
            <img src="<?php echo $coverImage ?>" class="img-responsive" style="max-height: 250px;background-size: cover;" />
        
            
        
    </div>
    <div class="page-title text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>E-book</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="about-section mb1">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
        
                <div class="img-block">
                   <img alt="<?php echo $image; ?>" src="<?php echo API_URL ?>geturl/uploads/cover/<?php echo $image; ?>" style="width:356px;height:234px;">
                </div>
                <div class="content-block">
                    <h2><?php echo $title; ?></h2>
                    <?php echo $description; ?>
                    
                    <center><a href="<?php echo API_URL ?>geturl/uploads/file/<?php echo $file_attach; ?>"  download> <button class="btn btn-radius btn-shadow btn-orange" style="margin-top: 33px;">Download Book</button></a></center>
                </div>
                
            </div>
                
        </div>
            
    </div>
        
</div>
            


				
<?php require_once('footer.php'); ?>
