<?php if ( !defined('BASEPATH') ) exit('No direct script access allowed');?>
<?php
	$link = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    $link_array = explode('/',$link);
    $lastpage = explode('?', end($link_array), 2);
	$last = $lastpage[0];
	$last = ($last == "") ? '' : ' - '.ucfirst(str_replace('-',' ',$last));
	$isLogin = $this->session->userdata('fc_recruitment');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<meta name="description" content="MetroTV e-recruitment">
	<meta name="keywords" content="Metro, Metrotv, Lowongan, Karir, Job, Magang, Freelance, Recruitment, E-recruitment">
	<meta name="author" content="MetroTV & FragmentCode">
	<meta name="copyright" content="MetroTV All Rights Reserved">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>E-Recruitment | <?=$site['company']?><?=$last?></title>
    <meta property="og:url" content="<?=current_url()?>">
	<meta property="og:site_name" content="<?=$site['title']?>">
	<meta property="og:image" content="<?=base_url()?>media/site/images/logo_metrotv_s.png">
	<meta property="og:description" content="<?=$site['shortdesc']?>">
	<meta property="og:title" content="<?=$site['title']?><?=$last?>">
	<meta property="og:see_also" content="<?=base_url()?>">
	<meta name="twitter:card" content="summary">
	<meta name="twitter:url" content="<?=current_url()?>">
	<meta name="twitter:title" content="<?=$site['title']?><?=$last?>">
	<meta name="twitter:description" content="<?=$site['shortdesc']?>">
	<meta name="twitter:image" content="<?=base_url()?>media/site/images/logo_metrotv_s.png">
	<link rel="icon" href="<?=base_url()?>favicon.ico" type="image/x-icon">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800%7CShadows+Into+Light" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
    <?php
		if (! empty($files['css'])) {
			foreach ($files['css'] as $css)
				echo "<link href=\"{$css}\" rel=\"stylesheet\" type=\"text/css\"/>".PHP_EOL;
		}
		if (! empty($files['css_custom'])) {
			foreach ($files['css_custom'] as $css)
				echo "<link href=\"{$css}\" rel=\"stylesheet\" type=\"text/css\"/>".PHP_EOL;
		}
	?>
	<noscript>
		<style>
			body>*:not(.warning) { display:none; }
			.warning { height:100vh; background:black; color:white; margin:0; padding:20px 50px; }
		</style>
		<div class="warning">
			<h1>WARNING: JavaScript is disabled in your browser !</h1>
			<p>We will not be able to serve you properly with Javascript disabled in your browser.</p>
			<p>Please enabled JavaScript support in your browser and refresh this page before you continue.</p>
			<p>Here are the instructions <a href="https://www.enable-javascript.com/" target="_blank">how to enable JavaScript in your web browser</a>.</p>
			<p>If you are not sure how to do this, please contact your system administrator.</p>
			<p>- E-RECRUITMENT METRO TV -</p>
		</div>
	</noscript>
</head>
<body>
	<!--div id="fb-root"></div-->
	<!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-indigo">
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
	<div id="main-wrapper">
		<!-- Top Bar -->
		<nav class="navbar">
			<div class="container">
				<div class="navbar-header">
					<?php 
						if ($isLogin) { 
					?>
					<a href="javascript:void(0);" class="navbar-toggle collapsed metro-link" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
					<?php 
						} 
					?>
					<div id="fc_logo"><a href="<?=base_url()?>"><img src="<?=base_url()?>media/site/images/logo_metrotv_s.png" height="40"></a></div>
					<div id="fc_title">E-RECRUITMENT</div>
				</div>
				<?php 
					if ($isLogin) { 
				?>
				<div class="collapse navbar-collapse" id="navbar-collapse">
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown"><a href="<?=base_url()?>" class="metro-link" style="background-color:transparent"><i class="material-icons">home</i></a></li>
						<!-- Notifications -->
						<li class="dropdown">
							<a href="javascript:void(0);" class="dropdown-toggle metro-link" data-toggle="dropdown" role="button" style="background-color:transparent">
							   <span class=""><?=$this->session->userdata('fc_recruitment')->log_email?></span><i class="material-icons">settings</i>
							</a>
							<ul class="dropdown-menu">
								<li class="body">
									<ul class="menu">
										<li>
											<a href="<?=base_url('applicant')?>" class="btn btn-link fc_nav_link">
												<div class="icon-circle bg-orange">
													<i class="material-icons">person</i>
												</div>
												<span>Applicant Data</span>
											</a>
										</li>
										<li>
											<a href="<?=base_url('site/change_password')?>" class="btn btn-link fc_nav_link">
												<div class="icon-circle bg-green">
													<i class="material-icons">lock</i>
												</div>
												<span>Change Password</span>
											</a>
										</li>
										<li>
											<a href="<?=base_url('site/logout')?>" class="btn btn-link fc_nav_link">
												<div class="icon-circle bg-indigo">
													<i class="material-icons">input</i>
												</div>
												<span>Logout</span>
											</a>
										</li>
									</ul>
								</li>
							</ul>
						</li>
						<!-- #END# Notifications -->
					</ul>
				</div>
				<?php 
					}
				?>
			</div>
		</nav>
		<!-- #Top Bar -->
		<div class="main" style="">
			<div class="container" style="margin-top:80px;min-height:100%">
				<!-- ROW -->
				<div class="row clearfix">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">