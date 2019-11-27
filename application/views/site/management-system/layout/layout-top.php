<?php if (!defined('BASEPATH') )exit('No direct script access allowed');?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="robots" content="noindex,nofollow">
    <title>E &ndash; Recruitment | Metro TV</title>
    <!-- Favicon-->
    <link rel="icon" href="<?php echo base_url()?>media/backend/images/favicon.ico" type="image/x-icon">
	<?php $this->load->view(SYS_FILE."layout/css.loader/{$css_loader}.php")?>
	<style>.navbar{background-color:#123456 !important;}</style>
</head>

<body class="theme-blue">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-blue">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <!--div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div-->
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    <nav class="navbar" id="Headernavbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="<?php echo base_url().SYS_AUTH?>">E &ndash; Recruitment | Metro TV</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <!-- Call Search -->
                    <!--li><a href="javascript:void(0);" class="js-search" data-close="true"><i class="material-icons">search</i></a></li-->
                    <!-- #END# Call Search -->
					<li><a href="<?php echo base_url()?>" target="_blank"><i class="material-icons">web</i></a></li>
					<li><a href="<?php echo base_url().SYS_AUTH."/profile"?>"><i class="material-icons">perm_identity</i></a></li>
					<li><a href="<?php echo base_url()?>auth/checkout"><i class="material-icons">power_settings_new</i></a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
    <section id="Headerleftsidebar">
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="<?php echo base_url()?>media/backend/images/logo.png" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name"><?php echo $this->session->userdata(SES_END)->log_name?></div>                    
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">MAIN NAVIGATION</li>
                    <li <?php echo ( isset($header_menu) and $header_menu == 'dashboard' ) ? ' class="active"' : '';?>>
                        <a href="<?php echo base_url().SYS_AUTH?>">
                            <i class="material-icons">home</i>
                            <span>Home</span>
                        </a>
                    </li>
					<li <?php echo ( isset($header_menu) and $header_menu == 'calendar' ) ? ' class="active"' : '';?>>
                        <a href="<?php echo base_url().SYS_AUTH?>/calendar">
                            <i class="material-icons">date_range</i>
                            <span>Calendar</span>
                        </a>
                    </li>
					<li <?php echo ( isset($header_menu) and $header_menu == 'settings' ) ? ' class="active"' : '';?>>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">settings</i>
                            <span>Settings</span>
                        </a>
                        <ul class="ml-menu">
							<?php if ( $this->session->userdata(SES_END)->log_role == "1" ){?>
							<li <?php echo ( isset($header_child) and $header_child == 'users' ) ? 'class="active"' : '';?>>
                                <a href="<?php echo base_url().SYS_AUTH?>/users">Users</a>
                            </li>
							<?php }?>
							<li <?php echo ( isset($header_child) and $header_child == 'slideshow' ) ? 'class="active"' : '';?>>
                                <a href="<?php echo base_url().SYS_AUTH?>/slideshow">Slideshow</a>
                            </li>
                            <li <?php echo ( isset($header_child) and $header_child == 'university' ) ? 'class="active"' : '';?>>
                                <a href="<?php echo base_url().SYS_AUTH?>/university">University</a>
                            </li>                      
                            <li <?php echo ( isset($header_child) and $header_child == 'editorial' ) ? ' class="active"' : '';?>>
                                <a href="<?php echo base_url().SYS_AUTH?>/editorial">Editorial Picks</a>
                            </li>
                            <li <?php echo ( isset($header_child) and $header_child == 'testimoni' ) ? ' class="active"' : '';?>>
                                <a href="<?php echo base_url().SYS_AUTH?>/testimoni">Testimoni</a>
                            </li>
                            <li <?php echo ( isset($header_child) and $header_child == 'activities' ) ? ' class="active"' : '';?>>
                                <a href="<?php echo base_url().SYS_AUTH?>/activities">Activities</a>
                            </li>
                            <li <?php echo ( isset($header_child) and $header_child == 'faq' ) ? ' class="active"' : '';?>>
                                <a href="<?php echo base_url().SYS_AUTH?>/faq">FAQ</a>
                            </li>      
							            
                        </ul>
                    </li>

                    <li <?php echo ( isset($header_menu) and $header_menu == 'vacant' ) ? ' class="active"' : '';?>>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">computer</i>
                            <span>Vacancy</span>
                        </a>
                        <ul class="ml-menu">
                            <li <?php echo ( isset($header_child) and $header_child == 'vacant' ) ? ' class="active"' : '';?>>
                                <a href="<?php echo base_url().SYS_AUTH?>/vacant">Vacancy List</a>
                            </li>
                            <li <?php echo ( isset($header_child) and $header_child == 'vacant_group' ) ? ' class="active"' : '';?>>
                                <a href="<?php echo base_url().SYS_AUTH?>/vacantGroup">Vacancy Group</a>
                            </li>
                            <li <?php echo ( isset($header_child) and $header_child == 'vacant_unit' ) ? ' class="active"' : '';?>>
                                <a href="<?php echo base_url().SYS_AUTH?>/vacantUnit">Vacancy Unit</a>
                            </li>
                        </ul>
                    </li>

					<!-- <li<?php echo ( isset($header_menu) and $header_menu == 'vacant' ) ? ' class="active"' : '';?>>
                        <a href="<?php echo base_url().SYS_AUTH?>/vacant">
                            <i class="material-icons">computer</i>
                            <span>Vacancy</span>
                        </a>
                    </li> -->
                    <li <?php echo ( isset($header_menu) and $header_menu == 'applicant' ) ? ' class="active"' : '';?>>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">group</i>
                            <span>Applicant</span>
                        </a>
                        <ul class="ml-menu">
                            <li <?php echo ( isset($header_child) and $header_child == 'manage' ) ? ' class="active"' : '';?>>
                                <a href="<?php echo base_url().SYS_AUTH?>/applicant">Manage</a>
                            </li>
                            <li <?php echo ( isset($header_child) and $header_child == 'history' ) ? ' class="active"' : '';?>>
                                <a href="<?php echo base_url().SYS_AUTH?>/applicant/history">History</a>
                            </li>
                            <li <?php echo ( isset($header_child) and $header_child == 'candidate' ) ? ' class="active"' : '';?>>
                                <a href="javascript:void(0)">Candidate</a>
                            </li>
                        </ul>
                    </li>
                    <li <?php echo ( isset($header_menu) and $header_menu == 'template' ) ? ' class="active"' : '';?>>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">language</i>
                            <span>Template</span>
                        </a>
                        <ul class="ml-menu">
                            <li <?php echo ( isset($header_child) and $header_child == 'template' ) ? 'class="active"' : '';?>>
                                <a href="<?php echo base_url().SYS_AUTH?>/template">Template Email</a>
                            </li>
							<li <?php echo ( isset($header_child) and $header_child == 'template-venue' ) ? 'class="active"' : '';?>>
                                <a href="<?php echo base_url().SYS_AUTH?>/temp_venue">Template Venue</a>
                            </li>                
                        </ul>
                    </li>
					<li <?php echo ( isset($header_menu) and $header_menu == 'reporting' ) ? ' class="active"' : '';?>>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">timeline</i>
                            <span>Reporting</span>
                        </a>
                        <ul class="ml-menu">
                            <li <?php echo ( isset($header_child) and $header_child == 'global' ) ? ' class="active"' : '';?>>
                                <a href="<?php echo base_url().SYS_AUTH?>/reporting">Global</a>
                            </li>
							<li <?php echo ( isset($header_child) and $header_child == 'candidat-progress' ) ? ' class="active"' : '';?>>
                                <a href="<?php echo base_url().SYS_AUTH?>/reporting/candidat-progress">Candidat Progress</a>
                            </li>
                        </ul>
                    </li>
                    <li <?php echo ( isset($header_menu) and $header_menu == 'qr_code' ) ? ' class="active"' : '';?>>
                        <a href="<?php echo base_url().SYS_AUTH?>/qr_code">
                            <i class="material-icons">border_outer</i>
                            <span>QR Code</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; 2017 <a href="<?php echo base_url().SYS_AUTH?>">E &ndash; Recruitment | Metro TV</a>.
                </div>
                <div class="version">
                    <b>Version: </b> 1.0.0
                </div>
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
    </section>