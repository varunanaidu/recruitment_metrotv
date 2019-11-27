<?php if ( !defined('BASEPATH') )exit( 'No direct script access allowed' );
	class Users extends CI_Controller{
		function __construct(){
			parent::__construct();
		}
		
		function index(){
			if (!isLogin()) redirect ( base_url().SYS_AUTH );
			$data['header_menu'] = "settings";
			$data['header_child'] = "users";
			$data['css_loader'] = 'users.css';			
			$data['page'] = 'users/view-users';			
			$data['data'] = $this->sitemodel->view("tab_user", "*", array("role_id !="=>"1"));			
			$this->load->view(SYS_FILE."main-site", $data);
		}
		
		function ajax_validation(){
			$msg = array();
			if ( isLogin() ) {
				if ( $_POST ){
					$uname = $this->input->post("uname");
					$ufname = $this->input->post("ufname");
					$upwd = $this->input->post("upwd");
					$type = $this->input->post("type");
					$id = $this->input->post("id");
					
					if ( empty($uname) or empty($ufname) or empty($type) ){
						$msg['type'] = 'failed';
						$msg['msg'] = "Input all required data.";
					}
					else{
						if ( $type == 'add' ){
							if ( empty($upwd) == false ){
								$cek = $this->sitemodel->view("tab_user", "*", array("user_name"=>$uname, "user_status"=>"ACTIVE"));
								if ( $cek == '0' ){
									$data = array(
										"user_name" => $uname,
										"user_pwd"	=> md5($upwd),
										"user_f_name"=> $ufname,
										"role_id"	=> "2",
										"user_status"=> "ACTIVE"
									);
									
									$this->sitemodel->insert("tab_user", $data);
									$msg['type'] = 'done';
									$msg['msg'] = "Successfully add new user.";
								}
								else{
									$msg['type'] = 'failed';
									$msg['msg'] = "Username already exists.";
								}
							}
							else{
								$msg['type'] = 'failed';
								$msg['msg'] = "Input all required data.";
							}
						}
						else if ( $type == 'edit' ){
							if ( empty($id) ){
								$msg['type'] = 'failed';
								$msg['msg'] = "Input all required data.";
							}
							else{
								$data = array(
									"user_f_name"=> $ufname,
								);
								if( empty($upwd) == false )
									$data["user_pwd"]	= md5($upwd);
								$this->sitemodel->update("tab_user", $data, array("user_id"=>$id));
								$msg['type'] = 'done';
								$msg['msg'] = "Successfully edit user.";
							}
						}
						else{
							$msg['type'] = 'failed';
							$msg['msg'] = "Invalid parameter.";
						}
					}
				}
				else{
					$msg['type'] = 'failed';
					$msg['msg'] = 'Invalid parameter';
				}
			}
			else{
				$msg['type'] = 'failed';
				$msg['msg'] = "Login expired, please refresh your browser.";
			}
			echo json_encode($msg);
		}
		
		function find_data(){
			$msg = array();
			if ( isLogin() ) {
				if ( $_POST ){
					$key = $this->input->post("key");
					if ( empty($key) ){
						$msg['type'] = 'failed';
						$msg['msg'] = "Invalid parameter.";
					}
					else{
						$cek = $this->sitemodel->view("tab_user", "user_id A, user_name B, user_f_name C", array("user_id"=>$key));
						if ( $cek == '0' ){
							$msg['type'] = 'failed';
							$msg['msg'] = 'No user found.';
						}
						else{
							$msg['type'] = 'done';
							$msg['msg'] = $cek;
						}
					}
				}
				else{
					$msg['type'] = 'failed';
					$msg['msg'] = 'Invalid parameter';
				}
			}
			else{
				$msg['type'] = 'failed';
				$msg['msg'] = "Login expired, please refresh your browser.";
			}
			echo json_encode($msg);
		}
		
		function ajax_remove(){
			$msg = array();
			if ( isLogin() ) {
				if ( $_POST ){
					$key = $this->input->post("key");
					if ( empty($key) ){
						$msg['type'] = 'failed';
						$msg['msg'] = "Invalid parameter.";
					}
					else{
						$cek = $this->sitemodel->view("tab_user", "*", array("user_id"=>$key));
						if ( $cek == '0' ){
							$msg['type'] = 'failed';
							$msg['msg'] = "No user found.";
						}
						else{
							$this->sitemodel->update("tab_user", array("user_status"=>"NOT ACTIVE"), array('user_id'=>$key));
							$msg['type'] = 'done';
							$msg['msg'] = "Successfully remove user.";
						}
					}
				}
				else{
					$msg['type'] = 'failed';
					$msg['msg'] = 'Invalid parameter';
				}
			}
			else{
				$msg['type'] = 'failed';
				$msg['msg'] = "Login expired, please refresh your browser.";
			}
			echo json_encode($msg);
		}
	}