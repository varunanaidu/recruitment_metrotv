<?php if ( !defined('BASEPATH') )exit('No direct script access allowed');?>
<section id="Headerrightsidebar" class="content">
	<div class="container-fluid">
		<div class="block-header">
			<ol class="breadcrumb breadcrumb-bg-teal">
				<li><a href="javascript:void(0);"><i class="material-icons">group</i> Applicant</a></li>
				<li class="active"><a href="javascript:void(0);"><i class="material-icons">settings</i> Candidate</a></li>
			</ol>
		</div>
		<div class="row clearfix">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card">
					<div class="body">
						<div class="row">								
							<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
								<label>Candidate</label>
								<div class="form-group">
									<div class="form-line">
									</div>
								</div>									
							</div>
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
								<!-- <a href="javascript:void(0);" class="btn btn-primary btn-create"><i class="material-icons">add</i></a> -->
								<a href="javascript:void(0);" class="btn btn-danger collapse-side-bar"><i class="glyphicon glyphicon-resize-full"></i></a>
							</div>
						</div>
						<div class="table-responsive">
							<table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="tbl-applicant">
								<thead>
									<tr>
										<th class="text-center">#CandidateID</th>
										<th class="text-center">Name</th>
										<th class="text-center">Gender/Age/Status</th>
										<th class="text-center">Education</th>
										<th class="text-center">Major/GPA</th>
										<th class="text-center">Latest Job</th>
										<th class="text-center">Latest Salary</th>
										<th class="text-center">Domisili</th>
										<!-- <th class="text-center">Vacant</th> -->
										<!-- <th class="text-center">Progress</th> -->
										<!-- <th class="text-center">Action</th> -->
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">			
		<div class="modal-content">
			<img src="" id="model-image" class="img-responsive" style="width:100%;" />
		</div>
	</div>
</div>
<div class="modal fade" id="actionModal" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="actionModalLabel">Action</h4>
			</div>
			<div class="modal-body">

			</div>
			<div class="modal-footer default-footer">
				<button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="detail-test-modal" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">			
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="detait-test-modal-header"></h4>
			</div>
			<div class="modal-body">

			</div>
			<div class="modal-footer default-footer">
				<button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
			</div>
		</div>
	</div>
</div>
<!-- <div class="modal fade" id="call-test-modal" tabindex="-1" role="dialog">
<div class="modal-dialog" role="document">
<form method="POST" id="call-test-form">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title" id="call-test-label">Test</h4>
</div>
<div class="modal-body">
<div class="row clearfix">
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
<div class="form-group">
<label>Date & Time</label>
<div class="form-line">
<input type="text" name="test_time" class="datetimepicker form-control" placeholder="Choose date & time *" required />
</div>
</div>
</div>
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
<div class="form-group">
<label>Venue</label>
<div class="form-line">
<select name="test_location" class="form-control show-tick" required>
<option value="">- Choose Template Venue * -</option>
<?php
if ( isset($data_venue) and $data_venue != '0' ){
foreach($data_venue as $row)
echo "<option value=\"{$row->tv_id}\">{$row->tv_name}	</option>";
}
?>
</select>
</div>
</div>
</div>
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
<div class="form-group">
<label>PIC</label>
<div class="form-line">
<input type="text" name="test_pic" class="form-control" placeholder="Person In Charge *" required />
</div>
</div>
</div>
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
<div class="form-group">
<label>Template Email</label>
<div class="form-line">
<select name="temp_email" class="form-control show-tick" required>
<option value="">- Choose Template Email * -</option>
<?php
if ( isset($data_email) and $data_email != '0' ){
foreach($data_email as $row)
echo "<option value=\"{$row->template_id}\">{$row->template_name}	</option>";
}
?>
</select>
</div>
</div>
</div>
</div>
</div>
<div class="modal-footer default-footer">
<p class="alert text-center collapse"></p>
<input type="hidden" name="test_key" id="test_key" />
<input type="hidden" name="test_vac" id="test_vac" />
<input type="hidden" name="test_id" id="test_id" />
<input type="hidden" name="test_button" id="test_button" />
<button type="button" id="btn-save" class="btn btn-danger waves-effect">SAVE</button>
<button type="button" id="btn-save-send" class="btn btn-primary waves-effect">SAVE & SEND</button>
</div>
</div>
</form>
</div>
</div> -->

<!-- <div class="modal fade" id="process-test-modal" tabindex="-1" role="dialog">
<div class="modal-dialog" role="document">
<form method="POST" id="process-test-form" enctype="multipart/form-data">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title" id="process-test-label">Process Candidate</h4>
</div>
<div class="modal-body">
<div class="row clearfix">
<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
<div class="form-group">
<label>status</label>
<div class="form-line">
<select name="process_status" class="form-control show-tick" required>
<option value="">- Choose -</option>
<option value="Passed">Passed</option>
<option value="Failed">Failed</option>
</select>
</div>
</div>
</div>
<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
<div class="form-group">
<label>Process Date & Time</label>
<div class="form-line">
<input type="text" name="process_time" class="datetimepicker form-control" placeholder="Please choose date & time..." required />
</div>
</div>
</div>
<div class="col-xs-12">
<div class="form-group">
<label>Attachment</label>
<input type="file" name="file" class="form-control" accept=".pdf" />
<small style="color:red;">Allowed extension .pdf, Maximum pdf size 200 Kb.</small>
</div>
</div>
<div class="col-xs-12">
<div class="form-group">
<label>Remarks</label>
<div class="form-line">
<textarea name="process_remarks" class="form-control" placeholder="Enter Remarks..."></textarea>
</div>
</div>
</div>
</div>
</div>
<div class="modal-footer default-footer">
<p class="alert text-center collapse"></p>
<input type="hidden" name="process_key" id="process_key" />
<input type="hidden" name="process_vac" id="process_vac" />
<input type="hidden" name="process_id" id="process_id" />
<button type="submit" class="btn btn-primary waves-effect">SAVE</button>
</div>
</div>
</form>
</div>
</div> -->

<!-- <div class="modal fade" id="approval-test-modal" tabindex="-1" role="dialog">
<div class="modal-dialog" role="document">
<form method="POST" id="approval-test-form">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title" id="approval-test-label">Process Candidate</h4>
</div>
<div class="modal-body">
<div class="form-group">
<label>status</label>
<div class="form-line">
<select name="approval_status" class="form-control show-tick" required>
<option value="">- Choose -</option>
<option value="Passed">Passed</option>
<option value="Failed">Failed</option>
</select>
</div>
</div>
<div class="form-group">
<label>Process Date & Time</label>
<div class="form-line">
<input type="text" name="approval_time" class="datetimepicker form-control" placeholder="Please choose date & time..." required />
</div>
</div>
<div class="form-group">
<label>Remarks</label>
<div class="form-line">
<textarea name="approval_remarks" class="form-control" placeholder="Enter Remarks..."></textarea>
</div>
</div>						
</div>
<div class="modal-footer default-footer">
<p class="alert text-center collapse"></p>
<input type="hidden" name="approval_key" id="approval_key" />
<input type="hidden" name="approval_id" id="approval_id" />
<button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
<button type="submit" class="btn btn-primary waves-effect">Save</button>
</div>
</div>
</form>
</div>
</div> -->

<!-- modal for creating candidat -->
<!-- <div class="modal fade" id="new-cnd-modal" tabindex="-1" role="dialog">
<div class="modal-dialog" role="document">
<form method="POST" id="new-cnd-form">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title" id="new-cnd-label">New Candidate</h4>
</div>
<div class="modal-body">
<div class="form-group">
<div class="form-line">
<input type="text" name="cnd_name" class="form-control" placeholder="Candidate Name *" required />
</div>
</div>
<div class="form-group">
<div class="form-line">
<input type="email" name="cnd_email" class="form-control" placeholder="Candidate Email *" required />
</div>
</div>
</div>
<div class="modal-footer default-footer">
<p class="alert text-center collapse"></p>
<button type="submit" class="btn btn-primary waves-effect">Create</button>
</div>
</div>
</form>
</div>
</div> -->

<!-- modal for attachment candidat -->
<!-- <div class="modal fade" id="attachment-modal" tabindex="-1" role="dialog">
<div class="modal-dialog" role="document">
<form method="POST" id="attachment-form" enctype="multipart/form-data">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title" id="new-cnd-label">Attachment</h4>
</div>
<div class="modal-body">
<div class="form-group">
<div class="form-line">
<input type="file" name="attachment_file" class="form-control" required accept=".pdf" />
<small style="color:red;">Allowed extension .pdf, Maximum pdf size 200 Kb.</small>
</div>
</div>
<div class="form-group">
<a target="_blank" id="target-attachment">Preview Attachment</a>
</div>
</div>
<div class="modal-footer default-footer">
<input type="hidden" name="attachmentid" id="attachmentid" />
<input type="hidden" name="attachmenttype" id="attachmenttype" />
<button type="submit" class="btn btn-primary waves-effect">Upload</button>
</div>
</div>
</form>
</div>
</div> -->

<div id="print_preview" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content" style="height:600px;">
			<iframe id="pview"  style="width:100%;height:100%;" src=""></iframe>
		</div>
	</div>
</div>

<script>var base_url = "<?php echo base_url().SYS_AUTH?>/"; var basic_url = "<?=base_url()?>";</script>
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
<!-- SweetAlert Plugin Js -->
<script src="<?php echo base_url()?>media/backend/plugins/sweetalert/sweetalert.min.js"></script>
<!-- Moment Plugin Js -->
<script src="<?php echo base_url()?>media/backend/plugins/momentjs/moment.js"></script>
<!-- Bootstrap Material Datetime Picker Plugin Js -->
<script src="<?php echo base_url()?>media/backend/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
<!-- Jquery DataTable Plugin Js -->
<script src="<?php echo base_url()?>media/backend/plugins/jquery-datatable/jquery.dataTables.js"></script>
<script src="<?php echo base_url()?>media/backend/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
<!-- Select Plugin Js -->
<script src="<?php echo base_url()?>media/backend/plugins/bootstrap-select/js/bootstrap-select.js"></script>
<!-- Validation Plugin Js -->
<script src="<?php echo base_url()?>media/backend/plugins/jquery-validation/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/3.51/jquery.form.min.js"></script>
<!-- Custom Js -->
<script src="<?php echo base_url()?>media/backend/js/admin.js"></script>
<script src="<?php echo base_url()?>media/backend/js/pages/applicant/applicant-candidate.js"></script>
<!-- Demo Js -->
<script src="<?php echo base_url()?>media/backend/js/demo.js"></script>
<script>
	$(document).ready(function(){
		$(".collapse-side-bar").on("click", function(e){
			e.preventDefault();        
			var $this = $(this);			
			if ($this.children('i').hasClass('glyphicon-resize-full'))
			{
				$("#Headerrightsidebar").removeClass("content").addClass("content-fullscreen");					
				$this.children('i').removeClass('glyphicon-resize-full');
				$this.children('i').addClass('glyphicon-resize-small');
				$(".block-header").hide();
			}
			else if ($this.children('i').hasClass('glyphicon-resize-small'))
			{
				$("#Headerrightsidebar").removeClass("content-fullscreen").addClass("content");
				$this.children('i').removeClass('glyphicon-resize-small');
				$this.children('i').addClass('glyphicon-resize-full');
				$(".block-header").show();
			}
			$("#Headerleftsidebar").toggle("slow");
			$("#Headernavbar").toggle("slow");				
		});
	});
</script>]