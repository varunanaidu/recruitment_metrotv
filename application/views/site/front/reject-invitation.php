<?php if ( !defined('BASEPATH' ) )exit('No direct script access allowed');?>

	<div class="col-md-12">
		<div class="card" style="width:400px;margin:30px auto;">
			<div class="header text-center">
				<h3>Decline Invitation</h3>
			</div>
			<div class="body" style="padding:20px 40px">
				<?php echo form_open(base_url().'invitation/submit', ['id' => 'reject-form'])?>
				<div class="row clearfix">
					<div class="col-md-12">
						<div class="alert alert-danger small collapse"></div>
					</div>
					<div class="col-md-12">
						<div class="input-group">
							<textarea name="content_reject" class="form-control" rows="8" style="resize:none;" placeholder="Reason for Decline Invitation *" maxlength="500" required></textarea>
						</div>
					</div>
				</div>
				<div class="row clearfix">
					<div class="col-sm-12">
						<input type="hidden" name="appid" value="<?php echo $appid?>" />
						<input type="hidden" name="callback" value="<?php echo $callback?>" />
						<input type="hidden" name="apptype" value="<?php echo $apptype?>" />
						<button class="btn btn-block btn-lg bg-indigo waves-effect" type="submit">SUBMIT</button>
					</div>
				</div>
				<?php echo form_close()?>
			</div>
		</div>
	</div>