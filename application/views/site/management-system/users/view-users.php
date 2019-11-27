<?php if ( !defined('BASEPATH') )exit('No direct script access allowed');?>
	<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <ol class="breadcrumb breadcrumb-bg-teal">
					<li><a href="javascript:void(0);"><i class="material-icons">settings</i> Settings</a></li>
					<li class="active"><a href="javascript:void(0);"><i class="material-icons">person_add</i> Users</a></li>
				</ol>
            </div>
			<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
							<div class="row">
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<button type="button" class="btn btn-primary pull-right waves-effect" id="btn-add">New Users</button>
								</div>
							</div>
							<div class="table-responsive">								
								<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
									<thead>
										<tr>
											<th>#</th>
											<th>Username</th>
											<th>Fullname</th>
												<th>Status</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
									<?php
										if ( isset($data) and $data != '0' ){
											$no = 1;
											foreach($data as $row){
												echo "
													<tr>
														<td>{$no}</td>
														<td>{$row->user_name}</td>
														<td>{$row->user_f_name}</td>
														<td>{$row->user_status}</td>
														<td>
															<div class=\"btn-group\">
																<button type=\"button\" class=\"btn btn-primary dropdown-toggle\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"true\">PRIMARY <span class=\"caret\"></span></button>
																<ul class=\"dropdown-menu\">
																	<li><a href=\"javascript:void(0);\" class=\"btn-edit waves-effect waves-block\" attr-data=\"{$row->user_id}\"><i class=\"material-icons\">create</i> Edit</a></li>
																	<li><a href=\"javascript:void(0);\" class=\"btn-remove waves-effect waves-block\" attr-data=\"{$row->user_id}\"><i class=\"material-icons\">clear</i> Remove</a></li>
																</ul>
															</div>
														</td>
													</tr>
												";
												
												$no++;
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
		<div class="modal-dialog" role="document">
			<form method="POST" id="default-form">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="defaultModalLabel">Users</h4>
					</div>
					<div class="modal-body">
						<div class="row clearfix">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">								
								<div class="form-group">
									<div class="form-line">
										<input type="text" id="uname" name="uname" class="form-control" placeholder="Username *" maxlength="20" required>
									</div>							
								</div>
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">								
								<div class="form-group">
									<div class="form-line">
										<input type="text" id="ufname" name="ufname" class="form-control" placeholder="Full name *" maxlength="100" required>
									</div>							
								</div>
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">								
								<div class="form-group">
									<div class="form-line">
										<input type="text" id="upwd" name="upwd" class="form-control" placeholder="Password *" maxlength="50">
									</div>							
								</div>
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">		
								<small style="color:red;">* For editing : Empty password will be same as before</small>
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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/3.51/jquery.form.min.js"></script>
    <!-- Custom Js -->
    <script src="<?php echo base_url()?>media/backend/js/admin.js"></script>
	<script src="<?php echo base_url()?>media/backend/js/pages/users/users.js"></script>
	<!-- SweetAlert Plugin Js -->
    <script src="<?php echo base_url()?>media/backend/plugins/sweetalert/sweetalert.min.js"></script>
    <!-- Demo Js -->
    <script src="<?php echo base_url()?>media/backend/js/demo.js"></script>