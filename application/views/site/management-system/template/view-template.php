<?php if ( !defined('BASEPATH') )exit('No direct script access allowed');?>
	<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <ol class="breadcrumb breadcrumb-bg-teal">
					<li><a href="javascript:void(0);"><i class="material-icons">language</i> Template</a></li>
					<li class="active"><a href="javascript:void(0);"><i class="material-icons">content_copy</i> Template Email</a></li>
				</ol>
            </div>
			<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
							<div class="row">
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<button type="button" class="btn btn-primary pull-right waves-effect" id="btn-add">New Template</button>
								</div>
							</div>
							<div class="table-responsive">								
								<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
									<thead>
										<tr>
											<th>#</th>
											<th>Template Name</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
									<?php
										if ( isset($data) and $data != '0' ){
											$no = 1;
											foreach($data as $row){
												$no_del = $row->created_by == "0" ? "" : "<li><a href=\"javascript:void(0);\" class=\"btn-remove waves-effect waves-block\" tag-id=\"{$row->template_id}\"><i class=\"material-icons\">clear</i> Remove</a></li>";
												echo "
													<tr>
														<td>{$no}</td>
														<td>{$row->template_name}</td>
														<td>
															<div class=\"btn-group\">
																<button type=\"button\" class=\"btn btn-primary dropdown-toggle\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"true\">PRIMARY <span class=\"caret\"></span></button>
																<ul class=\"dropdown-menu\">
																	<li><a href=\"javascript:void(0);\" class=\"btn-edit waves-effect waves-block\" tag-id=\"{$row->template_id}\"><i class=\"material-icons\">create</i> Edit</a></li>
																	{$no_del}
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
			<form method="POST" id="default-form" enctype="multipart/form-data">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="defaultModalLabel">Template</h4>
					</div>
					<div class="modal-body">
						<div class="row clearfix">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">								
								<div class="form-group">
									<div class="form-line">
										<input type="text" id="temp_name" name="temp_name" class="form-control" placeholder="Template Name *" maxlength="100" required>
									</div>							
								</div>
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">								
								<div class="form-group">
									<div class="form-line">
										<textarea name="temp_content" style="resize:none;" rows="15" id="temp_content" class="form-control" placeholder="Template content *" maxlength="500" required></textarea>
									</div>							
								</div>
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
	<script src="<?php echo base_url()?>media/backend/js/pages/template/template.js"></script>
	<!-- SweetAlert Plugin Js -->
    <script src="<?php echo base_url()?>media/backend/plugins/sweetalert/sweetalert.min.js"></script>