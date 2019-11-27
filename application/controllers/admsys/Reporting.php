<?php if ( !defined('BASEPATH') )exit('No direct script access allowed');
	class Reporting extends CI_Controller{
		function __construct(){
			parent::__construct();
		}
		
		//ALL VIEW
		function index(){
			if ( !isLogin() )redirect(redirect(base_url().SYS_AUTH));
			$data['header_menu'] = "reporting";
			$data['header_child'] = "global";
			$data['css_loader'] = 'reporting-global.css';			
			$data['page'] = 'reporting/view-reporting-global';
			$this->load->view(SYS_FILE."main-site", $data);
		}
		
		function candidat_progress(){
			if ( !isLogin() )redirect(redirect(base_url().SYS_AUTH));
			$data['header_menu'] = "reporting";
			$data['header_child'] = "candidat-progress";
			$data['css_loader'] = 'reporting-global.css';
			$data['data_vacant'] = $this->sitemodel->view("tr_vacant", "vacant_id, vacant_title, DATE_FORMAT(open_date, '%d %M %Y') as a, DATE_FORMAT(close_date, '%d %M %Y') as b", null, null, null, null, false);
			$data['page'] = 'reporting/view-reporting-candidat-progress';
			$this->load->view(SYS_FILE."main-site", $data);
		}
		//#END ALL VIEW
		
		//ALL MODULAR AJAXd
		//VALIDATING EXCEL FOR GLOBAL REPORT
		function validate_excel_global(){
			$msg = array();
			if ( isLogin() ){
				if ( $_POST ){
					$year = $this->input->post("year");
					if ( empty($year) ){
						$msg['type'] = 'failed';
						$msg['msg'] = "Maaf, tahun tidak boleh kosong.";
					}
					else{
						$msg['type'] = 'done';
						$msg['msg'] = '';
					}
				}
				else{
					$msg['type'] = 'failed';
					$msg['msg'] = "Invalid parameter.";
				}
			}
			else{
				$msg['type'] = 'failed';
				$msg['msg'] = "Maaf, Session anda telah berakhir, harap refresh ulang browser anda.";
			}
			echo json_encode($msg);
		}
		//VALIDATING EXCEL FOR CANDIDAT PROGRESS REPORT
		function validate_excel_cp(){
			$msg = array();
			if ( isLogin() ){
				if ( $_POST ){
					$vacant = $this->input->post("vacant");
					$range_date = $this->input->post("range_date");
					
					if ( empty($vacant) or empty($range_date) ){
						$msg['type'] = 'failed';
						$msg['msg'] = "Harap isi semua data.";
					}
					else{
						$exp = explode(" - ", $range_date);
						if ( count($exp) == 2 ){
							$msg['type'] = 'done';
							$msg['msg'] = '';
						}
						else{
							$msg['type'] = 'failed';
							$msg['msg'] = "Invalid format tanggal.";
						}
					}
				}
				else{
					$msg['type'] = 'failed';
					$msg['msg'] = "Invalid parameter.";
				}
			}
			else{
				$msg['type'] = 'failed';
				$msg['msg'] = "Maaf, Session anda telah berakhir, harap refresh ulang browser anda.";
			}
			echo json_encode($msg);
		}
		
		//GENERATE EXCEL FOR CANDIDAT PROGRESS REPORT
		function get_excel_cp($vac='', $rd=''){
			$exp = explode("%20-%20", $rd);
			
			$where = array(
				"vacant_id" => $vac,
				"apply_date BETWEEN '{$exp[0]}' AND '{$exp[1]}'"=>NULL
			);
			$join = array(
				"tab_candidat b"=>"a.candidat_id=b.candidat_id,"
			);
			$get = $this->sitemodel->view("tr_applicant a", "candidat_name, iu_stat, ihr_stat, psikotest_stat, ia_stat, mcu_stat, final_stat, applicant_status", $where, $join);
			$data['data_vacant'] = $this->sitemodel->view("tr_vacant", "vacant_id, vacant_title, DATE_FORMAT(open_date, '%d %M %Y') as a, DATE_FORMAT(close_date, '%d %M %Y') as b", array("vacant_id"=>$vac), null, null, null, false);
			$data['data'] = $get;
			$this->load->view(SYS_FILE."reporting/view-excel-cp", $data);			
		}
		
		//GENERATE EXCEL FOR GLOBAL REPORT
		function get_excel_global($year=''){
			$where = array(
				$year
			);
			//QUERY untuk dapetin jumlah vacancy yang dibuka
			$sql = "SELECT COUNT(*) AS TOTAL FROM tr_vacant WHERE DATE_FORMAT(created_date, '%Y') = ?";
			$get_vacant = $this->sitemodel->custom_query($sql, $where);
			//QUERY untuk dapetin jumlah applicant yang melamar
			$sql = "SELECT COUNT(*) AS TOTAL FROM tr_applicant WHERE DATE_FORMAT(apply_date, '%Y') = ?";
			$get_applicant = $this->sitemodel->custom_query($sql, $where);			
			//QUERY untuk dapetin jumlah pelamar yang diproses ( KESELURUHAN )
			$sql = "SELECT COUNT(*) AS TOTAL FROM tr_applicant WHERE applicant_status IN ('On Going', 'Failed', 'Passed') AND DATE_FORMAT(apply_date, '%Y') = ?";
			$get_proses  = $this->sitemodel->custom_query($sql, $where);
			//QUERY untuk dapetin jumlah pelamar yang diproses ( PASSED )
			$sql = "SELECT COUNT(*) AS TOTAL FROM tr_applicant WHERE applicant_status IN ('Passed') AND DATE_FORMAT(apply_date, '%Y') = ?";
			$get_passed  = $this->sitemodel->custom_query($sql, $where);
			//QUERY untuk dapetin jumlah pelamar yang diproses ( FAILED )
			$sql = "SELECT COUNT(*) AS TOTAL FROM tr_applicant WHERE applicant_status IN ('Failed') AND DATE_FORMAT(apply_date, '%Y') = ?";
			$get_failed  = $this->sitemodel->custom_query($sql, $where);
			//QUERY untuk dapetin jumlah pelamar yang diproses ( ON GOING )
			$sql = "SELECT COUNT(*) AS TOTAL FROM tr_applicant WHERE applicant_status IN ('On Going') AND DATE_FORMAT(apply_date, '%Y') = ?";
			$get_going  = $this->sitemodel->custom_query($sql, $where);
			
			$data['data_vacant'] = $get_vacant;
			$data['data_applicant'] = $get_applicant;
			$data['data_proses'] = $get_proses;
			$data['data_passed'] = $get_passed;
			$data['data_failed'] = $get_failed;
			$data['data_going'] = $get_going;
			$data['data_year'] = $year;
			$this->load->view(SYS_FILE."reporting/view-excel-global", $data);
		}
		
		//GENERATE EXCEL FOR GLOBAL REPORT (MONTH)
		function get_excel_global_month($year='', $month=''){
			$where = array(
				$year, $month
			);
			//QUERY untuk dapetin jumlah vacancy yang dibuka
			$sql = "SELECT COUNT(*) AS TOTAL FROM tr_vacant WHERE DATE_FORMAT(created_date, '%Y') = ? AND DATE_FORMAT(created_date, '%M') = ?";
			$get_vacant = $this->sitemodel->custom_query($sql, $where);
			//QUERY untuk dapetin jumlah applicant yang melamar
			$sql = "SELECT COUNT(*) AS TOTAL FROM tr_applicant WHERE DATE_FORMAT(apply_date, '%Y') = ? AND DATE_FORMAT(apply_date, '%M') = ?";
			$get_applicant = $this->sitemodel->custom_query($sql, $where);			
			//QUERY untuk dapetin jumlah pelamar yang diproses ( KESELURUHAN )
			$sql = "SELECT COUNT(*) AS TOTAL FROM tr_applicant WHERE applicant_status IN ('On Going', 'Failed', 'Passed') AND DATE_FORMAT(apply_date, '%Y') = ? AND DATE_FORMAT(apply_date, '%M') = ?";
			$get_proses  = $this->sitemodel->custom_query($sql, $where);
			//QUERY untuk dapetin jumlah pelamar yang diproses ( PASSED )
			$sql = "SELECT COUNT(*) AS TOTAL FROM tr_applicant WHERE applicant_status IN ('Passed') AND DATE_FORMAT(apply_date, '%Y') = ? AND DATE_FORMAT(apply_date, '%M') = ?";
			$get_passed  = $this->sitemodel->custom_query($sql, $where);
			//QUERY untuk dapetin jumlah pelamar yang diproses ( FAILED )
			$sql = "SELECT COUNT(*) AS TOTAL FROM tr_applicant WHERE applicant_status IN ('Failed') AND DATE_FORMAT(apply_date, '%Y') = ? AND DATE_FORMAT(apply_date, '%M') = ?";
			$get_failed  = $this->sitemodel->custom_query($sql, $where);
			//QUERY untuk dapetin jumlah pelamar yang diproses ( ON GOING )
			$sql = "SELECT COUNT(*) AS TOTAL FROM tr_applicant WHERE applicant_status IN ('On Going') AND DATE_FORMAT(apply_date, '%Y') = ? AND DATE_FORMAT(apply_date, '%M') = ?";
			$get_going  = $this->sitemodel->custom_query($sql, $where);
			
			$data['data_vacant'] = $get_vacant;
			$data['data_applicant'] = $get_applicant;
			$data['data_proses'] = $get_proses;
			$data['data_passed'] = $get_passed;
			$data['data_failed'] = $get_failed;
			$data['data_going'] = $get_going;
			$data['data_year'] = $year;
			$data['data_month'] = $month;
			$this->load->view(SYS_FILE."reporting/view-excel-global-month", $data);
		}
		
		//SHOW LOADING PAGE
		function loading_page(){
			$data['m'] = 'm';
			$this->load->view(SYS_FILE."reporting/loading-page", $data);
		}
		
		//VALIDATING PDF FOR CANDIDAT PROGRESS REPORT
		function get_pdf_cp(){
			$msg = array();
			if ( isLogin() ){
				if ( $_POST ){
					$vacant = $this->input->post("vacant");
					$range_date = $this->input->post("range_date");
					
					if ( empty($vacant) or empty($range_date) ){
						$msg['type'] = 'failed';
						$msg['msg'] = "Harap isi semua data.";
					}
					else{
						$exp = explode(" - ", $range_date);
						if ( count($exp) == 2 ){
							$msg['type'] = 'done';
							$msg['msg'] = base_url().SYS_AUTH."/reporting/view_pdf_cp/{$vacant}/{$range_date}";
						}
						else{
							$msg['type'] = 'failed';
							$msg['msg'] = "Invalid format tanggal.";
						}
					}
				}
				else{
					$msg['type'] = 'failed';
					$msg['msg'] = "Invalid parameter.";
				}
			}
			else{
				$msg['type'] = 'failed';
				$msg['msg'] = "Maaf, Session anda telah berakhir, harap refresh ulang browser anda.";
			}
			echo json_encode($msg);
		}
		
		//VALIDATING FOR REPORT GLOBAL
		function get_pdf_global(){
			$msg = array();
			if ( isLogin() ){
				if ( $_POST ){
					$year = $this->input->post("year");
					
					if ( empty($year) ){
						$msg['type'] = 'failed';
						$msg['msg'] = "Harap isi semua data.";
					}
					else{						
						$msg['type'] = 'done';
						$msg['msg'] = base_url().SYS_AUTH."/reporting/view_pdf_global/{$year}";						
					}
				}
				else{
					$msg['type'] = 'failed';
					$msg['msg'] = "Invalid parameter.";
				}
			}
			else{
				$msg['type'] = 'failed';
				$msg['msg'] = "Maaf, Session anda telah berakhir, harap refresh ulang browser anda.";
			}
			echo json_encode($msg);
		}

		// VALIDATING FOR REPORT GLOBAL (MONTH)
		function get_pdf_global_month(){
			$msg = array();
			if ( isLogin() ){
				if ( $_POST ){
					$year = $this->input->post("year");
					$month = $this->input->post("month");
					
					if ( empty($year) || empty($month) ){
						$msg['type'] = 'failed';
						$msg['msg'] = "Harap isi semua data.";
					}
					else{						
						$msg['type'] = 'done';
						$msg['msg'] = base_url().SYS_AUTH."/reporting/view_pdf_global_month/{$year}/{$month}";						
					}
				}
				else{
					$msg['type'] = 'failed';
					$msg['msg'] = "Invalid parameter.";
				}
			}
			else{
				$msg['type'] = 'failed';
				$msg['msg'] = "Maaf, Session anda telah berakhir, harap refresh ulang browser anda.";
			}
			echo json_encode($msg);
		}
		
		//create pdf report for candidat progress
		function view_pdf_cp($vac='', $rd=''){
			$data['data'] = $this->site_pdf_cp($vac, $rd);
			$this->load->view(SYS_FILE."reporting/get-pdf-cp", $data);
		}
		
		//create pdf report for global
		function view_pdf_global($year=''){
			$data['data'] = $this->site_pdf_global($year);
			$this->load->view(SYS_FILE."reporting/get-pdf-global", $data);
		}
		
		//create pdf report for global (month)
		function view_pdf_global_month($year='', $month=''){
			$data['data'] = $this->site_pdf_global_month($year, $month);
			$this->load->view(SYS_FILE."reporting/get-pdf-global", $data);
		}
		
		//generate view report for candidat progress
		function site_pdf_cp($vac='', $rd=''){
			$exp = explode("%20-%20", $rd);
			
			$where = array(
				"vacant_id" => $vac,
				"apply_date BETWEEN '{$exp[0]}' AND '{$exp[1]}'"=>NULL
			);
			$join = array(
				"tab_candidat b"=>"a.candidat_id=b.candidat_id,"
			);
			$get = $this->sitemodel->view("tr_applicant a", "candidat_name, iu_stat, ihr_stat, psikotest_stat, ia_stat, mcu_stat, final_stat, applicant_status", $where, $join);
			$data['data_vacant'] = $this->sitemodel->view("tr_vacant", "vacant_id, vacant_title, DATE_FORMAT(open_date, '%d %M %Y') as a, DATE_FORMAT(close_date, '%d %M %Y') as b", array("vacant_id"=>$vac), null, null, null, false);
			$data['data'] = $get;
			$site = $this->load->view(SYS_FILE."reporting/view-pdf-cp", $data, TRUE);
			
			return $site;
		}
		
		//generate view report for global
		function site_pdf_global($year=''){
			$where = array(
				$year
			);
			//QUERY untuk dapetin jumlah vacancy yang dibuka
			$sql = "SELECT COUNT(*) AS TOTAL FROM tr_vacant WHERE DATE_FORMAT(created_date, '%Y') = ?";
			$get_vacant = $this->sitemodel->custom_query($sql, $where);
			//QUERY untuk dapetin jumlah applicant yang melamar
			$sql = "SELECT COUNT(*) AS TOTAL FROM tr_applicant WHERE DATE_FORMAT(apply_date, '%Y') = ?";
			$get_applicant = $this->sitemodel->custom_query($sql, $where);			
			//QUERY untuk dapetin jumlah pelamar yang diproses ( KESELURUHAN )
			$sql = "SELECT COUNT(*) AS TOTAL FROM tr_applicant WHERE applicant_status IN ('On Going', 'Failed', 'Passed') AND DATE_FORMAT(apply_date, '%Y') = ?";
			$get_proses  = $this->sitemodel->custom_query($sql, $where);
			//QUERY untuk dapetin jumlah pelamar yang diproses ( PASSED )
			$sql = "SELECT COUNT(*) AS TOTAL FROM tr_applicant WHERE applicant_status IN ('Passed') AND DATE_FORMAT(apply_date, '%Y') = ?";
			$get_passed  = $this->sitemodel->custom_query($sql, $where);
			//QUERY untuk dapetin jumlah pelamar yang diproses ( FAILED )
			$sql = "SELECT COUNT(*) AS TOTAL FROM tr_applicant WHERE applicant_status IN ('Failed') AND DATE_FORMAT(apply_date, '%Y') = ?";
			$get_failed  = $this->sitemodel->custom_query($sql, $where);
			//QUERY untuk dapetin jumlah pelamar yang diproses ( ON GOING )
			$sql = "SELECT COUNT(*) AS TOTAL FROM tr_applicant WHERE applicant_status IN ('On Going') AND DATE_FORMAT(apply_date, '%Y') = ?";
			$get_going  = $this->sitemodel->custom_query($sql, $where);			
			$data['data_vacant'] = $get_vacant;
			$data['data_applicant'] = $get_applicant;
			$data['data_proses'] = $get_proses;
			$data['data_passed'] = $get_passed;
			$data['data_failed'] = $get_failed;
			$data['data_going'] = $get_going;
			$data['data_year'] = $year;
			$site = $this->load->view(SYS_FILE."reporting/view-pdf-global", $data, TRUE);
			
			return $site;
		}

		//generate view report for global (month)
		function site_pdf_global_month($year='', $month=''){
			$where = array(
				$year, $month
			);
			//QUERY untuk dapetin jumlah vacancy yang dibuka
			$sql = "SELECT COUNT(*) AS TOTAL FROM tr_vacant WHERE DATE_FORMAT(created_date, '%Y') = ? AND DATE_FORMAT(created_date, '%M') = ?";
			$get_vacant = $this->sitemodel->custom_query($sql, $where);
			//QUERY untuk dapetin jumlah applicant yang melamar
			$sql = "SELECT COUNT(*) AS TOTAL FROM tr_applicant WHERE DATE_FORMAT(apply_date, '%Y') = ? AND DATE_FORMAT(apply_date, '%M') = ? ";
			$get_applicant = $this->sitemodel->custom_query($sql, $where);			
			//QUERY untuk dapetin jumlah pelamar yang diproses ( KESELURUHAN )
			$sql = "SELECT COUNT(*) AS TOTAL FROM tr_applicant WHERE applicant_status IN ('On Going', 'Failed', 'Passed') AND DATE_FORMAT(apply_date, '%Y') = ? AND DATE_FORMAT(apply_date, '%M') = ?";
			$get_proses  = $this->sitemodel->custom_query($sql, $where);			
			//QUERY untuk dapetin jumlah pelamar yang diproses ( PER VACANCY )
			$sql = "SELECT vacant_title, COUNT(*) AS TOTAL FROM tr_applicant ta JOIN tr_vacant tv ON ta.vacant_id = tv.vacant_id WHERE applicant_status IN ('On Going', 'Failed', 'Passed') AND DATE_FORMAT(apply_date, '%Y') = ? AND DATE_FORMAT(apply_date, '%M') = ? GROUP BY tv.vacant_id";
			$get_proses_perVacancty  = $this->sitemodel->custom_query($sql, $where);
			//QUERY untuk dapetin jumlah pelamar yang diproses ( PASSED )
			$sql = "SELECT COUNT(*) AS TOTAL FROM tr_applicant WHERE applicant_status IN ('Passed') AND DATE_FORMAT(apply_date, '%Y') = ? AND DATE_FORMAT(apply_date, '%M') = ?";
			$get_passed  = $this->sitemodel->custom_query($sql, $where);
			//QUERY untuk dapetin jumlah pelamar yang diproses ( FAILED )
			$sql = "SELECT COUNT(*) AS TOTAL FROM tr_applicant WHERE applicant_status IN ('Failed') AND DATE_FORMAT(apply_date, '%Y') = ? AND DATE_FORMAT(apply_date, '%M') = ?";
			$get_failed  = $this->sitemodel->custom_query($sql, $where);
			//QUERY untuk dapetin jumlah pelamar yang diproses ( ON GOING )
			$sql = "SELECT COUNT(*) AS TOTAL FROM tr_applicant WHERE applicant_status IN ('On Going') AND DATE_FORMAT(apply_date, '%Y') = ? AND DATE_FORMAT(apply_date, '%M') = ?";
			$get_going  = $this->sitemodel->custom_query($sql, $where);			
			$data['data_vacant'] = $get_vacant;
			$data['data_applicant'] = $get_applicant;
			$data['data_proses'] = $get_proses;
			$data['data_proses_perv'] = $get_proses_perVacancty;
			$data['data_passed'] = $get_passed;
			$data['data_failed'] = $get_failed;
			$data['data_going'] = $get_going;
			$data['data_year'] = $year;
			$data['data_month'] = $month;
			$site = $this->load->view(SYS_FILE."reporting/view-pdf-global-month", $data, TRUE);
			
			return $site;
		}
		//#END MODULAR AJAX
	}