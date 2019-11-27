<?php if ( !defined('BASEPATH') )exit('No direct script access allowed');?>
	<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <ol class="breadcrumb breadcrumb-bg-teal">
					<li><a href="javascript:void(0);"><i class="material-icons">timeline</i> Reporting</a></li>
					<li class="active"><a href="javascript:void(0);"><i class="material-icons">accessibility</i> Candidat Progress</a></li>
				</ol>
            </div>
			<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
							<div class="row clearfix">
								<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">									
									<div class="form-line">
										<select name="vacant" id="vacant" class="form-control show-tick">
											<option value="">- Choose Vacancy-</option>
											<?php
												if ( isset($data_vacant) and $data_vacant != '0' ){
													foreach($data_vacant as $row)
														echo "<option value=\"{$row->vacant_id}\">{$row->vacant_title} ({$row->a} s/d {$row->b})</option>";
												}
											?>
										</select>
									</div>
								</div>
								<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">									
									<div class="form-line">
										<input type="text" name="range_date" id="range_date" readonly="readonly" class="form-control dpicker" placeholder="Choose range date" />
									</div>
								</div>
								<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
									<button type="button" class="btn btn-primary" id="btn-pdf">PDF</button>
									<button type="button" class="btn btn-primary" id="btn-excel">EXCEL</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
        </div>
    </section>
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
	<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
	<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
	<!-- SweetAlert Plugin Js -->
    <script src="<?php echo base_url()?>media/backend/plugins/sweetalert/sweetalert.min.js"></script>
    <!-- Custom Js -->
    <script src="<?php echo base_url()?>media/backend/js/admin.js"></script>
	<script src="<?php echo base_url()?>media/backend/js/pages/report/candidat-progress.js"></script>
    <!-- Demo Js -->
    <script src="<?php echo base_url()?>media/backend/js/demo.js"></script>