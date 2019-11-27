<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends CI_Controller {

	function __construct(){
		parent::__construct();		
	}
	
	function index(){
		if (isLogin() == FALSE){
			$this->load->view(SYS_FILE."login");
			return;
		}
		else{
			$data['css_loader'] = 'view-dashboard.css';
			$data['header_menu'] = "dashboard";			
			$data['page'] = 'dashboard/view-dashboard';
			$temp = $this->sitemodel->view("tab_candidat", "COUNT(*) as total", null, null, null, null, false);
			$total_cnd = "0";
			foreach($temp as $row) $total_cnd = $row->total;
			$data['total_cnd'] = $total_cnd;
			$temp = $this->sitemodel->view("tr_vacant", "COUNT(*) as total", array("vacant_status"=>"ACTIVE"), null, null, null, false);
			$vac_open = "0";
			foreach($temp as $row) $vac_open = $row->total;
			$data['vac_open'] = $vac_open;
			$temp = $this->sitemodel->view("tr_applicant", "COUNT(*) as total", null, null, null, null, false);
			$cnd_apply = "0";
			foreach($temp as $row) $cnd_apply = $row->total;
			$data['cnd_apply'] = $cnd_apply;
			$sql = "SELECT 'Interview User' as E,
						(SELECT COUNT(*) FROM tr_applicant WHERE iu_stat = 'Passed') as A,
						(SELECT COUNT(*) FROM tr_applicant WHERE iu_stat = 'Failed') as B,
						(SELECT COUNT(*) FROM tr_applicant WHERE iu_stat = 'On Going') as C,
						(SELECT COUNT(*) FROM tr_applicant WHERE iu_stat = 'N/A') as D";
			$temp = $this->sitemodel->custom_query($sql);
			$data['log_iu'] = $temp;
			$sql = "SELECT 'Interview HR' as E,
						(SELECT COUNT(*) FROM tr_applicant WHERE ihr_stat = 'Passed') as A,
						(SELECT COUNT(*) FROM tr_applicant WHERE ihr_stat = 'Failed') as B,
						(SELECT COUNT(*) FROM tr_applicant WHERE ihr_stat = 'On Going') as C,
						(SELECT COUNT(*) FROM tr_applicant WHERE ihr_stat = 'N/A') as D";
			$temp = $this->sitemodel->custom_query($sql);
			$data['log_ihr'] = $temp;
			$sql = "SELECT 'Psikotest' as E,
						(SELECT COUNT(*) FROM tr_applicant WHERE psikotest_stat = 'Passed') as A,
						(SELECT COUNT(*) FROM tr_applicant WHERE psikotest_stat = 'Failed') as B,
						(SELECT COUNT(*) FROM tr_applicant WHERE psikotest_stat = 'On Going') as C,
						(SELECT COUNT(*) FROM tr_applicant WHERE psikotest_stat = 'N/A') as D";
			$temp = $this->sitemodel->custom_query($sql);
			$data['log_psikotest'] = $temp;
			$sql = "SELECT 'Interview Accessor' as E,
						(SELECT COUNT(*) FROM tr_applicant WHERE ia_stat = 'Passed') as A,
						(SELECT COUNT(*) FROM tr_applicant WHERE ia_stat = 'Failed') as B,
						(SELECT COUNT(*) FROM tr_applicant WHERE ia_stat = 'On Going') as C,
						(SELECT COUNT(*) FROM tr_applicant WHERE ia_stat = 'N/A') as D";
			$temp = $this->sitemodel->custom_query($sql);
			$data['log_ia'] = $temp;
			$sql = "SELECT 'MCU' as E,
						(SELECT COUNT(*) FROM tr_applicant WHERE mcu_stat = 'Passed') as A,
						(SELECT COUNT(*) FROM tr_applicant WHERE mcu_stat = 'Failed') as B,
						(SELECT COUNT(*) FROM tr_applicant WHERE mcu_stat = 'On Going') as C,
						(SELECT COUNT(*) FROM tr_applicant WHERE mcu_stat = 'N/A') as D";
			$temp = $this->sitemodel->custom_query($sql);
			$data['log_mcu'] = $temp;
			$sql = "SELECT 'Finalization' as E,
						(SELECT COUNT(*) FROM tr_applicant WHERE final_stat = 'Passed') as A,
						(SELECT COUNT(*) FROM tr_applicant WHERE final_stat = 'Failed') as B,
						(SELECT COUNT(*) FROM tr_applicant WHERE final_stat = 'On Going') as C,
						(SELECT COUNT(*) FROM tr_applicant WHERE final_stat = 'N/A') as D";
			$temp = $this->sitemodel->custom_query($sql);			
			$data['log_final'] = $temp;
			$sql = "SELECT 'Results' as E,
						(SELECT COUNT(*) FROM tr_applicant WHERE applicant_status = 'Passed') as A,
						(SELECT COUNT(*) FROM tr_applicant WHERE applicant_status = 'Failed') as B,
						(SELECT COUNT(*) FROM tr_applicant WHERE applicant_status = 'On Going') as C,
						(SELECT COUNT(*) FROM tr_applicant WHERE applicant_status = 'N/A') as D";
			$temp = $this->sitemodel->custom_query($sql);			
			$data['log_results'] = $temp;
			$this->load->view(SYS_FILE."main-site", $data);
		}
	}

	// function login(){
	// 	$this->load->view(SYS_FILE."login");
	// }
	
	function checkin(){
		
		$msg = array();
		$msg['type'] = 'failed';		
		if( $_POST ){
			$user = trim($this->input->post('username'));
			$pass = $this->input->post('password');
			
			if ( empty($user) and empty($pass) ){
				$msg['msg'] = 'Input username and password.';			
			}
			else {
				$where = array('user_name' => $user);
				$res = $this->sitemodel->view('tab_user', 'user_id, user_name, role_id, user_pwd, user_f_name', $where);
				
				if($res == '0'){
					$msg['msg'] = 'Invalid username or password.';
				}
				else {
					$storedpwd = '';
					$data = array();
					foreach($res as $row){
						$data['log_id']		= $row->user_id;
						$data['log_user']	= $row->user_name;
						$data['log_name']	= $row->user_f_name;
						$data['log_role'] 	= $row->role_id;
						$storedpwd		  	= $row->user_pwd;
					}
					$pass = md5($pass);
						
					if( $pass !== $storedpwd ){
						$msg['msg'] = 'Invalid username or password.';							
					}
					else {						
						// $data = (object)$data;
						$this->session->set_userdata(SES_END, (object)$data);
						$msg['type'] = 'done';
						$msg['msg'] = 'Successfully login. We will redirect you shortly.';
						$msg['debug'] = $this->session->userdata(SES_END);
						$msg['debug2'] = isLogin() ? 'login' : 'no login';
					}
				}
			}
		}
		else {
			$msg['msg'] = 'Input username and password';
		}
		echo json_encode( $msg );
	}
	
	function checkout(){
		
		$this->session->unset_userdata(SES_END);
		redirect(base_url().SYS_AUTH);
	}
}