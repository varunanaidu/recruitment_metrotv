<?php if ( !defined('BASEPATH' ) )exit('No direct script access allowed');?>

	<div class="col-md-12">
		<div class="card" style="width:400px;margin:30px auto;">
			<div class="header text-center">
				<h3>Change Password</h3>
			</div>
			<div class="body" style="padding:20px 40px">
				<form role="form" method="POST" class="form_validation" id="change_pass">
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
								<input type="password" class="form-control" name="old_pass" placeholder="Old Password" data-rule-minlength="8" required autofocus>
							</div>
						</div>
						<div class="input-group">
							<span class="input-group-addon">
								<i class="material-icons">lock</i>
							</span>
							<div class="form-line">
								<input type="password" class="form-control" name="new_pass" placeholder="New Password" data-rule-minlength="8" required>
							</div>
						</div>
						<div class="input-group">
							<span class="input-group-addon">
								<i class="material-icons">lock</i>
							</span>
							<div class="form-line">
								<input type="password" class="form-control" name="confirm_pass" data-rule-minlength="8" data-rule-equalTo="[name='new_pass']" placeholder="Confirm Password" required>
							</div>
						</div>
					</div>
				</div>
				<div class="row clearfix">
					<div class="col-sm-12">
						<button id="change_passBtn" class="btn btn-block btn-lg bg-indigo waves-effect" type="submit">SUBMIT</button>
					</div>
				</div>
				</form>
			</div>
		</div>
	</div>