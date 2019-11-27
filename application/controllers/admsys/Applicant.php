<?php if ( !defined('BASEPATH') )exit('No direct script access allowed');
class Applicant extends CI_Controller{
	function __construct(){
		parent::__construct();			
// ini_set("error_reporting", E_ALL);
	}

	function index(){
		if (!isLogin()) redirect ( base_url().SYS_AUTH );			
		$data['header_menu'] = "applicant";
		$data['header_child'] = "manage";
		$data['css_loader'] = 'view-applicant.css';			
		$data['page'] = 'applicant/view-applicant-v2';
		$data['data_vacant'] = $this->sitemodel->view("tr_vacant", "vacant_id, vacant_title, DATE_FORMAT(open_date, '%d %M %Y') as a, DATE_FORMAT(close_date, '%d %M %Y') as b, (SELECT COUNT(*) FROM tr_applicant WHERE tr_vacant.vacant_id = tr_applicant.vacant_id) total_candidat, vacant_status c", null, null, "vacant_status, vacant_title ASC", null, false);
		$data['data_email'] = $this->sitemodel->view("tab_template", "*", array("created_by IN (0, {$this->session->userdata(SES_END)->log_id})"=>NULL));
		$data['data_venue'] = $this->sitemodel->view("template_venue", "*");
		$data['vacant_selected'] = ($this->input->get('vac') !== null) ? $this->input->get('vac') : '';
		$this->load->view(SYS_FILE."main-site", $data);
	}

	function history(){
		if (!isLogin()) redirect ( base_url().SYS_AUTH );
		$data['header_menu'] = "applicant";
		$data['header_child'] = "history";
		$data['css_loader'] = 'view-applicant-history.css';			
		$data['page'] = 'applicant/view-applicant-history-v2';
		$data['data_vacant'] = $this->sitemodel->view("tr_vacant", "vacant_id, vacant_title, DATE_FORMAT(open_date, '%d %M %Y') as a, DATE_FORMAT(close_date, '%d %M %Y') as b, (SELECT COUNT(*) FROM tr_applicant WHERE tr_vacant.vacant_id = tr_applicant.vacant_id) total_candidat", null, null, null, null, false);
		$data['vacant_selected'] = ($this->input->get('vac') !== null) ? $this->input->get('vac') : '';
		$this->load->view(SYS_FILE."main-site", $data);
	}

	function candidate(){
		if (!isLogin()) redirect ( base_url().SYS_AUTH );
		$data['header_menu'] = "applicant";
		$data['header_child'] = "candidate";
// $data['css_loader'] = 'view-applicant-history.css';			
		$data['css_loader'] = 'view-applicant-candidate.css';			
// $data['page'] = 'applicant/view-applicant-history-v2';
		$data['page'] = 'applicant/view-candidate';
		$this->load->view(SYS_FILE."main-site", $data);
	}

	function view_candidate()
	{
		$data = array();
		$this->load->model('candidate_model');
		$res = $this->candidate_model->get_applicant();
		$temp = $this->db->last_query();
		// echo $temp;die;

		foreach ($res as $row) {
			// $class_visited = ($row->is_visited == '0') ? ' special-cv-blue' : ' special-cv-red';
			$col = array();
			$col[] = $row->candidat_id;
			$col[] = "<a href=\"javascript:;\" class=\"create-cv\" tag-id=\"{$row->candidat_id}\">{$row->candidat_name}</a> - <a href=\"javascript:;\" class=\"open-cv special-cv-blue\" tag-data=\"{$row->candidat_cv}\">[CV]</a><img src=\"".base_url()."media/candidate/{$row->candidat_foto}\" style=\"width:30px;height:30px;cursor:pointer;\" data-src=\"".base_url()."media/candidate/{$row->candidat_foto}\" alt=\"\" title=\"{$row->candidat_name}\" class=\"img-responsive view-img\" />";
			$col[] = "{$row->gender}/{$row->usia}th/{$row->marital_status}";
			$col[] = "{$row->edu_title}, {$row->edu_institute}";
			$col[] = "{$row->edu_major}, {$row->gpa}";
			$col[] = empty($row->company_name) ? "-" : $row->company_name;
			$col[] = empty($row->last_salary) ? "-" : number_format($row->last_salary, 0, ".", ",");
			$col[] = $row->ca_city;
			$data[] = $col;
		}
		$output = array(
			"draw" 				=> $_POST['draw'],
			"recordsTotal" 		=> $this->candidate_model->get_applicant_count_all(),
			"recordsFiltered" 	=> $this->candidate_model->get_applicant_count_filtered(),
			"data" 				=> $data,
			// "benchmark"			=> $this->benchmark->elapsed_time('code_start', 'code_end'),
			"q"					=> $temp //temp for tracing db query

		);
		echo json_encode($output);
		exit;
	}

// function filtering(){
// 	$msg = array();
// 	if ( isLogin() == false ){
// 		$msg['type'] = 'failed';
// 		$msg['msg'] = "Login expired, please refresh your browser.";
// 		echo json_encode($msg);
// 	}
// 	if ( $_POST == false ){
// 		$msg['type'] = 'failed';
// 		$msg['msg'] = "Invalid parameter";
// 		echo json_encode($msg);
// 	}
// 	$key = $this->input->post("key");
// 	$type = $this->input->post("type");
// 	if ( empty($key) or empty($type) ){
// 		$msg['type'] = 'failed';
// 		$msg['msg'] = 'Invalid parameter.';
// 		echo json_encode($msg);
// 	}

// 	$addon = "";
// 	if ( $type == "manage" ){
// 		$where = array(
// 			"applicant_status IN('On Going', 'N/A')" => null,
// 			"c.candidat_status" => "N/A"
// 		);			
// 		if ( $key != "ALL" ) $where["a.vacant_id"] = $key;							
// 	}
// 	else{
// 		$where = array(
// 			"applicant_status IN('Failed', 'Passed')" => null
// 		);
// 		if ( $key != "ALL" ) $where["a.vacant_id"] = $key;

// 	}
// 	if ( $key == "ALL" ){
// 		$join = array("tr_vacant b"=>"a.vacant_id=b.vacant_id,","tab_candidat c"=>"a.candidat_id=c.candidat_id,", "(SELECT * FROM candidat_edu GROUP BY candidat_id ORDER BY FIELD(edu_title, 'S2', 'S1', 'D3', 'SMU'))AS d"=>"c.candidat_id=d.candidat_id,LEFT", "(SELECT * FROM candidat_work_exp GROUP BY candidat_id ORDER BY work_exp_id)AS e"=>"c.candidat_id=e.candidat_id,LEFT");
// 		if ( $type == "history" )
// 			$data = $this->sitemodel->view("tr_applicant a", "applicant_id, vacant_code, a.candidat_id, candidat_name, candidat_foto, candidat_cv, TIMESTAMPDIFF(YEAR, dob, CURDATE()) as usia, gender, marital_status, ca_city, applicant_status, edu_title, edu_institute, edu_major, gpa, company_name, last_salary, iu_stat, ihr_stat, psikotest_stat, ia_stat, mcu_stat, final_stat, is_visited", $where, $join, null, null, false, "a.candidat_id");
// 		else
// 			$data = $this->sitemodel->view("tr_applicant a", "applicant_id, GROUP_CONCAT(vacant_code SEPARATOR ', ') vacant_code, a.candidat_id, candidat_name, candidat_foto, candidat_cv, TIMESTAMPDIFF(YEAR, dob, CURDATE()) as usia, gender, marital_status, ca_city, GROUP_CONCAT(applicant_status SEPARATOR ',') as applicant_status, edu_title, edu_institute, edu_major, gpa, company_name, last_salary, iu_stat, ihr_stat, psikotest_stat, ia_stat, mcu_stat, final_stat, is_visited", $where, $join, null, null, false, "a.candidat_id");
// 		// echo $this->db->last_query();
// 		if ( $data == '0' ){
// 			$msg['type'] = 'done';
// 			$msg['msg'] = '';
// 		}
// 		else{
// 			$content = "";
// 			$no = 1;
// 			foreach($data as $row){
// 				if ( $type == "history" ){
// 					$if_failed = ($row->applicant_status == "Failed") ? "<li><a href=\"javascript:void(0);\" class=\" waves-effect waves-block btn-move-pos\" attr-data=\"{$row->applicant_id};{$row->candidat_id}\"><i class=\"material-icons\">swap_horiz</i> Move</a></li>" : "";
// 					$addon = "<td>
// 								<div class=\"btn-group\">
// 									<button type=\"button\" class=\"btn btn-primary dropdown-toggle\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"true\">
// 										MANAGE <span class=\"caret\"></span>
// 									</button>
// 									<ul class=\"dropdown-menu\">
// 										<li><a href=\"javascript:void(0);\" class=\" waves-effect waves-block btn-action\" attr-data=\"{$row->candidat_id}\"><i class=\"material-icons\">pageview</i> View</a></li>
// 										{$if_failed}
// 									</ul>
// 								</div>
// 					</td>";
// 				}
// 				else
// 					$addon = "<td><button type=\"button\" class=\"btn btn-primary waves-effect btn-action\" attr-data=\"{$row->candidat_id}\">Action</button></td>";
// 				$processing_flag = "";
// 				$class_visited = ($row->is_visited == '0') ? ' special-cv-blue' : ' special-cv-red';
// 				$company_name = empty($row->company_name) ? "-" : $row->company_name;
// 				$last_salary = empty($row->last_salary) ? "-" : number_format($row->last_salary, 0, ".", ",");
// 				$marital_status = ($row->marital_status == "Married") ? "M" : "S";
// 				$content .= "<tr>
// 					<td>{$no}</td>
// 					<td><a href=\"javascript:;\" class=\"create-cv\" tag-id=\"{$row->candidat_id}\">{$row->candidat_name}</a> - <a href=\"javascript:;\" class=\"open-cv{$class_visited}\" tag-id=\"{$row->applicant_id}\" tag-data=\"{$row->candidat_cv}\">[CV]</a><img src=\"".base_url()."media/candidate/{$row->candidat_foto}\" style=\"width:30px;height:30px;cursor:pointer;\" data-src=\"".base_url()."media/candidate/{$row->candidat_foto}\" alt=\"{$row->candidat_name}\" title=\"{$row->candidat_name}\" class=\"img-responsive view-img\" /></td>
// 					<td>{$row->gender}/{$row->usia}/{$marital_status}</td>
// 					<td>{$row->edu_title}, {$row->edu_institute}</td>
// 					<td>{$row->edu_major}, {$row->gpa}</td>
// 					<td>{$company_name}</td>
// 					<td>{$last_salary}</td>
// 					<td>{$row->ca_city}</td>
// 					<td>{$row->vacant_code}</td>
// 					<td>{$row->applicant_status}{$processing_flag}</td>
// 					{$addon}
// 				</tr>";
// 				$no++;
// 			}

// 			$msg['type'] = 'done';
// 			$msg['msg'] = $content;
// 		}
// 	}	
// 	else{
// 		$join = array("tr_vacant b"=>"a.vacant_id=b.vacant_id,","tab_candidat c"=>"a.candidat_id=c.candidat_id,", "(SELECT * FROM candidat_edu GROUP BY candidat_id ORDER BY FIELD(edu_title, 'S2', 'S1', 'D3', 'SMU'))AS d"=>"c.candidat_id=d.candidat_id,LEFT", "(SELECT * FROM candidat_work_exp GROUP BY candidat_id ORDER BY work_exp_id)AS e"=>"c.candidat_id=e.candidat_id,LEFT");
// 		$data = $this->sitemodel->view("tr_applicant a", "applicant_id, vacant_code, a.candidat_id, candidat_name, candidat_foto, candidat_cv, TIMESTAMPDIFF(YEAR, dob, CURDATE()) as usia, gender, marital_status, ca_city, applicant_status, edu_title, edu_institute, edu_major, gpa, company_name, last_salary, iu_stat, ihr_stat, psikotest_stat, ia_stat, mcu_stat, final_stat, is_visited", $where, $join, null, null, false, "a.candidat_id");

// 		if ( $data == '0' ){
// 			$msg['type'] = 'done';
// 			$msg['msg'] = '';
// 		}
// 		else{
// 			$content = "";
// 			$no = 1;
// 			foreach($data as $row){
// 				if ( $type == "history" ){
// 					$if_failed = ($row->applicant_status == "Failed") ? "<li><a href=\"javascript:void(0);\" class=\" waves-effect waves-block btn-move-pos\" attr-data=\"{$row->applicant_id};{$row->candidat_id}\"><i class=\"material-icons\">swap_horiz</i> Move</a></li>" : "";
// 					$addon = "<td>
// 								<div class=\"btn-group\">
// 									<button type=\"button\" class=\"btn btn-primary dropdown-toggle\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"true\">
// 										MANAGE <span class=\"caret\"></span>
// 									</button>
// 									<ul class=\"dropdown-menu\">
// 										<li><a href=\"javascript:void(0);\" class=\" waves-effect waves-block btn-action\" attr-data=\"{$row->candidat_id}\"><i class=\"material-icons\">pageview</i> View</a></li>
// 										{$if_failed}															
// 									</ul>
// 								</div>
// 					</td>";
// 				}
// 				else
// 					$addon = "<td><button type=\"button\" class=\"btn btn-primary waves-effect btn-action\" attr-data=\"{$row->candidat_id}\">Action</button></td>";
// 				$processing_flag = "";									
// 				$company_name = empty($row->company_name) ? "-" : $row->company_name;
// 				$last_salary = empty($row->last_salary) ? "-" : number_format($row->last_salary, 0, ".", ",");
// 				$class_visited = ($row->is_visited == '0') ? ' special-cv-blue' : ' special-cv-red';
// 				$content .= "<tr>
// 					<td>{$no}</td>
// 					<td><a href=\"javascript:;\" class=\"create-cv\" tag-id=\"{$row->candidat_id}\">{$row->candidat_name}</a> - <a href=\"javascript:;\" class=\"open-cv{$class_visited}\" tag-id=\"{$row->applicant_id}\" tag-data=\"{$row->candidat_cv}\">[CV]</a><img src=\"".base_url()."media/candidate/{$row->candidat_foto}\" style=\"width:30px;height:30px;cursor:pointer;\" data-src=\"".base_url()."media/candidate/{$row->candidat_foto}\" alt=\"{$row->candidat_name}\" title=\"{$row->candidat_name}\" class=\"img-responsive view-img\" /></td>
// 					<td>{$row->gender}/<br/>{$row->usia}th/<br/>{$row->marital_status}</td>
// 					<td>{$row->edu_title}, {$row->edu_institute}</td>
// 					<td>{$row->edu_major}, {$row->gpa}</td>
// 					<td>{$company_name}</td>
// 					<td>{$last_salary}</td>
// 					<td>{$row->ca_city}</td>
// 					<td>{$row->vacant_code}</td>
// 					<td>{$row->applicant_status}{$processing_flag}</td>
// 					{$addon}
// 				</tr>";
// 				$no++;
// 			}

// 			$msg['type'] = 'done';
// 			$msg['msg'] = $content;
// 		}
// 	}			
// 	echo json_encode($msg);
// }

	function filtering(){
		$type = ($this->input->get('t') !== null) ? $this->input->get('t') : 'manage';
		$key = ($this->input->get('vac') !== null) ? $this->input->get('vac') : 'ALL';
		$this->benchmark->mark('code_start');
		$this->load->model('adm_applicant_model', 'model');
		$list = $this->model->get_applicant($type, $key);
		//temp for tracing db query
		$temp = $this->db->last_query();
		/*echo "<pre>";
		echo $temp; die;
		echo "</pre>";*/
		$data = array();
		foreach ($list as $row){
			$show_button = "";
			if ( $type == "history" ){
				$if_failed = ($row->applicant_status == "Failed") ? "<li><a href=\"javascript:void(0);\" class=\" waves-effect waves-block btn-move-pos\" attr-data=\"{$row->applicant_id};{$row->candidat_id}\"><i class=\"material-icons\">swap_horiz</i> Move</a></li>" : "";
				$show_button = "<td>
				<div class=\"btn-group\">
				<button type=\"button\" class=\"btn btn-primary dropdown-toggle\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"true\">
				MANAGE <span class=\"caret\"></span>
				</button>
				<ul class=\"dropdown-menu\">
				<li><a href=\"javascript:void(0);\" class=\" waves-effect waves-block btn-action\" attr-data=\"{$row->candidat_id}\"><i class=\"material-icons\">pageview</i> View</a></li>
				{$if_failed}															
				</ul>
				</div>
				</td>";
			}
			else $show_button = "<td><button type=\"button\" class=\"btn btn-primary waves-effect btn-action\" attr-data=\"{$row->candidat_id}\">Action</button></td>";
			$class_visited = ($row->is_visited == '0') ? ' special-cv-blue' : ' special-cv-red';
			// $marital_status = ($row->marital_status == "Married") ? "M" : "S";
			$col = array();
			$col[] = $row->applicant_id;
			$col[] = "<a href=\"javascript:;\" class=\"create-cv\" tag-id=\"{$row->candidat_id}\">{$row->candidat_name}</a> - <a href=\"javascript:;\" class=\"open-cv{$class_visited}\" tag-id=\"{$row->applicant_id}\" tag-data=\"{$row->candidat_cv}\">[CV]</a><img src=\"".base_url()."media/candidate/{$row->candidat_foto}\" style=\"width:30px;height:30px;cursor:pointer;\" data-src=\"".base_url()."media/candidate/{$row->candidat_foto}\" alt=\"\" title=\"{$row->candidat_name}\" class=\"img-responsive view-img\" />";
			$col[] = "{$row->gender}/{$row->usia}th/{$row->marital_status}";
			$col[] = "{$row->edu_title}, {$row->edu_institute}";
			$col[] = "{$row->edu_major}, {$row->gpa}";
			$col[] = empty($row->company_name) ? "-" : $row->company_name;
			$col[] = empty($row->last_salary) ? "-" : number_format($row->last_salary, 0, ".", ",");
			$col[] = $row->ca_city;
			$col[] = $row->vacant_code;
			$col[] = $row->applicant_status;
			$col[] = $show_button;
			$data[] = $col;
		}
		$this->benchmark->mark('code_end');
		$output = array(
			"draw" 				=> $_POST['draw'],
			"recordsTotal" 		=> $this->model->get_applicant_count_all(),
			"recordsFiltered" 	=> $this->model->get_applicant_count_filtered($type, $key),
			"data" 				=> $data,
			"benchmark"			=> $this->benchmark->elapsed_time('code_start', 'code_end'),
			"q"					=> $temp //temp for tracing db query
			);
		echo json_encode($output);
		exit;
	}

	function create_detail_test($key, $type=null){
		$msg = array();
		$join = array("tr_vacant b"=>"a.vacant_id=b.vacant_id,");
		$where = array(
			"candidat_id"=>$key
		);
		if ( $type )
			$where["applicant_status IN ('Failed', 'Passed')"] = NULL;
		$cek = $this->sitemodel->view("tr_applicant a", "applicant_id, a.vacant_id, vacant_code, applicant_status, iu_stat, ihr_stat, psikotest_stat, ia_stat, mcu_stat, final_stat, mcu_file, psikotest_file", $where, $join);
		if ( $cek == '0' ){
			$msg['type'] = 'failed';
			$msg['msg'] = "Invalid parameter.".$this->db->last_query();
		}
		else{
			$test_name = array("Interview User", "Interview HR", "Psikotest", "Interview Accessor", "MCU", "Finalisasi");
			$test_code = array("iu", "ihr", "psikotest", "ia", "mcu", "finalisasi");
			$test_db = array("iu_stat", "ihr_stat", "psikotest_stat", "ia_stat", "mcu_stat", "final_stat");
			$test_icon = array("contacts", "contacts", "event_note", "contacts", "local_hospital", "check");

			$content = "";
			$content_header = "<ul class=\"nav nav-tabs tab-nav-right\" role=\"tablist\">";
			$content_body = "<div class=\"tab-content\">";
			$content_footer = "";

			$num = 1;							
			foreach($cek as $row){
				$content_footer = "<div class=\"row clearfix\"><div class=\"table-responsive\"><table class=\"table table-bordered table-striped table-hover {$row->vacant_code}-table\">
				<thead>
				<tr>";
				for($i = 0; $i < count($test_name); $i++)
					$content_footer .= "<th class=\"text-center\">{$test_name[$i]}</th>";
				$content_footer .= "		<th class=\"text-center\">Results</tr>
				</thead><tbody>";

				$iu_stat = ($row->iu_stat == "N/A") ? $row->iu_stat : "<a href=\"javascript:void(0);\" class=\"view-detail-test\" data-key=\"{$row->applicant_id};{$key}\" data-src=\"iu\">{$row->iu_stat}</a>";
				$ihr_stat = ($row->ihr_stat == "N/A") ? $row->ihr_stat : "<a href=\"javascript:void(0);\" class=\"view-detail-test\" data-key=\"{$row->applicant_id};{$key}\" data-src=\"ihr\">{$row->ihr_stat}</a>";
				$psikotest_stat = ($row->psikotest_stat == "N/A") ? $row->psikotest_stat : "<a href=\"javascript:void(0);\" class=\"view-detail-test\" data-key=\"{$row->applicant_id};{$key}\" data-src=\"psikotest\">{$row->psikotest_stat}</a> <a href=\"javascript:;\" class=\"view-attachment\" tag-key=\"psikotest\" tag-id=\"{$row->applicant_id}\" tag-data=\"{$row->psikotest_file}\">[pdf]</a>";
				$ia_stat = ($row->ia_stat == "N/A") ? $row->ia_stat : "<a href=\"javascript:void(0);\" class=\"view-detail-test\" data-key=\"{$row->applicant_id};{$key}\" data-src=\"ia\">{$row->ia_stat}</a>";
				$mcu_stat = ($row->mcu_stat == "N/A") ? $row->mcu_stat : "<a href=\"javascript:void(0);\" class=\"view-detail-test\" data-key=\"{$row->applicant_id};{$key}\" data-src=\"mcu\">{$row->mcu_stat} <a href=\"javascript:;\" class=\"view-attachment\" tag-id=\"{$row->applicant_id}\" tag-key=\"mcu\" tag-data=\"{$row->mcu_file}\">[pdf]</a>";
				$final_stat = ($row->final_stat == "N/A") ? $row->final_stat : "<a href=\"javascript:void(0);\" class=\"view-detail-test\" data-key=\"{$row->applicant_id};{$key}\" data-src=\"finalisasi\">{$row->final_stat}</a>";
				$applicant_status = ($row->applicant_status == "Passed" or $row->applicant_status == "Failed") ? "<a href=\"javascript:void(0);\" class=\"view-detail-test\" data-key=\"{$row->applicant_id};{$key}\" data-src=\"applicant\">{$row->applicant_status}</a>" : $row->applicant_status;

				$content_footer .= "<tr>
				<td>{$iu_stat}</td>
				<td>{$ihr_stat}</td>
				<td>{$psikotest_stat}</td>
				<td>{$ia_stat}</td>
				<td>{$mcu_stat}</td>
				<td>{$final_stat}</td>
				<td>{$applicant_status}</td>
				</tr>";
				$content_footer .= "</tbody></table></div></div>";
				if ( $row->applicant_status != "Passed" and $row->applicant_status != "Failed" )
					$content_footer .= "<br /><div class=\"row clearfix\"><div class=\"col-md-12 col-lg-12 col-sm-12 col-xs-12\"><button type=\"button\" class=\"btn btn-primary btn-approval pull-right\" data-key=\"{$key}\" data-id=\"{$row->applicant_id}\">Approve / Reject Candidate</button></div></div>";					
				if ( $num == 1 ){
					$content_header .= "<li role=\"presentation\" class=\"active\"><a href=\"#content{$num}\" data-toggle=\"tab\">{$row->vacant_code}</a></li>";
					$content_body .= "<div role=\"tabpanel\" class=\"tab-pane fade in active\" id=\"content{$num}\"><div class=\"row clearfix\">";

					for($i = 0; $i < count($test_name); $i++){
						if ( $row->applicant_status == "Failed" or $row->applicant_status == "Passed" ){
							$content_body .= "<div class=\"col-lg-2 col-md-2 col-xs-6 col-sm-4\">
							<div class=\"text-center\">
							<i class=\"material-icons\">{$test_icon[$i]}</i>
							</div>
							<div class=\"text-center\">
							<label class=\"text-center\">{$test_name[$i]}</label>
							</div>
							</div>";
						}
						else{
							if ( $row->{$test_db[$i]} == "N/A" ){									
								$content_body .= "<div class=\"col-lg-2 col-md-2 col-xs-6 col-sm-4\">
								<a href=\"javascript:void(0);\" class=\"call-test\" data-key=\"{$test_code[$i]}\" data-src=\"{$test_name[$i]}\" data-vac=\"{$row->applicant_id}\" data-id=\"{$key}\">
								<div class=\"text-center\">
								<i class=\"material-icons\">{$test_icon[$i]}</i>
								</div>
								<div class=\"text-center\">
								<label class=\"text-center\">{$test_name[$i]}</label>
								</div>
								</a>
								</div>";
							}
							else{									
								$color_code = ( ($row->{$test_db[$i]} == "Passed") ? "col-green" : (($row->{$test_db[$i]} == "On Going") ? "col-orange" : "col-red") );										
								$content_body .= "<div class=\"col-lg-2 col-md-2 col-xs-6 col-sm-4\">
								<div class=\"text-center\">
								<i class=\"material-icons {$color_code}\">{$test_icon[$i]}</i>
								</div>
								<div class=\"text-center\">
								<label class=\"text-center {$color_code}\">{$test_name[$i]}</label>
								</div>
								</div>";
							}
						}
					}
					$content_body .= "</div>{$content_footer}</div>";
				}
				else{
					$content_header .= "<li role=\"presentation\"><a href=\"#content{$num}\" data-toggle=\"tab\">{$row->vacant_code}</a></li>";
					$content_body .= "<div role=\"tabpanel\" class=\"tab-pane fade\" id=\"content{$num}\"><div class=\"row clearfix\">";
					for($i = 0; $i < count($test_name); $i++){
						if ( $row->applicant_status == "Failed" or $row->applicant_status == "Passed" ){
							$content_body .= "<div class=\"col-lg-2 col-md-2 col-xs-6 col-sm-4\">
							<div class=\"text-center\">
							<i class=\"material-icons\">{$test_icon[$i]}</i>
							</div>
							<div class=\"text-center\">
							<label class=\"text-center\">{$test_name[$i]}</label>
							</div>
							</div>";
						}
						else{
							if ( $row->{$test_db[$i]} == "N/A" ){								
								$content_body .= "<div class=\"col-lg-2 col-md-2 col-xs-6 col-sm-4\">
								<a href=\"javascript:void(0);\" class=\"call-test\" data-key=\"{$test_code[$i]}\" data-src=\"{$test_name[$i]}\" data-vac=\"{$row->applicant_id}\" data-id=\"{$key}\">
								<div class=\"text-center\">
								<i class=\"material-icons\">{$test_icon[$i]}</i>
								</div>
								<div class=\"text-center\">
								<label class=\"text-center\">{$test_name[$i]}</label>
								</div>
								</a>
								</div>";
							}
							else{
								$color_code = ( ($row->{$test_db[$i]} == "Passed") ? "col-green" : (($row->{$test_db[$i]} == "On Going") ? "col-orange" : "col-red") );
								$content_body .= "<div class=\"col-lg-2 col-md-2 col-xs-6 col-sm-4\">
								<div class=\"text-center\">
								<i class=\"material-icons {$color_code}\">{$test_icon[$i]}</i>
								</div>
								<div class=\"text-center\">
								<label class=\"text-center {$color_code}\">{$test_name[$i]}</label>
								</div>
								</div>";
							}
						}
					}
					$content_body .= "</div>{$content_footer}</div>";
				}
				$num ++;
			}							
			$content_header .= "</ul>";
			$content_body .= "</div>";
			$content = $content_header.$content_body;
			$msg['type'] = 'done';
			$msg['content'] = $content;
		}

		return $msg;
	}

	function results_history(){
		$msg = array();
		if ( isLogin() ){
			if ( $_POST ){
				$key = $this->input->post("key");
				if ( empty($key) ){
					$msg['type'] = 'failed';
					$msg['msg'] = "Invalid parameter.";
				}
				else{						
					$data = $this->create_detail_test($key, "history");
					if ( $data['type'] == 'failed' ){
						$msg['type'] = 'failed';
						$msg['msg'] = $data['msg'];
					}
					else{
						$msg['type'] = 'done';
						$msg['msg'] = $data['content'];
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
			$msg['msg'] = "Login expired, please refresh your browser.";
		}
		echo json_encode($msg);
	}

	function results(){
		$msg = array();
		if ( isLogin() ){
			if ( $_POST ){
				$key = $this->input->post("key");
				if ( empty($key) ){
					$msg['type'] = 'failed';
					$msg['msg'] = "Invalid parameter.";
				}
				else{						
					$data = $this->create_detail_test($key);
					if ( $data['type'] == 'failed' ){
						$msg['type'] = 'failed';
						$msg['msg'] = $data['msg'];
					}
					else{
						$msg['type'] = 'done';
						$msg['msg'] = $data['content'];
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
			$msg['msg'] = "Login expired, please refresh your browser.";
		}
		echo json_encode($msg);
	}

	function detail_test(){
		$msg = array();
		if ( isLogin() ){
			if ( $_POST ){
				date_default_timezone_set('Asia/Jakarta');
				$key = $this->input->post("key");
				$type = $this->input->post("type");
				if ( empty($key) or empty($type) ){
					$msg['type'] = 'failed';
					$msg['msg'] = "Invalid parameter.";
				}
				else{
					$id = explode(";", $key);
					if ( count($id) != 2 ){
						$msg['type'] = "failed";
						$msg['msg'] = "Invalid parameter.";
					}
					else{
						$test_name = array(
							"iu"		=> "Interview User", 
							"ihr"		=> "Interview HR", 
							"psikotest"	=> "Psikotest", 
							"ia"		=> "Interview Accessor", 
							"mcu"		=> "MCU", 
							"finalisasi"=> "Finalisasi",
							"applicant" => "Applicant"
						);
						$test_code = array(
							"iu"		=> "iu_stat as A, DATE_FORMAT(iu_date, '%W, %d %M %Y %h:%i %p') as B, iu_lokasi as C, iu_pic as D, iu_user_id as E, iu_ket as F, DATE_FORMAT(iu_date_res, '%d %M %Y') as G, DATE_FORMAT(apply_date, '%W, %d %M %Y') as H, iu_acc I, iu_acc_reason J, DATE_FORMAT(iu_date, '%Y-%m-%d') K",
							"ihr"		=> "ihr_stat as A, DATE_FORMAT(ihr_date, '%W, %d %M %Y %h:%i %p') as B, ihr_lokasi as C, ihr_pic as D, ihr_user_id as E, ihr_ket as F, DATE_FORMAT(ihr_date_res, '%d %M %Y') as G, DATE_FORMAT(apply_date, '%W, %d %M %Y') as H, ihr_acc I, ihr_acc_reason J, DATE_FORMAT(ihr_date, '%Y-%m-%d') K", 
							"psikotest"	=> "psikotest_stat as A, DATE_FORMAT(psikotest_date, '%W, %d %M %Y %h:%i %p') as B, psikotest_lokasi as C, psikotest_pic as D, psikotest_user_id as E, psikotest_ket as F, DATE_FORMAT(psikotest_date_res, '%d %M %Y') as G, DATE_FORMAT(apply_date, '%W, %d %M %Y') as H, psikotest_acc I, psikotest_acc_reason J, DATE_FORMAT(psikotest_date, '%Y-%m-%d') K", 
							"ia"		=> "ia_stat as A, DATE_FORMAT(ia_date, '%W, %d %M %Y %h:%i %p') as B, ia_lokasi as C, ia_pic as D, ia_user_id as E, ia_ket as F, DATE_FORMAT(ia_date_res, '%d %M %Y') as G, DATE_FORMAT(apply_date, '%W, %d %M %Y') as H, ia_acc I, ia_acc_reason J, DATE_FORMAT(ia_date, '%Y-%m-%d') K",
							"mcu"		=> "mcu_stat as A, DATE_FORMAT(mcu_date, '%W, %d %M %Y %h:%i %p') as B, mcu_lokasi as C, mcu_pic as D, mcu_user_id as E, mcu_ket as F, DATE_FORMAT(mcu_date_res, '%d %M %Y') as G, DATE_FORMAT(apply_date, '%W, %d %M %Y') as H, mcu_acc I, mcu_acc_reason J, DATE_FORMAT(mcu_date, '%Y-%m-%d') K",
							"finalisasi"=> "final_stat as A, DATE_FORMAT(final_date, '%W, %d %M %Y %h:%i %p') as B, final_lokasi as C, final_pic as D, final_user_id as E, final_ket as F, DATE_FORMAT(final_date_res, '%d %M %Y') as G, DATE_FORMAT(apply_date, '%W, %d %M %Y') as H, final_acc I, final_acc_reason J, DATE_FORMAT(final_date, '%Y-%m-%d') K",
							"applicant"	=> "applicant_status as A, '-' as B, '-' as C, '-' as D, applicant_user_id as E, applicant_ket as F, DATE_FORMAT(applicant_date_res, '%d %M %Y') as G, DATE_FORMAT(apply_date, '%W, %d %M %Y') as H"
						);

						$cek = $this->sitemodel->view("tr_applicant", "{$test_code[$type]}", array("applicant_id"=>$id[0], "candidat_id"=>$id[1]), null, null, null, false);

						if ( $cek == '0' ){
							$msg['type'] = 'failed';
							$msg['msg'] = "No record found.";
						}
						else{
							$content = "<div class=\"row clearfix\">";
							foreach($cek as $row){
								$acc = ($row->I == "A") ? "Accept" : "Reject";
								$content .= "
								<div class=\"col-lg-3 col-md-3 col-sm-3 col-xs-3\"><strong>Apply Date</strong></div>
								<div class=\"col-lg-1 col-md-1 col-sm-1 col-xs-1\"><strong>:</strong></div>
								<div class=\"col-lg-8 col-md-8 col-sm-8 col-xs-8\">{$row->H}&nbsp;</div>

								<div class=\"col-lg-3 col-md-3 col-sm-3 col-xs-3\"><strong>Test Name</strong></div>
								<div class=\"col-lg-1 col-md-1 col-sm-1 col-xs-1\"><strong>:</strong></div>
								<div class=\"col-lg-8 col-md-8 col-sm-8 col-xs-8\">{$test_name[$type]}&nbsp;</div>

								<div class=\"col-lg-3 col-md-3 col-sm-3 col-xs-3\"><strong>Status</strong></div>
								<div class=\"col-lg-1 col-md-1 col-sm-1 col-xs-1\"><strong>:</strong></div>
								<div class=\"col-lg-8 col-md-8 col-sm-8 col-xs-8\">{$row->A}&nbsp;</div>

								<div class=\"col-lg-3 col-md-3 col-sm-3 col-xs-3\"><strong>Test Date</strong></div>
								<div class=\"col-lg-1 col-md-1 col-sm-1 col-xs-1\"><strong>:</strong></div>
								<div class=\"col-lg-8 col-md-8 col-sm-8 col-xs-8\">{$row->B}&nbsp;</div>

								<div class=\"col-lg-3 col-md-3 col-sm-3 col-xs-3\"><strong>PIC</strong></div>
								<div class=\"col-lg-1 col-md-1 col-sm-1 col-xs-1\"><strong>:</strong></div>
								<div class=\"col-lg-8 col-md-8 col-sm-8 col-xs-8\">{$row->D}&nbsp;</div>

								<div class=\"col-lg-3 col-md-3 col-sm-3 col-xs-3\"><strong>Location</strong></div>
								<div class=\"col-lg-1 col-md-1 col-sm-1 col-xs-1\"><strong>:</strong></div>
								<div class=\"col-lg-8 col-md-8 col-sm-8 col-xs-8\">{$row->C}&nbsp;</div>

								<div class=\"col-lg-3 col-md-3 col-sm-3 col-xs-3\"><strong>Accept Invitation</strong></div>
								<div class=\"col-lg-1 col-md-1 col-sm-1 col-xs-1\"><strong>:</strong></div>
								<div class=\"col-lg-8 col-md-8 col-sm-8 col-xs-8\">{$acc}&nbsp;</div>

								<div class=\"col-lg-3 col-md-3 col-sm-3 col-xs-3\"><strong>Reason</strong></div>
								<div class=\"col-lg-1 col-md-1 col-sm-1 col-xs-1\"><strong>:</strong></div>
								<div class=\"col-lg-8 col-md-8 col-sm-8 col-xs-8\">{$row->J}&nbsp;</div>

								<div class=\"col-lg-3 col-md-3 col-sm-3 col-xs-3\"><strong>Remarks</strong></div>
								<div class=\"col-lg-1 col-md-1 col-sm-1 col-xs-1\"><strong>:</strong></div>
								<div class=\"col-lg-8 col-md-8 col-sm-8 col-xs-8\">{$row->F}&nbsp;</div>

								<div class=\"col-lg-3 col-md-3 col-sm-3 col-xs-3\"><strong>Result Date</strong></div>
								<div class=\"col-lg-1 col-md-1 col-sm-1 col-xs-1\"><strong>:</strong></div>
								<div class=\"col-lg-8 col-md-8 col-sm-8 col-xs-8\">{$row->G}&nbsp;</div>

								<div class=\"col-lg-3 col-md-3 col-sm-3 col-xs-3\"><strong>Entry By</strong></div>
								<div class=\"col-lg-1 col-md-1 col-sm-1 col-xs-1\"><strong>:</strong></div>
								<div class=\"col-lg-8 col-md-8 col-sm-8 col-xs-8\">{$row->E}&nbsp;</div>													
								";

								if ( $row->A == "On Going" ){
									$temp = "";
									if ( $row->I == "R" and $row->K <= date("Y-m-d"))
										$temp = "<button type=\"button\" class=\"btn btn-danger btn-reset-schedule\" data-vac=\"{$id[0]}\" data-cnd=\"{$id[1]}\" data-key=\"{$type}\">Reset Schedule</button> ";

									$content .= "<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\">{$temp}<button type=\"button\" class=\"btn btn-primary btn-process-candidate\" data-vac=\"{$id[0]}\" data-cnd=\"{$id[1]}\" data-key=\"{$type}\">Process Candidate</button></div>";
								}
							}
							$content .= "</div>";

							$msg['type'] = 'done';
							$msg['header'] = $test_name[$type];
							$msg['msg'] = $content;
						}							
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
			$msg['msg'] = "Login expired, please refresh your browser.";
		}
		echo json_encode($msg);
	}

	function check_test(){
		$msg = array();
		$msg['type'] = 'failed';
		if ( isLogin() ){
			if ( $_POST ){
				$vac = $this->input->post("vac");
				$id = $this->input->post("id");

				if ( empty($vac) or empty($id) )						
					$msg['msg'] = "Invalid parameter.";					
				else{
					$join = array("tr_vacant b"=>"a.vacant_id=b.vacant_id,");
					$cek_test = $this->sitemodel->view("tr_applicant a", " vacant_title, applicant_status", array("candidat_id"=>$id, "applicant_id NOT IN ({$vac})"=>NULL), $join);
					if ( $cek_test == '0' ){
						$cek = $this->sitemodel->view("tr_applicant", "applicant_status", array("applicant_id"=>$vac, "candidat_id"=>$id));
						if ( $cek == '0' )
							$msg['msg'] = "No record found.";
						else{
							$flag = true;							
							foreach($cek as $row){
								if ( $row->applicant_status == "Failed" ){
									$msg['msg'] = "This candidate already rejected for this position.";
									$flag = false;
								}
								else if ( $row->applicant_status == "Passed" ){
									$msg['msg'] = "This candidate already Accepted for this position";
									$flag = false;
								}									
							}

							if ( $flag ){
								$msg['type'] = 'done';
								$msg['msg'] = "";
							}
						}
					}
					else{
						$flag_other_test = true;
						$test_title = "";
						foreach($cek_test as $row){
							if ( $row->applicant_status == "On Going" and $flag_other_test ){
								$flag_other_test = false;
								$test_title = $row->vacant_title;
							}
						}

						if ( $flag_other_test ){
							$cek = $this->sitemodel->view("tr_applicant", "applicant_status", array("applicant_id"=>$vac, "candidat_id"=>$id));
							if ( $cek == '0' )
								$msg['msg'] = "No record found.";
							else{
								$flag = true;							
								foreach($cek as $row){
									if ( $row->applicant_status == "Failed" ){
										$msg['msg'] = "This candidate already rejected for this position.";
										$flag = false;
									}
									else if ( $row->applicant_status == "Passed" ){
										$msg['msg'] = "This candidate already Accepted for this position";
										$flag = false;
									}									
								}

								if ( $flag ){
									$msg['type'] = 'done';
									$msg['msg'] = "";
								}
							}
						}
						else
							$msg['msg'] = "This candidate already processing in {$test_title} vacancy.";							
					}
				}
			}
			else
				$msg['msg'] = "Invalid parameter.";				
		}
		else
			$msg['msg'] = "Login expired, please refresh your browser.";

		echo json_encode($msg);
	}

	function ajax_test(){
		$msg = array();
		if ( isLogin() ){
			if ( $_POST ){
				$test_time = $this->input->post("test_time");
				$test_location = $this->input->post("test_location");
				$test_pic = $this->input->post("test_pic");
				$test_key = $this->input->post("test_key");
$test_vac = $this->input->post("test_vac"); // applicant_id
$test_id = $this->input->post("test_id");
$temp_email = $this->input->post("temp_email");
$test_button = $this->input->post("test_button");

if ( empty($test_time) or empty($test_location) or empty($test_pic) or empty($test_key) or empty($test_vac) or empty($test_id) or empty($temp_email) or empty($test_button) ){
	$msg['type'] = 'failed';
	$msg['msg'] = "Input all required data.";
}
else{
	$get_venue = $this->sitemodel->view("template_venue", "tv_content", ["tv_id"=>$test_location]);
	if ( $get_venue == '0' ){
		$msg['type'] = 'failed';
		$msg['msg'] = "No venue found.";
	}
	else{
		$test_location = $get_venue[0]->tv_content;
		$exp = explode(", ", $test_time);
		$data = array(
			"iu"		=> array(
				"iu_stat"		=> "On Going",
				"iu_date"		=> $exp[1].":00",
				"iu_lokasi"		=> $test_location,
				"iu_pic"		=> $test_pic,
				"applicant_status" => "On Going"
			), 
			"ihr"		=> array(
				"ihr_stat"		=> "On Going",
				"ihr_date"		=> $exp[1].":00",
				"ihr_lokasi"	=> $test_location,
				"ihr_pic"		=> $test_pic,
				"applicant_status" => "On Going"
			), 
			"psikotest"	=> array(
				"psikotest_stat"	=> "On Going",
				"psikotest_date"	=> $exp[1].":00",
				"psikotest_lokasi"	=> $test_location,
				"psikotest_pic"		=> $test_pic,
				"applicant_status" => "On Going"
			), 
			"ia"		=> array(
				"ia_stat"		=> "On Going",
				"ia_date"		=> $exp[1].":00",
				"ia_lokasi"		=> $test_location,
				"ia_pic"		=> $test_pic,
				"applicant_status" => "On Going"
			), 
			"mcu"		=> array(
				"mcu_stat"		=> "On Going",
				"mcu_date"		=> $exp[1].":00",
				"mcu_lokasi"	=> $test_location,
				"mcu_pic"		=> $test_pic,
				"applicant_status" => "On Going"
			), 
			"finalisasi"=> array(
				"final_stat"	=> "On Going",
				"final_date"	=> $exp[1].":00",
				"final_lokasi"	=> $test_location,
				"final_pic"		=> $test_pic,
				"applicant_status" => "On Going"
			)
		);

		$subject = array(
			"iu"		=> "Interview User", 
			"ihr"		=> "Interview HR", 
			"psikotest"	=> "Psikotest", 
			"ia"		=> "Interview Accessor", 
			"mcu"		=> "Medical Checkup", 
			"finalisasi"=> "Negotiation"
		);

		$details = array(
			"iu"		=> array(
				date('l, d F Y;h:i A', strtotime($exp[1].":00")),
				$test_location,
				$test_pic,
				"iu",
			), 
			"ihr"		=> array(
				date('l, d F Y;h:i A', strtotime($exp[1].":00")),
				$test_location,
				$test_pic,
				"ihr",
			), 
			"psikotest"	=> array(
				date('l, d F Y;h:i A', strtotime($exp[1].":00")),
				$test_location,
				$test_pic,
				"psikotest",
			), 
			"ia"		=> array(
				date('l, d F Y;h:i A', strtotime($exp[1].":00")),
				$test_location,
				$test_pic,
				"ia",
			), 
			"mcu"		=> array(
				date('l, d F Y;h:i A', strtotime($exp[1].":00")),
				$test_location,
				$test_pic,
				"mcu",
			), 
			"finalisasi"=> array(
				date('l, d F Y;h:i A', strtotime($exp[1].":00")),
				$test_location,
				$test_pic,
				"final",
			)
		);

		$where = array(
			"applicant_id"	=> $test_vac,
			"candidat_id"	=> $test_id
		);
		$this->sitemodel->update("tr_applicant", $data[$test_key], $where);

		$result_data = $this->create_detail_test($test_id);
		if ( $result_data['type'] == 'failed' ){
			$msg['type'] = 'failed';
			$msg['msg'] = $result_data['msg'];
		}
		else{
			if ( $test_button == "SS" ){
				$get_email = $this->sitemodel->view("tab_candidat", "candidat_name, candidat_email, candidat_rg_key", array("candidat_id"=>$test_id));
				$cnd_email = "";
				$cnd_name = "";
				$cnd_rg_key = "";
				foreach($get_email as $row){ $cnd_email = $row->candidat_email; $cnd_name = $row->candidat_name; $cnd_rg_key = $row->candidat_rg_key; }
				$join = array("tr_vacant b"=>"a.vacant_id=b.vacant_id,");
				$get_vacant = $this->sitemodel->view("tr_applicant a", "applicant_id, vacant_title", array("applicant_id"=>$test_vac), $join);
				$data['vacant'] = $get_vacant;
				$data['data_test'] = $details[$test_key][0];
				$data['data_location'] = $details[$test_key][1];
				$data['data_pic'] = $details[$test_key][2];
				$data['data_apptype'] = $details[$test_key][3];
				$data['data_subject'] = $subject[$test_key];							
				$data['data_cnd'] = $cnd_name;
				$data['data_cnd_rg_key'] = $cnd_rg_key;
				$data["page"] = "invitation";
				$data['data_email'] = $this->sitemodel->view("tab_template", "*", array("template_id"=>$temp_email));
				$content = $this->load->view("site/emails/template", $data, TRUE);
				sendEmail($cnd_email, $subject[$test_key], $content, "Metro TV e-Recruitment - Invitation");
				$msg['type'] = 'done';
$msg['msg'] = "Sending email successfully."; //ADD FITUTE SEND EMAIL
$msg['content'] = $result_data['content'];
}
else{//if recruiter choose not to send email
	$msg['type'] = 'done';
	$msg['msg'] = "Submitting data successfully.";
	$msg['content'] = $result_data['content'];
}
}
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
	$msg['msg'] = "Login expired, please refresh your browser.";
}
echo json_encode($msg);
}

function ajax_approval(){
	$msg = array();
	if ( isLogin() ){
		if ( $_POST ){
			$approval_status = $this->input->post("approval_status");
			$approval_time = $this->input->post("approval_time");
			$approval_remarks = $this->input->post("approval_remarks");

			$approval_key = $this->input->post("approval_key");
			$approval_id = $this->input->post("approval_id");

			if ( empty($approval_status) or empty($approval_time) or empty($approval_id) or empty($approval_key) ){
				$msg['type'] = 'failed';
				$msg['msg'] = "Input all required data.";
			}
			else{
				$exp = explode(", ", $approval_time);
				$data = array(
					"applicant_status"	=> $approval_status,
					"applicant_date_res"=> $exp[1].":00",
					"applicant_ket"		=> $approval_remarks,
					"applicant_user_id"		=> $this->session->userdata(SES_END)->log_user,								
				);

				$where = array(
					"applicant_id"		=> $approval_id
				);

				$this->sitemodel->update("tr_applicant", $data, $where);
				if ( $approval_status == "Passed" )
					$this->sitemodel->update("tab_candidat", array("candidat_status"=>$approval_status), array("candidat_id"=>$approval_key));

				$result_data = $this->create_detail_test($approval_key);
				if ( $result_data['type'] == 'failed' ){
					$msg['type'] = 'failed';
					$msg['msg'] = $result_data['msg'];
				}
				else{
					$msg['type'] = 'done';
					$msg['msg'] = "Processing Candidate successfully.";
					$msg['content'] = $result_data['content'];
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
		$msg['msg'] = "Login expired, please refresh your browser.";
	}
	echo json_encode($msg);
}

function ajax_process(){
	$msg = array();
	if ( isLogin() ){
		if ( $_POST ){
			$process_status = $this->input->post("process_status");
			$process_time = $this->input->post("process_time");
			$process_remarks = $this->input->post("process_remarks");					

			$process_key = $this->input->post("process_key");
$process_vac = $this->input->post("process_vac"); //applicant_id
$process_id = $this->input->post("process_id");

if ( empty($process_status) or empty($process_time) or empty($process_key) or empty($process_vac) or empty($process_id) ){
	$msg['type'] = 'failed';
	$msg['msg'] = "Input all required data.";
}
else{
	$where = array(
		"applicant_id"	=> $process_vac,
		"candidat_id"	=> $process_id
	);
	$cek = $this->sitemodel->view("tr_applicant", "applicant_status", $where);
	$applicant_status = "";
	foreach($cek as $row)$applicant_status = $row->applicant_status;

	if ( $applicant_status == "Passed" or $applicant_status == "Failed" ){
		$msg['type'] = 'failed';
		$msg['msg'] = "You can not process this candidate.";
	}
	else{
		$file_psikotest = NULL;
		$file_mcu = NULL;
		if ( isset($_FILES['file']['name']) ){
			$filename = $_FILES['file']['name'];
			$exp = explode(".", $filename);
			$ext = end($exp);
			if ($_FILES["file"]["size"] > 200000) {
				$msg['msg'] = "Maximum pdf allowed only 200 Kb.";
				echo json_encode($msg);
				return;
			}

			if ( strtolower($ext) != "pdf" ){
				$msg['msg'] = "Extension allowed .pdf";
				echo json_encode($msg);
				return;
			}

			$newfile = md5(time().$filename).".{$ext}";
			if ( $process_key == "psikotest" ){
				move_uploaded_file($_FILES['file']['tmp_name'], "media/assessments/{$newfile}");
				$file_psikotest = $newfile;
			}
			else{
				move_uploaded_file($_FILES['file']['tmp_name'], "media/mcus/{$newfile}");
				$file_mcu = $newfile;
			}								
		}
		$exp = explode(", ", $process_time);
		$data = array(
			"iu"		=> array(
				"iu_stat"		=> $process_status,
				"iu_date_res"		=> $exp[1].":00",
				"iu_ket"		=> $process_remarks,
				"iu_user_id"		=> $this->session->userdata(SES_END)->log_user,
			), 
			"ihr"		=> array(
				"ihr_stat"		=> $process_status,
				"ihr_date_res"		=> $exp[1].":00",
				"ihr_ket"	=> $process_remarks,
				"ihr_user_id"		=> $this->session->userdata(SES_END)->log_user,
			), 
			"psikotest"	=> array(
				"psikotest_stat"	=> $process_status,
				"psikotest_date_res"	=> $exp[1].":00",
				"psikotest_ket"	=> $process_remarks,
				"psikotest_user_id"		=> $this->session->userdata(SES_END)->log_user,
				"psikotest_file"	=> $file_psikotest,
				"psikotest_file_entry"	=> date("Y-m-d H:i:s")
			), 
			"ia"		=> array(
				"ia_stat"		=> $process_status,
				"ia_date_res"		=> $exp[1].":00",
				"ia_ket"		=> $process_remarks,
				"ia_user_id"		=> $this->session->userdata(SES_END)->log_user,
			), 
			"mcu"		=> array(
				"mcu_stat"		=> $process_status,
				"mcu_date_res"		=> $exp[1].":00",
				"mcu_ket"	=> $process_remarks,
				"mcu_user_id"		=> $this->session->userdata(SES_END)->log_user,
				"mcu_file"		=> $file_mcu,
				"mcu_file_entry"	=> date("Y-m-d H:i:s")
			), 
			"finalisasi"=> array(
				"final_stat"	=> $process_status,
				"final_date_res"	=> $exp[1].":00",
				"final_ket"	=> $process_remarks,
				"final_user_id"		=> $this->session->userdata(SES_END)->log_user,
			)
		);						

		$this->sitemodel->update("tr_applicant", $data[$process_key], $where);
		if ( $process_key != "iu" ){
			$where = array(
				'applicant_status' => 'N/A',
				"candidat_id"	=> $process_id
			);
			$this->sitemodel->update("tr_applicant", $data[$process_key], $where);								
		}

		$result_data = $this->create_detail_test($process_id);
		if ( $result_data['type'] == 'failed' ){
			$msg['type'] = 'failed';
			$msg['msg'] = $result_data['msg'];
		}
		else{
			$msg['type'] = 'done';
			$msg['msg'] = "Processing Candidate successfully.";
			$msg['content'] = $result_data['content'];
		}							
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
	$msg['msg'] = "Login expired, please refresh your browser.";
}
echo json_encode($msg);
}

function move_candidat(){
	$msg = array();
	if ( isLogin() ){
		if ( $_POST ){
			$vac_move = $this->input->post("vac_move");
			$id_move = $this->input->post("id_move");
			if ( empty($vac_move) or empty($id_move) ){
				$msg['type'] = 'failed';
				$msg['msg'] = "Input all required data.";
			}
			else{
				$exp = explode(";", $id_move);
				if ( count($exp) != 2 ){
					$msg['type'] = 'failed';
					$msg['msg'] = "Invalid parameter.";
				}
				else{
					$cek = $this->sitemodel->view("tr_applicant", "applicant_id", array("applicant_id"=>$exp[0], "vacant_id"=>$vac_move, "candidat_id"=>$exp[1]));
					if ( $cek == '0' ){
						$ret = $this->sitemodel->insert_applicant($exp[0]);
						$data = array(
							"iu_stat" => "N/A",
							"iu_date"	=> NULL,
							"iu_lokasi"	=> NULL,
							"iu_pic"	=> NULL,
							"iu_user_id"	=> NULL,
							"iu_ket"	=> NULL,
							"iu_date_res" => NULL,
							"applicant_status" => "N/A",
							"applicant_date_res"	=> NULL,
							"applicant_ket"	=> NULL,
							"applicant_user_id"	=> NULL,
							"final_stat" => "N/A",
							"final_date"	=> NULL,
							"final_lokasi"	=> NULL,
							"final_pic"		=> NULL,
							"final_user_id"	=> NULL,
							"final_ket"	=> NULL,
							"final_date_res" => NULL,
							"vacant_id"	=> $vac_move
						);
						$this->sitemodel->update("tr_applicant", $data, array("applicant_id"=>$ret));
						$msg['type'] = 'done';
						$msg['msg'] = "Successfully move candidat to new vacancy.";
					}
					else{
						$msg['type'] = 'failed';
						$msg['msg'] = "Candidat already applied for this position.";
					}
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
		$msg['msg'] = "Login expired, please refresh your browser.";
	}
	echo json_encode($msg);
}

function new_candidat($key=''){
	if (!isLogin()) redirect ( base_url().SYS_AUTH );
	if ( empty($key) ) redirect ( base_url().SYS_AUTH );
	$cek = $this->sitemodel->view("tab_candidat", "*", array("candidat_id"=>$key));
	if ($cek == '0' ) redirect ( base_url().SYS_AUTH.'/applicant' );

	$data['header_menu'] = "applicant";
	$data['header_child'] = "manage";
	$data['css_loader'] = 'new-candidat.css';			
	$data['page'] = 'applicant/new-candidat';
	$data['data_vacant'] = $this->sitemodel->view("tr_vacant", "vacant_id, vacant_title, DATE_FORMAT(open_date, '%d %M %Y') as a, DATE_FORMAT(close_date, '%d %M %Y') as b", null, null, null, null, false);
	$data['data_city'] = $this->sitemodel->view("tab_kota", "*", null, null, "nama_kota ASC");
	$data['data'] = $this->sitemodel->view("tab_candidat", "*", array("candidat_id"=>$key));
	$this->load->view(SYS_FILE."main-site", $data);
}

//function to create first step of candidat
function create_candidat_step_one(){
	$msg = array();
	if ( isLogin() ){
		if ( $_POST ){
			$cnd_name = $this->input->post("cnd_name");
			$cnd_email = $this->input->post("cnd_email");

			if ( empty($cnd_name) or empty($cnd_email) ){
				$msg['type'] = 'failed';
				$msg['msg'] = "Input all required data.";
			}
			else{
				$cek = $this->sitemodel->view("tab_candidat", "*", array("candidat_email"=>$cnd_email));
				if ( $cek == '0' ){

					$data = array(
						"candidat_email"	=> $cnd_email,
						"candidat_name"		=> $cnd_name,
						"candidat_rg_key"	=> md5(date('YmdHis').$this->session->userdata(SES_END)->log_user),
						"candidat_verify"	=> "Y"
					);

					$ret = $this->sitemodel->insert("tab_candidat", $data);
					$msg['type'] = 'done';
					$msg['msg'] = "Successfully add candidate. We will redirect you shortly.";
					$msg['url'] = base_url().SYS_AUTH."/applicant/new-candidat/{$ret}";
				}
				else{
					$msg['type'] = 'failed';
					$msg['msg'] = "Email Candidate already exists.";
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
		$msg['msg'] = "Login expired, please refresh your browser.";
	}
	echo json_encode($msg);
}

//process cpi form
function cpi_proses(){
	$msg = array();
	if ( isLogin() ){
		if ( $_POST ){
			$cnd_id_cpi = $this->input->post("cnd_id_cpi");
			$nama = $this->input->post("nama");
			$email = $this->input->post("email");
			$ktp = $this->input->post("ktp");
			$curr_address = $this->input->post("curr_address");
			$curr_city = $this->input->post("curr_city");
			$curr_zipcode = $this->input->post("curr_zipcode");
			$curr_phone = $this->input->post("curr_phone");
			$per_address = $this->input->post("per_address");
			$per_city = $this->input->post("per_city");
			$per_zipcode = $this->input->post("per_zipcode");
			$per_phone = $this->input->post("per_phone");
			$hp = $this->input->post("hp");
			$pob = $this->input->post("pob");
			$dob = $this->input->post("dob");
			$agama = $this->input->post("agama");
$gol_darah = $this->input->post("gol_darah"); //tidak wajib isi
$nation = $this->input->post("nation");
$gender = $this->input->post("gender");
$berat = $this->input->post("berat");
$tinggi = $this->input->post("tinggi");
$status_married = $this->input->post("status_married");
//wajib diisi ketika status married = "Married"
$married_date = $this->input->post("married_date");
$spouse_name = $this->input->post("spouse_name");
$spouse_dob = $this->input->post("spouse_dob");
$spouse_edu = $this->input->post("spouse_edu");
$spouse_occu = $this->input->post("spouse_occu");

if( empty($cnd_id_cpi) or empty($nama) or empty($email) or empty($ktp) or empty($curr_address) or empty($curr_city) or empty($curr_zipcode) or empty($curr_phone) or empty($per_address) or empty($per_city) or empty($per_zipcode) or empty($per_phone) or empty($hp) or empty($pob) or empty($dob) or empty($agama) or empty($nation) or empty($gender) or empty($berat) or empty($tinggi) or empty($status_married) ){
	$msg['type'] = 'failed';
	$msg['msg'] = "Input all required data.";
}
else{
	$flag_married = true;
	if ( $status_married == "Married" ){
		if ( empty($married_date) or empty($spouse_name) or empty($spouse_dob) or empty($spouse_edu) or empty($spouse_occu) ){
			$msg['type'] = 'failed';
			$msg['msg'] = "Spouse data can not be empty.";
			$flag_married = false;
		}
	}

	if ( $flag_married ){
		$data = array(
			"candidat_name"		=> $nama,
			"candidat_phone"	=> $hp,
			"curr_address"		=> $curr_address,
			"ca_zip_code"		=> $curr_zipcode,
			"ca_ph"				=> $curr_phone,
			"ca_city"			=> $curr_city,
			"per_address"		=> $per_address,
			"pa_zip_code"		=> $per_zipcode,
			"pa_ph"				=> $per_phone,
			"pa_city"			=> $per_city,
			"pob"				=> $pob,
			"dob"				=> $dob,
			"religion_id"		=> $agama,
			"nationality"		=> $nation,
			"gender"			=> $gender,
			"weight"			=> $berat,
			"height"			=> $tinggi,
			"id_number"			=> $ktp,
			"marital_status"	=> $status_married
		);

		if ( isset($gol_darah) and empty($gol_darah) == false ){
			$data['blood_id'] = $gol_darah;
		}

		if ( $status_married == "Married" ){
			$data['marital_date'] = $married_date;
			$data['spouse_name'] = $spouse_name;
			$data['spouse_dob'] = $spouse_dob;
			$data['spouse_edu'] = $spouse_edu;
			$data['spouse_occupation'] = $spouse_occu;
		}

		$this->sitemodel->update("tab_candidat", $data, array("candidat_id"=>$cnd_id_cpi));
		$msg['type'] = 'done';
		$msg['msg'] = "Successfully update Candidat Personal Information.";
	}
}
}
else{
	$msg['type'] = 'failed';
	$msg['msg'] = 'Invalid parameter.';
}
}
else{
	$msg['type'] = 'failed';
	$msg['msg'] = "Login expired, please refresh your browser.";
}
echo json_encode($msg);
}

//process cfi form
function cfi_proses(){
	$msg = array();
	if ( isLogin() ){
		if ( $_POST ){
			$cnd_id_cfi = $this->input->post("cnd_id_cfi");

//CHILDREN AREA
			$child_name = $this->input->post("child_name");
			$child_dob = $this->input->post("child_dob");
			$child_gender = $this->input->post("child_gender");
			$child_edu = $this->input->post("child_edu");

//FAMILY ( PARENTS, SIBLINGS ) AREA
			$family_name = $this->input->post("family_name");
			$family_relation = $this->input->post("family_relation");
			$family_dob = $this->input->post("family_dob");
			$family_gender = $this->input->post("family_gender");
			$family_edu = $this->input->post("family_edu");

			if ( empty($cnd_id_cfi) ){
				$msg['type'] = 'failed';
				$msg['msg'] = "Input all required data.";
			}
			else{
				$this->sitemodel->delete("candidat_children", array("candidat_id"=>$cnd_id_cfi));
				$this->sitemodel->delete("candidat_family", array("candidat_id"=>$cnd_id_cfi));
				for($i = 0; $i < count($child_name); $i++){
					if ( empty($child_name[$i]) == false and empty($child_dob[$i]) == false and empty($child_gender[$i]) == false and empty($child_edu[$i]) == false ){
						$data = array(
							"candidat_id"	=> $cnd_id_cfi,
							"child_name"	=> $child_name[$i],
							"child_dob"		=> $child_dob[$i],
							"child_gender"	=> $child_gender[$i],
							"child_edu"		=> $child_edu[$i]
						);

						$this->sitemodel->insert("candidat_children", $data);								
					}
				}

				for($i = 0; $i < count($family_name); $i++){
					if ( empty($family_name[$i]) == false and empty($family_relation[$i]) == false and empty($family_dob[$i]) == false and empty($family_gender[$i]) == false and empty($family_edu[$i]) == false ){
						$data = array(
							"candidat_id"	=> $cnd_id_cfi,
							"family_name"	=> $family_name[$i],
							"family_relation"	=> $family_relation[$i],
							"family_dob"	=> $family_dob[$i],
							"family_gender"	=> $family_gender[$i],
							"family_edu"	=> $family_edu[$i]
						);

						$this->sitemodel->insert("candidat_family", $data);
					}
				}

				$msg['type'] = 'done';
				$msg['msg'] = "Successfully update Candidat Family Information";
			}
		}
		else{
			$msg['type'] = 'failed';
			$msg['msg'] = "Invalid parameter.";
		}
	}
	else{
		$msg['type'] = 'failed';
		$msg['msg'] = "Login expired, please refresh your browser.";
	}
	echo json_encode($msg);
}

function cei_proses(){
	$msg = array();
	if ( isLogin() ){
		if ( $_POST ){
			$cnd_id_cei = $this->input->post("cnd_id_cei");

//FORMAL EDUCATION
			$edu_title = $this->input->post("edu_title");
			$edu_school_name = $this->input->post("edu_school_name");
			$edu_major = $this->input->post("edu_major");
			$edu_date = $this->input->post("edu_date");
			$edu_remark = $this->input->post("edu_remark");

//INFORMAL EDUCATION
			$training_name = $this->input->post("training_name");
			$training_cert = $this->input->post("training_cert");
			$training_year = $this->input->post("training_year");

//FOREIGN LANGUAGE
			$lang_name = $this->input->post("lang_name");
			$lang_spoken = $this->input->post("lang_spoken");
			$lang_written = $this->input->post("lang_written");
			$toefl_score = $this->input->post("toefl_score");
			$toefl_year = $this->input->post("toefl_year");

			if ( empty($cnd_id_cei) ){
				$msg['type'] = 'failed';
				$msg['msg'] = "Input all required data.";
			}
			else{
				$this->sitemodel->delete("candidat_edu", array("candidat_id"=>$cnd_id_cei));
				$this->sitemodel->delete("candidat_inf_edu", array("candidat_id"=>$cnd_id_cei));
				$this->sitemodel->delete("candidat_lang", array("candidat_id"=>$cnd_id_cei));
				for($i = 0; $i < count($edu_title);$i++){
					if ( empty($edu_title[$i]) == false and empty($edu_school_name[$i]) == false and empty($edu_major[$i]) == false and empty($edu_date[$i]) == false and empty($edu_remark[$i]) == false ){
						$exp = explode(" - ", $edu_date[$i]);
						$data = array(
							"candidat_id"	=> $cnd_id_cei,
							"edu_title"		=> $edu_title[$i],
							"edu_institute"	=> $edu_school_name[$i],
							"edu_major"		=> $edu_major[$i],
							"edu_start"		=> $exp[0],
							"edu_end"		=> $exp[1],
							"gpa"			=> $edu_remark[$i]
						);

						$this->sitemodel->insert("candidat_edu", $data);
					}
				}

				for($i = 0; $i < count($training_name); $i++){
					if ( empty($training_name[$i]) == false and empty($training_cert[$i]) == false and empty($training_year[$i]) == false ){
						$data = array(
							"candidat_id"	=> $cnd_id_cei,
							"inf_edu_name"	=> $training_name[$i],
							"inf_edu_cert"	=> $training_cert[$i],
							"inf_edu_year"	=> $training_year[$i]
						);

						$this->sitemodel->insert("candidat_inf_edu", $data);
					}
				}

				for($i = 0; $i < count($lang_name); $i++){
					if ( empty($lang_name[$i]) == false and empty($lang_spoken[$i]) == false and empty($lang_written[$i]) == false ){
						$data = array(
							"candidat_id"	=> $cnd_id_cei,
							"lang_name" 	=> $lang_name[$i],
							"cap_spoken"	=> $lang_spoken[$i],
							"cap_written"	=> $lang_written[$i]
						);

						if ( empty($toefl_score[$i]) == false and empty($toefl_year[$i]) == false ){
							$data['toefl_score'] = $toefl_score[$i];
							$data['toefl_year'] = $toefl_year[$i];
							$data['have_toefl'] = 'Y';
						}
						else{
							$data['have_toefl'] = 'N';
						}

						$this->sitemodel->insert("candidat_lang", $data);
					}
				}

				$msg['type'] = 'done';
				$msg['msg'] = "Successfully update Candidat Education Information";
			}
		}
		else{
			$msg['type'] = 'failed';
			$msg['msg'] = "Invalid parameter.";
		}
	}
	else{
		$msg['type'] = 'failed';
		$msg['msg'] = "Login expired, please refresh your browser.";
	}
	echo json_encode($msg);
}

function ceb_proses(){
	$msg = array();
	if ( isLogin() ){
		if ( $_POST ){
			$cnd_id_ceb = $this->input->post("cnd_id_ceb");
			$employee_date = $this->input->post("employee_date");
			$employee_company = $this->input->post("employee_company");
			$employee_position = $this->input->post("employee_position");
			$employee_report = $this->input->post("employee_report");
			$employee_salary = $this->input->post("employee_salary");
			$job_desc = $this->input->post("job_desc");
			$reason_leaving = $this->input->post("reason_leaving");

			if ( empty($cnd_id_ceb) ){
				$msg['type'] = 'failed';
				$msg['msg'] = "Input all required data.";
			}
			else{
				$this->sitemodel->delete("candidat_work_exp", array("candidat_id"=>$cnd_id_ceb));
				for($i = 0; $i < count($employee_company); $i++){
					if ( empty($employee_date[$i]) == false and empty($employee_company[$i]) == false and empty($employee_position[$i]) == false and empty($employee_report[$i]) == false and empty($employee_salary[$i]) == false and empty($job_desc[$i]) == false and empty($reason_leaving[$i]) == false ){
						$exp = explode( " - ", $employee_date[$i]);

						$data = array(
							"candidat_id"	=> $cnd_id_ceb,
							"work_exp_from"	=> $exp[0],
							"work_exp_to"	=> $exp[1],
							"company_name"	=> $employee_company[$i],
							"work_exp_title"=> $employee_position[$i],
							"report_to"		=> $employee_report[$i],
							"last_salary"	=> $employee_salary[$i],
							"job_desc"		=> $job_desc[$i],
							"reason_leaving"=> $reason_leaving[$i],
							"may_contact"	=> "N"
						);

						$this->sitemodel->insert("candidat_work_exp", $data);								
					}
				}

				$msg['type'] = 'done';
				$msg['msg'] = "Successfully update Candidat Working Experience";
			}
		}
		else{
			$msg['type'] = 'failed';
			$msg['msg'] = "Invalid parameter.";
		}
	}
	else{
		$msg['type'] = 'failed';
		$msg['msg'] = "Login expired, please refresh your browser.";
	}
	echo json_encode($msg);
}

function ai_proses(){
	$msg = array();
	if ( isLogin() ){
		if ( $_POST ){
			$cnd_id_ai = $this->input->post("cnd_id_ai");
			$vacant = $this->input->post("vacant");

			if ( empty($cnd_id_ai) or empty($vacant) ){
				$msg['type'] = 'failed';
				$msg['msg'] = "Input all required data.";
			}
			else{
				$cek = $this->sitemodel->view("tr_applicant", "*", array("vacant_id"=>$vacant, "candidat_id"=>$cnd_id_ai));
				$data = array(
					"vacant_id"		=> $vacant,
					"candidat_id"	=> $cnd_id_ai, 
					"apply_date"	=> date("Y-m-d H:i:s")
				);
				if ( $cek == '0' )
					$this->sitemodel->insert("tr_applicant", $data);						
				else{
					$get_applicant_id = $cek[0]->applicant_id;
					$this->sitemodel->update("tr_applicant", $data, array("applicant_id"=>$get_applicant_id));
				}
				$msg['type'] = 'done';
				$msg['cnd_id'] = $cnd_id_ai;
				$msg['msg'] = "Successfully update Candidat Additional Information";
			}
		}
		else{
			$msg['type'] = 'failed';
			$msg['msg'] = "Invalid parameter.";
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

//dropzone for file
function dropzone_file(){
	$myid = $this->input->post("myid");
	$target = "media/candidates/{$myid}";
	if ( !file_exists($target) )
		mkdir($target);

	$filename = $_FILES['dzfile']['name'];			
	$get_ext = explode(".", $filename);
	$ext = end($get_ext);
	$save_file = md5($filename.time()).'.'.$ext;
	move_uploaded_file($_FILES['dzfile']['tmp_name'], $target.'/'.$save_file);
	$this->sitemodel->update("tab_candidat", array("candidat_cv" => $save_file), array("candidat_id"=>$myid));
}

//dropzone for photo
function dropzone_foto(){
	$myid = $this->input->post("myid");
	$target = "media/candidates/{$myid}";
	if ( !file_exists($target) )
		mkdir($target);

	$filename = $_FILES['dzfoto']['name'];			
	$get_ext = explode(".", $filename);
	$ext = end($get_ext);
	$save_file = md5($filename.time()).'.'.$ext;
	$this->compress_image($_FILES['dzfoto']['tmp_name'], $target.'/'.$save_file, 75);
	$this->sitemodel->update("tab_candidat", array("candidat_foto" => $save_file), array("candidat_id"=>$myid));
}

//create cv based on candidate application form
function get_create_cv(){
	$msg = array();
	$msg['type'] = 'failed';
// if ( isLogin() ){
	if ( $_POST ){
		$key = $this->input->post("key");
		if ( empty($key) )
			$msg['msg'] = "Invalid parameter.";
		else{
			$cek = $this->sitemodel->view("tab_candidat", "*", array("candidat_verify"=>"Y", "candidat_id"=>$key));
			if ( $cek == '0' )
				$msg['msg'] = "No candidate found.";
			else{
				$msg['type'] = 'done';
				$msg['msg'] = base_url().SYS_AUTH."/applicant/view_create_cv/{$key}";
			}
		}
	}
	else
		$msg['msg'] = "Invalid parameter.";
// }
// else
// $msg['msg'] = "Session expired, please refresh your browser.";
	echo json_encode($msg);
}

function view_create_cv($key=''){
	$data['data'] = $this->site_create_cv($key);
	$this->load->view(SYS_FILE."applicant/get-create-cv", $data);
}

function site_create_cv($key=''){
	$data['data_cnd'] = $this->sitemodel->view("tab_candidat", "*", array("candidat_id"=>$key));
	$data['data_edu'] = $this->sitemodel->view("candidat_edu", "*", array("candidat_id"=>$key));
	$data['data_exp'] = $this->sitemodel->view("candidat_work_exp", "*", array("candidat_id"=>$key), null, null, "3");
	$data['data_fam'] = $this->sitemodel->view("candidat_family", "*", array("candidat_id"=>$key));
	$data['data_child'] = $this->sitemodel->view("candidat_children", "*", array("candidat_id"=>$key));
	$data['data_achiev'] = $this->sitemodel->view("candidat_achievement", "*", array("candidat_id"=>$key));
	$data['data_iedu'] = $this->sitemodel->view("candidat_inf_edu", "*", array("candidat_id"=>$key));
	$data['data_lang'] = $this->sitemodel->view("candidat_lang", "*", array("candidat_id"=>$key));
	$data['data_org'] = $this->sitemodel->view("candidat_organizational", "*", array("candidat_id"=>$key));
	$data['data_ref'] = $this->sitemodel->view("candidat_references", "*", array("candidat_id"=>$key));

	$site = $this->load->view(SYS_FILE."applicant/view-create-cv", $data, TRUE);

	return $site;
}

function reset_schedule(){
	$msg = [];
	$msg['type'] = 'failed';
	if ( isLogin() ){
		if ( $_POST ){
			$key = $this->input->post("key");
			$cndid = $this->input->post("cndid");
			$type = $this->input->post("type");

			if ( empty($key) or empty($cndid) or empty($type) )
				$msg['msg'] = "Invalid parameter.";
			else{
				$data = [
					"iu"	=> ["iu_acc", "iu_stat", "iu_date", "iu_lokasi", "iu_pic", "iu_acc_reason"],
					"ihr"	=> ["ihr_acc", "ihr_stat", "ihr_date", "ihr_lokasi", "ihr_pic", "ihr_acc_reason"],
					"psikotest"	=> ["psikotest_acc", "psikotest_stat", "psikotest_date", "psikotest_lokasi", "psikotest_pic", "psikotest_acc_reason"],
					"ia"		=> ["ia_acc", "ia_stat", "ia_date", "ia_lokasi", "ia_pic", "ia_acc_reason"],
					"mcu"		=> ["mcu_stat", "mcu_stat", "mcu_date", "mcu_lokasi", "mcu_pic", "mcu_acc_reason"],
					"finalisasi"=> ["final_acc", "final_stat", "final_date", "final_lokasi", "final_pic", "final_acc_reason"]
				];
				$cek = $this->sitemodel->view("tr_applicant", "vacant_id, {$data[$type][0]}", ["applicant_id"=>$key]);
				if ( $cek == '0' )
					$msg['msg'] = "No record found.";
				else{
					$vacid = $cek[0]->vacant_id;
					if ( $cek[0]->{$data[$type][0]} == "A" )
						$msg['msg'] = "Candidate already accept this invitation.";
					else{
						$items = [
							$data[$type][0] => NULL,
							$data[$type][1] => "N/A",
							$data[$type][2] => NULL,
							$data[$type][3] => NULL,
							$data[$type][4] => NULL,
							$data[$type][5] => NULL,
						];
						$this->sitemodel->update("tr_applicant", $items, ["applicant_id"=>$key]);
						$ret = $this->create_detail_test($cndid);								
						$msg['type'] = 'done';
						$msg['msg'] = "Successfully reset schedule.";
						$msg['content'] = $ret['content'];
					}
				}
			}
		}
		else
			$msg['msg'] = "Invalid parameter.";
	}
	else
		$msg['msg'] = "Session expired, please refresh your browser.";
	echo json_encode($msg);
}

function ajax_attachment(){
	$msg = [];
	$msg['type'] = 'failed';
	if ( isLogin() ){
		if ( $_POST ){
			$attachmentid = $this->input->post("attachmentid");
			$attachmenttype = $this->input->post("attachmenttype");
			if ( empty($attachmentid) or empty($attachmenttype) )
				$msg['msg'] = "Invalid parameter.";
			else{
				if ( isset($_FILES['attachment_file']['name']) ){
					$filename = $_FILES['attachment_file']['name'];
					$exp = explode(".", $filename);
					$ext = end($exp);
					if ($_FILES["attachment_file"]["size"] > 200000) {
						$msg['msg'] = "Maximum pdf allowed only 200 Kb.";
						echo json_encode($msg);
						return;
					}

					if ( strtolower($ext) != "pdf" ){
						$msg['msg'] = "Extension allowed .pdf";
						echo json_encode($msg);
						return;
					}

					$newfile = md5(time().$filename).".{$ext}";
					$data = [];
					if ( $attachmenttype == "psikotest" ){
						move_uploaded_file($_FILES['attachment_file']['tmp_name'], "media/assessments/{$newfile}");
						$data["psikotest_file"] = $newfile;
						$data['psikotest_file_entry'] = date("Y-m-d H:i:s");
					}
					else{
						move_uploaded_file($_FILES['attachment_file']['tmp_name'], "media/mcus/{$newfile}");
						$data["mcu_file"] = $newfile;
						$data['mcu_file_entry'] = date("Y-m-d H:i:s");
					}
					$this->sitemodel->update("tr_applicant", $data, ["applicant_id"=>$attachmentid]);
					$get = $this->sitemodel->view("tr_applicant", "candidat_id", ["applicant_id"=>$attachmentid]);
					$attachmenttype = strtoupper($attachmenttype);
					$msg['type'] = 'done';
					$msg['msg'] = "Successfully upload attachment for {$attachmenttype}.";
					$ret = $this->create_detail_test($get[0]->candidat_id);
					$msg['content'] = $ret['content'];
				}
				else
					$msg['msg'] = "Invalid parameter.";
			}
		}
		else
			$msg['msg'] = "Invalid parameter.";
	}
	else
		$msg['msg'] = "Session expired, please refresh your browser.";
	echo json_encode($msg);
}

function ajax_visited(){
	$msg = [];
	$msg['type'] = 'failed';
	if ( isLogin() ){
		if ( $_POST ){
			$key = $this->input->post("key");
			$mycv = $this->input->post("mycv");

			if ($this->input->post("type") == "candidate") {
				if ( empty($mycv) )
					$msg['msg'] = "Candidat has not upload CV yet.";
				else{
					$msg['type'] = 'done';
					$msg['msg'] = base_url()."media/candidate/{$mycv}";
				}
			}else{
				if ( empty($key) or empty($mycv) )
					$msg['msg'] = "Candidat has not upload CV yet.";
				else{
					$this->sitemodel->update("tr_applicant", ["is_visited"=>"1"], ["applicant_id"=>$key]);
					$msg['type'] = 'done';
					$msg['msg'] = base_url()."media/candidate/{$mycv}";
				}
			}

		}
		else
			$msg['msg'] = "Invalid parameter.";
	}
	else
		$msg['msg'] = "Session expired, please refresh your browser.";
	echo json_encode($msg);
}
}