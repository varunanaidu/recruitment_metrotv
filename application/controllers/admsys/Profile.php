<?php if ( !defined('BASEPATH') )exit('No direct script access allowed');
	class Profile extends CI_Controller{
		function __construct(){
			parent::__construct();
		}
		
		function index(){
			if (!isLogin()) redirect ( base_url().SYS_AUTH );			
			$data['css_loader'] = 'profile.css';			
			$data['page'] = 'profile/view-profile';			
			$data['data'] = $this->sitemodel->view("tab_user", "*", array("user_id"=>$this->session->userdata(SES_END)->log_id));			
			$this->load->view(SYS_FILE."main-site", $data);
		}
		
		function change_data(){
			$msg = array();
			if ( isLogin() ) {
				if ( $_POST ){
					$ufname = $this->input->post("ufname");
					$upwd = $this->input->post("upwd");
					
					if ( empty($ufname) ){
						$msg['type'] = 'failed';
						$msg['msg'] = "Input all required data.";
					}
					else{
						$data = array(
							"user_f_name" => $ufname
						);
						
						if ( empty($upwd) == false )
							$data['user_pwd'] = md5($upwd);
							
						$this->sitemodel->update("tab_user", $data, array("user_id"=>$this->session->userdata(SES_END)->log_id));
						$msg['type'] = 'done';
						$msg['msg'] = "Successfully update profile.";
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