<?php if ( !defined('BASEPATH') )exit('No direct script access allowed');
	class Temp_venue extends CI_Controller{
		function __construct(){
			parent::__construct();
		}
		
		function index(){
			if ( !isLogin() ) redirect ( base_url().SYS_AUTH );
			$data['header_menu'] = "template";
			$data['header_child'] = "template-venue";
			$data['css_loader'] = 'template-venue.css';			
			$data['page'] = 'template/template-venue';
			$data['data'] = $this->sitemodel->view("template_venue", "*");
			$this->load->view(SYS_FILE."main-site", $data);
		}
		
		function ajax_validation(){
			$msg = array();
			$msg['type'] = 'failed';
			if ( isLogin() ) {
				if ( $_POST ){
					$id = $this->input->post("id");
					$type = $this->input->post("type");
					$temp_name = $this->input->post("temp_name");
					$temp_content = $this->input->post("temp_content");
					
					if ( empty($type) or empty($temp_name) or empty($temp_content) )
						$msg['msg'] = "Please input all required data.";
					else{
						if ( $type == "add" ){
							$data = [
								"tv_name"	=> $temp_name,
								"tv_content"	=> $temp_content
							];
							
							$this->sitemodel->insert("template_venue", $data);
							$msg['type'] = 'done';
							$msg['msg'] = "Successfully insert template venue.";
						}
						else if ( $type == "edit" ){
							if ( empty($id) )
								$msg['msg'] = "Please input all required data.";
							else{
								$data = [
									"tv_name"	=> $temp_name,
									"tv_content"	=> $temp_content
								];
								
								$this->sitemodel->update("template_venue", $data, array("tv_id"=>$id));
								$msg['type'] = 'done';
								$msg['msg'] = "Successfully update template venue.";
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
						$cek = $this->sitemodel->view("template_venue", "tv_id a, tv_name b, tv_content c", array("tv_id"=>$key));
						if ( $cek == '0' )
							$msg['msg'] = "No template venue found.";
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
						$msg['msg'] = "Invalid paramter.";
					else{
						$cek = $this->sitemodel->view("template_venue", "*", array("tv_id"=>$key));
						if ( $cek == '0' )
							$msg['msg'] = "No template venue found.";
						else{
							$this->sitemodel->delete("template_venue", array("tv_id"=>$key));
							$msg['type'] = 'done';
							$msg['msg'] = "Successfully delete template venue.";
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