<?php if ( !defined('BASEPATH') )exit('No direct script access allowed');?>
<style>
	.qr {
		width: 35%;
		display: block;
		margin-left: auto;
		margin-right: auto;

	}
	.ph-button {

		border-style: solid;
		border-width: 0px 0px 3px;
		box-shadow: 0 -1px 0 rgba(255, 255, 255, 0.1) inset;
		color: #FFFFFF;	   
		border-radius: 6px;
		cursor: pointer;
		display: inline-block;
		font-style: normal;
		overflow: hidden;
		text-align: center;
		text-decoration: none;
		text-overflow: ellipsis;
		transition: all 200ms ease-in-out 0s;
		white-space: nowrap;	
		font-family: "Gotham Rounded A","Gotham Rounded B",Helvetica,Arial,sans-serif;
		font-weight: 700;	
		padding: 19px 39px 18px;
		font-size: 18px;

	}
/*Green
==========================*/
.ph-btn-green {

	border-color: #3AC162;
	background-color: #5FCF80;

}
.ph-btn-green:hover, .ph-btn-green:focus, .ph-btn-green:active {
	background-color: #4BC970;
	border-color: #3AC162;    
}

/*Blue
==========================*/
.ph-btn-blue {

	border-color: #326E99;
	background-color: #3F8ABF;
}

.ph-btn-blue:hover, .ph-btn-blue:focus, .ph-btn-blue:active {
	background-color: #397CAC;
	border-color: #326E99;   
}

.ph-float {
	margin-top: 2em;
	text-align: center;

}
</style>

<script>
	function VoucherSourcetoPrint(source) {
		return "<html><head><script>function step1(){\n" +
				"setTimeout('step2()', 10);}\n" +
				"function step2(){window.print();window.close()}\n" +
				"</scri" + "pt></head><body onload='step1()'>\n" +
				"<img src='" + source + "' /></body></html>";
	}
	function Print(source) {
		Pagelink = "about:blank";
		var pwa = window.open(Pagelink, "_new");
		pwa.document.open();
		pwa.document.write(VoucherSourcetoPrint(source));
		pwa.document.close();
	}
</script>

<section class="content">
	<div class="container-fluid">
		<div class="block-header">
			<ol class="breadcrumb breadcrumb-bg-teal">
				<li><a href="javascript:void(0);"><i class="material-icons">border_outer</i> QR Code</a></li>
			</ol>
		</div>
		<div class="row clearfix">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card">
					<div class="body">
						<img src="<?php echo base_url(); ?>assets/images/main/qr_code.png" class="qr" id="printableArea" alt="">
						<div class="ph-float">
							<a href="<?php echo base_url(); ?>assets/images/main/qr_code.png" download class='ph-button ph-btn-blue'> <img src="<?php echo base_url(); ?>assets/images/main/download.png"> Download </a>

							<a href="#" onclick="Print('<?php echo base_url(); ?>assets/images/main/qr_code.png'); return false;" class='ph-button ph-btn-green'> <img src="<?php echo base_url(); ?>assets/images/main/print.png"> Print </a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

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
<!-- Custom Js -->
<script src="<?php echo base_url()?>media/backend/js/admin.js"></script>

<!-- SweetAlert Plugin Js -->
<script src="<?php echo base_url()?>media/backend/plugins/sweetalert/sweetalert.min.js"></script>