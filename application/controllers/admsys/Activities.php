<?php if ( !defined('BASEPATH') )exit( 'No direct script access allowed' );
class Activities extends CI_Controller{
	function __construct(){
		parent::__construct();
	}

	function index(){
		if (!isLogin()) redirect ( base_url().SYS_AUTH );
		$data['header_menu'] = "settings";
		$data['header_child'] = "activities";
		$data['css_loader'] = 'view-activities.css';			
		$data['page'] = 'activities/view-activities';			
		$data['data'] = $this->sitemodel->view("tab_activity", "*");
		$this->load->view(SYS_FILE."main-site", $data);
	}

	function ajax_validation(){
		// print_r($_FILES);die;
		$msg = array();
		if ( isLogin() ) {
			if ( $_POST ){
				$id 		= $this->input->post("id");
				$type 		= $this->input->post("type");
				$title 		= $this->input->post("a_title");
				$date 		= $this->input->post("activity_date");
				$content 	= $this->input->post("activity_content");

				if ( empty($type) or empty($title) or empty($date) or empty($content) ){
					$msg['type'] = 'failed';
					$msg['msg'] = "Input all required data.";
				}
				else{
					if ( $type == "add" ){
						if ( isset($_FILES['activity_file']['name']) ){
							$file = $_FILES['activity_file']['name'];
							$exp = explode(".", $file);
							$end = strtolower(end($exp));
							$allowed = array("png", "jpg", "jpeg", "mp4");
							if ( in_array($end, $allowed) ){
								if ($end == "mp4") {
									$fileUpload = md5($file.date("YmdHis")).".".$end;

									$configVid['upload_path'] = 'assets/activity';
									$configVid['allowed_types'] = 'mp4';
									$configVid['max_size'] = '0';
									$configVid['file_name'] = $fileUpload;
									$configVideo['overwrite'] = FALSE;
									$configVideo['remove_spaces'] = TRUE;

									$data = array(
										"url_image" 	=> $fileUpload,
										"title"			=> $title,
										"date"			=> $date,
										"content"		=> $content,
										"created_by"	=> $this->session->userdata(SES_END)->log_id,
										"created_date"	=> date("Y-m-d H:i:s")	
									);

									$this->load->library('upload', $configVid);
									$this->upload->initialize($configVid);
									$this->upload->do_upload('activity_file');

									$this->sitemodel->insert("tab_activity", $data);
									$msg['type'] = 'done';
									$msg['msg'] = "Successfully add activity.";
								}else{	
									if ( $_FILES['activity_file']['size'] > 200000 ){
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
										$this->compress_image($_FILES['activity_file']['tmp_name'], "assets/activity/".$fileUpload, 75);
										$this->sitemodel->insert("tab_activity", $data);
										$msg['type'] = 'done';
										$msg['msg'] = "Successfully add activity.";
									}
								}
							}
							else{
								$msg['type'] = 'failed';
								$msg['msg'] = "Invalid File extension.";
							}
						}
						else{
							$msg['type'] = 'failed';
							$msg['msg'] = "Input all required data.";
						}
					}
					// ###############################################################################################################
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

							if ( isset($_FILES['activity_file']['name']) ){
								$file = $_FILES['activity_file']['name'];
								$exp = explode(".", $file);
								$end = strtolower(end($exp));
								$allowed = array("png", "jpg", "jpeg");
								if ( in_array($end, $allowed) ){
									if ( $_FILES['activity_file']['size'] > 200000 ){
										$msg['type'] = 'failed';
										$msg['msg'] = 'Maximum image can be upload is 200 Kb.';
									}
									else{
										$fileUpload = md5($file.date("YmdHis")).".".$end;
										$data["url_image"] = $fileUpload;

										$this->compress_image($_FILES['activity_file']['tmp_name'], "assets/activity/".$fileUpload, 75);
										$this->sitemodel->update("tab_activity", $data, array("activity_id"=>$id));
										$msg['type'] = 'done';
										$msg['msg'] = "Successfully update activity.";
									}
								}
								else{
									$msg['type'] = 'failed';
									$msg['msg'] = "Invalid image extension.";
								}
							}
							else{
								$this->sitemodel->update("tab_activity", $data, array("activity_id"=>$id));
								$msg['type'] = 'done';
								$msg['msg'] = "Successfully update activity.";
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
					$cek = $this->sitemodel->view("tab_activity", "activity_id a, title b, date c, content d, url_image e", array("activity_id"=>$key));
					if ( $cek == '0' ){
						$msg['type'] = 'failed';
						$msg['msg'] = "No activity found.";
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
		$this->load->helper('file');
		$msg = array();
		if ( isLogin() ) {
			if ( $_POST ){
				$key = $this->input->post("key");
				if ( empty($key) ){
					$msg['type'] = 'failed';
					$msg['msg'] = "Invalid parameter.";
				}
				else{
					$cek = $this->sitemodel->view("tab_activity", "*", array("activity_id"=>$key));
					if ( $cek == '0' ){
						$msg['type'] = 'failed';
						$msg['msg'] = "No activity found.";
					}
					else{
						$this->sitemodel->delete("tab_activity", array('activity_id'=>$key));
						$path = 'assets/activity/'.$cek[0]->url_image;
						unlink($path);
						$msg['type'] = 'done';
						$msg['msg'] = "Successfully remove activity.";
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