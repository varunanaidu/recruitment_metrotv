<?php if ( !defined('BASEPATH') )exit( 'No direct script access allowed' );
class Editorial extends CI_Controller{
	function __construct(){
		parent::__construct();
	}

	function index(){
		if (!isLogin()) redirect ( base_url().SYS_AUTH );
		$data['header_menu'] = "settings";
		$data['header_child'] = "editorial";
		$data['css_loader'] = 'view-editorial.css';			
		$data['page'] = 'editorial/view-editorial';			
		$data['data'] = $this->sitemodel->view("tab_tipsntrick", "*");
		$this->load->view(SYS_FILE."main-site", $data);
	}

	function ajax_validation(){
		// print_r($_FILES);die;
		$msg = array();
		if ( isLogin() ) {
			if ( $_POST ){
				$id 		= $this->input->post("id");
				$type 		= $this->input->post("type");
				$title 		= $this->input->post("e_title");
				$date 		= $this->input->post("editorial_date");
				$content 	= $this->input->post("editorial_content");

				if ( empty($type) or empty($title) or empty($date) or empty($content) ){
					$msg['type'] = 'failed';
					$msg['msg'] = "Input all required data.";
				}
				else{
					if ( $type == "add" ){
						if ( isset($_FILES['editorial_file']['name']) ){
							$file = $_FILES['editorial_file']['name'];
							$exp = explode(".", $file);
							$end = strtolower(end($exp));
							$allowed = array("png", "jpg", "jpeg");
							if ( in_array($end, $allowed) ){
								if ( $_FILES['editorial_file']['size'] > 200000 ){
									$msg['type'] = 'failed';
									$msg['msg'] = 'Maximum image can be upload is 200 Kb.';
								}
								else{
									$fileUpload = md5($file.date("YmdHis")).".".$end;
									$data = array(
										"url_image" 	=> $fileUpload,
										"title"			=> $title,
										"date"			=> $date,
										"content"		=> $content,
										"created_by"	=> $this->session->userdata(SES_END)->log_id,
										"created_date"	=> date("Y-m-d H:i:s")	
									);
									
									$this->compress_image($_FILES['editorial_file']['tmp_name'], "assets/editorial/".$fileUpload, 75);
									$this->sitemodel->insert("tab_tipsntrick", $data);
									$msg['type'] = 'done';
									$msg['msg'] = "Successfully add Editorial.";
								}
							}
							else{
								$msg['type'] = 'failed';
								$msg['msg'] = "Invalid image extension.";
							}
						}
						else{
							$msg['type'] = 'failed';
							$msg['msg'] = "Input all required data.";
						}
					}
					else if ( $type == "edit" ){
						if ( empty($id) ){
							$msg['type'] = 'failed';
							$msg['msg'] = "Input all required data.";
						}
						else{
							$data = array(
								"title"			=> $title,
								"date"			=> $date,
								"content"		=> $content,
								"modified_by"	=> $this->session->userdata(SES_END)->log_id,
								"modified_date"	=> date("Y-m-d H:i:s")	
							);

							if ( isset($_FILES['editorial_file']['name']) ){
								$file = $_FILES['editorial_file']['name'];
								$exp = explode(".", $file);
								$end = strtolower(end($exp));
								$allowed = array("png", "jpg", "jpeg");
								if ( in_array($end, $allowed) ){
									if ( $_FILES['editorial_file']['size'] > 200000 ){
										$msg['type'] = 'failed';
										$msg['msg'] = 'Maximum image can be upload is 200 Kb.';
									}
									else{
										$fileUpload = md5($file.date("YmdHis")).".".$end;
										$data["url_image"] = $fileUpload;

										$this->compress_image($_FILES['editorial_file']['tmp_name'], "assets/editorial/".$fileUpload, 75);
										$this->sitemodel->update("tab_tipsntrick", $data, array("tipsntrick_id"=>$id));
										$msg['type'] = 'done';
										$msg['msg'] = "Successfully update editorial.";
									}
								}
								else{
									$msg['type'] = 'failed';
									$msg['msg'] = "Invalid image extension.";
								}
							}
							else{
								$this->sitemodel->update("tab_tipsntrick", $data, array("tipsntrick_id"=>$id));
								$msg['type'] = 'done';
								$msg['msg'] = "Successfully update editorial.";
							}
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

	function ajax_finder(){
		$msg = array();
		if ( isLogin() ) {
			if ( $_POST ){
				$key = $this->input->post("key");
				if ( empty($key) ){
					$msg['type'] = 'failed';
					$msg['msg'] = "Invalid parameter.";
				}
				else{
					$cek = $this->sitemodel->view("tab_tipsntrick", "tipsntrick_id a, title b, date c, content d, url_image e", array("tipsntrick_id"=>$key));
					if ( $cek == '0' ){
						$msg['type'] = 'failed';
						$msg['msg'] = "No editorial found.";
					}
					else{
						$msg['type'] ='done';
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
					$cek = $this->sitemodel->view("tab_tipsntrick", "*", array("tipsntrick_id"=>$key));
					if ( $cek == '0' ){
						$msg['type'] = 'failed';
						$msg['msg'] = "No editorial found.";
					}
					else{
						$this->sitemodel->delete("tab_tipsntrick", array('tipsntrick_id'=>$key));
						$msg['type'] = 'done';
						$msg['msg'] = "Successfully remove editorial.";
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

	function compress_image($source_url, $destination_url, $quality) {
		$info = getimagesize($source_url);

		if ($info['mime'] == 'image/jpeg')
			$image = imagecreatefromjpeg($source_url);
		elseif ($info['mime'] == 'image/gif')
			$image = imagecreatefromgif($source_url);
		elseif ($info['mime'] == 'image/png')
			$image = imagecreatefrompng($source_url);
		imagejpeg($image, $destination_url, $quality);

		return true;
	}
}