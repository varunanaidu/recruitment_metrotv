<?php if ( !defined('BASEPATH') )exit('No direct script access allowed');?>
<section class="content">
	<div class="container-fluid">
		<div class="block-header">
			<ol class="breadcrumb breadcrumb-bg-teal">
				<li><a href="javascript:void(0);"><i class="material-icons">settings</i> Others</a></li>
				<li class="active"><a href="javascript:void(0);"><i class="material-icons">photo_library</i> Testimonials</a></li>
			</ol>
		</div>
		<div class="row clearfix">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card">
					<div class="body">
						<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<button type="button" class="btn btn-primary pull-right waves-effect" id="btn-add">New Testimonials</button>
							</div>
						</div>
						<div class="table-responsive">								
							<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
								<thead>
									<tr>
										<th>#</th>
										<th>Name</th>
										<th>Batch</th>
										<th>Content</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									if ( isset($data) and $data != '0' ){
										$no = 1;
										foreach($data as $row){
											$content = strlen($row->content) >= 30 ? substr($row->content, 0, 30)."..." : $row->content;
											echo "
											<tr>
											<td>{$no}</td>
											<td>{$row->name}</td>
											<td>{$row->batch}</td>
											<td>{$content}</td>
											<td>
											<div class=\"btn-group\">
											<button type=\"button\" class=\"btn btn-primary dropdown-toggle\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"true\">PRIMARY <span class=\"caret\"></span></button>
											<ul class=\"dropdown-menu\">
											<li><a href=\"javascript:void(0);\" class=\"btn-edit waves-effect waves-block\" attr-data=\"{$row->testimoni_id}\"><i class=\"material-icons\">create</i> Edit</a></li>
											<li><a href=\"javascript:void(0);\" class=\"btn-remove waves-effect waves-block\" attr-data=\"{$row->testimoni_id}\"><i class=\"material-icons\">clear</i> Remove</a></li>
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
					<h4 class="modal-title" id="defaultModalLabel">Testimonials</h4>
				</div>
				<div class="modal-body">
					<div class="row clearfix">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">		
							<label for="name">Name</label>
							<div class="form-group">
								<div class="form-line">
									<input type="text" id="name" name="name" class="form-control" placeholder="Enter Name" required>
								</div>							
							</div>
						</div>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">		
							<label for="batch">Batch</label>
							<div class="form-group">
								<div class="form-line">
									<input type="text" id="batch" name="batch" class="form-control" placeholder="Enter Batch">
								</div>							
							</div>
						</div>
					</div>
					<div class="row clearfix">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">		
							<label>Testimonial Image</label>
							<div class="form-group">
								<div class="form-line">
									<input type="file" id="testimoni_file" name="testimoni_file" class="form-control" accept=".jpeg, .jpg, .png">
									<small style="color:red;">Maximum image upload 200 Kb, only allowed *.jpg, *.png types, Best Preview 730x350 pixels and above</small>
								</div>							
							</div>
						</div>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="content-img">		
							<img src="" id="img-data" class="img-responsive" />
						</div>
					</div>
					<label for="testimoni_content">Content</label>
					<div class="form-group">
						<div class="form-line">
							<textarea id="testimoni_content" name="testimoni_content" required></textarea>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/3.51/jquery.form.min.js"></script>
<!-- Ckeditor -->
<script src="<?php echo base_url()?>media/backend/plugins/ckeditor/ckeditor.js"></script>
<!-- Custom Js -->
<script src="<?php echo base_url()?>media/backend/js/admin.js"></script>
<script src="<?php echo base_url()?>media/backend/js/pages/testimoni/testimoni.js"></script>
<!-- SweetAlert Plugin Js -->
<script src="<?php echo base_url()?>media/backend/plugins/sweetalert/sweetalert.min.js"></script>