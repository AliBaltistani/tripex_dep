
<style>
 
.footer-section.style-2 .footer-top {
    padding-top: 5% !important;
    padding-bottom: 0px;
}
/* .footer-section .footer-top {
    padding-top: 15%;
    padding-bottom: 0px;
} */
</style>
<footer class="footer-section style-2">
    <div class="container">
        <div class="footer-top">
            <div class="row g-lg-4 gy-5 justify-content-center">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer-widget">
                        <div class="footer-logo">
                            <a href="index#"><img src="<?= base_url(web_info('web_logo')) ?>" alt></a>
                        </div>
                        <h3>Want <span>to Take <br></span> Tour Packages<span>?</span></h3>
                        <a href="https://wa.me/<?= web_info('whatstapp'); ?>" class="primary-btn1">Book A Tour</a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6 d-flex justify-content-lg-center justify-content-sm-start">
                    <div class="footer-widget">
                        <div class="widget-title">
                            <h5>Quick Link</h5>
                        </div>
                        <ul class="widget-list">
                            <li><a href="<?= base_url() ?>about-us">About Us</a></li>
                            <li><a href="#">Destinations</a></li>
                            <li><a href="#">Tour Package</a></li>
                            <li><a href="#">Tour Guide</a></li>
                            <li><a href="#">Article</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 d-flex justify-content-lg-center justify-content-md-start">
                    <div class="footer-widget">
                        <div class="single-contact mb-30">
                            <div class="widget-title">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                                    <g clip-path="url(#clip0_1139_225)">
                                        <path d="M17.5107 13.2102L14.9988 10.6982C14.1016 9.80111 12.5765 10.16 12.2177 11.3262C11.9485 12.1337 11.0514 12.5822 10.244 12.4028C8.44974 11.9542 6.0275 9.62168 5.57894 7.73772C5.3098 6.93027 5.84808 6.03314 6.65549 5.76404C7.82176 5.40519 8.18061 3.88007 7.28348 2.98295L4.77153 0.470991C4.05382 -0.156997 2.97727 -0.156997 2.34929 0.470991L0.644745 2.17553C-1.0598 3.96978 0.82417 8.72455 5.04066 12.941C9.25716 17.1575 14.0119 19.1313 15.8062 17.337L17.5107 15.6324C18.1387 14.9147 18.1387 13.8382 17.5107 13.2102Z" />
                                    </g>
                                </svg>
                                <h5>More Inquiry</h5>
                            </div>
                            <a href="tel:<?= web_info('contact'); ?>"><?= web_info('contact'); ?></a>
                        </div>

                        <div class="single-contact">
                            <div class="widget-title">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                                    <g clip-path="url(#clip0_1137_183)">
                                        <path d="M14.3281 3.08241C13.2357 1.19719 11.2954 0.0454395 9.13767 0.00142383C9.04556 -0.000474609 8.95285 -0.000474609 8.86071 0.00142383C6.70303 0.0454395 4.76268 1.19719 3.67024 3.08241C2.5536 5.0094 2.52305 7.32408 3.5885 9.27424L8.05204 17.4441C8.05405 17.4477 8.05605 17.4513 8.05812 17.4549C8.25451 17.7963 8.60632 18 8.99926 18C9.39216 18 9.74397 17.7962 9.94032 17.4549C9.94239 17.4513 9.9444 17.4477 9.9464 17.4441L14.4099 9.27424C15.4753 7.32408 15.4448 5.0094 14.3281 3.08241ZM8.99919 8.15627C7.60345 8.15627 6.46794 7.02076 6.46794 5.62502C6.46794 4.22928 7.60345 3.09377 8.99919 3.09377C10.3949 3.09377 11.5304 4.22928 11.5304 5.62502C11.5304 7.02076 10.395 8.15627 8.99919 8.15627Z" />
                                    </g>
                                </svg>
                                <h5>Address</h5>
                            </div>
                            <a href="https://www.google.com/maps/place/Egens+Lab/@23.8340712,90.3631117,17z/data=!3m1!4b1!4m6!3m5!1s0x3755c14c8682a473:0xa6c74743d52adb88!8m2!3d23.8340663!4d90.3656866!16s%2Fg%2F11rs9vlwsk?entry=ttu"><?= web_info('web_address'); ?></a>

                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 d-flex justify-content-lg-end justify-content-sm-end">
                    <div class="footer-widget">
                        <div class="widget-title">
                            <h5>We Are Here</h5>
                        </div>
                        <p><?= web_info('web_address'); ?></p>
                        <div class="payment-partner">
                            <div class="widget-title">
                                <h5>Payment Partner</h5>
                            </div>
                            <div class="icons">
                                <ul>
                                    <li><img src="<?= base_url() ?>assets/img/home1/icon/visa-logo.svg" alt></li>
                                    <li><img src="<?= base_url() ?>assets/img/home1/icon/stripe-logo.svg" alt></li>
                                    <li><img src="<?= base_url() ?>assets/img/home1/icon/paypal-logo.svg" alt></li>
                                    <li><img src="<?= base_url() ?>assets/img/home1/icon/woo-logo.svg" alt></li>
                                    <li><img src="<?= base_url() ?>assets/img/home1/icon/skrill-logo.svg" alt></li>
                                </ul>
                            </div>
                        </div>

                        <div class="mt-4 payment-partner">
                            <div class="widget-title">
                                <h5>About</h5>
                            </div>
                            <div class="icons">
                                <ul>
                                    <li><p>
                                    <?= web_info('web_desc'); ?>
                                    </p></li>
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="row">
                <div class="col-lg-12 d-flex flex-md-row flex-column align-items-center justify-content-md-between justify-content-center flex-wrap gap-3">
                    <ul class="social-list">
                        <li>
                            <a href="<?= web_info('fb_link'); ?>"><i class="bx bxl-facebook"></i></a>
                        </li>
                        <li>
                            <a href="<?= web_info('web_address'); ?>"><svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-twitter-x" viewBox="0 0 16 16">
                                    <path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865l8.875 11.633Z" />
                                </svg></a>
                        </li>
                        <li>
                            <a href="<?= web_info('youtube_link'); ?>"><i class="bx bxl-youtube"></i></a>
                        </li>
                        <li>
                            <a href="<?= web_info('inst_link'); ?>"><i class="bx bxl-instagram"></i></a>
                        </li>
                    </ul>
                    <p>©Copyright 2024 | Design By <a href="https://madigitalhub.com/">MA Digital Agency</a></p>
                    <div class="footer-right">
                        <ul>
                            <li><a href="<?= web_info('privacy'); ?>">Privacy Policy</a></li>
                            <li><a href="<?= web_info('terms_condition'); ?>">Terms & Condition</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>


<script data-cfasync="false" src="../../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
<script src="<?= base_url() ?>assets/js/jquery-3.7.1.min.html"></script>
<script src="<?= base_url() ?>assets/js/jquery-ui.html"></script>
<script src="<?= base_url() ?>assets/js/moment.min.js"></script>
<script src="<?= base_url() ?>assets/js/daterangepicker.min.js"></script>

<script src="<?= base_url() ?>assets/js/bootstrap.min.html"></script>
<script src="<?= base_url() ?>assets/js/popper.min.js"></script>

<script src="<?= base_url() ?>assets/js/swiper-bundle.min.js"></script>
<script src="<?= base_url() ?>assets/js/slick.html"></script>

<script src="<?= base_url() ?>assets/js/waypoints.min.js"></script>

<script src="<?= base_url() ?>assets/js/jquery.counterup.min.js"></script>

<script src="<?= base_url() ?>assets/js/isotope.pkgd.min.js"></script>

<script src="<?= base_url() ?>assets/js/jquery.magnific-popup.min.js"></script>

<script src="<?= base_url() ?>assets/js/jquery.marquee.min.js"></script>

<script src="<?= base_url() ?>assets/js/jquery.nice-select.min.js"></script>

<script src="<?= base_url() ?>assets/js/select2.min.js"></script>
<script src="<?= base_url() ?>assets/js/jquery.fancybox.min.js"></script>

<script src="<?= base_url() ?>assets/js/custom.js"></script>
</body>

<!-- Mirrored from demo-egenslab.b-cdn.net/html/triprex/preview/index5# by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 17 Feb 2024 13:29:45 GMT -->

</html>