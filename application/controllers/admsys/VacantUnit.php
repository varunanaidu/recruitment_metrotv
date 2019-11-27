<?php if ( !defined('BASEPATH') )exit('No direct script access allowed');
class VacantUnit extends CI_Controller{
	function __construct(){
		parent::__construct();
	}

	function index(){
		if (!isLogin()) redirect ( base_url().SYS_AUTH );
		$data['header_menu'] = "vacant";
		$data['header_child'] = "vacant_unit";
		$data['css_loader'] = 'view-vacantUnit.css';			
		$data['page'] = 'vacantUnit/view-vacantUnit';

		$data['data'] = $this->sitemodel->view("tr_vacant_unit", "*");

		$this->load->view(SYS_FILE."main-site", $data);
	}

	function ajax_validation(){
		$msg = array();
		$msg['type'] = 'failed';
		if ( isLogin() ) {
			if ( $_POST ){
				$id 			= $this->input->post("id");
				$type 			= $this->input->post("type");
				$unit_name 		= $this->input->post("vacant_unit_name");

				if ( empty($unit_name) or empty($type) )
					$msg['msg'] = "Please Input all required data.";
				else{
					if ( $type == "add" ){
						$data = [
							"unit_name"		=> $unit_name,
							"created_by"	=> $this->session->userdata(SES_END)->log_id,
							"created_date"	=> date("Y-m-d H:i:s")	
						];

						$this->sitemodel->insert("tr_vacant_unit", $data);
						$msg['type'] = 'done';
						$msg['msg'] = "Successfully add Vacant Unit.";
					}
					else if ( $type == "edit" ){
						if ( empty($id) )
							$msg['msg'] = "please input all required data.";
						else{
							$data = [
								"unit_name"	=> $unit_name,
								"modified_by"	=> $this->session->userdata(SES_END)->log_id,
								"modified_date"	=> date("Y-m-d H:i:s")	
							];

							$this->sitemodel->update("tr_vacant_unit", $data, array("vacant_unit_id"=>$id));
							$msg['type'] = 'done';
							$msg['msg'] = "Successfully update Vacant Unit.";
						}
					}
					else
						$msg['msg'] = "Invalid parameter.";
				}
			}
			else
				$msg['msg'] = 'Invalid parameter';				
		}
		else
			$msg['msg'] = "Login expired, please refresh your browser.";

		echo json_encode($msg);
	}

	function ajax_finder(){
		$msg = array();
		$msg['type'] = 'failed';
		if ( isLogin() ) {
			if ( $_POST ){
				$key = $this->input->post("key");
				if ( empty($key) )
					$msg['msg'] = "Invalid parameter.";
				else{
					$cek = $this->sitemodel->view("tr_vacant_unit", "vacant_unit_id a, unit_name b", array("vacant_unit_id"=>$key));
					if ( $cek == '0' )
						$msg['msg'] = "No Vacant Unit found.";
					else{
						$msg['type'] = 'done';
						$msg['msg'] = $cek;
					}
				}
			}
			else
				$msg['msg'] = 'Invalid parameter';				
		}
		else
			$msg['msg'] = "Login expired, please refresh your browser.";

		echo json_encode($msg);
	}

	function ajax_remove(){
		$msg = array();
		$msg['type'] = 'failed';
		if ( isLogin() ) {
			if ( $_POST ){
				$key = $this->input->post("key");
				if ( empty($key) )
					$msg['msg'] = "Invalid parameter.";
				else{
					$cek = $this->sitemodel->view("tr_vacant_unit", "vacant_unit_id a, unit_name b", array("vacant_unit_id"=>$key));
					if ( $cek == '0' )
						$msg['msg'] = "No Vacant Unit found.";
					else{
						$this->sitemodel->delete("tr_vacant_unit", array("vacant_unit_id"=>$key));
						$msg['type'] = 'done';
						$msg['msg'] = "Successfully remove Vacant Unit.";
					}
				}
			}
			else
				$msg['msg'] = 'Invalid parameter';				
		}
		else
			$msg['msg'] = "Login expired, please refresh your browser.";

		echo json_encode($msg);
	}
}