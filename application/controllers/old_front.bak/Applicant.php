<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Applicant extends SITE_Controller {

	function __construct(){
		parent::__construct();	
		
		if (! $this->hasLogin()) {
			redirect('/');
			//test
		}
		
		# main css additional
		array_push(
			$this->fc['files']['css'],
			base_url('media/backend/plugins/bootstrap-select/css/bootstrap-select.min.css'),
			base_url('media/backend/plugins/dropzone/dropzone.css'),
			base_url('media/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')
		);
		
		# main js additional
		array_push(
			$this->fc['files']['js'],
			base_url('media/backend/plugins/bootstrap-select/js/bootstrap-select.min.js'),
			base_url('media/backend/plugins/dropzone/dropzone.js'),
			base_url('media/backend/plugins/jquery-inputmask/jquery.inputmask.bundle.js'),
			base_url('media/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')
		);
		
		# custom js additional
		array_push(
			$this->fc['files']['js_custom'],
			base_url('media/site/js/fc_applicant.js')
		);
	}
	
	function index() {
		
		# vacancy_id
		if ($this->input->get('v')) {
			$data['vacancy_detail'] = $this->sitemodel->view('tr_vacant', '*', ['vacant_id' => $this->input->get('v')]);
		}
		
		$data['university'] = $this->sitemodel->view('tab_university', '*');
		
		# LOAD F1 F2 F8 - PERSONAL INFORMATION
		$data['applicant_data'] = $this->sitemodel->view('tab_candidat', '*', ['candidat_id' => $this->log_user]);
		
		# LOAD F3 EDUCATION
		$data['applicant_edu'] 		= $this->sitemodel->view('candidat_edu', '*', ['candidat_id' => $this->log_user]);
		$data['applicant_inf_edu'] 	= $this->sitemodel->view('candidat_inf_edu', '*', ['candidat_id' => $this->log_user]);
		$data['applicant_lang'] 	= $this->sitemodel->view('candidat_lang', '*', ['candidat_id' => $this->log_user]);
		
		# LOAD F4 FAMILY
		$data['applicant_family'] 	= $this->sitemodel->view('candidat_family', '*', ['candidat_id' => $this->log_user], false, 'family_dob');
		$data['applicant_children'] = $this->sitemodel->view('candidat_children', '*', ['candidat_id' => $this->log_user], false, 'child_dob');
		
		# LOAD F5 EMPLOYMENT 
		$data['applicant_employment'] = $this->sitemodel->view('candidat_work_exp', '*', ['candidat_id' => $this->log_user]);
		
		# LOAD F6 ORGANIZATION 
		$data['applicant_organization'] = $this->sitemodel->view('candidat_organizational', '*', ['candidat_id' => $this->log_user]);
		$data['applicant_achivement'] = $this->sitemodel->view('candidat_achievement', '*', ['candidat_id' => $this->log_user]);
		
		# LOAD F7 REFERENCES 
		$data['applicant_reference'] = $this->sitemodel->view('candidat_references', '*', ['candidat_id' => $this->log_user]);

		$data['page'] = 'applicant_data';
		$this->load->view('site/front/main-site', $data + $this->fc);
	}
	
	/*
	*
	*	FORM 2 : PERSONAL INFORMATION
	*
	*/
	function update_frm_f2() {

		$this->load->library('form_validation');
		$this->form_validation->set_rules('f2[name]','Name','trim|required');
		$this->form_validation->set_rules('f2[idno]','ID Number','trim|required');
		$this->form_validation->set_rules('f2[pob]','Place of Birth','trim|required');
		$this->form_validation->set_rules('f2[dob]','Date of Birth','trim|required|callback_isValidDate_check');
		$this->form_validation->set_rules('f2[gender]','Gender','required');
		$this->form_validation->set_rules('f2[nat]','Nationality','required');
		$this->form_validation->set_rules('f2[blood]','Blood Type','required');
		$this->form_validation->set_rules('f2[religi]','Religion','required');
		$this->form_validation->set_rules('f2[height]','Height','trim|numeric|required');
		$this->form_validation->set_rules('f2[weight]','Weight','trim|numeric|required');
		                                     
		$this->form_validation->set_rules('f2[cadd]','Current Address','trim|required');
		$this->form_validation->set_rules('f2[ccity]','Current Address - City','trim|required');
		$this->form_validation->set_rules('f2[cpost]','Current Address - Postal Code','trim|required|max_length[10]');
		$this->form_validation->set_rules('f2[cphone]','Current Address - Phone','trim|required');
		$this->form_validation->set_rules('f2[padd]','Permanent Address','trim|required');
		$this->form_validation->set_rules('f2[pcity]','Permanent Address - City','trim|required');
		$this->form_validation->set_rules('f2[ppost]','Permanent Address - Postal Code','trim|required|max_length[10]');
		$this->form_validation->set_rules('f2[pphone]','Permanent Address - Phone','trim|required');
		                                     
		$this->form_validation->set_rules('f2[marriagedate]','Date Of Marriage','trim');
		$this->form_validation->set_rules('f2[spousename]','Spouse Name','trim');
		$this->form_validation->set_rules('f2[spousedob]','Spouse DOB','trim');
		$this->form_validation->set_rules('f2[spouseocc]','Spouse Occupation','trim');
		$this->form_validation->set_rules('f2[spouseedu]','Spouse Education','trim');
				
		if ($this->form_validation->run() == false) {
			$msg['msg'] = validation_errors();
			echo json_encode($msg);
			return;
		}
		
		$applicant_data = [
			'candidat_name' 		=> $this->input->post('f2[name]'),
			'id_number'				=> $this->input->post('f2[idno]'),
			'pob'					=> $this->input->post('f2[pob]'),
			'dob'					=> date('Y-m-d', strtotime($this->input->post('f2[dob]'))),
			'gender'				=> $this->input->post('f2[gender]'),
			'nationality'			=> $this->input->post('f2[nat]'),
			'blood_id'				=> $this->input->post('f2[blood]'),
			'religion_id'			=> $this->input->post('f2[religi]'),
			'height'				=> $this->input->post('f2[height]'),
			'weight'				=> $this->input->post('f2[weight]'),
			'curr_address'			=> $this->input->post('f2[cadd]'),
			'ca_city'				=> $this->input->post('f2[ccity]'),
			'ca_zip_code'			=> $this->input->post('f2[cpost]'),
			'ca_ph'					=> $this->input->post('f2[cphone]'),
			'per_address'			=> $this->input->post('f2[padd]'),
			'pa_city'				=> $this->input->post('f2[pcity]'),
			'pa_zip_code'			=> $this->input->post('f2[ppost]'),
			'pa_ph'					=> $this->input->post('f2[pphone]'),
			'marital_status'		=> $this->input->post('f2[marital_status]'),
			'spouse_name'			=> $this->input->post('f2[spousename]'),
			'spouse_occupation'		=> $this->input->post('f2[spouseocc]'),
			'spouse_edu'			=> $this->input->post('f2[spouseedu]')
		];
		
		$marital_date 	= $this->input->post('f2[marriagedate]');
		$spouse_dob		= $this->input->post('f2[spousedob]');
		if (!empty($marital_date)) {
			$applicant_data['marital_date'] = date('Y-m-d',strtotime($marital_date));
		}
		if (!empty($spouse_dob)) {
			$applicant_data['spouse_dob'] = date('Y-m-d',strtotime($spouse_dob));
		}
		
		$this->sitemodel->update('tab_candidat', $applicant_data, ['candidat_id' => $this->log_user]);
		$msg['type'] = 'done';
		echo json_encode($msg);
	}
	
	/*
	*
	*	FORM 3 : EDUCATIONAL BACKGROUND
	*
	*/
	function update_frm_f3() {
		
		$f3 		= $this->input->post('f3');
		$f3_inf 	= $this->input->post('f3_inf');
		$f3_lang	= $this->input->post('f3_lang');
		$f3_eng		= $this->input->post('f3_eng');
		
		$this->db->trans_start();
		/* formal edu */
		for ($i = 0; $i < count($f3); $i++) {
			
			$edu_grade	= trim($f3[$i]['grade']);
			$edu_univ	= trim($f3[$i]['university']);
			$edu_other	= trim($f3[$i]['univother']);
			$edu_major	= trim($f3[$i]['major']);
			$edu_gpa	= trim($f3[$i]['gpa']);
			$edu_start	= trim($f3[$i]['date_start']);
			$edu_end 	= trim($f3[$i]['date_end']);
			
			/* IGNORE EMPTY UNIV / OTHER */
			if ( !empty($edu_univ) or !empty($edu_other) ) {
				$data_edu = [
					'edu_title' 	=> $edu_grade,
					'edu_institute'	=> ($edu_univ != 'Other') ? $edu_univ : $edu_other,
					'edu_major'		=> $edu_major,
					'gpa'			=> $edu_gpa
				];
				
				/* SMU */
				if ($edu_grade == 'SMU') {
					$data_edu['edu_institute'] = $edu_other;
				}
				if (!empty($edu_start)) {
					$date = '01-'.str_replace('/', '-', $edu_start);
					$data_edu['edu_start'] = date('Y-m-d', strtotime($date));
				}
				if (!empty($edu_end)) {
					$date = '01-'.str_replace('/', '-', $edu_end);
					$data_edu['edu_end'] = date('Y-m-d', strtotime($date));
				}				
				$edu_id = $f3[$i]['edu_id'];
				$mode = empty($edu_id) ? 'insert' : 'update';
				if ($mode == 'insert') {
					$data_edu['candidat_id'] = $this->log_user;
					$this->sitemodel->insert('candidat_edu', $data_edu);
				}				
				else {
					$this->sitemodel->update('candidat_edu', $data_edu, ['candidat_id' => $this->log_user, 'cedu_id' => $edu_id ]);
				}
				# update last edu
				// $last_edu = $this->sitemodel->view('view_candidat_edu', '*', ['candidat_id' => $this->log_user]);
				// if ($last_edu != '0'){
				// 	$this->sitemodel->update('tab_candidat', [
				// 		'latest_edu_title' 		=> $last_edu[0]->edu_title,
				// 		'latest_edu_institute'	=> $last_edu[0]->edu_institute,
				// 		'latest_edu_major'		=> $last_edu[0]->edu_major,
				// 		'latest_edu_gpa'		=> $last_edu[0]->gpa
				// 	], ['candidat_id' => $this->log_user]);
				// }
			}
		}
		
		/* informal edu */
		for ($i = 0; $i < count($f3_inf); $i++) {
			
			$inf_edu_name = trim($f3_inf[$i]['name']);
			$inf_edu_cert = trim($f3_inf[$i]['cert']);
			$inf_edu_year = trim($f3_inf[$i]['year']);
			
			/* IGNORE EMPTY NAME */
			if ( !empty($inf_edu_name) ) {
				$data_inf_edu = [
					'inf_edu_name' => $inf_edu_name,
					'inf_edu_cert' => $inf_edu_cert,
					'inf_edu_year' => (int)$inf_edu_year
				];				
				$inf_edu_id = $f3_inf[$i]['inf_edu_id'];
				$mode = empty($inf_edu_id) ? 'insert' : 'update';
				if ($mode == 'insert') {
					$data_inf_edu['candidat_id'] = $this->log_user;
					$this->sitemodel->insert('candidat_inf_edu', $data_inf_edu);
				}				
				else {
					$this->sitemodel->update('candidat_inf_edu', $data_inf_edu, ['candidat_id' => $this->log_user, 'inf_edu_id' => $inf_edu_id ]);
				}
			}
		}
		
		/* foreign language */
		for ($i = 0; $i < count($f3_lang); $i++) {
			
			$lang_name		= trim($f3_lang[$i]['name']);
			$lang_spoken	= trim($f3_lang[$i]['spoken']);
			$lang_written	= trim($f3_lang[$i]['written']);
			
			/* IGNORE EMPTY NAME */
			if ( !empty($lang_name) ) {
				$data_lang = [
					'lang_name' 	=> $lang_name,
					'cap_spoken' 	=> $lang_spoken,
					'cap_written' 	=> $lang_written
				];				
				$lang_id = $f3_lang[$i]['lang_id'];
				$mode = empty($lang_id) ? 'insert' : 'update';
				if ($mode == 'insert') {
					$data_lang['candidat_id'] = $this->log_user;
					$this->sitemodel->insert('candidat_lang', $data_lang);
				}				
				else {
					$this->sitemodel->update('candidat_lang', $data_lang, ['candidat_id' => $this->log_user, 'clang_id' => $lang_id ]);
				}
			}
		}
		
		/* english certificate */
		$eng_cert 	= trim($f3_eng['name']);
		$eng_score	= trim($f3_eng['score']);
		$eng_year	= trim($f3_eng['year']);
		$data_eng = [
			'candidat_eng_cert'		=> $eng_cert,
			'candidat_eng_score'	=> $eng_score,
			'candidat_eng_year'		=> $eng_year
		];
		$this->sitemodel->update('tab_candidat', $data_eng, ['candidat_id' => $this->log_user]);
		
		$this->db->trans_complete();
		$msg['type'] = 'done';
		echo json_encode($msg);
	}
	
	/*
	*
	*	FORM 4 : FAMILY INFORMATION
	*
	*/
	function update_frm_f4() {

		$f4_fam		= $this->input->post('f4_fam');		
		$f4_child	= $this->input->post('f4_child');
		
		$this->db->trans_start();
		/* FAMILY */
		for ($i = 0; $i < count($f4_fam); $i++) {
			
			$fam_name = trim($f4_fam[$i]['name']);
			/* IGNORE EMPTY NAME */
			if ( !empty($fam_name) ) {
				$data_family = [
					'family_name' 		=> $fam_name,
					'family_relation' 	=> trim($f4_fam[$i]['relation']),
					'family_gender' 	=> trim($f4_fam[$i]['gender']),
					'family_edu' 		=> trim($f4_fam[$i]['education'])
				];				
				$id 	= $f4_fam[$i]['family_id'];
				$dob 	= $f4_fam[$i]['dob'];
				if (!empty($dob)) {
					$data_family['family_dob'] = date('Y-m-d', strtotime($f4_fam[$i]['dob']));
				}
				if (empty($id)) {
					$data_family['candidat_id'] = $this->log_user;
					$this->sitemodel->insert('candidat_family', $data_family);
				}				
				else {
					$this->sitemodel->update('candidat_family', $data_family, ['candidat_id' => $this->log_user, 'family_id' => $id ]);
				}
			}
		}
		/* CHILDREN */
		for ($i = 0; $i < count($f4_child); $i++) {
			
			$child_name = trim($f4_child[$i]['name']);
			/* IGNORE EMPTY NAME */
			if ( !empty($child_name) ) {
				$data_children = [
					'child_name' 	=> $child_name,
					'child_gender' 	=> trim($f4_child[$i]['gender']),
					'child_edu' 	=> trim($f4_child[$i]['education'])
				];				
				$id 	= $f4_child[$i]['child_id'];
				$dob 	= $f4_child[$i]['dob'];
				if (!empty($dob)) {
					$data_children['child_dob'] = date('Y-m-d', strtotime($f4_child[$i]['dob']));
				}
				if (empty($id)) {
					$data_children['candidat_id'] = $this->log_user;
					$this->sitemodel->insert('candidat_children', $data_children);
				}				
				else {
					$this->sitemodel->update('candidat_children', $data_children, ['candidat_id' => $this->log_user, 'child_id' => $id ]);
				}
			}
		}
		$this->db->trans_complete();
		$msg['type'] = 'done';
		echo json_encode($msg);
	}
	
	/*
	*
	*	FORM 5 : EMPLOYMENT BACKGROUND
	*
	*/
	function update_frm_f5() {

		$this->load->library('form_validation');
		$this->form_validation->set_rules('f5[company]','Company Name','trim|required');
		$this->form_validation->set_rules('f5[date_start]','Date Start','trim|required');
		$this->form_validation->set_rules('f5[date_end]','Date End','trim');
		$this->form_validation->set_rules('f5[title]','Title','trim|required');
		$this->form_validation->set_rules('f5[report_to]','Report To','trim|required');
		$this->form_validation->set_rules('f5[salary]','Last Salary','trim|required');
		$this->form_validation->set_rules('f5[job_desc]','Job Description','trim|required');
		$this->form_validation->set_rules('f5[reason_leave]','Reason For Leaving','trim|required');
		$this->form_validation->set_rules('f5[may_contact]','May Contact','trim|required');
		$this->form_validation->set_rules('f5[reason_contact]','Reason / Contact Number','trim|required');
				
		if ($this->form_validation->run() == false) {
			$msg['msg'] = validation_errors();
			echo json_encode($msg);
			return;
		}
		
		$data_employment = [
			'company_name'		=> $this->input->post('f5[company]'),
			'work_exp_title'	=> $this->input->post('f5[title]'),
			'report_to'			=> $this->input->post('f5[report_to]'),
			'last_salary'		=> (float)str_replace(',', '', $this->input->post('f5[salary]')),
			'job_desc'			=> $this->input->post('f5[job_desc]'),
			'reason_leaving'	=> $this->input->post('f5[reason_leave]'),
			'may_contact'		=> $this->input->post('f5[may_contact]'),
			'reason_deny'		=> $this->input->post('f5[reason_contact]'),
		];
		
		$employ_start	= $this->input->post('f5[date_start]');
		$employ_end 	= $this->input->post('f5[date_end]');
		if (!empty($employ_start)) {
			$date = '01-'.str_replace('/', '-', $employ_start);
			$data_employment['work_exp_from'] = date('Y-m-d', strtotime($date));
		}
		if (!empty($employ_end)) {
			$date = '01-'.str_replace('/', '-', $employ_end);
			$data_employment['work_exp_to'] = date('Y-m-d', strtotime($date));
		}
		
		$mode = 'insert';
		if ($mode == 'insert') {
			$data_employment['candidat_id'] = $this->log_user;
			$this->sitemodel->insert('candidat_work_exp', $data_employment);
		}
		# update last work exp
		// $last_exp = $this->sitemodel->view('view_candidat_work', '*', ['candidat_id' => $this->log_user]);
		// if ($last_exp != '0'){
		// 	$this->sitemodel->update('tab_candidat', [
		// 		'latest_work_company' 	=> $last_exp[0]->company_name,
		// 		'latest_work_salary'	=> $last_exp[0]->last_salary
		// 	], ['candidat_id' => $this->log_user]);
		// }
		$msg['type'] = 'done';
		echo json_encode($msg);
	}
	
	/*
	*
	*	FORM 6 : ORGANIZATIONAL EXP
	*
	*/
	function update_frm_f6() {

		$f6_org	= $this->input->post('f6_org');		
		$f6_ach = $this->input->post('f6_ach');
		$f6_hobby = $this->input->post('f6[hobby]');
		
		$this->db->trans_start();
		/* ORGANIZATION */
		for ($i = 0; $i < count($f6_org); $i++) {
			
			$org_name = trim($f6_org[$i]['name']);
			/* IGNORE EMPTY NAME */
			if ( !empty($org_name) ) {
				$data_organization = [
					'activities' 		=> $org_name,
					'type_of_org' 		=> trim($f6_org[$i]['type']),
					'org_year_start' 	=> trim($f6_org[$i]['year_start']),
					'org_year_end' 		=> trim($f6_org[$i]['year_end']),
					'org_pos' 			=> trim($f6_org[$i]['position'])
				];				
				$id = $f6_org[$i]['org_id'];
				if (empty($id)) {
					$data_organization['candidat_id'] = $this->log_user;
					$this->sitemodel->insert('candidat_organizational', $data_organization);
				}				
				else {
					$this->sitemodel->update('candidat_organizational', $data_organization, ['candidat_id' => $this->log_user, 'org_id' => $id ]);
				}
			}
		}
		/* ACHIEVEMENT */
		for ($i = 0; $i < count($f6_ach); $i++) {
			
			$ach_title = trim($f6_ach[$i]['ach_title']);
			/* IGNORE EMPTY NAME */
			if ( !empty($ach_title) ) {
				$data_achievement = [
					'achievement_title' => $ach_title,
					'achievement_org' 	=> trim($f6_ach[$i]['ach_org']),
					'achievement_year' 	=> trim($f6_ach[$i]['ach_year'])
				];				
				$id = $f6_ach[$i]['ach_id'];
				if (empty($id)) {
					$data_achievement['candidat_id'] = $this->log_user;
					$this->sitemodel->insert('candidat_achievement', $data_achievement);
				}				
				else {
					$this->sitemodel->update('candidat_achievement', $data_achievement, ['candidat_id' => $this->log_user, 'achievement_id' => $id ]);
				}
			}
		}
		/* HOBBY */
		$data_hobby = [
			'candidat_hobby' => trim($f6_hobby)
		];
		$this->sitemodel->update('tab_candidat', $data_hobby, ['candidat_id' => $this->log_user]);
		
		$this->db->trans_complete();
		$msg['type'] = 'done';
		echo json_encode($msg);
	}
	
	/*
	*
	*	FORM 7 : REFERENCES
	*
	*/
	function update_frm_f7() {

		$f7	= $this->input->post('f7');		
		/* FAMILY */
		for ($i = 0; $i < count($f7); $i++) {
			
			$ref_name = trim($f7[$i]['name']);
			/* IGNORE EMPTY NAME */
			if ( !empty($ref_name) ) {
				$data_reference = [
					'cref_name' 	=> $ref_name,
					'cref_rel' 		=> trim($f7[$i]['relation']),
					'cref_addr' 	=> trim($f7[$i]['address']),
					'cref_occu' 	=> trim($f7[$i]['position']),
					'cref_years' 	=> (int)trim($f7[$i]['year'])
				];				
				$id = $f7[$i]['ref_id'];
				if (empty($id)) {
					$data_reference['candidat_id'] = $this->log_user;
					$this->sitemodel->insert('candidat_references', $data_reference);
				}				
				else {
					$this->sitemodel->update('candidat_references', $data_reference, ['candidat_id' => $this->log_user, 'cref_id' => $id ]);
				}
			}
		}
		$msg['type'] = 'done';
		echo json_encode($msg);
	}
	
	/*
	*
	*	FORM 8 : WHY WE SHOULD HIRE YOU
	*
	*/
	function update_frm_f8() {

		$this->load->library('form_validation');
		$this->form_validation->set_rules('f8[describe]','Describe Yourself','trim|required');
		$this->form_validation->set_rules('f8[salary]','Expected Salary','trim|required');
				
		if ($this->form_validation->run() == false) {
			$msg['msg'] = validation_errors();
			echo json_encode($msg);
			return;
		}
		
		$applicant_data = [
			'candidat_describe'		=> $this->input->post('f8[describe]'),
			'expect_salary'			=> (float)str_replace(',', '', $this->input->post('f8[salary]'))
		];
		
		$this->sitemodel->update('tab_candidat', $applicant_data, ['candidat_id' => $this->log_user]);
		$msg['type'] = 'done';
		echo json_encode($msg);
	}
	
	# custom callback function for form validation
	public function isValidDate_check($str) {
		
		// $d = DateTime::createFromFormat('Y-m-d', $date);
		// return $d && $d->format('Y-m-d') === $date;
		list($d, $m, $y) = explode('-', $str);		
		if (checkdate($m, $d, $y)) {
			return TRUE;
		}
		else {
			$this->form_validation->set_message('isValidDate_check', 'The {field} field must be a valid date');
			return FALSE;
		}
	}
		
	/*
	*
	*	FORM 1 : UPLOAD CV & PHOTO
	* 	MUST ADD FILE UPLOAD VALIDATION (EXTENSION FILTER) !!!
	*/
	function dz_upload(){
		
		$candidat_id	= $this->log_user;		
		$target_dir 	= "media/candidate/";
		$type 			= $this->input->get('type');

		# file validation	
		if (empty($_FILES['dzfile']) and empty($type) and $_FILES['dzfile']['size'] < 0) {
			$msg['msg'] = 'File does not exist';
			echo json_encode($msg);
			return;
		}
		$allowed_ext['cv'] = ['doc', 'docx', 'pdf'];
		$allowed_ext['photo'] = ['jpg', 'jpeg', 'png'];
		$allowed_size = 200;
		
		$filename = $_FILES['dzfile']['name'];
		$ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
		
		if ($_FILES['dzfile']['size'] > $allowed_size*1024) {
			$msg['msg'] = "Max. file size allowed = {$allowed_size} Kb";
			echo json_encode($msg);
			return;
		}
		if (! in_array($ext, $allowed_ext[$type])) {
			$msg['msg'] = "Allowed ext = [ ".join(', ',$allowed_ext[$type])." ]";
			echo json_encode($msg);
			return;
		}
		
		$random_str 	= bin2hex(openssl_random_pseudo_bytes(16));
		$new_filename 	= $random_str.'.'.$ext;		
		$hasMoved 		= move_uploaded_file($_FILES['dzfile']['tmp_name'], $target_dir.$new_filename);
		
		if ($hasMoved) {
			if ($type == 'cv') {
				$this->sitemodel->update('tab_candidat', ['candidat_cv' => $new_filename], ['candidat_id' => $candidat_id]);
			}
			else if ($type == 'photo') {
				$this->sitemodel->update('tab_candidat', ['candidat_foto' => $new_filename], ['candidat_id' => $candidat_id]);
			}
		}
		$msg['type'] = 'done';
		$msg['msg'] = 'Your data has been saved succesfully!';
		echo json_encode($msg);
	}
	
	/*
	*
	*	FUNCTION REMOVE FILE for FORM 1 - UPLOAD CV & PHOTO
	*
	*/
	function remove_file() {
		
		$type 		= $this->input->post('type');
		$target_dir = "media/candidate/";
		
		#check exists
		$file = $this->sitemodel->view('tab_candidat', 'candidat_cv, candidat_foto', ['candidat_id' => $this->log_user]);
		if ($file == '0') {
			$msg['msg'] = 'File does not exist';
			echo json_encode($msg);
			return;
		}	
		
		if ($type == 'cv') {
			if (empty($file[0]->candidat_cv)) {
				$msg['msg'] = 'File does not exist';
				echo json_encode($msg);
				return;
			}
			if (file_exists($target_dir.$file[0]->candidat_cv)) {
				if (unlink($target_dir.$file[0]->candidat_cv)) {
					$this->sitemodel->update('tab_candidat', ['candidat_cv' => ''], ['candidat_id' => $this->log_user]);
				}
			}
		}
		else if ($type == 'photo') {
			if (empty($file[0]->candidat_foto)) {
				$msg['msg'] = 'File does not exist';
				echo json_encode($msg);
				return;
			}			
			if (file_exists($target_dir.$file[0]->candidat_foto)) {
				if (unlink($target_dir.$file[0]->candidat_foto)) {
					$this->sitemodel->update('tab_candidat', ['candidat_foto' => ''], ['candidat_id' => $this->log_user]);
				}
			}
		}
		
		$msg['type'] = 'done';
		$msg['msg'] = 'Data has been deleted';
		echo json_encode($msg);
	}

	function delete_experience() {
		
		$work_exp_id = $this->input->post('id');
		#check exists
		$exp = $this->sitemodel->view('candidat_work_exp', '*', ['candidat_id' => $this->log_user, 'work_exp_id' => $work_exp_id]);
		if ($exp == '0') {
			$msg['msg'] = 'Data does not exist';
			echo json_encode($msg);
			return;
		}
		$this->sitemodel->delete('candidat_work_exp', ['work_exp_id' => $work_exp_id]);
		$msg['type'] = 'done';
		$msg['msg'] = 'Data has been deleted';
		echo json_encode($msg);
	}
}