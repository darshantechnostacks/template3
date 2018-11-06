<?php
require_once('header.php');
$image = FEATURE_PHOTO.'1537364753_613913.jpg';
?>
<div class="sub-page-banner mb3">
    <div class="banner-img">
        <img src="img/resource-banner.png" class="img-responsive" />
    </div>
    <div class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>RESOURCES</h2>
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
<div class="clearfix mb1">
    <div class="container">
        <p class="font-16 mb4 font-light">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem quae ab illo inventore veritatis</p>
        <div class="row mb2 services-inner">
            <div class="col-md-4 col-sm-6 mb2">
                <div class="inner-box clearfix">
                    <div class="icon-block">
                        <i class=" icon mb-3"><img src="img/services-icon.png" class="img-responsive" /></i>
                    </div>
                    <div class="content">
                        <div class="title-block">
                            <h2 class="title">Tax cuts & job act</h2>
                        </div>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                        <a href="#" class="btn-link">Read More >></a>
                    </div>

                </div>
            </div>
            <div class="col-md-4 col-sm-6 mb2">
                <div class="inner-box clearfix">
                    <div class="icon-block">
                        <i class=" icon mb-3"><img src="img/services-icon.png" class="img-responsive" /></i>
                    </div>
                    <div class="content">
                        <div class="title-block">
                            <h2 class="title">financial calculator</h2>
                        </div>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                        <a href="#" class="btn-link">Read More >></a>
                    </div>

                </div>
            </div>
            <div class="col-md-4 col-sm-6 mb2">
                <div class="inner-box clearfix">
                    <div class="icon-block">
                        <i class=" icon mb-3"><img src="img/services-icon.png" class="img-responsive" /></i>
                    </div>
                    <div class="content">
                        <div class="title-block">
                            <h2 class="title">client forms & organizer</h2>
                        </div>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                        <a href="#" class="btn-link">Read More >></a>
                    </div>

                </div>
            </div>
            <div class="col-md-4 col-sm-6 mb2">
                <div class="inner-box clearfix">
                    <div class="icon-block">
                        <i class=" icon mb-3"><img src="img/services-icon.png" class="img-responsive" /></i>
                    </div>
                    <div class="content">
                        <div class="title-block">
                            <h2 class="title">accounting concepts</h2>
                        </div>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                        <a href="#" class="btn-link">Read More >></a>
                    </div>

                </div>
            </div>
            <div class="col-md-4 col-sm-6 mb2">
                <div class="inner-box clearfix">
                    <div class="icon-block">
                        <i class=" icon mb-3"><img src="img/services-icon.png" class="img-responsive" /></i>
                    </div>
                    <div class="content">
                        <div class="title-block">
                            <h2 class="title">tax center</h2>
                        </div>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                        <a href="#" class="btn-link">Read More >></a>
                    </div>

                </div>
            </div>
            <div class="col-md-4 col-sm-6 mb2">
                <div class="inner-box clearfix">
                    <div class="icon-block">
                        <i class=" icon mb-3"><img src="img/services-icon.png" class="img-responsive" /></i>
                    </div>
                    <div class="content">
                        <div class="title-block">
                            <h2 class="title">downloads</h2>
                        </div>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                        <a href="#" class="btn-link">Read More >></a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<div class="news-letter-section">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-1 col-sm-6 col-xs-12">
                <h4 class="">newsletter</h4>
                <p>Subscribe to your monthly newsletter</p>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-10">
                <div class="form-group mb2">
                    <label>Enter Your Email Address</label>
                    <input type="text" class="form-control" />
                </div>
                <div class="clearfix">
                    <a href="#" class="btn btn-black btn-small font-medium">Cancel</a>
                    <a href="#" class="btn btn-pink btn-small font-medium">Submit</a>
                </div>
            </div>
        </div>
    </div>
</div>