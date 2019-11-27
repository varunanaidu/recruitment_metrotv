<?php if ( !defined('BASEPATH') )exit('No direct script access allowed');?>
	<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <ol class="breadcrumb breadcrumb-bg-teal">
					<li class="active"><a href="javascript:void(0);"><i class="material-icons">date_range</i> Calendar</a></li>
				</ol>
            </div>
			<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
							<div class="page-header">
								<div class="pull-right form-inline">
									<div class="btn-group">
										<button class="btn btn-primary" data-calendar-nav="prev"><< Prev</button>
										<button class="btn btn-default" data-calendar-nav="today">Today</button>
										<button class="btn btn-primary" data-calendar-nav="next">Next >></button>
									</div>			
								</div>
								<h3></h3>
							</div>
							<div class="row">
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<div id="calendar"></div>
								</div>		
							</div>
						</div>
					</div>
				</div>
			</div>
        </div>
    </section>
	<script>
		var base_url = "<?php echo base_url().SYS_AUTH?>/";
		var basic_url = "<?php echo base_url()?>";
	</script>
    <!-- Jquery Core Js -->
    <script src="<?php echo base_url()?>media/plugins/calendar/components/jquery/jquery.1.12.4.min.js"></script>
    <!-- Bootstrap Core Js -->
    <script src="<?php echo base_url()?>media/plugins/calendar/components/bootstrap/js/bootstrap.min.js"></script>
    <!-- Slimscroll Plugin Js -->
    <script src="<?php echo base_url()?>media/backend/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
    <!-- Waves Effect Plugin Js -->
    <script src="<?php echo base_url()?>media/backend/plugins/node-waves/waves.js"></script>
	<script src="<?php echo base_url()?>media/plugins/calendar/components/underscore/underscore-min.js"></script>
	<script src="<?php echo base_url()?>media/plugins/calendar/components/jstimezonedetect/jstz.min.js"></script>
	<script src="<?php echo base_url()?>media/plugins/calendar/js/calendar.js"></script>
	<script src="<?php echo base_url()?>media/plugins/calendar/js/app.js"></script>	
    <!-- Custom Js -->
    <script src="<?php echo base_url()?>media/backend/js/admin.js"></script>	