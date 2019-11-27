<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Vacancy extends SITE_Controller {

	function __construct() {
		parent::__construct();
		
		$this->session->set_userdata('referred_to', current_url());
		
		if (! $this->hasLogin()) {
			redirect('?login_popup=true');
		}
	}
	
	function apply($job_id) {
		
		# check if job_id exists
		$vacant = $this->sitemodel->view('tr_vacant', 'vacant_id, vacant_title', ['vacant_id' => $job_id, 'vacant_status' => 'ACTIVE']);
		if ($vacant == '0') {
			$msg = ['type' => 'error', 'msg' => "Sorry, we don't have this vacancy right now."];
			$this->session->set_flashdata('fc_alert', $msg);
			redirect('/');
			return;
		}
		
		# check if user already applied this vacancy before (time limitation 6 month before new application for same job_id)
		############################################ PERLU REVISI
		$data = $this->sitemodel->view('tr_applicant', '*', ['candidat_id' => $this->log_user, 'vacant_id' => $job_id], false, 'apply_date DESC');
		$hasAppliedBefore = ($data != '0');
		if ($hasAppliedBefore) {
			$msg = ['type' => 'error', 'msg' => "You already applied this vacancy before."];
			$this->session->set_flashdata('fc_alert', $msg);
			redirect('/');
			return;
		}
		
		# check if user already filled application form
		############################################ PERLU REVISI
		# cek cv + photo + describe + salary, name, education
		$data_app = $this->sitemodel->view('tab_candidat', 'candidat_id, candidat_name, candidat_cv, candidat_foto, candidat_describe, expect_salary', ['candidat_id' => $this->log_user]); 
		$data_edu = $this->sitemodel->view('candidat_edu', '*', ['candidat_id' => $this->log_user]);
		$isFilled = (!empty($data_app[0]->candidat_name) 
						// and !empty($data_app[0]->candidat_cv) /* temporary disable */
						// and !empty($data_app[0]->candidat_foto) /* temporary disable */
						and !empty($data_app[0]->candidat_describe) 
						and !empty($data_app[0]->expect_salary) 
						and ($data_edu != '0'));
		if (! $isFilled) {
			redirect("applicant?v={$job_id}");
			return;
		}
		
		# success
		$this->session->set_userdata('referred_to', base_url("vacancy/apply_confirm/{$job_id}"));
		redirect("?confirm_popup=true&v={$job_id}");
	}
	
	function apply_confirm($job_id) {
		
		# check if job_id exists
		$data = $this->sitemodel->view('tr_vacant', 'vacant_id', ['vacant_id' => $job_id, 'vacant_status' => 'ACTIVE']);
		if ($data == '0') {
			$msg['msg'] = "Sorry, we don't have this vacancy right now.";
			echo json_encode($msg);
			return;
		}
		
		# check if user already applied this vacancy before (time limitation 6 month before new application for same job_id)
		############################################ PERLU REVISI
		$data = $this->sitemodel->view('tr_applicant', '*', ['candidat_id' => $this->log_user, 'vacant_id' => $job_id], false, 'apply_date DESC');
		$hasAppliedBefore = ($data != '0');
		if ($hasAppliedBefore) {
			$msg['msg'] = "You already applied this vacancy before.";
			echo json_encode($msg);
			return;
		}
		
		# check if user already filled application form
		# cek cv + photo + describe + salary, name, education
		$data_app = $this->sitemodel->view('tab_candidat', 'candidat_id, candidat_name, candidat_cv, candidat_foto, candidat_describe, expect_salary', ['candidat_id' => $this->log_user]); 
		$data_edu = $this->sitemodel->view('candidat_edu', '*', ['candidat_id' => $this->log_user]);
		$isFilled = (!empty($data_app[0]->candidat_name) 
						// and !empty($data_app[0]->candidat_cv) /* temporary disable */
						// and !empty($data_app[0]->candidat_foto) /* temporary disable */
						and !empty($data_app[0]->candidat_describe) 
						and !empty($data_app[0]->expect_salary) 
						and ($data_edu != '0'));
		
		if (! $isFilled) {
			$msg['msg'] = "<p>Please fill in all required informations.</p>
							<p>Required informations :</p>
							<!--p class='strong'>Upload CV &amp; Latest Photo</p-->
							<p class='strong'>Personal Information</p>
							<p class='strong'>Educational Background</p>
							<p class='strong'>Why we should hire you</p>";
			echo json_encode($msg);
			return;
		}
		
		$config = [
			'candidat_id' 	=> $this->log_user,
			'vacant_id'		=> $job_id,
			'apply_date'	=> date('Y-m-d H:i:s')
		];
		
		$this->sitemodel->insert('tr_applicant', $config);
		
		$msg['type'] = 'done';
		$msg['msg'] = "Thank you! We have received your application.";
		echo json_encode($msg);
	}

}
