<?php if ( !defined('BASEPATH') )exit('No direct script access allowed');
	
class SITE_Controller extends CI_Controller{
	
	protected $fc = array();
	protected $log_user = '';
	protected $log_email = '';
	
	function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		# company information
		$this->fc['site']['company'] 	= 'METRO TV';
		$this->fc['site']['title'] 		= 'METRO TV E-Recruitment';
		$this->fc['site']['shortdesc'] 	= '';
		
		# project year
		$this->fc['site']['year'] = '2017';
		
		# main css
		$this->fc['files']['css'] = [
			base_url('media/backend/plugins/bootstrap/css/bootstrap.min.css'),
			base_url('media/backend/plugins/font-awesome/css/font-awesome.min.css'),
			base_url('media/backend/plugins/node-waves/waves.min.css'),
			base_url('media/backend/plugins/animate-css/animate.min.css'),
			base_url('media/backend/plugins/sweetalert/sweetalert.css'),
			base_url('media/plugins/jssocials-1.4.0/dist/jssocials.css'),
			base_url('media/plugins/jssocials-1.4.0/dist/jssocials-theme-flat.css')
		];
		
		# custom css
		$this->fc['files']['css_custom'] = [
			base_url('media/backend/css/style.min.css'), #template adminbsb
			base_url('media/site/css/style.css')
		];
		
		# main js (template)
		$this->fc['files']['js'] = [
			base_url('media/backend/plugins/jquery/jquery.min.js'),
			base_url('media/backend/plugins/bootstrap/js/bootstrap.min.js'),
			base_url('media/backend/plugins/node-waves/waves.min.js'),
			base_url('media/backend/plugins/jquery-validation/jquery.validate.js'),
			base_url('media/backend/plugins/sweetalert/sweetalert.min.js'),
			base_url('media/plugins/jssocials-1.4.0/dist/jssocials.min.js')
		];
		
		# custom js
		$this->fc['files']['js_custom'] = [
			base_url('media/site/js/fc_main.js')
		];
		
		if ($this->hasLogin()) {
			$this->log_user = $this->session->userdata('fc_recruitment')->log_user;
			$this->log_email = $this->session->userdata('fc_recruitment')->log_email;
		}
		
	}
	
	function hasLogin() {
		
		return $this->session->userdata('fc_recruitment');
	}
	
	function page_404() {
		
		$this->output->set_status_header('404');
		$this->load->view('site/fof');
	}
}