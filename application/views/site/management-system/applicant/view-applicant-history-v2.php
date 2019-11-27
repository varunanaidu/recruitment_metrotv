<?php if ( !defined('BASEPATH') )exit('No direct script access allowed');
$vacantSelected = isset($vacant_selected) ? $vacant_selected : '';
?>
	<section id="Headerrightsidebar" class="content">
        <div class="container-fluid">
            <div class="block-header">
                <ol class="breadcrumb breadcrumb-bg-teal">
					<li><a href="javascript:void(0);"><i class="material-icons">group</i> Applicant</a></li>
					<li class="active"><a href="javascript:void(0);"><i class="material-icons">history</i> History</a></li>
				</ol>
            </div>
			<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
							<div class="row">
								<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
									<div class="form-group">
										<div class="form-line">
											<label>Vacant</label>
											<select name="vac_id" id="vac_id" class="form-control show-tick" required>
												<option value="" <?=($vacantSelected == '') ? 'selected' : ''?>>- Choose -</option>
												<option value="ALL" <?=($vacantSelected == 'ALL') ? 'selected' : ''?>>- ALL -</option>
												<?php
													if ( isset($data_vacant) and $data_vacant != '0' ){
														foreach($data_vacant as $row){
															$selected = ($vacantSelected == $row->vacant_id) ? 'selected' : '';	
															echo "<option value=\"{$row->vacant_id}\" {$selected}>{$row->vacant_title} ({$row->a} s/d {$row->b}) - {$row->total_candidat} Applicants</option>";
														}
													}
												?>
											</select>
										</div>
									</div>									
								</div>
								<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
									<a href="javascript:void(0);" class="btn btn-danger collapse-side-bar"><i class="glyphicon glyphicon-resize-full"></i></a>
								</div>
							</div>
							<div class="table-responsive">
								<table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="tbl-applicant-history">
									<thead>
										<tr>
											<th class="text-center">#AppID</th>                                        
											<th class="text-center">Name</th>
											<th class="text-center">Gender/Age/Status</th>
											<th class="text-center">Education</th>
											<th class="text-center">Major/GPA</th>
											<th class="text-center">Latest Job</th>
											<th class="text-center">Latest Salary</th>
											<th class="text-center">Domisili</th>
											<th class="text-center">Vacant</th>
											<th class="text-center">Status</th>
											<th class="text-center">Action</th>
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
	<div class="modal fade" id="move-pos-modal" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<form method="POST" id="move-pos-form">
					<div class="modal-header">
						<h4 class="modal-title" id="actionModalLabel">CHANGE CANDIDAT POSITION</h4>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<div class="form-line">
								<label>Choose Vacancy</label>
								<select name="vac_move" id="vac_move" class="form-control show-tick" required>
									<option value="">- Choose -</option>
									<?php
										if ( isset($data_vacant) and $data_vacant != '0' ){
											foreach($data_vacant as $row)
												echo "<option value=\"{$row->vacant_id}\">{$row->vacant_title}</option>";
										}
									?>
								</select>
							</div>
						</div>
					</div>
					<div class="modal-footer default-footer">
						<p class="alert collapse"></p>
						<input type="hidden" name="id_move" id="id_move" />
						<button type="submit" class="btn btn-primary waves-effect">CHANGE</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div id="print_preview" class="modal fade" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content" style="height:600px;">
				<iframe id="pview"  style="width:100%;height:100%;" src=""></iframe>
			</div>
		</div>
	</div>
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
	<!-- Jquery DataTable Plugin Js -->
    <script src="<?php echo base_url()?>media/backend/plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="<?php echo base_url()?>media/backend/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
	 <!-- Select Plugin Js -->
    <script src="<?php echo base_url()?>media/backend/plugins/bootstrap-select/js/bootstrap-select.js"></script>
	<!-- SweetAlert Plugin Js -->
    <script src="<?php echo base_url()?>media/backend/plugins/sweetalert/sweetalert.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/3.51/jquery.form.min.js"></script>
    <!-- Custom Js -->
    <script src="<?php echo base_url()?>media/backend/js/admin.js"></script>
	<script src="<?php echo base_url()?>media/backend/js/pages/applicant/applicant-history.js?v=20190614"></script>	
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
	</script>