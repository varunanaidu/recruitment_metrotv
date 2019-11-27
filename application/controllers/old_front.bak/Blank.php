<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Blank extends CI_Controller {

	function __construct(){
		parent::__construct();	
		
		// if (! $this->hasLogin()) {
			// // redirect('/');
		// }
		
		// # main css additional
		// array_push(
			// $this->fc['files']['css'],
			// base_url('media/backend/plugins/bootstrap-select/css/bootstrap-select.min.css'),
			// base_url('media/backend/plugins/dropzone/dropzone.css'),
			// base_url('media/plugins/select2-4.0.3/dist/css/select2.min.css'),
			// base_url('media/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')
		// );
		
		// # main js additional
		// array_push(
			// $this->fc['files']['js'],
			// // base_url('media/backend/plugins/jquery-steps/jquery.steps.js'),
			// base_url('media/backend/plugins/bootstrap-select/js/bootstrap-select.min.js'),
			// base_url('media/backend/plugins/dropzone/dropzone.js'),
			// base_url('media/backend/plugins/jquery-inputmask/jquery.inputmask.bundle.js'),
			// base_url('media/plugins/select2-4.0.3/dist/js/select2.full.min.js'),
			// base_url('media/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')
		// );
		
		// # custom js additional
		// array_push(
			// $this->fc['files']['js_custom'],
			// base_url('media/site/js/fc_applicant.js')
		// );
	}
	
	function index() {
		
		// $data['page'] = 'blank';
		// $this->load->view('site/front/main-site', $data + $this->fc);
		$data['page'] = 'registration';
		$this->load->view('site/emails/template', $data);
	}
}