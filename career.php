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
?>

<div class="sub-page-banner mb3">
    <div class="banner-img">
        <img src='img/career-banner.png' class='img-responsive'/>
    </div>
    <div class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>CAREER</h2>
                    <h4>We love what we do and we’re good at it!</h4>
                </div>
            </div>
        </div>
    </div>
    <ul class="top-contact-info">
        <li><i class="icon-mobile"></i><?= isset($homePages->firm_phone) ? $homePages->firm_phone : "" ?></li>
        <li><i class="icon-email"></i> <a
                    href="mailtto:<?= isset($homePages->firm_email) ? $homePages->firm_email : "" ?>"><?= isset($homePages->firm_email) ? $homePages->firm_email : "" ?></a>
        </li>
    </ul>
</div>
<div id="form_top"></div>
<div class="about-section mb1">
    <div class="container">
        <div class="row mb3">
            <div class="col-md-8 mb3">
                <?php
                if ($Career) {
                    foreach ($Career as $key => $single_career) {
                        if ($single_career->status == 1) {
                            ?>
                            <div class="panel panel-default career-heading">
                                <a class="accordion-toggle collapsed" data-toggle="collapse"
                                   data-parent="#career-group<?= $key ?>"
                                   href="#career-group<?= $key ?>">
                                    <?= isset($single_career->title) ? $single_career->title : '' ?>
                                </a>
                                <div id="career-group<?= $key ?>" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <p><?= isset($single_career->description) ? $single_career->description : '' ?></p>
                                        <h6 class="sc_title no_padding sc_title_regular margin_top_small">JOb Details</h6>
                                        <ul class="sc_list  sc_list_style_ul margin_top_none">
                                            <li class="sc_list_item"><b>Experience
                                                    :</b><?= isset($single_career->experience) ? $single_career->experience : '' ?>
                                            </li>
                                            <li class="sc_list_item"><b>Openings
                                                    :</b> <?= isset($single_career->no_of_opening) ? $single_career->no_of_opening : '' ?>
                                            </li>
                                            <li class="sc_list_item"><b>Qualification
                                                    :</b><?= isset($single_career->qualification) ? $single_career->qualification : '' ?>
                                            </li>
                                            <li class="sc_list_item"><b>Job Location
                                                    :</b><?= isset($single_career->job_location) ? $single_career->job_location : '' ?>
                                            </li>
                                        </ul>
                                        <br/>
                                        <a  href="#form_top"  title="Apply Now" data-text="Apply Now" onclick="applyJob('<?php echo $single_career->title; ?>','<?php echo $single_career->id;?>');" class="btn btn-pink">Apply Now</a>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                }
                ?>
            </div>



            <div class="col-md-4">
                <form enctype="multipart/form-data" id="career_post" method="post" >
                <div class="clearfix mb3">

                    <input type="hidden" id="position_for" name="position_for" value="">
                    <input type="hidden" name="websiteId" value="<?= $websiteId ?>">

                    <h4 class="font-16 font-medium mb2 text-center">Upload Your Resume</h4>
                    <div class="clearfix contact-form-inner-pages">
                        <div class="form-group">
                            <input placeholder="Apply For" id="title" readonly type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <input maxlength="50" required placeholder="Enter First Name"  type="text" class="form-control" name="first_name">
                        </div>
                        <div class="form-group">
                            <input maxlength="50" required placeholder="Enter Last Name"  type="text" class="form-control" name="last_name">
                        </div>
                        <div class="form-group current-employement">
                            <input id="imgInp" required type="file" title="Document must be pdf or doc" class="form-control" name="document_image">
                            <input id="feature_photo" type="hidden" name="document" value="" >
                            <p>Please upload document is pdf or doc.</p>
                        </div>
                        <div class="form-group upload-block">
                            <input maxlength="50" required placeholder="Enter Email Address"  type="email" class="form-control" name="email">
                        </div>
                        <div class="form-group verification-block">
                            <input maxlength="20" required placeholder="Enter Phone Number"  type="text" class="allownumericwithoutdecimal form-control" name="phone">
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-pink btn-small font-medium" data-text="Submit" id="Button">Submit</button>
                        </div>
                    </div>
                </div>
                </form>
            </div>

        </div>
    </div>
</div>

<?php require_once('footer.php'); ?>
<script type="text/javascript">
    function grayer(formId, yesNo) {
        var f = document.getElementById(formId), s, opacity;
        s = f.style;
        opacity = yesNo ? '40' : '100';
        s.opacity = s.MozOpacity = s.KhtmlOpacity = opacity / 100;
        s.filter = 'alpha(opacity=' + opacity + ')';
        for (var i = 0; i < f.length; i++) f[i].disabled = yesNo;
    }

    window.onload = function () {
        grayer('career_post', true);
        document.getElementById("Button").disabled = true;
    };

    function applyJob(title, id) {
        $('#position_for').val(id);
        $('#title').val(title);
        grayer('career_post', false);
    }

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

    $(document).on('change', '#imgInp', function () {
        myfile = $(this).val();
        var ext = myfile.split('.').pop();
        if (ext == "pdf" || ext == "docx" || ext == "doc") {
            var file_data = $('#imgInp').prop('files')[0];
            var form_data = new FormData();
            form_data.append('file', file_data);
            $.ajax({
                url: '<?php echo API_URL;?>' + 'Users/uploadImage',
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function (response) {
                    $('#feature_photo').val(response.Users.file);
                    document.getElementById("Button").disabled = false;
                }
            });
        } else {
            jQuery('#myModal3').modal('show');
            jQuery('#message3').html('Please Upload Valid Document type');
        }
    });
</script>