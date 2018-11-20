<?php
require_once('header.php');

$curl = new CURL();
$row = array();
$row['websiteId'] = WEBSITE_ID;
$websiteId = WEBSITE_ID;
$result = $curl->send_api($row, 'Career/index');
$tags = '';
if ($result->code == 200) {
    $Career = isset($result->Career) ? $result->Career : '';
}
$coverImageUrl = "img/about-banner.png";
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
.ui-widget-content {
    border: 1px solid #dddddd;
    background: #ffffff;
    color: #222222;
}
</style>

<div class="sub-page-banner">
    <div class="banner-img">
        <img src="<?php echo $coverImageUrl; ?>" class="img-responsive" style="max-height: 250px;background-size: cover; " />
    </div>
    <div class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Career</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="about-section mb1">
    <div class="container">
        <div class="row">
            
            <div class="content_wrap">
                <div class="columns_wrap sc_columns" data-animation="animated fadeInUp normal">
                    <h3 class="text-center">CURRENT OPENING(S)</h3>		
                    <div class=" col-md-4 column-1_3 sc_column_item" style="border: 1px solid #e3e3e3;padding: 16px;">

                        <form enctype="multipart/form-data" id="career_post" method="post" class="text-center border border-light p-5" >
                            <input type="hidden" id="position_for" name="position_for" value="">
                            <input type="hidden" name="websiteId" value="<?php echo $websiteId; ?>">	

                            <div class="form-group">												
                                <input placeholder="Apply For" id="title" readonly type="text" class="form-control white-bg">
                            </div>
                            <div class="form-group">												
                                <input maxlength="50" required placeholder="Enter First Name"  type="text" class="form-control white-bg" name="first_name">
                            </div>
                            <div class="form-group">												
                                <input maxlength="50" required placeholder="Enter Last Name"  type="text" class="form-control white-bg" name="last_name">
                            </div>
                            <div class="form-group">												
                                <input id="imgInp" required type="file" title="Document must be pdf or doc" class="form-control white-bg" name="document_image">									
                                <input id="feature_photo" type="hidden" name="document" value="" >
                                <p>Please upload document is pdf or doc.</p>
                            </div>
                            <div class="form-group">												
                                <input maxlength="50" required placeholder="Enter Email Address"  type="email" class="form-control white-bg" name="email">
                            </div>
                            <div class="form-group">												
                                <input maxlength="20" required placeholder="Enter Phone Number"  type="text" class="allownumericwithoutdecimal form-control white-bg" name="phone">
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-orange btn-radius" data-text="Apply Now" id="Button">Apply Now</button>
                            </div>
                        </form>

                    </div>
                    
                    <div class=" col-md-8 column-2_3 sc_column_item">
                        <div class="sc_accordion sc_accordion_style_1" data-active="0">
                            <?php
                            if ($Career) {
                                foreach ($Career as $single_career) {
                                    if ($single_career->status == 1) {
                                        ?>    
                                        <div class="sc_accordion_item">
                                            <h5 class="sc_accordion_title">
                                                <span class="sc_accordion_icon sc_accordion_icon_closed icon-plus-2"> </span>
                                                <span class="sc_accordion_icon sc_accordion_icon_opened icon-minus-2"> </span>
            <?php echo $single_career->title; ?>
                                            </h5>
                                            <div class="sc_accordion_content">
                                                <div class="">
                                                    <div class="">
                                                        <p><?php echo $single_career->description; ?></p>
                                                    </div>
                                                </div>
                                                <h6 class="sc_title no_padding sc_title_regular margin_top_small">JOb Details</h6>
                                                <ul class="sc_list  sc_list_style_ul margin_top_none">
                                                    <li class="sc_list_item"><b>Experience :</b><?php echo $single_career->experience; ?> </li>
                                                    <li class="sc_list_item"><b>Openings :</b> <?php echo $single_career->no_of_opening; ?></li>
                                                    <li class="sc_list_item"><b>Qualification :</b><?php echo $single_career->qualification; ?></li>
                                                    <li class="sc_list_item"><b>Job Location :</b><?php echo $single_career->job_location; ?></li>

                                                </ul>
                                                <br/>
                                                <a  href="#form_top"  title="Apply Now" data-text="Apply Now" onclick="applyJob('<?php echo $single_career->title; ?>', '<?php echo $single_career->id; ?>');" class="btn btn-orange btn-radius">Apply Now</a>
                                            </div>
                                        </div>
                                    <?php }
                                }
                            }else{ ?>
                            <h3 style="margin-top: 200px;text-align: center;">No record found.</h3>
                                
                            <?php } ?>

                        </div>
                    </div>
                </div>
                
                
            </div>
        </div>
    </div>
</div>
<?php require_once('footer.php'); ?>



<script type="text/javascript">
function grayer(formId, yesNo) {
   var f = document.getElementById(formId), s, opacity;
   s = f.style;
   opacity = yesNo? '40' : '100';
   s.opacity = s.MozOpacity = s.KhtmlOpacity = opacity/100;
   s.filter = 'alpha(opacity='+opacity+')';
   for(var i=0; i<f.length; i++) f[i].disabled = yesNo;
}
window.onload=function(){
	grayer('career_post',true);
	document.getElementById("Button").disabled = true;	
};
function applyJob(title,id)
{
	$('#position_for').val(id);
	$('#title').val(title);
	grayer('career_post',false);
}

$(document).on('change','#imgInp',function(){   
	myfile= $(this ).val();
	var ext = myfile.split('.').pop();
	if(ext=="pdf" || ext=="docx" || ext=="doc")
	{
		var file_data = $('#imgInp').prop('files')[0];   
		var form_data = new FormData();                  
		form_data.append('file', file_data);         
		$.ajax({
			url: '<?php echo API_URL;?>'+'Users/uploadImage', 
			dataType: 'json', 
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,                         
			type: 'post',
			success: function(response)
			{
				$('#feature_photo').val(response.Users.file);
				document.getElementById("Button").disabled = false;
			}
		});
	} else{
		jQuery('#myModal3').modal('show');
		jQuery('#message3').html('Please Upload Valid Document type');
	}
});	

jQuery("#career_post").submit(function (event) {
		event.stopPropagation(); 
        event.preventDefault(); 
		var doc = $('#feature_photo').val();
		if(doc == '')
		{
			jQuery('#myModal3').modal('show');
			jQuery('#message3').html('Please Upload Valid Document');
			return false;
		} else {
        var post_url = 'career_post.php'; 
        var request_method = jQuery(this).attr("method"); 
		$form = $(event.currentTarget);
		var data = new FormData(this);	
        jQuery.ajax({
			url: post_url,
			data: data,
			type: 'post',
			contentType: false,
			cache: false,            
			processData:false,
			dataType: 'json',     
			beforeSend: function () {                                   
				jQuery('.loadingLoader').show();
				jQuery('.overlay').show();
			},
			success: function (data) {
				$form.each (function() { this.reset(); });
			
				document.getElementById("career_post").reset();
				
				jQuery(".loadingLoader").hide();
				jQuery('.overlay').hide();                   
				var messages = '<div class="flash-message"> <strong> Thank You For Applying </strong></div>';
				jQuery('#myModal3').modal('show');
				jQuery('#message3').html(messages);
				setTimeout(function () {
                       location.reload();
                    }, 2000);
				
			}
        });
		}
    });
    
</script>
<script type='text/javascript' src='js/core.utils.min.js'></script> 
<script type='text/javascript' src='js/core.init.min.js'></script>