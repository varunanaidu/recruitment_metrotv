<?php if ( !defined('BASEPATH') )exit('No direct script access allowed');?>
<section class="content">
	<div class="container-fluid">
		<div class="block-header">
			<ol class="breadcrumb breadcrumb-bg-teal">
				<li class="active"><a href="javascript:void(0);"><i class="material-icons">computer</i> Vacancy</a></li>
			</ol>
		</div>
		<div class="row clearfix">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card">
					<div class="body">
						<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<button type="button" class="btn btn-primary pull-right waves-effect" id="btn-add">New Vacancy</button>
							</div>
						</div>
						<div class="table-responsive">
							<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
								<thead>
									<tr>
										<th>#</th>
										<th>Unit</th>
										<th>Group</th>
										<th>Vacancy</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									if ( isset($data) and $data != '0') {
										$no = 1;
										foreach($data as $row){
											?>
											<tr>
												<td><?php echo $no?></td>
												<td><?php echo $row->unit_name?></td>
												<td><?php echo $row->name?></td>
												<td><?php echo $row->vacant_title?></td>
												<td><?php echo $row->vacant_status?></td>
												<td>
													<div class="btn-group">
														<button name="primaryBtnV" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">PRIMARY <span class="caret"></span></button>
														<ul class="dropdown-menu">
															<li><a href="javascript:void(0);" class="btn-edit waves-effect waves-block" attr-data="<?php echo $row->vacant_id?>"><i class="material-icons">create</i> Edit</a></li>
															<li><a href="javascript:void(0);" class="btn-remove waves-effect waves-block" attr-data="<?php echo $row->vacant_id?>"><i class="material-icons">clear</i> Remove</a></li>
														</ul>
													</div>
												</td>
											</tr>
											<?php
											$no ++;
										}
									}
									?>
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
	<div class="modal-dialog modal-lg" role="document">
		<form method="POST" id="default-form">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="defaultModalLabel">Vacant</h4>
				</div>
				<div class="modal-body">
					<div class="row clearfix">
						<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
							<label for="v_unit_id">Unit</label>
							<div class="form-group">
								<div class="form-line">
									<select class="form-control show-tick" id="v_unit_id" name="v_unit_id" required>
										<option value="">-- Please Select --</option>
										<?php
											if (isset($vacant_unit) and $vacant_unit != '0'){
												foreach ($vacant_unit as $row){
													echo "<option value='{$row->vacant_unit_id}'>{$row->unit_name}</option>";
												}
											}
										?>
									</select>
								</div>							
							</div>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
							<label for="v_group_id">Group</label>
							<div class="form-group">
								<div class="form-line">
									<select class="form-control show-tick" id="v_group_id" name="v_group_id" required>
									<option value="">-- Please Select --</option>
									</select>
								</div>							
							</div>
						</div>
					</div>
					<div class="row clearfix">
						<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
							<label for="v_title">Title</label>
							<div class="form-group">
								<div class="form-line">
									<input type="text" id="v_title" name="v_title" class="form-control" placeholder="Enter Vacant Title" required>
								</div>							
							</div>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
							<label for="v_code">Vacant Code</label>
							<div class="form-group">
								<div class="form-line">
									<input type="text" id="v_code" name="v_code" class="form-control" placeholder="Enter Vacant Code" required>
								</div>							
							</div>
						</div>
						<!-- <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
							<label for="v_group_id">Vacant Group</label>
							<div class="form-group">
								<div class="form-line">
									<select class="form-control show-tick" id="v_group_id" name="v_group_id" required>
									</select>
								</div>							
							</div>
						</div> -->
					</div>
					<div class="row clearfix">
						<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
							<label>Status Vacant</label>
							<div class="form-group">
								<input name="v_stat" type="radio" checked="" id="radio_4" class="with-gap" value="ACTIVE" /><label for="radio_4">ACTIVE</label>
								<input name="v_stat" type="radio" id="radio_5" class="with-gap" value="NOT ACTIVE" /><label for="radio_5">NOT ACTIVE</label>
							</div>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<label>Open - Close Vacancy</label>
							<div class="form-group">
								<input type="text" name="range_date" id="range_date" readonly="readonly" class="form-control dpicker" placeholder="Choose Range Date" />
							</div>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<label>Candidat Needed</label>
							<div class="form-group">
								<input type="number" name="candidat_needed" id="candidat_needed" class="form-control" placeholder="Choose Candidat" min="1" value="1" />
							</div>
						</div>
					</div>
					<div class="row clearfix">
						<div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
							<label>Vacancy Poster</label>
							<div class="form-group">
								<div class="form-line">
									<input type="file" id="v_poster" name="v_poster" class="form-control" accept=".jpeg, .jpg, .png">
									<small style="color:red;">Maximum image upload 200 Kb, only allowed *.jpg, *.png types, Best Preview 730x350 pixels and above</small>
								</div>
							</div>
						</div>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="content-img">
							<img src="" id="img-data" class="img-responsive" />
						</div>
					</div>
					<label for="v_req">Requirements</label>
					<div class="form-group">
						<div class="form-line">
							<textarea id="v_req" name="v_req" required></textarea>
						</div>
					</div>						
				</div>
				<div class="modal-footer default-footer">
					<input type="hidden" name="id" id="id" /><input type="hidden" name="type" id="type" />
					<button type="submit" id="btn-save" class="btn btn-primary waves-effect">SAVE CHANGES</button>
				</div>
			</div>
		</form>
	</div>
</div>
<script>var base_url = "<?php echo base_url().SYS_AUTH?>/";</script>
<script>var basic_url = "<?php echo base_url()?>";</script>
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
<!-- Ckeditor -->
<script src="<?php echo base_url()?>media/backend/plugins/ckeditor/ckeditor.js"></script>
<!-- Validation Plugin Js -->
<script src="<?php echo base_url()?>media/backend/plugins/jquery-validation/jquery.validate.js"></script>
<!-- SweetAlert Plugin Js -->
<script src="<?php echo base_url()?>media/backend/plugins/sweetalert/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/3.51/jquery.form.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<!-- Custom Js -->
<script src="<?php echo base_url()?>media/backend/js/admin.js"></script>
<script src="<?php echo base_url()?>media/backend/js/pages/vacant/vacant.js?v=1.0.20190918"></script>
<!-- Demo Js -->
<script src="<?php echo base_url()?>media/backend/js/demo.js"></script>