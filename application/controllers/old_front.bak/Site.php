<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends SITE_Controller {

	function __construct() {
		parent::__construct();
		
		# main js additional
		if (!$this->hasLogin()) {
			array_push(
				$this->fc['files']['js'],
				"https://www.google.com/recaptcha/api.js?onload=CaptchaCallback&render=explicit"
			);
		}
		
		array_push(
			$this->fc['files']['js_custom'],
			base_url('media/site/js/fc_home.js')
		);
	}
	
	function index() {
		
		# login popup
		$data['login_popup'] = $this->input->get('login_popup');
		# confirm_vacancy
		$data['confirm_popup'] = $this->input->get('confirm_popup');
		# vacancy_title
		$vac_id = $this->input->get('v');
		$vac = $this->sitemodel->view('tr_vacant', 'vacant_id, vacant_title', ['vacant_id' => $vac_id]);
		$data['vacancy_title']	= ($vac != '0') ? $vac[0]->vacant_title : '';
		$data['vacancy_id']		= ($vac != '0') ? $vac[0]->vacant_id : '';
		# slideshow
		$data['slide'] = $this->sitemodel->view('tab_slideshow', '*');
		
		# load data candidate if has login
		if ($this->hasLogin()) {
			$sql = "select a.*, b.vacant_title 
					from tr_applicant a
					join tr_vacant b on a.vacant_id = b.vacant_id
					where candidat_id = {$this->db->escape($this->log_user)}
					and applicant_status in ('On Going')
					order by applicant_status";
			$data['application_inprogress'] = $this->sitemodel->custom_query($sql);
			$sql = "select b.vacant_title 
					from tr_applicant a
					join tr_vacant b on a.vacant_id = b.vacant_id
					where candidat_id = {$this->db->escape($this->log_user)}
					and applicant_status in ('On Going', 'N/A')
					order by applicant_status";
			$data['application_applied'] = $this->sitemodel->custom_query($sql);
			#################### PROGRESS DI HOME PAKAI PROGRESSBAR ANIMATED
		}

		# load active vacancy
		$data['jobs'] = $this->sitemodel->view('tr_vacant', '*', ['vacant_status' => 'ACTIVE'], false, 'vacant_id DESC');
		$data['page'] = 'home';
		$this->load->view('site/front/main-site', $data + $this->fc);
	}
	
	function login() {
		
		# uncomment this when CAPTCHA ready !!
		$captcha = $this->input->post('g-recaptcha-response');
		if (! $this->isValidCaptcha($captcha)) {
			$msg['msg'] = 'Invalid reCAPTCHA code !';
			echo json_encode($msg);
			return;
		}
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('frm_email','Email','trim|required|valid_email');
		$this->form_validation->set_rules('frm_pwd','Password','required');
		
		if ($this->form_validation->run() == false) {
			$msg['msg'] = validation_errors();
			echo json_encode($msg);
			return;
		}
		
		$email = $this->input->post('frm_email');
		$passw = $this->input->post('frm_pwd');
		$data = $this->sitemodel->view('tab_candidat', 'candidat_id, candidat_email, candidat_pwd, candidat_verify, candidat_name', ['candidat_email' => $email]);
		
		if ($data == '0') {
			$msg['msg'] = "Unregistered email address.";
			echo json_encode($msg);
			return;
		}
		if ($data[0]->candidat_verify != "Y") {
			$msg['msg'] = "Please check your email and click the activation link that we sent to activate this account.";
			echo json_encode($msg);
			return;
		}
		if (! password_verify($passw, $data[0]->candidat_pwd)) {
			$msg['msg'] = "Invalid email address or password.";
			echo json_encode($msg);
			return;					
		}
		
		$data = [
			'log_user'	=> $data[0]->candidat_id,
			'log_email'	=> html_escape($data[0]->candidat_email),
			'log_name'	=> html_escape($data[0]->candidat_name)
		];
		$this->session->set_userdata('fc_recruitment', (object)$data);
		
		$msg['type'] = 'done';
		$msg['referred_to'] = $this->session->userdata('referred_to') ? $this->session->userdata('referred_to') : '';
		echo json_encode($msg);
	}
	
	function logout() {
		
		$this->session->sess_destroy();
		redirect('/');
	}
	
	function register() {
		
		$this->load->library('form_validation');
		#check if email already exist
		$this->form_validation->set_rules('frm_su_email', 
											'Email', 
											'trim|required|valid_email|is_unique[tab_candidat.candidat_email]|strtolower', 
											array('is_unique' => "This {field} address is already registered."));
		$this->form_validation->set_rules('frm_su_passw', 'Password', 'required|min_length[8]');
		$this->form_validation->set_rules('frm_su_passc', 'Confirm Password', 'required|matches[frm_su_passw]');
		$this->form_validation->set_rules('terms',' Terms of Usage', 'required');
		
		if ($this->form_validation->run() == false) {
			$msg['msg'] = validation_errors();
			echo json_encode($msg);
			return;
		}
		
		$email = strtolower($this->input->post('frm_su_email'));
		$passw = $this->input->post('frm_su_passw');
		
		# generate token
		$token = bin2hex(openssl_random_pseudo_bytes(16));
		$data = [
			'candidat_email' 	=> $email,
			'candidat_pwd'		=> password_hash($passw, PASSWORD_DEFAULT),
			'candidat_verify'	=> 'N',
			'candidat_rg_key'	=> $token
		];
		$this->sitemodel->insert('tab_candidat', $data);
		
		# send email
		$subject = "MetroTV E-Recruitment - Email Verification";
		$data_email['email']['id'] = $email;
		$data_email['email']['link'] = base_url("email_verification/verify/{$token}");
		$data_email['page'] = 'registration';
		$content = $this->load->view('site/emails/template', $data_email, true);
		$isSent = sendEmail($email, $subject, $content, "MetroTV - E-Recruitment");
		if (! $isSent) {
			$msg['msg'] = "Oops, we failed to send activation email. Please click resend activation email in the bottom of this menu.";
			echo json_encode($msg);
			return;
		}
		
		$msg['type'] = 'done';
		$msg['msg'] = "Please check your email and click the activation link that we sent to activate your account.";
		echo json_encode($msg);		
	}
	
	function resend_verification_email() {
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('frm_verify_email','Email','trim|required|valid_email');
		
		if ($this->form_validation->run() == false) {
			$msg['msg'] = validation_errors();
			echo json_encode($msg);
			return;
		}
		
		# check if email exists
		$email = $this->input->post('frm_verify_email');
		$data = $this->sitemodel->view('tab_candidat', 'candidat_verify', ['candidat_email' => $email]);
		if ($data == '0') {
			$msg['msg'] = "This email address not registered.";
			echo json_encode($msg);
			return;
		}
		
		# check verify status
		$verify_status = $data[0]->candidat_verify;
		if ($verify_status == 'Y') {
			$msg['msg'] = "This email address has already been verified.<br>You can login with this email address.";
			echo json_encode($msg);
			return;
		}
		
		# generate new token
		$token = bin2hex(openssl_random_pseudo_bytes(16));
		$data = [
			'candidat_rg_key'	=> $token
		];
		$this->sitemodel->update('tab_candidat', $data, ['candidat_email' => $email]);
		
		# send email
		$subject = "MetroTV E-Recruitment - Email Verification";
		$data_email['email']['id'] = $email;
		$data_email['email']['link'] = base_url("email_verification/verify/{$token}");
		$data_email['page'] = 'registration';
		$content = $this->load->view('site/emails/template', $data_email, true);
		$isSent = sendEmail($email, $subject, $content, "MetroTV - E-Recruitment");
		if (! $isSent) {
			$msg['msg'] = "Oops, we failed to send activation email. Please click resend activation email in the bottom of this menu.";
			echo json_encode($msg);
			return;
		}

		$msg['type'] = 'done';
		$msg['msg'] = "We have sent you a confirmation email with a link to activate your account.";
		echo json_encode($msg);	
	}
	
	function resend_forgot_pass() {
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('frm_email','Email','trim|required|valid_email');
		
		if ($this->form_validation->run() == false) {
			$msg['msg'] = validation_errors();
			echo json_encode($msg);
			return;
		}
		
		# check if email exists
		$email = $this->input->post('frm_email');		
		$data = $this->sitemodel->view('tab_candidat', 'candidat_verify', ['candidat_email' => $email]);
		if ($data == '0') {
			$msg['msg'] = "This email address not registered.";
			echo json_encode($msg);
			return;
		}
		
		# generate new token
		$token = bin2hex(openssl_random_pseudo_bytes(16));
		$data = [
			'candidat_rg_key'	=> $token
		];
		$this->sitemodel->update('tab_candidat', $data, ['candidat_email' => $email]);
		
		# send email
		$subject = "MetroTV E-Recruitment - Forget Password";
		$content = "Thank You! Click this <a href=\"".base_url()."email_verification/forgot_password/{$token}\">link to change your password</a>";
		if (! sendEmail($email, $subject, $content)) {
			$msg['msg'] = "Oops, we failed to send email. Please try again.";
			echo json_encode($msg);
			return;
		}
		
		$msg['type'] = 'done';
		$msg['msg'] = "We have sent you a confirmation email with a link to restore your password.";
		echo json_encode($msg);	
	}
	
	function isValidCaptcha($captcha) {
		
		if (empty($captcha)) return false;
		
		$google_url	= "https://www.google.com/recaptcha/api/siteverify";
		$secret		= "6LeFxRkUAAAAANAb7IUIePJfQxPIFDKJEf9H4XXY";
		$ip			= $_SERVER['REMOTE_ADDR'];
		$captchaurl	= $google_url."?secret=".$secret."&response=".$captcha."&remoteip=".$ip;
		
		$curl_init = curl_init();
		curl_setopt($curl_init, CURLOPT_URL, $captchaurl);
		curl_setopt($curl_init, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl_init, CURLOPT_TIMEOUT, 10);
		$results = curl_exec($curl_init);
		curl_close($curl_init);
		
		$results = json_decode($results, true);
		return $results['success'];
	}
	
	function forgot_password() {
		
		# email
		$data['email'] = $this->input->get('e');
		$data['token'] = $this->input->get('t');
		
		if (empty($data['email']) or empty($data['token'])) {
			redirect('/');
		}
		
		# check email & token validity
		$res = $this->sitemodel->view('tab_candidat', '*', ['candidat_email' => $data['email'], 'candidat_rg_key' => $data['token']]);
		$valid = ($res != '0');
		
		if ($valid) {
			$data['page'] = 'forgot_password';
			$this->load->view('site/front/main-site', $data + $this->fc);
		}
		else {
			redirect('/');
		}
	}
	
	function change_password() {
		
		if (! $this->hasLogin()) {
			redirect('/');
		}
		
		$data['page'] = 'change_password';
		$this->load->view('site/front/main-site', $data + $this->fc);
	}
	
	function update_password() {
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('old_pass','Old Password','required|min_length[8]');
		$this->form_validation->set_rules('new_pass','New Password','required|min_length[8]');
		$this->form_validation->set_rules('confirm_pass', 'Confirm Password', 'required|matches[new_pass]');
		
		if ($this->form_validation->run() == false) {
			$msg['msg'] = validation_errors();
			echo json_encode($msg);
			return;
		}
		
		#check oldpass valid		
		$data = $this->sitemodel->view('tab_candidat', 'candidat_pwd', ['candidat_id' => $this->log_user]);
		if ($data == '0') {
			$msg['msg'] = "Invalid data.";
			echo json_encode($msg);
			return;
		}
		
		$passw = $this->input->post('old_pass');
		if (! password_verify($passw, $data[0]->candidat_pwd)) {
			$msg['msg'] = "Invalid old password.";
			echo json_encode($msg);
			return;					
		}
		
		$new_pass = $this->input->post('new_pass');
		$data_update = [
			'candidat_pwd' => password_hash($new_pass, PASSWORD_DEFAULT)
		];
		
		$this->sitemodel->update('tab_candidat', $data_update, ['candidat_id' => $this->log_user]);
		$msg['type'] = "success";
		$msg['msg'] = "Password has been saved!";
		echo json_encode($msg);
	}
	
	function update_forgot_password() {
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('new_pass','New Password','required|min_length[8]');
		$this->form_validation->set_rules('confirm_pass', 'Confirm Password', 'required|matches[new_pass]');
		
		if ($this->form_validation->run() == false) {
			$msg['msg'] = validation_errors();
			echo json_encode($msg);
			return;
		}
		
		#check token valid
		$email = strtolower($this->input->post('frm_email'));
		$token = $this->input->post('frm_token');
		$data = $this->sitemodel->view('tab_candidat', 'candidat_rg_key', ['candidat_email' => $email]);
		if ($data == '0') {
			$msg['msg'] = "Invalid data.";
			echo json_encode($msg);
			return;
		}
		
		#compare token
		if ($token !== $data[0]->candidat_rg_key) {
			$msg['msg'] = "Invalid data.";
			echo json_encode($msg);
			return;					
		}
		
		$new_pass = $this->input->post('new_pass');
		$data_update = [
			'candidat_pwd' => password_hash($new_pass, PASSWORD_DEFAULT)
		];
		
		$this->sitemodel->update('tab_candidat', $data_update, ['candidat_email' => $email]);
		$msg['type'] = "success";
		$msg['msg'] = "Password has been saved!";
		echo json_encode($msg);
	}
	
	// function test_email() {
		// $email = "internizti21@gmail.com";
		// $token = "abcde";
		// # send email
		// $subject = "Email Verification";
		
		// $data_email['email']['id'] = $email;
		// $data_email['email']['link'] = base_url("email_verification/verify/{$token}");
		// $data_email['page'] = 'registration';
		// $content = $this->load->view('site/emails/template', $data_email, true);
		// $isSent = sendEmail($email, $subject, $content, "MetroTV - E-Recruitment");
		// if (! $isSent) {
			// $msg['msg'] = "Oops, we failed to send activation email. Please click resend activation email in the bottom of this menu.";
			// echo json_encode($msg);
			// return;
		// }
	// }
}