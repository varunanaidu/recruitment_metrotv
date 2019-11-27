<?php if ( !defined('BASEPATH') )exit('No direct script access allowed');
	$ufname = "";
	if ( isset($data) and $data != '0' ){
		foreach($data as $row){
			$ufname = $row->user_f_name;
		}
	}
?>
	<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <ol class="breadcrumb breadcrumb-bg-teal">
					<li><a href="javascript:void(0);"><i class="material-icons">settings</i> Settings</a></li>
					<li class="active"><a href="javascript:void(0);"><i class="material-icons">perm_identity</i> Profile</a></li>
				</ol>
            </div>
			<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
							<div class="row">
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<form method="post" id="change-profile-form">
										<div class="form-group">
											<div class="form-line">
												<input type="text" id="ufname" name="ufname" class="form-control" placeholder="Full name *" maxlength="100" value="<?php echo $ufname?>" required>
											</div>							
										</div>
										<div class="form-group">
											<div class="form-line">
												<input type="text" id="upwd" name="upwd" class="form-control" placeholder="Password *" maxlength="50">
											</div>							
										</div>
										<small>* For editing : Empty password will be same as before</small>
										<br />
										<br />
										<div class="form-group">
											<button type="submit" id="btn-save" class="btn btn-primary waves-effect">SAVE CHANGES</button>
										</div>
									</form>									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
        </div>
    </section>
	<script>var base_url = "<?php echo base_url().SYS_AUTH?>/";</script>
    <!-- Jquery Core Js -->
    <script src="<?php echo base_url()?>media/backend/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap Core Js -->
    <script src="<?php echo base_url()?>media/backend/plugins/bootstrap/js/bootstrap.js"></script>
    <!-- Select Plugin Js -->
    <script src="<?php echo base_url()?>media/backend/plugins/bootstrap-select/js/bootstrap-select.js"></script>
    <!-- Slimscroll Plugin Js -->
    <script src="<?php echo base_url()?>media/backend/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
    <!-- Waves Effect Plugin Js -->
    <script src="<?php echo base_url()?>media/backend/plugins/node-waves/waves.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/3.51/jquery.form.min.js"></script>
    <!-- Custom Js -->
    <script src="<?php echo base_url()?>media/backend/js/admin.js"></script>
	<script src="<?php echo base_url()?>media/backend/js/pages/profile/profile.js"></script>
	<!-- SweetAlert Plugin Js -->
    <script src="<?php echo base_url()?>media/backend/plugins/sweetalert/sweetalert.min.js"></script>
    <!-- Demo Js -->
    <script src="<?php echo base_url()?>media/backend/js/demo.js"></script>