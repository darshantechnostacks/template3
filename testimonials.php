<?php
require_once('header.php');
$image = FEATURE_PHOTO . 'testimonials_default.png';
?>
<style>
    .testiminial-block {
        padding: 10px 0 30px;
        border-bottom: 1px solid #ccc;
        dispaly: block;
        margin: 0 0 20px;
    }

    .testimonial-content h3 {
        margin-top: 0px;
        color: #444;
    }

    .testimonial-content p {
        color: #777;
    }

    .testimonial-author {
        font-size: 12px;
        font-style: italic;
        color: #999;
    }

    .comp-logo {
        padding-top: 40px;
    }

    @media (max-width: 767px) {
        .testimonial-content {
            margin: 20px 0;
        }

        .comp-logo {
            padding-top: 0px;
        }
    }

    blockquote, blockquote p {
        font-size: 100% !important;
    }

    svg:not(:root) {
        margin: 0;
    }
</style>

<div class="sub-page-banner mb3">
    <div class="banner-img">
        <img src="<?= $image ?>" class="img-responsive"/>
    </div>
    <div class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Testimonials</h2>
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

<div class="grey_section">
    <div class="container padding_bottom_small padding_top_small addblog">

        <?php
        if (!empty($testimonals)) {
            $cnt = count($testimonals);

            $i = 0;
            foreach ($testimonals as $key => $value) {
                ?>

                <div class="d-flex margin_bottom_small testimonial-container xs-flex-column">
                    <div class="clearfix">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="col-sm-4">
                                    <div class="align-items-center d-flex flex-shrink-0">
                                        <?php $avtar = !empty($value->photo) && isset($value->photo) ? $value->photo : "default.png"; ?>
                                        <img class="person-pic"
                                             src="<?php echo API_URL . 'geturl/uploads/photo/' . $avtar; ?>" alt=""
                                             style="width:200px;height: auto;"/>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="d-flex flex-column flex-grow-1 padding_bottom_mini padding_left_mini padding_right_mini padding_top_mini">
                                        <div class="feedback justify-content-center d-flex flex-column flex-grow-1">
                                            <blockquote class="margin_bottom_small margin_top_small"><?php
                                                if ($value->type == 0) {
                                                    echo $details = str_replace("{company_name}", $homePages->firm_name, ($value->description));
                                                } else {
                                                    if (strpos($value->video, 'youtube') !== false) { ?>
                                                        <iframe src="<?php echo $value->video; ?>" frameborder="0"
                                                                allow="autoplay; encrypted-media"
                                                                allowfullscreen=""
                                                                style="width:350px;min-height: 250px;height: 250px;"></iframe>
                                                    <?php } else {
                                                        $vimeoUrl = (int)substr(parse_url($value->video, PHP_URL_PATH), 1);
                                                        ?>
                                                        <iframe src="https://player.vimeo.com/video/<?php echo $vimeoUrl; ?>??autoplay=1"
                                                                frameborder="0"
                                                                allowfullscreen=""
                                                                style="width:350px;min-height: 250px;height: 250px;"></iframe>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </blockquote>
                                            <div class="center-block user-rating"
                                                 data-rate="<?php echo $value->ratings; ?>"></div>
                                        </div>
                                        <div class="flex-shrink-0 person-name text-center text-muted"><i class="">
                                                <strong>
                                                    <?php echo $value->name; ?>
                                                    ,</strong> <?php echo $value->designation; ?>
                                            </i>
                                            <p>
                                                <i><?php echo $value->firm_name . ' , ' . $value->Cities->city . ' , ' . $value->States->state_name; ?></i>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                $lastid = ++$i;
                if ($i == 15) {
                    break;
                }
            }
        }
        ?>
        <input type="hidden" id="totblog" value="<?php echo isset($lastid) ? $lastid : 0; ?>"/>


    </div>
    <?php if ($cnt > 15) { ?>
        <div class="sc_contact_form_item sc_contact_form_button loadmorebtndiv" style="text-align: center">
            <div class="squareButton sc_button_size sc_button_style_global global">
                <button type="submit" name="contact_submit" id="loadblog"
                        class="sc_button button-hover sc_button_square sc_button_style_red sc_button_size_mini contact_form_submit"
                        data-text="Click Here">Load More
                </button>
            </div>
        </div>
    <?php } ?>

    <div style="padding:25px 0px;"></div>

</div>

<?php require_once('footer.php'); ?>
<script type="text/javascript">

    jQuery(document).on('click', '#loadblog', function () {


        var post_url = 'testimonialload.php';
        jQuery.ajax({
            url: post_url,
            data: {lastid: $('#totblog').val()},
            type: 'post',
            dataType: 'json',
            beforeSend: function () {
                jQuery('.loadingLoader').show();
                jQuery('.overlay').show();
            },
            success: function (data) {
                var x = jQuery('#totblog').val();
                var y = data.last_id;
                var tot = +x + +y;
                if (data.message == '') {
                    $('.loadmorebtndiv').hide();
                }

                jQuery('#totblog').val(tot);
                jQuery('.addblog').append(data.message);
                jQuery(".loadingLoader").hide();
                jQuery('.overlay').hide();
                userRatings();
            }
        });
    });
    jQuery(function () {
        userRatings();
    });

    function userRatings() {
        jQuery('.user-rating').each((index, ele) => {
            jQuery(ele).rateYo({
                "rating": ele.dataset.rate,
                starWidth: "20px",
                "starSvg": '<svg width="24" height="24" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1728 647q0 22-26 48l-363 354 86 500q1 7 1 20 0 21-10.5 35.5t-30.5 14.5q-19 0-40-12l-449-236-449 236q-22 12-40 12-21 0-31.5-14.5t-10.5-35.5q0-6 2-20l86-500-364-354q-25-27-25-48 0-37 56-46l502-73 225-455q19-41 49-41t49 41l225 455 502 73q56 9 56 46z"/></svg>',
                //ratedFill: '#ffce00',
                readOnly: true,
                spacing: "3px",
                // onSet: function (rating, rateYoInstance) {
                //     $('#lblRating').text(rating);
                // }
            });
        })
    }
</script>

