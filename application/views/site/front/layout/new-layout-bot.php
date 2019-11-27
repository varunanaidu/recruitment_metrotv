<?php if ( !defined('BASEPATH') ) exit('No direct script access allowed');?>
<div class="footer">
    <div class="frame">
        <div class="wrap">
            <div class="foot">
                <div class="foot_fill ct_us">
                    <h3>Contact Us</h3>
                    <span>PT Media Televisi Indonesia</span>
                    <p>Jl. Pilar Mas Raya Kav. A-D<br/>
                        Kedoya - Kebon Jeruk<br/>
                        Jakarta 11520 - Indonesia<br/>
                        <i class="fa fa-envelope"></i>recruitment@metrotvnews.com</p>
                    </div>
                    <div class="foot_fill">
                        <h3>Follow Us</h3>
                        <!-- <p>Follow Our social Media to get the latest news.</p> -->
                        <ul class="sosc">
                            <li><a href="https://twitter.com/HRD_MetroTV" title="twitter"><img src="<?php echo base_url(); ?>assets/images/main/ic_twitter.png" alt="twitter"/></a></li>
                            <li><a href="https://www.instagram.com/metrotvcareer/?hl=id" title="instagram"><img src="<?php echo base_url(); ?>assets/images/main/ic_instagram.png" alt="instagram"/></a></li>
                            <li><a href="https://www.linkedin.com/company/media-televisi-indonesia-pt-metro-tv-/about/" title="linkedin"><img src="<?php echo base_url(); ?>assets/images/main/ic_linkedin.png" alt="linkedin"/></a></li>
                        </ul>
                    </div>
                    <div class="foot_fill">
                        <h3>Company</h3>
                        <div class="co">
                            <img src="<?php echo base_url(); ?>assets/images/main/lg_metro.png" alt="">
                        </div>
                        <div class="co">
                            <img src="<?php echo base_url(); ?>assets/images/main/lg_medcom.png" alt="">
                        </div>
                        <div class="co">
                            <img src="<?php echo base_url(); ?>assets/images/main/lg_idm.png" alt="">
                        </div>
                     </div>
                    <div class="foot_fill">
                        <div class="mapouter"><div class="gmap_canvas"><iframe width="375" height="200" id="gmap_canvas" src="https://maps.google.com/maps?q=Metro%20tv&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe></div><style>.mapouter{position:relative;text-align:right;height:200px;width:375px;}.gmap_canvas {overflow:hidden;background:none!important;height:200px;width:375px;}</style></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright">
        <div class="frame">
            <div class="wrap">
                <span class="copy">
                    &copy; 2019 Metro TV. All Rights Reserved.
                </span>
                <span class="render">
                    / rendering in {elapsed_time} seconds [71]
                </span>
            </div>
        </div>
    </div>

    <?php if ($isLogin == FALSE){ ?>
        <div class="rver_pop wrapper_pop">
            <div class="account-popup">
                <span class="close-popup">x</span>
                <h3>Re-send Activation Email</h3>
                <form role="form" id="rver_form" class="form-validation" method="POST">
                    <div class="cfield">
                        <input type="email" name="verify_email" placeholder="Email Address" class="form-control" required="">
                    </div>
                    <button id="rverBtn" type="submit">Send</button>
                </form>
            </div>
        </div>
        <div class="fpass_pop wrapper_pop">
            <div class="account-popup">
                <span class="close-popup">x</span>
                <h3>Forgot Password</h3>
                <span>Please enter your email address below<br>We will send you an email that will allow you to reset your password</span>
                <form role="form" id="fpass_form" class="form-validation" method="POST">
                    <div class="cfield">
                        <input type="email" name="fpass_email" placeholder="Email Address" class="form-control" required="">
                    </div>
                    <button id="fpassBtn" type="submit">Send</button>
                </form>
            </div>
        </div>
        <div class="login_pop wrapper_pop">
            <div class="account-popup">
                <span class="close-popup">X</span>
                <h3>User Login</h3>
                <form role="form" id="login_form" class="form-validation">
                    <div class="cfield">
                        <input placeholder="Email" type="email" id="email" class="form-control" name="Email" required="">
                        <i class="fa fa-envelope"></i>
                    </div>
                    <div class="cfield">
                        <input placeholder="Password" type="password" id="password" class="form-control" name="password" required="">
                        <i class="fa fa-key"></i>
                    </div>
                    <div class="captcha">
                        <div class="g-recaptcha" data-sitekey="6LfrhLIUAAAAAPyqYVv8eL9Zp3x0csS4oscReyXw"></div>
                    </div>
                    <button id="loginBtn" type="submit">Login</button>
                </form>
                <a class="forgot_pass link_show" href="#" title="Forgot Password?">Forgot Password?</a>
            </div>
        </div>
        <div class="reg_pop wrapper_pop">
            <div class="account-popup">
                <span class="close-popup">x</span>
                <h3>Sign Up</h3>
                <span>New User? Register here</span>
                <form role="form" id="regis_form" class="form-validation" method="POST">
                    <div class="cfield">
                        <input placeholder="Email" type="email" id="email" class="form-control" name="Email" required="">
                        <i class="fa fa-envelope"></i>
                    </div>
                    <div class="cfield">
                        <input placeholder="Password" type="password" id="NewPassword" class="form-control" name="NewPassword" required="">
                        <i class="fa fa-key"></i>
                    </div>
                    <div class="cfield">
                        <input placeholder="Confirm Password" type="password" id="RePassword" class="form-control" name="RePassword" required="">
                        <i class="fa fa-key"></i>
                    </div>
                    <label class="term" for="terms">I read and agree to the <a href="<?php echo site_url('site/tos')?>">terms of usage</a>.
                        <input class="chc" name="terms" id="terms" type="checkbox">
                        <span class="checkmark"></span>
                    </label>
                    <button id="registerBtn" type="submit">Sign Up</button>
                </form>
                <a class="resend_email link_show" href="#" title="Re-send Activation Email">Re-send Activation Email</a>
            </div>
        </div>
    <?php } ?>
    <script>var base_url = "<?php echo base_url()?>";</script>
    <script>var type = '<?php echo $type ?>'; var msg = '<?php echo $msg ?>';</script>
    <script src="<?php echo base_url(); ?>assets/js/vendor/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/vendor/less.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/vendor/modernizr-2.6.2.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/vendor/owl.carousel.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/vendor/jquery.validate.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/vendor/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/sweetalert2.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/vendor/jquery.steps.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/moment.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script> -->
    <!--  <script src='https://www.google.com/recaptcha/api.js'></script> -->
    <script src="<?php echo base_url(); ?>assets/vendors/highlight.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/app.js"></script>
    <!-- <script src="<?php echo base_url(); ?>assets/plugins/lightbox2-2.11.1/dist/js/lightbox.js"></script> -->
    <script src="<?php echo base_url(); ?>assets/js/main.js?v=1.0.2"></script>
</body>
</html>