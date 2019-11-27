<?php if ( !defined('BASEPATH') )exit( 'No direct script access allowed' );
	class Template extends CI_Controller{
		function __construct(){
			parent::__construct();
		}
		
		function index(){
			if (!isLogin()) redirect ( base_url().SYS_AUTH );
			$data['header_menu'] = "template";
			$data['header_child'] = "template";
			$data['css_loader'] = 'template.css';			
			$data['page'] = 'template/view-template';			
			$data['data'] = $this->sitemodel->view("tab_template", "*");
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
								"template_name"	=> $temp_name,
								"template_content"	=> $temp_content,
								"created_by"		=> $this->session->userdata(SES_END)->log_id
							];
							
							$this->sitemodel->insert("tab_template", $data);
							$msg['type'] = 'done';
							$msg['msg'] = "Successfully insert template email.";
						}
						else if ( $type == "edit" ){
							if ( empty($id) )
								$msg['msg'] = "Please input all required data.";
							else{
								$data = [
									"template_name"	=> $temp_name,
									"template_content"	=> $temp_content
								];
								
								$this->sitemodel->update("tab_template", $data, array("template_id"=>$id));
								$msg['type'] = 'done';
								$msg['msg'] = "Successfully update template email.";
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
						$msg['msg'] = "Invalid paramter.";
					else{
						$cek = $this->sitemodel->view("tab_template", "template_id a, template_name b, template_content c", array("template_id"=>$key));
						if ( $cek == '0' )
							$msg['msg'] = "No template email found.";
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
						$cek = $this->sitemodel->view("tab_template", "*", array("template_id"=>$key));
						if ( $cek == '0' )
							$msg['msg'] = "No template email found.";
						else{
							$this->sitemodel->delete("tab_template", array("template_id"=>$key));
							$msg['type'] = 'done';
							$msg['msg'] = "Successfully delete template email.";
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