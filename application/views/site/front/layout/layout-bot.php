<?php if ( !defined('BASEPATH') ) exit('No direct script access allowed');?>

</div>
</div>
<!-- #END ROW -->
</div>
<!-- #END CONTAINER -->
</div>
<!-- #END MAIN -->
<footer class="m-t-30">
	<div id="footer-copyright">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<?php 
					$show_year = (date('Y') == $site['year']) ? $site['year'] : $site['year'].' - '.date('Y');
					?>
					<p class="margin-0">&copy; <?=$show_year?> <?=$site['company']?>. All Rights Reserved.</p>
				</div>
			</div>
		</div>
	</div>
</footer>
</div>
<!-- #END MAIN-WRAPPER -->
<!-- MODAL -->
<?php if (!$isLogin) { ?>
	<div class="modal fade" id="modal_resend_verification" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-fc" role="document">
			<div class="modal-content">
				<?php echo form_open('', ['id' => 'frm_resend_verification', 'autocomplete' => 'off'])?>
				<div class="modal-header text-center">
					<img src="<?=base_url()?>media/site/images/logo_metrotv.png">
					<h4 class="modal-title" id="" style="margin-top:10px;font-family:Verdana;text-shadow:2px 2px 5px #AAA;">Re-send Activation Email</h4>
				</div>
				<div class="modal-body" id="">
					<div id="resend_alert" class="alert alert-danger small collapse"></div>
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group form-float">
								<div class="form-line">
									<input type="text" class="form-control" name="frm_verify_email" data-rule-email="true" required>
									<label class="form-label">Email Address</label>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<button class="btn btn-block btn-lg bg-indigo waves-effect btn-fc" type="submit" id="fc_btn_resend">SEND</button>
						</div>
					</div>
				</div>
				<?php echo form_close()?>
			</div>
		</div>
	</div>
	<div class="modal fade" id="modal_forgot_pass" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-fc" role="document">
			<div class="modal-content">
				<?php echo form_open('', ['id' => 'frm_forgot_pass', 'autocomplete' => 'off'])?>
				<div class="modal-header text-center">
					<img src="<?=base_url()?>media/site/images/logo_metrotv.png">
					<h4 class="modal-title" id="" style="margin-top:10px;font-family:Verdana;text-shadow:2px 2px 5px #AAA;">Forgot Password</h4>
				</div>
				<div class="modal-body" id="">
					<div id="forgot_alert" class="alert alert-danger small collapse"></div>
					<div class="row">
						<div class="col-sm-12 m-b-20 text-center" style="font-size:13px">
							Please enter your email address below<br>We will send you an email that will allow you to reset your password
						</div>
						<div class="col-sm-12">
							<div class="form-group form-float">
								<div class="form-line">
									<input type="text" class="form-control" name="frm_email" data-rule-email="true" required>
									<label class="form-label">Email Address</label>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<button class="btn btn-block btn-lg bg-indigo waves-effect btn-fc" type="submit" id="fc_btn_forgot">SEND</button>
						</div>
					</div>
				</div>
				<?php echo form_close()?>
			</div>
		</div>
	</div>
<?php } ?>
<?php if (isset($login_popup) and ($login_popup === 'true') and !$isLogin) { ?>
	<div class="modal fade" id="modal_login_popup" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-fc" role="document">
			<div class="modal-content">
				<?php echo form_open('', ['id' => 'frm_sign_in_popup', 'autocomplete' => 'off'])?>
				<div class="modal-header text-center">
					<img src="<?=base_url()?>media/site/images/logo_metrotv.png">
					<h4 class="modal-title" id="" style="margin-top:10px;font-family:Verdana;text-shadow:2px 2px 5px #AAA;">Login e-Recruitment</h4>
				</div>
				<div class="modal-body" id="">
					<div id="pop_signin_alert" class="alert alert-danger small collapse"></div>
					<div class="row m-t-10">
						<div class="col-sm-12">
							<div class="form-group form-float">
								<div class="form-line">
									<input type="text" class="form-control" name="frm_email" data-rule-email="true" required>
									<label class="form-label">Email</label>
								</div>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group form-float">
								<div class="form-line">
									<input type="password" class="form-control" name="frm_pwd" required>
									<label class="form-label">Password</label>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 text-center" style="margin:5px 0;">
							<div class="g-recaptcha" data-sitekey="" style="display:inline-block;"></div>
						</div>
					</div>
					<div class="row m-t-10">
						<div class="col-sm-12">
							<button class="btn btn-block btn-lg bg-indigo waves-effect btn-fc" type="submit" id="fc_pop_signin">LOGIN</button>
						</div>
					</div>
				</div>
				<?php echo form_close()?>
			</div>
		</div>
	</div>
<?php } ?>
<!-- #END MODAL -->	
<script>var _base_url = "<?=base_url()?>"</script>
<?php
if (!empty($files['js'])) {
	foreach($files['js'] as $js)
		echo "<script src=\"{$js}\"></script>".PHP_EOL;
}

if (!empty($files['js_custom'])) {
	foreach($files['js_custom'] as $js)
		echo "<script src=\"{$js}\"></script>".PHP_EOL;
}

if (isset($login_popup) and ($login_popup === 'true') and !$isLogin) {
	echo "<script>$(function(){ $('#modal_login_popup').modal('show'); });</script>";
}

$msg = $this->session->flashdata('fc_alert');
if ($msg) { 
	$title 	= ($msg['type'] == "done") ? "Success!" : "Oops!";
	$type 	= ($msg['type'] == "done") ? "success" : "warning";
	$text	= $msg['msg'];
	echo "<script>swal({ title:'{$title}', text:'{$text}', type:'{$type}', html:true });</script>";
}
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/3.51/jquery.form.min.js"></script>
<?php if (isset($confirm_popup) and ($confirm_popup === 'true') and $isLogin and (!empty($vacancy_title) and !empty($vacancy_id))) { ?>
	<script>
		swal({
			title: "<?=$vacancy_title?>",
			text: "Are you sure want to apply this vacancy?<br><div class='m-t-10 italic'>Please kindly remember to update your <a href='<?=base_url('applicant/?v='.$vacancy_id)?>'>applicant data</a>.</div>",
			type: "warning",
			html: true,
			showCancelButton: true,
			closeOnConfirm: false,
			showLoaderOnConfirm: true,
		}, function() {
			setTimeout(function() {
				$.ajax({
					type: "POST",
					url: "<?=$this->session->userdata('referred_to')?>",
					dataType: "json",
					success: function (data) {
						if(data.type == 'done') {
							swal({ title: "Application submitted!", text: "Thank you! We have received your application.", type: "success" }, function() { 
								window.location.href = _base_url; 
							});
						}
						else {
							swal({ title: "Failed to apply", type: "warning", text: data.msg, html: true }, function() {
								window.location.href = _base_url;
							});
						}
					}
				});
			}, 2000);
		});

		$().ready(function() {

			$('#fpass_change_pass').ajaxForm({
				url : base_url + "site/update_forgot_password",
				dataType : "JSON",
				beforeSubmit : function(){
					$("#fpass_updateBtn").html ( "Please wait..." ).removeClass("btn-primary").addClass("btn-warning").prop("disabled", true);
				},
				success : function(data){
					if ( data.type == 'done' ){
						swal({
							title : "Success!", 
							text : data.msg, 
							type : "success"
						}, 
						function(){
							window.location.reload();
						}
						);
					}
					else{
						swal({
							title : "Error!", 
							text : data.msg, 
							type : "error"
						}, 
						function(){
							swal.close();
							$("#fpass_updateBtn").html ( "SAVE CHANGES" ).removeClass("btn-warning").addClass("btn-primary").prop("disabled", false);
						}
						);
					}
				}
			});
		});
	</script>
<?php } ?>
</body>
</html>