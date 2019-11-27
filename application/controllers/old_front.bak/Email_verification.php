<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Email_verification extends CI_Controller {

	function __construct(){
		parent::__construct();	
		
	}

	function verify($token){
		
		# check if token exists in database
		$data = $this->sitemodel->view('tab_candidat', 'candidat_id, candidat_verify', ['candidat_rg_key' => $token]);
		if($data == '0') {
			$msg['type'] = "failed";
			$msg['msg'] = "Email verification failed.<br>Please click resend activation email at menu [Register].";
			$this->session->set_flashdata('fc_alert', $msg);
			redirect('/');
			return;
		}
		
		# check verify status
		$verify_status = $data[0]->candidat_verify;
		if($verify_status == 'Y') {
			$msg['type'] = "failed";
			$msg['msg'] = "This email address has already been verified.<br>You can login with this email address.";
			$this->session->set_flashdata('fc_alert', $msg);
			redirect('/');
			return;
		}
		
		# update verify status
		$this->sitemodel->update('tab_candidat', ['candidat_verify' => 'Y'], ['candidat_id' => $data[0]->candidat_id]);		
		$msg['type'] = "done";
		$msg['msg'] = "Email verification success.<br>You can login with this email address.";
		$this->session->set_flashdata('fc_alert', $msg);
		redirect('/');
	}
	
	function forgot_password($token){
		
		# check if token exists in database
		$data = $this->sitemodel->view('tab_candidat', 'candidat_id, candidat_email, candidat_verify', ['candidat_rg_key' => $token]);
		if($data == '0') {
			$msg['type'] = "failed";
			$msg['msg'] = "Email verification failed.<br>Please click resend activation email at menu [Register].";
			$this->session->set_flashdata('fc_alert', $msg);
			redirect('/');
			return;
		}
		
		# update verify status
		// $this->sitemodel->update('tab_candidat', ['candidat_verify' => 'Y'], ['candidat_id' => $data[0]->candidat_id]);		
		// $msg['type'] = "done";
		// $msg['msg'] = "Email verification success.<br>You can login with this email address.";
		// $this->session->set_flashdata('fc_alert', $msg);
		redirect('site/forgot_password/?e='.$data[0]->candidat_email.'&t='.$token);
	}
}
