<?php if ( !defined('BASEPATH') )exit('No direct script access allowed');?>
	<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <ol class="breadcrumb breadcrumb-bg-teal">
					<li class="active"><a href="javascript:void(0);"><i class="material-icons">home</i> Home</a></li>
				</ol>
            </div>
			
			<!-- Widgets -->
            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box-3 bg-blue hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">receipt</i>
                        </div>
                        <div class="content">
                            <div class="text">VACANCY OPEN</div>
                            <div class="number"><?php echo $vac_open?></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box-3 bg-light-blue hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">person</i>
                        </div>
                        <div class="content">
                            <div class="text">CANDIDATES</div>
                            <div class="number"><?php echo $total_cnd?></div>
                        </div>
                    </div>
                </div>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box-3 bg-pink hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">done</i>
                        </div>
                        <div class="content">
                            <div class="text">CANDIDAT APPLIES</div>
                            <div class="number"><?php echo $cnd_apply?></div>
                        </div>
                    </div>

                </div>
            </div>
			
			<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="card">
						<div class="header">
                            <h2>
                                PROGRESS AREA
                            </h2>
						</div>
						<div class="body">
							<div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos">
                                    <thead>
                                        <tr>
                                            <th>Test Type</th>
                                            <th>Passed</th>
                                            <th>Failed</th>
                                            <th>On Going</th>
                                            <th>N/A</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php
											if ( isset($log_iu) and $log_iu != '0' ){
												foreach($log_iu as $row){
													echo "<tr>
															<td>{$row->E}</td>
															<td>{$row->A}</td>
															<td>{$row->B}</td>
															<td>{$row->C}</td>
															<td>{$row->D}</td>
														</tr>";
												}
											}
											if ( isset($log_ihr) and $log_ihr != '0' ){
												foreach($log_ihr as $row){
													echo "<tr>
															<td>{$row->E}</td>
															<td>{$row->A}</td>
															<td>{$row->B}</td>
															<td>{$row->C}</td>
															<td>{$row->D}</td>
														</tr>";
												}
											}
											if ( isset($log_psikotest) and $log_psikotest != '0' ){
												foreach($log_psikotest as $row){
													echo "<tr>
															<td>{$row->E}</td>
															<td>{$row->A}</td>
															<td>{$row->B}</td>
															<td>{$row->C}</td>
															<td>{$row->D}</td>
														</tr>";
												}
											}
											if ( isset($log_ia) and $log_ia != '0' ){
												foreach($log_ia as $row){
													echo "<tr>
															<td>{$row->E}</td>
															<td>{$row->A}</td>
															<td>{$row->B}</td>
															<td>{$row->C}</td>
															<td>{$row->D}</td>
														</tr>";
												}
											}
											if ( isset($log_mcu) and $log_mcu != '0' ){
												foreach($log_mcu as $row){
													echo "<tr>
															<td>{$row->E}</td>
															<td>{$row->A}</td>
															<td>{$row->B}</td>
															<td>{$row->C}</td>
															<td>{$row->D}</td>
														</tr>";
												}
											}
											if ( isset($log_final) and $log_final != '0' ){
												foreach($log_final as $row){
													echo "<tr>
															<td>{$row->E}</td>
															<td>{$row->A}</td>
															<td>{$row->B}</td>
															<td>{$row->C}</td>
															<td>{$row->D}</td>
														</tr>";
												}
											}
											if ( isset($log_results) and $log_results != '0' ){
												foreach($log_results as $row){
													echo "<tr>
															<td>{$row->E}</td>
															<td>{$row->A}</td>
															<td>{$row->B}</td>
															<td>{$row->C}</td>
															<td>{$row->D}</td>
														</tr>";
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
            <!-- #END# Widgets -->
        </div>
    </section>

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
    <!-- Custom Js -->
    <script src="<?php echo base_url()?>media/backend/js/admin.js"></script>
    <!-- Demo Js -->
    <script src="<?php echo base_url()?>media/backend/js/demo.js"></script>