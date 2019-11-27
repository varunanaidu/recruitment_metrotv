<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends SITE_Controller {


	function __construct() {
		parent::__construct();

		# main js additional
		// if (!$this->hasLogin()) {
		// 	array_push(
		// 		$this->fc['files']['js'],
		// 		"https://www.google.com/recaptcha/api.js?onload=CaptchaCallback&render=explicit"
		// 	);
		// }

		// array_push(
		// 	$this->fc['files']['js_custom'],
		// 	base_url('media/site/js/fc_home.js')
		// );
		$this->load->model('vacancy_model');
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

		$data['data_slideshow'] = $this->sitemodel->view("tab_slideshow", "*");

		// $data['data_vacancies'] = $this->sitemodel->view("tr_vacant tv", "tv.vacant_id as a, tvg.vacant_group_id as b, tv.vacant_title as c, tvg.name as d, tv.vacant_code as e, tv.vacant_criteria as f, tv.open_date as g, tv.close_date as h, tv.candidat_needed as i, tv.vacant_status as j", ['tvu.unit_name' => 'METRO TV', 'tv.vacant_status' => 'ACTIVE' ], array("tr_vacant_group tvg" => "tvg.vacant_group_id=tv.vacant_group_id,", "tr_vacant_unit tvu" => "tvu.vacant_unit_id=tvg.vacant_unit_id,"), false, 6, 0);
		$data['data_vacancies'] = $this->vacancy_model->get_vacancy(['unit_name' => 'METRO TV'], false, 6, 0);
		$data['data_faq'] = $this->sitemodel->view("tab_faq_general", "*", false, false, false, 6, 0);

		$data['data_editorial'] = $this->sitemodel->view("tab_tipsntrick", "*", false, false, "date DESC", 3, 0);
		$data['data_activities'] = $this->sitemodel->view("tab_activity", "*", false, false, "created_date DESC", 3, 0);
		$data['data_testimoni'] = $this->sitemodel->view("tab_testimoni", "*", false, false, "created_date DESC");
		$data['tr_vacant_unit'] = $this->vacancy_model->get_vacancy_unit(); 
		// $data['tr_vacant_group'] = $this->sitemodel->view("tr_vacant_group", "*", ['vacant_unit_id' => 3]); 

		if (!empty($this->session->userdata('fc_alert'))) {
			$data['fc_alert'] = $this->session->userdata('fc_alert');
		}

		$this->load->view('site/front/new-main-site', $data + $this->fc);
	}

	function login() {

		// echo json_encode($this->input->post());die;

		# uncomment this when CAPTCHA ready !!
		/*$captcha = $this->input->post('g-recaptcha-response');
		if (! $this->isValidCaptcha($captcha)) {
		$msg['msg'] = 'Invalid reCAPTCHA code !';
		echo json_encode($msg);
		return;
		}*/

		$this->load->library('form_validation');
		$this->form_validation->set_rules('Email','Email','trim|required|valid_email');
		$this->form_validation->set_rules('password','Password','required');

		if ($this->form_validation->run() == false) {
			$msg['msg'] = validation_errors();
			echo json_encode($msg);
			return;
		}

		$email = $this->input->post('Email');
		$passw = $this->input->post('password');
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
		$this->form_validation->set_rules('Email', 
			'Email', 
			'trim|required|valid_email|is_unique[tab_candidat.candidat_email]|strtolower', 
			array('is_unique' => "This {field} address is already registered."));
		$this->form_validation->set_rules('NewPassword', 'Password', 'required|min_length[8]');
		$this->form_validation->set_rules('RePassword', 'Confirm Password', 'required|matches[NewPassword]');
		$this->form_validation->set_rules('terms',' Terms of Usage', 'required');

		if ($this->form_validation->run() == false) {
			$msg['msg'] = validation_errors();
			echo json_encode($msg);
			return;
		}

		$email = strtolower($this->input->post('Email'));
		$passw = $this->input->post('NewPassword');

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
			$msg['msg'] = "Oops, we failed to send activation email.<br>Please click resend activation email in the bottom of this menu.";
			echo json_encode($msg);
			return;
		}

		$msg['type'] = 'done';
		$msg['msg'] = "Please check your email and click the activation link that we sent to activate your account.";
		echo json_encode($msg);		
	}

	function resend_verification_email() {

		$this->load->library('form_validation');
		$this->form_validation->set_rules('verify_email','Email','trim|required|valid_email');

		if ($this->form_validation->run() == false) {
			$msg['msg'] = validation_errors();
			echo json_encode($msg);
			return;
		}

		# check if email exists
		$email = $this->input->post('verify_email');
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
		$this->form_validation->set_rules('fpass_email','Email','trim|required|valid_email');

		if ($this->form_validation->run() == false) {
			$msg['msg'] = validation_errors();
			echo json_encode($msg);
			return;
		}

		# check if email exists
		$email = $this->input->post('fpass_email');		
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
			$this->load->view('site/front/new-main-site', $data + $this->fc);
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
		$this->load->view('site/front/new-main-site', $data + $this->fc);
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
			$msg['msg'] = "Invalid data 1.";
			echo json_encode($msg);
			return;
		}

		#compare token
		if ($token !== $data[0]->candidat_rg_key) {
			$msg['msg'] = "Invalid data 2.";
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

	function getVacantGroup()
	{
		$key = $this->input->post('key');
		$data = $this->sitemodel->view('tr_vacant_group', '*', ['vacant_unit_id' => $key]);
		echo json_encode($data);

	}

	function getUniversity()
	{
		$data = $this->sitemodel->view('tab_university', '*', false, false, 'university_name ASC');
		echo json_encode($data);

	}

	function change_view()
	{
		$key = $this->input->post('key');
		$unit = $this->input->post('unit');
		// $data['fData_vacancies'] = $this->sitemodel->view("tr_vacant tv", "tv.vacant_id as a, tvg.vacant_group_id as b, tv.vacant_title as c, tvg.name as d, tv.vacant_code as e, tv.vacant_criteria as f, tv.open_date as g, tv.close_date as h, tv.candidat_needed as i, tv.vacant_status as j", array("tvg.vacant_group_id"=>$key), array("tr_vacant_group tvg"=>"tvg.vacant_group_id=tv.vacant_group_id,"));
		$data['fData_vacancies'] = empty($key) ? $this->vacancy_model->get_vacancy(['vacant_unit_id' => $unit]) : $this->vacancy_model->get_vacancy(['vacant_group_id'	=> $key, 'vacant_unit_id' => $unit]);
		$data['type'] = 'filterVacancy';
		return $this->load->view('site/front/theme_2019/filter_vacancies.php', $data);
	}

	function change_view_unit()
	{
		$key = $this->input->post('key');
		// $data['fData_vacancies'] = $this->sitemodel->view("tr_vacant tv", "tv.vacant_id as a, tvu.vacant_unit_id as b, tv.vacant_title as c, tvg.name as d, tv.vacant_code as e, tv.vacant_criteria as f, tv.open_date as g, tv.close_date as h, tv.candidat_needed as i, tv.vacant_status as j", array("tvu.vacant_unit_id"=>$key), array("tr_vacant_group tvg"=>"tvg.vacant_group_id=tv.vacant_group_id,", "tr_vacant_unit tvu"=>"tvg.vacant_unit_id=tvu.vacant_unit_id,") );
		$data['fData_vacancies'] = empty($key) ? $this->vacancy_model->get_vacancy() : $this->vacancy_model->get_vacancy(['vacant_unit_id' => $key]);
		$data['type'] = 'filterVacancy';
		return $this->load->view('site/front/theme_2019/filter_vacancies.php', $data);
	}

	function searchJob()
	{
		$key 			 = trim($this->input->post('key'));
		$vacant_unit_id  = $this->input->post('vacant_unit_id');
		$vacant_group_id = $this->input->post('vacant_group_id');

		if ($vacant_group_id == "") {
			// $data['fData_vacancies'] = $this->sitemodel->view("tr_vacant tv", "tv.vacant_id as a, tvg.vacant_group_id as b, tv.vacant_title as c, tvg.name as d, tv.vacant_code as e, tv.vacant_criteria as f, tv.open_date as g, tv.close_date as h, tv.candidat_needed as i, tv.vacant_status as j", array("tv.vacant_title"=>$key, "tvu.vacant_unit_id"=>$vacant_unit_id), array("tr_vacant_group tvg"=>"tvg.vacant_group_id=tv.vacant_group_id,", "tr_vacant_unit tvu"=>"tvu.vacant_unit_id=tvg.vacant_unit_id,"));
			$data['fData_vacancies'] = $this->vacancy_model->get_vacancy([
				'vacant_title'		=> $key,
				'vacant_unit_id'	=> $vacant_unit_id
			]);
		}
		else{
			// $data['fData_vacancies'] = $this->sitemodel->view("tr_vacant tv", "tv.vacant_id as a, tvg.vacant_group_id as b, tv.vacant_title as c, tvg.name as d, tv.vacant_code as e, tv.vacant_criteria as f, tv.open_date as g, tv.close_date as h, tv.candidat_needed as i, tv.vacant_status as j", array("tv.vacant_title"=>$key, "tvu.vacant_unit_id"=>$vacant_unit_id, "tvg.vacant_group_id"=>$vacant_group_id), array("tr_vacant_group tvg"=>"tvg.vacant_group_id=tv.vacant_group_id,", "tr_vacant_unit tvu"=>"tvu.vacant_unit_id=tvg.vacant_unit_id,"));
			$data['fData_vacancies'] = $this->vacancy_model->get_vacancy([
				'vacant_title'		=> $key,
				'vacant_group_id'	=> $vacant_group_id,
				'vacant_unit_id'	=> $vacant_unit_id
			]);
		}
		$data['type'] = 'filterVacancy';
		return $this->load->view('site/front/theme_2019/filter_vacancies.php', $data);

	}

	function getPage($page){

		switch ($this->input->post('key')) {
			case 'vacancies':
			$start = ceil($page * 6);
			if ($this->input->post('vacant_group_id') == "") {
				$data['data_vacancies'] = $this->sitemodel->view("tr_vacant tv", "tv.vacant_id as a, tvg.vacant_group_id as b, tv.vacant_title as c, tvg.name as d, tv.vacant_code as e, tv.vacant_criteria as f, tv.open_date as g, tv.close_date as h, tv.candidat_needed as i, tv.vacant_status as j", array("tvu.vacant_unit_id"=>$this->input->post('vacant_unit_id'), "tv.vacant_status"=>"ACTIVE"), array("tr_vacant_group tvg" => "tvg.vacant_group_id=tv.vacant_group_id,", "tr_vacant_unit tvu" => "tvu.vacant_unit_id=tvg.vacant_unit_id,"), false, 6, $start);
			}else{
				$data['data_vacancies'] = $this->sitemodel->view("tr_vacant tv", "tv.vacant_id as a, tvg.vacant_group_id as b, tv.vacant_title as c, tvg.name as d, tv.vacant_code as e, tv.vacant_criteria as f, tv.open_date as g, tv.close_date as h, tv.candidat_needed as i, tv.vacant_status as j", array("tvu.vacant_unit_id"=>$this->input->post('vacant_unit_id'), "tvg.vacant_group_id"=>$this->input->post('vacant_group_id'), "tv.vacant_status"=>"ACTIVE" ), array("tr_vacant_group tvg" => "tvg.vacant_group_id=tv.vacant_group_id,", "tr_vacant_unit tvu" => "tvu.vacant_unit_id=tvg.vacant_unit_id,"), false, 6, $start);
			}
			echo json_encode($data);
			break;

			case 'editorial':
			$start = ceil($page * 3);
			$data['data_editorial'] = $this->sitemodel->view("tab_tipsntrick", "*", false, false, "date DESC", 3, $start);
			echo json_encode($data);
			break;

			case 'activity':
			$start = ceil($page * 3);
			$data['data_activities'] = $this->sitemodel->view("tab_activity", "*", false, false, "created_date DESC", 3, $start);
			echo json_encode($data);
			break;

			case 'faq':
			$start = ceil($page * 6);
			$data['data_faq'] = $this->sitemodel->view("tab_faq_general", "*", false, false, false, 6, $start);
			echo json_encode($data);
			break;
		}
	}

	function detailVacant($vacant_id){
		$data['page'] = 'detail_vacancies';
		$data['data_vacancies'] = $this->sitemodel->view("tr_vacant", "*",  array("vacant_id ="=> $vacant_id));
		$this->load->view('site/front/new-main-site', $data);
	}

	function detailTips($tipsntrick_id){
		$data['page'] = 'detail';
		$data['data_editorial'] = $this->sitemodel->view("tab_tipsntrick", "*",  array("tipsntrick_id ="=> $tipsntrick_id));
		$data['data_testimoni'] = $this->sitemodel->view("tab_testimoni", "*", false, false, "created_date DESC");
		$this->load->view('site/front/new-main-site', $data);
	}

	function detailAct($activity_id){
		$data['page'] = 'detail';
		$data['data_activity'] = $this->sitemodel->view("tab_activity", "*",  array("activity_id ="=> $activity_id));
		$data['data_testimoni'] = $this->sitemodel->view("tab_testimoni", "*", false, false, "created_date DESC");
		$this->load->view('site/front/new-main-site', $data);
	}

	function tos()
	{
		$data['page'] = 'tos';
		$this->load->view('site/front/new-main-site', $data);
	}

	function detailTesti($testimoni_id){
		$data['page'] = 'detail';
		$data['data_testimoni'] = $this->sitemodel->view("tab_testimoni", "*",  array("testimoni_id ="=> $testimoni_id));
		$this->load->view('site/front/new-main-site', $data);
	}

	function ajax_remove_data()
	{
		$msg = array();
		if ($_POST) {
			$type = $this->input->post('type');
			if ( empty($type) ) {
				$msg['type'] = 'failed';
				$msg['msg'] = "Invalid parameter.";
			}else{
				if ($type == 'delFamily') {
					if ($this->input->post('relation') == 'FAMILY') {
						$cek = $this->sitemodel->view("candidat_family", "*", array("family_id"=>$this->input->post('id')));
						if ($cek == 0) {
							$msg['type'] = 'failed';
							$msg['msg'] = "No Family found.";
						}else{
							$this->sitemodel->delete("candidat_family", array("family_id"=>$this->input->post('id')));
							$msg['type'] = 'done';
							$msg['msg'] = "Successfully remove family member.";
						}
					}else{
						$cek = $this->sitemodel->view("candidat_children", "*", array("child_id"=>$this->input->post('id')));
						if ($cek == 0) {
							$msg['type'] = 'failed';
							$msg['msg'] = "No Family found.";
						}else{
							$this->sitemodel->delete("candidat_children", array("child_id"=>$this->input->post('id')));
							$msg['type'] = 'done';
							$msg['msg'] = "Successfully remove family member.";
						}
					}
					
				}else if ($type == 'delWork'){
						$cek = $this->sitemodel->view("candidat_work_exp", "*", array("work_exp_id"=>$this->input->post('id')));
						if ($cek == 0) {
							$msg['type'] = 'failed';
							$msg['msg'] = "No work experience found.";
						}else{
							$this->sitemodel->delete("candidat_work_exp", array("work_exp_id"=>$this->input->post('id')));
							$msg['type'] = 'done';
							$msg['msg'] = "Successfully remove work experience.";
						}
				}else if ($type == 'delEdu'){
						$cek = $this->sitemodel->view("candidat_edu", "*", array("cedu_id"=>$this->input->post('id')));
						if ($cek == 0) {
							$msg['type'] = 'failed';
							$msg['msg'] = "No education found.";
						}else{
							$this->sitemodel->delete("candidat_edu", array("cedu_id"=>$this->input->post('id')));
							$msg['type'] = 'done';
							$msg['msg'] = "Successfully remove educational experience.";
						}
				}else if ($type == 'delOrg') {
						$cek = $this->sitemodel->view("candidat_organizational", "*", array("org_id"=>$this->input->post('id')));
						if ($cek == 0) {
							$msg['type'] = 'failed';
							$msg['msg'] = "No organization found.";
						}else{
							$this->sitemodel->delete("candidat_organizational", array("org_id"=>$this->input->post('id')));
							$msg['type'] = 'done';
							$msg['msg'] = "Successfully remove organizational experience.";
						}
				}
			}
		}
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