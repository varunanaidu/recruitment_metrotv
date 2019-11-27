<?php if ( !defined('BASEPATH') )exit('No direct script access allowed');
class VacantGroup extends CI_Controller{
	function __construct(){
		parent::__construct();
	}

	function index(){
		if (!isLogin()) redirect ( base_url().SYS_AUTH );
		$data['header_menu'] = "vacant";
		$data['header_child'] = "vacant_group";
		$data['css_loader'] = 'view-vacantGroup.css';			
		$data['page'] = 'vacantGroup/view-vacantGroup';

		$data['data'] = $this->sitemodel->view("tr_vacant_group a", "*", false, ["tr_vacant_unit b" => "a.vacant_unit_id=b.vacant_unit_id,"]);

		$this->load->view(SYS_FILE."main-site", $data);
	}

	function ajax_validation(){
		$msg = array();
		$msg['type'] = 'failed';
		if ( isLogin() ) {
			if ( $_POST ){
				$id 			= $this->input->post("id");
				$type 			= $this->input->post("type");
				$name 			= $this->input->post("vacant_group_name");
				$v_unit_id 		= $this->input->post("v_unit_id");

				if ( empty($name) or empty($type) or empty($v_unit_id) )
					$msg['msg'] = "Please Input all required data.";
				else{
					if ( $type == "add" ){
						$data = [
							"name"				=> $name,
							"vacant_unit_id"	=> $v_unit_id,
							"created_by"		=> $this->session->userdata(SES_END)->log_id,
							"created_date"		=> date("Y-m-d H:i:s")	
						];

						$this->sitemodel->insert("tr_vacant_group", $data);
						$msg['type'] = 'done';
						$msg['msg'] = "Successfully add Vacant Group.";
					}
					else if ( $type == "edit" ){
						if ( empty($id) )
							$msg['msg'] = "please input all required data.";
						else{
							$data = [
								"name"	=> $name,
								"vacant_unit_id"   => $v_unit_id,
								"modified_by"	=> $this->session->userdata(SES_END)->log_id,
								"modified_date"	=> date("Y-m-d H:i:s")	
							];

							$this->sitemodel->update("tr_vacant_group", $data, array("vacant_group_id"=>$id));
							$msg['type'] = 'done';
							$msg['msg'] = "Successfully update Vacant Group.";
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
					$cek = $this->sitemodel->view("tr_vacant_group", "vacant_group_id a, name b, vacant_unit_id c ", array("vacant_group_id"=>$key));
					if ( $cek == '0' )
						$msg['msg'] = "No Vacant Group found.";
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
					$cek = $this->sitemodel->view("tr_vacant_group", "vacant_group_id a, name b,  vacant_unit_id c", array("vacant_group_id"=>$key));
					if ( $cek == '0' )
						$msg['msg'] = "No Vacant Group found.";
					else{
						$this->sitemodel->delete("tr_vacant_group", array("vacant_group_id"=>$key));
						$msg['type'] = 'done';
						$msg['msg'] = "Successfully remove Vacant Group.";
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

    function get_vacantUnit()
    {
        $result = $this->sitemodel->view('tr_vacant_unit', '*');
        $data = array();

        foreach ($result as $key) {
            $sub_data = array();
            $sub_data['vacant_unit_id']    = $key->vacant_unit_id;
            $sub_data['unit_name']   = $key->unit_name;
            $data[] = $sub_data;
        }

        echo json_encode($data);
    }
}