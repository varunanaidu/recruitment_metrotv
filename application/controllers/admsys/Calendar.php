<?php if ( !defined('BASEPATH') )exit('No direct script access allowed');
	class Calendar extends CI_Controller{
		function __construct(){
			parent::__construct();
		}
		
		function index(){
			if (!isLogin()) redirect ( base_url().SYS_AUTH );			
			$data['css_loader'] = 'view-calendar.css';
			$data['header_menu'] = "calendar";			
			$data['page'] = 'calendar/view-calendar';		
			$this->load->view(SYS_FILE."main-site", $data);
		}
		
		function ajax_data(){
			$from = $this->input->get("from") / 1000;
			$to = $this->input->get("to") / 1000;
			$join = ["tab_candidat b"=>"a.candidat_id=b.candidat_id,"];
			
			//Interview User
			$cek = $this->sitemodel->view("tr_applicant a", "candidat_name a, DATE_FORMAT(iu_date, '%h:%i %p') as b, UNIX_TIMESTAMP(iu_date) as c, iu_acc d, iu_acc_reason e", ["UNIX_TIMESTAMP(iu_date) BETWEEN '{$from}' AND '{$to}'"=>NULL, "iu_stat NOT IN ('N/A')"=>NULL], $join, null, null, false);
			$out = array();
			if ( $cek != '0' ){
				foreach($cek as $row){
					$class = ( $row->d == "A" ? "event-success" : ( $row->d == "R" ? "event-important" : "event-warning" ) );
					$title = ( $row->d == "A" ? "Interview User with {$row->a} at {$row->b}" : ( $row->d == "R" ? "{$row->a} Reject Interview User, reason : {$row->e}." : "{$row->a} has not answer for Interview user session." ) );
					$out[] = [
						"title"	=> $title,
						"url"	=> "javascript:;",
						"class"	=> $class,
						"start"	=> $row->c.'000'
					];
				}
			}
			//Interview HR
			$cek = $this->sitemodel->view("tr_applicant a", "candidat_name a, DATE_FORMAT(ihr_date, '%h:%i %p') as b, UNIX_TIMESTAMP(ihr_date) as c, ihr_acc d, ihr_acc_reason e", ["UNIX_TIMESTAMP(ihr_date) BETWEEN '{$from}' AND '{$to}'"=>NULL, "ihr_stat NOT IN ('N/A')"=>NULL], $join, null, null, false);
			if ( $cek != '0' ){
				foreach($cek as $row){
					$class = ( $row->d == "A" ? "event-success" : ( $row->d == "R" ? "event-important" : "event-warning" ) );
					$title = ( $row->d == "A" ? "Interview HR with {$row->a} at {$row->b}" : ( $row->d == "R" ? "{$row->a} Reject Interview HR, reason : {$row->e}." : "{$row->a} has not answer for Interview HR session." ) );
					$out[] = [
						"title"	=> $title,
						"url"	=> "javascript:;",
						"class"	=> $class,
						"start"	=> $row->c.'000'
					];
				}
			}
			//Psikotest
			$cek = $this->sitemodel->view("tr_applicant a", "candidat_name a, DATE_FORMAT(psikotest_date, '%h:%i %p') as b, UNIX_TIMESTAMP(psikotest_date) as c, psikotest_acc d, psikotest_acc_reason e", ["UNIX_TIMESTAMP(psikotest_date) BETWEEN '{$from}' AND '{$to}'"=>NULL, "psikotest_stat NOT IN ('N/A')"=>NULL], $join, null, null, false);
			if ( $cek != '0' ){
				foreach($cek as $row){
					$class = ( $row->d == "A" ? "event-success" : ( $row->d == "R" ? "event-important" : "event-warning" ) );
					$title = ( $row->d == "A" ? "Psikotest {$row->a} at {$row->b}" : ( $row->d == "R" ? "{$row->a} Reject Psikotest, reason : {$row->e}." : "{$row->a} has not answer for psikotest." ) );
					$out[] = [
						"title"	=> $title,
						"url"	=> "javascript:;",
						"class"	=> $class,
						"start"	=> $row->c.'000'
					];
				}
			}
			//Interview Assessor
			$cek = $this->sitemodel->view("tr_applicant a", "candidat_name a, DATE_FORMAT(ia_date, '%h:%i %p') as b, UNIX_TIMESTAMP(ia_date) as c, ia_acc d, ia_acc_reason e", ["UNIX_TIMESTAMP(ia_date) BETWEEN '{$from}' AND '{$to}'"=>NULL, "ia_stat NOT IN ('N/A')"=>NULL], $join, null, null, false);
			if ( $cek != '0' ){
				foreach($cek as $row){
					$class = ( $row->d == "A" ? "event-success" : ( $row->d == "R" ? "event-important" : "event-warning" ) );
					$title = ( $row->d == "A" ? "Interview Assessor {$row->a} at {$row->b}" : ( $row->d == "R" ? "{$row->a} Reject Interview Assessor, reason : {$row->e}." : "{$row->a} has not answer for Interview Assessor Session." ) );
					$out[] = [
						"title"	=> $title,
						"url"	=> "javascript:;",
						"class"	=> $class,
						"start"	=> $row->c.'000'
					];
				}
			}
			//Medical Checkup
			$cek = $this->sitemodel->view("tr_applicant a", "candidat_name a, DATE_FORMAT(mcu_date, '%h:%i %p') as b, UNIX_TIMESTAMP(mcu_date) as c, mcu_acc d, mcu_acc_reason e", ["UNIX_TIMESTAMP(mcu_date) BETWEEN '{$from}' AND '{$to}'"=>NULL, "mcu_stat NOT IN ('N/A')"=>NULL], $join, null, null, false);
			if ( $cek != '0' ){
				foreach($cek as $row){
					$class = ( $row->d == "A" ? "event-success" : ( $row->d == "R" ? "event-important" : "event-warning" ) );
					$title = ( $row->d == "A" ? "Medical Checkup {$row->a} at {$row->b}" : ( $row->d == "R" ? "{$row->a} Reject Medical Checkup, reason : {$row->e}." : "{$row->a} has not answer for Medical Checkup." ) );
					$out[] = [
						"title"	=> $title,
						"url"	=> "javascript:;",
						"class"	=> $class,
						"start"	=> $row->c.'000'
					];
				}
			}
			//Finalization
			$cek = $this->sitemodel->view("tr_applicant a", "candidat_name a, DATE_FORMAT(final_date, '%h:%i %p') as b, UNIX_TIMESTAMP(final_date) as c, final_acc d, final_acc_reason e", ["UNIX_TIMESTAMP(final_date) BETWEEN '{$from}' AND '{$to}'"=>NULL, "final_stat NOT IN ('N/A')"=>NULL], $join, null, null, false);
			if ( $cek != '0' ){
				foreach($cek as $row){
					$class = ( $row->d == "A" ? "event-success" : ( $row->d == "R" ? "event-important" : "event-warning" ) );
					$title = ( $row->d == "A" ? "Finalization {$row->a} at {$row->b}" : ( $row->d == "R" ? "{$row->a} Reject Finalization, reason : {$row->e}." : "{$row->a} has not answer for Finalization." ) );
					$out[] = [
						"title"	=> $title,
						"url"	=> "javascript:;",
						"class"	=> $class,
						"start"	=> $row->c.'000'
					];
				}
			}
			echo json_encode(['success' => 1, 'result' => $out]);
		}
	}