<?php if ( !defined('BASEPATH' ) )exit('No direct script access allowed');?>
	<div class="col-md-12">
		<div class="card" style="width:450px;margin:30px auto;">
			<div class="header text-center">
				<h3>Change Password</h3>
			</div>
			<div class="body" style="padding:20px 40px">
				<form role="form" id="fpass_change_pass" class="form_validation" method="POST">
				<div class="row clearfix">
					<div class="col-md-12">
						<div class="alert alert-danger small collapse"></div>
					</div>
					<div class="col-md-12">
						<div class="input-group">
							<span class="input-group-addon">
								<i class="material-icons">lock</i>
							</span>
							<div class="form-line">
								<input type="password" class="form-control" name="new_pass" placeholder="New Password" required autofocus>
							</div>
						</div>
						<div class="input-group">
							<span class="input-group-addon">
								<i class="material-icons">lock</i>
							</span>
							<div class="form-line">
								<input type="password" class="form-control" name="confirm_pass" placeholder="Confirm Password" required>
							</div>
						</div>
					</div>
					<input type="hidden" name="frm_token" value="<?php echo $token ?>">
					<input type="hidden" name="frm_email" value="<?php echo $email ?>">
				</div>
				<div class="row clearfix">
					<div class="col-sm-12">
						<button id="fpass_updateBtn" class="btn btn-block btn-lg bg-indigo waves-effect" type="submit">SUBMIT</button>
					</div>
				</div>
				</form>
			</div>
		</div>
	</div>