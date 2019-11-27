<?php if ( !defined('BASEPATH') )exit('No direct script access allowed');
	class University extends CI_Controller{
		function __construct(){
			parent::__construct();
		}
		
		function index(){
			if (!isLogin()) redirect ( base_url().SYS_AUTH );
			$data['header_menu'] = "settings";
			$data['header_child'] = "university";
			$data['css_loader'] = 'view-university.css';			
			$data['page'] = 'university/view-university';
			
			$data['data'] = $this->sitemodel->view("tab_university", "*");
			
			$this->load->view(SYS_FILE."main-site", $data);
		}
		
		function ajax_validation(){
			$msg = array();
			$msg['type'] = 'failed';
			if ( isLogin() ) {
				if ( $_POST ){
					$id = $this->input->post("id");
					$type = $this->input->post("type");
					$univ_name = $this->input->post("univ_name");
					
					if ( empty($univ_name) or empty($type) )
						$msg['msg'] = "Please Input all required data.";
					else{
						if ( $type == "add" ){
							$data = [
								"university_name"	=> $univ_name
							];
							
							$this->sitemodel->insert("tab_university", $data);
							$msg['type'] = 'done';
							$msg['msg'] = "Successfully add University.";
						}
						else if ( $type == "edit" ){
							if ( empty($id) )
								$msg['msg'] = "please input all required data.";
							else{
								$data = [
									"university_name"	=> $univ_name
								];
								
								$this->sitemodel->update("tab_university", $data, array("university_id"=>$id));
								$msg['type'] = 'done';
								$msg['msg'] = "Successfully update University.";
							}
						}
						else
							$msg['msg'] = "Invalid paramter.";
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
						$cek = $this->sitemodel->view("tab_university", "university_id a, university_name b", array("university_id"=>$key));
						if ( $cek == '0' )
							$msg['msg'] = "No university found.";
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
						$cek = $this->sitemodel->view("tab_university", "university_id a, university_name b", array("university_id"=>$key));
						if ( $cek == '0' )
							$msg['msg'] = "No university found.";
						else{
							$this->sitemodel->delete("tab_university", array("university_id"=>$key));
							$msg['type'] = 'done';
							$msg['msg'] = "Successfully remove University.";
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