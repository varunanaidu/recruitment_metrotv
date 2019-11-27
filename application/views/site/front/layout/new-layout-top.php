<?php if ( !defined('BASEPATH') ) exit('No direct script access allowed');?>
<?php
$link = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$link_array = explode('/',$link);
$lastpage = explode('?', end($link_array), 2);
$last = $lastpage[0];
$last = ($last == "") ? '' : ' - '.ucfirst(str_replace('-',' ',$last));
$isLogin = $this->session->userdata('fc_recruitment');
if (isset($fc_alert)) {
    $type = $fc_alert['type'];
    $msg = $fc_alert['msg'];
}else{
    $type = '';
    $msg = '';
}
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="robots" content="index,follow">
    <meta name="viewport" content="width=device-width">
    <meta name="description" content="Lowongan Karir di Metro TV dan Media Group News. Pengalaman bekerja sebagai jurnalis atau reporter di stasiun televisi nomor satu di Indonesia.">
    <meta name="keywords" content="metro tv,media group,lowongan karir,lowongan kerja,magang,freelance,jurnalis,reporter,camera person,anchor,news,stasiun tv">
    <title>E-Recruitment | METRO TV</title>
    <link rel="icon" href="<?php echo base_url()?>media/backend/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/font.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/normalize.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-awesome.min.css">
    <link rel="stylesheet/less" href="<?php echo base_url(); ?>assets/css/main.less">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/sweetalert2.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/owlcarousel/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/owlcarousel/assets/owl.theme.default.min.css">
    <!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/lightbox2-2.11.1/dist/css/lightbox.css"> -->
    <script src="<?php echo base_url(); ?>assets/js/vendor/jquery-3.4.1.min.js"></script>
    <!--    <script src="https://www.google.com/recaptcha/api.js" async defer></script>-->
    <style type="text/css">body{height:auto;}</style>
</head>
<body>
    <div class="header">
        <div class="frame">
            <div class="wrap">
                <ul class="info_head">
                    <li class="info_list info_call">
                        <span><i class="fa fa-phone"></i>+6221 - 5830 0077</span>
                    </li>
                    <li class="info_list info_call">
                        <span><i class="fa fa-phone"></i>+62 811-1300-1548</span>
                    </li>
                    <li class="info_list info_mail">
                        <span><i class="fa fa-envelope"></i>recruitment@metrotvnews.com</span>
                    </li>
                </ul>
                <div class="block_menu">
                    <!-- MENU SLIDE -->
                    <div class="btm" id="bar">
                        <span class="fa fa-bars"></span>
                    </div>
                    <div class="sliders" id="sld">
                        <ul class="sl">
                            <li><a href="#" id="back"><span class="fa fa-arrow-left fa-lg"></span></a></li>
                            <li <?= (end($lastpage) == 'home' || end($lastpage) == 'index' ) ? 'class="act"' : '' ?>><a href="<?php echo site_url('home')?>" title="HOME">HOME</a></li>
                            <li <?= (end($lastpage) == 'vacancies') ? 'class="act"' : '' ?>><a href="<?php echo site_url('vacancies')?>" title="Vacancies">VACANCIES</a></li>            
                            <li <?= (end($lastpage) == 'tipsntricks') ? 'class="act"' : '' ?>><a href="<?php echo site_url('tipsntricks')?>" title="Tips & Tricks">TIPS & TRICKS</a></li>
                            <li <?= (end($lastpage) == 'activities') ? 'class="act"' : '' ?>><a href="<?php echo site_url('activities')?>" title="Activities">ACTIVITIES</a></li>        
                            <li <?= (end($lastpage) == 'faq') ? 'class="act"' : '' ?>><a href="<?php echo site_url('faq')?>" title="Frequently Answered Questions">FAQ</a></li>   
                            <?php
                            if ($isLogin) {
                                ?>
                                <!-- Notifications -->
                                <li>
                                    <a href="javascript:void(0);" class="dropdown-toggle metro-link" data-toggle="dropdown" role="button">
                                        <img src="<?php echo base_url(); ?>assets/images/main/man-user.png" class="userlogin">
                                        <span class=""><?=$this->session->userdata('fc_recruitment')->log_email?></span>
                                    </a>      
                                    <ul class="sl">
                                        <li>
                                            <a href="<?=base_url('applicant')?>" class="btn btn-link fc_nav_link">
                                                <span>Applicant Data</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?=base_url('site/change_password')?>" class="btn btn-link fc_nav_link">
                                                <span>Change Password</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?=base_url('site/logout')?>" class="btn btn-link fc_nav_link">
                                                <span>Logout</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <?php 
                            }  else{
                             ?>
                             <li class="register"><a href="#" title="register">REGISTER</a></li>
                             <li class="login"><a href="#" title="login">LOGIN</a></li>
                             <?php 
                         }
                         ?>
                     </ul>
                 </div>
                 <!-- MENU SLIDE -->
                 <a class="logo_header" href="<?php echo site_url('#home')?>" title="metro tv">
                    <img src="<?php echo base_url(); ?>assets/images/main/logo_mainmetro.png" alt="metro tv"/>
                </a>
                <ul class="m1 menu ">
                    <li data-id="home"><a name="aMenu" href="<?php echo site_url('#home')?>" class="scroll" title="HOME">HOME</a></li>
                    <li data-id="vacancies"><a name="aMenu" href="<?php echo site_url('#vacancies')?>" class="scroll" title="Vacancies">VACANCIES</a></li>
                    <li data-id="tipsntrick"><a name="aMenu" href="<?php echo site_url('#tipsntrick')?>" class="scroll" title="Tips & Tricks">TIPS & TRICKS</a></li>
                    <li data-id="activities"><a name="aMenu" href="<?php echo site_url('#activities')?>" class="scroll" title="Activities">ACTIVITIES</a></li>
                    <li data-id="faq"><a name="aMenu" href="<?php echo site_url('#faq')?>" class="scroll" title="Frequently Answered Questions">FAQ</a></li>

                    <?php
                    if ($isLogin) {
                        ?>
                        <!-- Notifications -->
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle metro-link" data-toggle="dropdown" role="button">
                                <img src="<?php echo base_url(); ?>assets/images/main/man-user.png" class="userlogin">
                                <span class=""><?=$this->session->userdata('fc_recruitment')->log_email?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="menu">
                                    <a href="<?=base_url('applicant')?>" class="btn btn-link fc_nav_link">
                                        <span>Applicant Data</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?=base_url('site/change_password')?>" class="btn btn-link fc_nav_link">
                                        <span>Change Password</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?=base_url('site/logout')?>" class="btn btn-link fc_nav_link">
                                        <span>Logout</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- #END# Notifications -->
                        <?php 
                    }  else{
                     ?>
                    <li class="acc_log register">
                        <a href="#" title="register"><img class="ic_acc" src="<?php echo base_url(); ?>assets/images/main/ic_register.png" alt="register" style="margin: -5px 5px 0 0; float: left; padding: 7px; border-radius: 50%; background-color: #1b316a; "/>REGISTER</a>
                    </li>
                    <li class="acc_log login">
                        <a href="#" title="login"><img class="ic_acc" src="<?php echo base_url(); ?>assets/images/main/ic_login.png" alt="login" style="margin: -5px 5px 0 0; float: left; padding: 7px; border-radius: 50%; background-color: #fe8b0c; "/>LOGIN</a>
                    </li>
                    <?php 
                }
                ?>
            </ul>
        </div>
    </div>
</div>
</div>