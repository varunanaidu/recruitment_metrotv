<?php if ( !defined('BASEPATH') )exit('No direct script access allowed');
	class Invitation extends SITE_Controller{
		function __construct(){
			parent::__construct();
		}
		
		function myinvitation($token='',$type='',$appid='',$apptype=''){
			if ( empty($token) or empty($type) or empty($appid) or empty($apptype) or ($type != 'A' and $type != 'R') ) redirect ( '/' );			
			
			$collection = ["iu", "ihr", "psikotest", "ia", "mcu", "final"];
			
			//check if appytype inside collection or not
			//if not move back to front page with error showing
			if ( ! in_array($apptype, $collection) ){
				$msg['type'] = "failed";
				$msg['msg'] = "Invitation failed 1.<br />Please contact Administrator for more information.";
				$this->session->set_flashdata('fc_alert', $msg);
				redirect('/');
				return;
			}
			
			//get candidat id and candidat verify
			$data = $this->sitemodel->view('tab_candidat', 'candidat_id, candidat_verify', ['candidat_rg_key' => $token]);
			//if candidat return '0'
			if($data == '0') {
				$msg['type'] = "failed";
				$msg['msg'] = "Invitation failed 2.<br />Please contact Administrator for more information.";
				$this->session->set_flashdata('fc_alert', $msg);
				redirect('/');
				return;
			}
			$cnd_id = $data[0]->candidat_id;
			# check verify status
			$verify_status = $data[0]->candidat_verify;
			if($verify_status == 'N') {
				$msg['type'] = "failed";
				$msg['msg'] = "Invitation failed 3.<br />Please contact Administrator for more information.";
				$this->session->set_flashdata('fc_alert', $msg);
				redirect('/');
				return;
			}
			
			$mydata = [
				"iu"	=> [
					"iu_stat",
					"iu_acc",
					"iu_date",
					"iu_acc_reason",
				],
				"ihr"	=> [
					"ihr_stat",
					"ihr_acc",
					"ihr_date",
					"ihr_acc_reason",
				],
				"psikotest"	=> [
					"psikotest_stat",
					"psikotest_acc",
					"psikotest_date",
					"psikotest_acc_reason",
				],
				"ia"	=> [
					"ia_stat",
					"ia_acc",
					"ia_date",
					"ia_acc_reason",
				],
				"mcu"	=> [
					"mcu_stat",
					"mcu_acc",
					"mcu_date",
					"mcu_acc_reason",
				],
				"final"	=> [
					"final_stat",
					"final_acc",
					"final_date",
					"final_acc_reason",
				]
			];
			//check status and acc from type test to validate if candidate doesnt inject or do something bad 
			$cek = $this->sitemodel->view("tr_applicant", "{$mydata[$apptype][0]},{$mydata[$apptype][1]}, {$mydata[$apptype][2]}", array("candidat_id"=>$cnd_id, "applicant_id"=>$appid));
			if ( $cek == '0' ){
				$msg['type'] = "failed";
				$msg['msg'] = "Invitation failed 4.<br />Please contact Administrator for more information.";
				$this->session->set_flashdata('fc_alert', $msg);
				redirect('/');
				return;
			}
			
			//check if the status and acc from type test still on goinf
			//if not return error to first place
			if ( $cek[0]->{$mydata[$apptype][0]} != "On Going" ){
				$msg['type'] = "failed";
				$msg['msg'] = "Invitation failed.<br />Please contact Administrator for more information.";
				$this->session->set_flashdata('fc_alert', $msg);
				redirect('/');
				return;
			}
			
			if ( ! empty ($cek[0]->{$mydata[$apptype][1]}) ){
				$curr_state = $cek[0]->{$mydata[$apptype][1]} == "A" ? "Approve" : "Reject";
				$msg['type'] = "failed";
				$msg['msg'] = "Invitation failed.<br />You have already {$curr_state} this invitation.";
				$this->session->set_flashdata('fc_alert', $msg);
				redirect('/');
				return;
			}
			
			if ( $type == 'A' ){
				if ( $cek[0]->{$mydata[$apptype][2]} <= date("Y-m-d") ){
					$this->sitemodel->update("tr_applicant", [$mydata[$apptype][1] => "R", $mydata[$apptype][3] => "Failed to accept invitation since is expired"], ["applicant_id"=>$appid]);
					$msg['type'] = "failed";
					$msg['msg'] = "Failed to accept invitation since is expired.";
					$this->session->set_flashdata('fc_alert', $msg);
					redirect('/');
					return;
				}
				
				$this->sitemodel->update("tr_applicant", array($mydata[$apptype][1]=>"A"), array("applicant_id"=>$appid));
				$msg['type'] = "done";
				$msg['msg'] = "You have accepted this Invitation.<br />Please present as scheduled.";
				$this->session->set_flashdata('fc_alert', $msg);
				redirect('/');
				return;
			}
			else if ( $type == 'R' ){
				$data['page'] = 'reject-invitation';
				$data['appid'] = $appid;
				$data['apptype'] = $apptype;
				$data['callback'] = base_url()."invitation/myinvitation/{$token}/{$type}/{$appid}/{$apptype}";
				$this->load->view('site/front/main-site', $data + $this->fc);
			}
		}
		
		function submit(){
			if ( $_POST ){
				$content_reject = $this->input->post("content_reject");
				$appid = $this->input->post("appid");
				$apptype = $this->input->post("apptype");
				$callback = $this->input->post("callback");
				
				$collection = ["iu", "ihr", "psikotest", "ia", "mcu", "final"];
				
				$mydata = [
					"iu"	=> [
						"iu_stat",
						"iu_acc",
						"iu_acc_reason",
					],
					"ihr"	=> [
						"ihr_stat",
						"ihr_acc",
						"ihr_acc_reason",
					],
					"psikotest"	=> [
						"psikotest_stat",
						"psikotest_acc",
						"psikotest_acc_reason"
					],
					"ia"	=> [
						"ia_stat",
						"ia_acc",
						"ia_acc_reason",
					],
					"mcu"	=> [
						"mcu_stat",
						"mcu_acc",
						"mcu_acc_reason"
					],
					"final"	=> [
						"final_stat",
						"final_acc",
						"final_acc_reason"
					]
				];
				
				if ( empty($callback) )
					redirect ( '/' );				
				else if ( empty($content_reject) or empty($appid) or empty($apptype) )
					redirect ( $callback );				
				else{
					if ( ! in_array($apptype, $collection) )
						redirect ( $callback );
					else{
						$cek = $this->sitemodel->view("tr_applicant", "*", array("applicant_id"=>$appid));
						if ( $cek == '0' )
							redirect(  $callback );
						else{
							$this->sitemodel->update("tr_applicant", array($mydata[$apptype][1]=>"R", $mydata[$apptype][2]=>$content_reject), array("applicant_id"=>$appid));
							$msg['type'] = "done";
							$msg['msg'] = "You have rejected this Invitation.";
							$this->session->set_flashdata('fc_alert', $msg);
							redirect('/');
							return;
						}
					}
				}
			}
			else
				redirect ( '/' );			
		}
	}