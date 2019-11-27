<?php if ( !defined('BASEPATH') )exit('No direct script access allowed');?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>E&ndash;Recruitment | Metro TV</title>
    <!-- Favicon-->
    <link rel="icon" href="<?php echo base_url()?>media/backend/images/favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="<?php echo base_url()?>media/backend/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="<?php echo base_url()?>media/backend/plugins/node-waves/waves.min.css" rel="stylesheet" />
	<!-- Sweetalert Css -->
    <link href="<?php echo base_url()?>media/backend/plugins/sweetalert2/sweetalert2.min.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="<?php echo base_url()?>media/backend/plugins/animate-css/animate.min.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="<?php echo base_url()?>media/backend/css/style.min.css" rel="stylesheet">
</head>

<body class="login-page">
    <div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);"><b>METRO TV</b></a>
            <small>E&ndash;Recruitment | Management System</small>
        </div>
        <div class="card">
            <div class="body">
                <form id="sign_in" method="POST">
                    <div class="msg">Sign in to start your session</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="username" placeholder="Username" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <button class="btn btn-block bg-pink waves-effect" type="submit" id="btn-sign-in">SIGN IN</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
	<script>var base_url = "<?php echo base_url()?>";</script>
    <!-- Jquery Core Js -->
    <script src="<?php echo base_url()?>media/backend/plugins/jquery/jquery-3.4.1.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="<?php echo base_url()?>media/backend/plugins/bootstrap/js/bootstrap.min.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="<?php echo base_url()?>media/backend/plugins/node-waves/waves.min.js"></script>

    <!-- Validation Plugin Js -->
    <script src="<?php echo base_url()?>media/backend/plugins/jquery-validation/jquery.validate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/3.51/jquery.form.min.js"></script>
	<!-- SweetAlert Plugin Js -->
    <script src="<?php echo base_url()?>media/backend/plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- Custom Js -->
    <script src="<?php echo base_url()?>media/backend/js/admin.js"></script>
    <script src="<?php echo base_url()?>media/backend/js/pages/examples/sign-in.js"></script>
</body>

</html>