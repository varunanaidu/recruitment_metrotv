<?php if ( !defined('BASEPATH') )exit('No direct script access allowed');
	class Api extends CI_Controller{
		function __construct(){
			parent::__construct();
		}
		
		function index($key=''){
			$msg = [];
			$msg['type'] = 'failed';
			if ( $key == 'this-is-key-example' ){
				$join = ["tab_candidat b"=>"a.candidat_id=b.candidat_id,"];
				// $data_cnd = $this->sitemodel->view("tr_applicant a", "b.*", ["applicant_status"=>"Passed", "is_sent"=>"NS"], $join, "candidat_name");
				//update 2019-06-19 (AP) : to view all applicant for history
				$data_cnd = $this->sitemodel->view("tr_applicant a", "b.*, a.is_sent", ["applicant_status"=>"Passed"], $join, "is_sent desc, candidat_id desc");
				// $msg['debug'] = $this->db->last_query();
				if ( $data_cnd == '0' )
					$msg['msg'] = "No data found.";
				else{
					$msg['type'] = 'done';
					$msg['msg'] = $data_cnd;
				}
			}
			else{
				$msg['msg'] = "Invalid key";
			}
			
			echo json_encode($msg);
		}
		
		function check($key='',$cnd=''){
			$msg = [];
			$msg['type'] = 'failed';
			if ( $key == 'this-is-key-example' ){
				$join = ["tab_candidat b"=>"a.candidat_id=b.candidat_id,"];
				$data_cnd = $this->sitemodel->view("tr_applicant a", "b.*", ["applicant_status"=>"Passed", "is_sent"=>"NS", "a.candidat_id"=>$cnd], $join, "candidat_name");
				// $msg['debug'] = $this->db->last_query();
				if ( $data_cnd == '0' )
					$msg['msg'] = "No data found.";
				else{
					$msg['type'] = 'done';
					$msg['msg'] = $data_cnd;
				}
			}
			else{
				$msg['msg'] = "Invalid key";
			}
			
			echo json_encode($msg);
		}
		
		function get_achievment($key='', $cnd=''){
			$msg = [];
			$msg['type'] = 'failed';
			if ( $key == 'this-is-key-example' ){
				$join = ["tab_candidat b"=>"a.candidat_id=b.candidat_id,LEFT"];
				$data_cnd = $this->sitemodel->view("candidat_achievement a", "a.*", ["a.candidat_id"=>$cnd], $join, "achievement_id");
				$msg['type'] = 'done';
				$msg['msg'] = $data_cnd;				
			}
			else{
				$msg['msg'] = "Invalid key";
			}
			
			echo json_encode($msg);
		}
		
		function get_children($key='', $cnd=''){
			$msg = [];
			$msg['type'] = 'failed';
			if ( $key == 'this-is-key-example' ){
				$join = ["tab_candidat b"=>"a.candidat_id=b.candidat_id,LEFT"];
				$data_cnd = $this->sitemodel->view("candidat_children a", "a.*", ["a.candidat_id"=>$cnd], $join, "child_id");
				$msg['type'] = 'done';
				$msg['msg'] = $data_cnd;				
			}
			else{
				$msg['msg'] = "Invalid key";
			}
			
			echo json_encode($msg);
		}
		
		function get_education($key='', $cnd=''){
			$msg = [];
			$msg['type'] = 'failed';
			if ( $key == 'this-is-key-example' ){
				$join = ["tab_candidat b"=>"a.candidat_id=b.candidat_id,LEFT"];
				$data_cnd = $this->sitemodel->view("candidat_edu a", "a.*", ["a.candidat_id"=>$cnd], $join, "cedu_id");
				$msg['type'] = 'done';
				$msg['msg'] = $data_cnd;				
			}
			else{
				$msg['msg'] = "Invalid key";
			}
			
			echo json_encode($msg);
		}
		
		function get_family($key='', $cnd=''){
			$msg = [];
			$msg['type'] = 'failed';
			if ( $key == 'this-is-key-example' ){
				$join = ["tab_candidat b"=>"a.candidat_id=b.candidat_id,LEFT"];
				$data_cnd = $this->sitemodel->view("candidat_family a", "a.*", ["a.candidat_id"=>$cnd], $join, "family_id");
				$msg['type'] = 'done';
				$msg['msg'] = $data_cnd;				
			}
			else{
				$msg['msg'] = "Invalid key";
			}
			
			echo json_encode($msg);
		}
		
		function get_inf_edu($key='', $cnd=''){
			$msg = [];
			$msg['type'] = 'failed';
			if ( $key == 'this-is-key-example' ){
				$join = ["tab_candidat b"=>"a.candidat_id=b.candidat_id,LEFT"];
				$data_cnd = $this->sitemodel->view("candidat_inf_edu a", "a.*", ["a.candidat_id"=>$cnd], $join, "inf_edu_id");
				$msg['type'] = 'done';
				$msg['msg'] = $data_cnd;				
			}
			else{
				$msg['msg'] = "Invalid key";
			}
			
			echo json_encode($msg);
		}
		
		function get_lang($key='', $cnd=''){
			$msg = [];
			$msg['type'] = 'failed';
			if ( $key == 'this-is-key-example' ){
				$join = ["tab_candidat b"=>"a.candidat_id=b.candidat_id,LEFT"];
				$data_cnd = $this->sitemodel->view("candidat_lang a", "a.*", ["a.candidat_id"=>$cnd], $join, "clang_id");
				$msg['type'] = 'done';
				$msg['msg'] = $data_cnd;				
			}
			else{
				$msg['msg'] = "Invalid key";
			}
			
			echo json_encode($msg);
		}
		
		function get_org($key='', $cnd=''){
			$msg = [];
			$msg['type'] = 'failed';
			if ( $key == 'this-is-key-example' ){
				$join = ["tab_candidat b"=>"a.candidat_id=b.candidat_id,LEFT"];
				$data_cnd = $this->sitemodel->view("candidat_organizational a", "a.*", ["a.candidat_id"=>$cnd], $join, "org_id");
				$msg['type'] = 'done';
				$msg['msg'] = $data_cnd;				
			}
			else{
				$msg['msg'] = "Invalid key";
			}
			
			echo json_encode($msg);
		}
		
		function get_references($key='', $cnd=''){
			$msg = [];
			$msg['type'] = 'failed';
			if ( $key == 'this-is-key-example' ){
				$join = ["tab_candidat b"=>"a.candidat_id=b.candidat_id,LEFT"];
				$data_cnd = $this->sitemodel->view("candidat_references a", "a.*", ["a.candidat_id"=>$cnd], $join, "cref_id");
				$msg['type'] = 'done';
				$msg['msg'] = $data_cnd;				
			}
			else{
				$msg['msg'] = "Invalid key";
			}
			
			echo json_encode($msg);
		}
		
		function get_experiences($key='', $cnd=''){
			$msg = [];
			$msg['type'] = 'failed';
			if ( $key == 'this-is-key-example' ){
				$join = ["tab_candidat b"=>"a.candidat_id=b.candidat_id,LEFT"];
				$data_cnd = $this->sitemodel->view("candidat_work_exp a", "a.*", ["a.candidat_id"=>$cnd], $join, "work_exp_id");
				$msg['type'] = 'done';
				$msg['msg'] = $data_cnd;				
			}
			else{
				$msg['msg'] = "Invalid key";
			}
			
			echo json_encode($msg);
		}
		
		function set_flag($key='', $cnd=''){
			$msg = [];
			$msg['type'] = 'failed';
			if ( $key == 'this-is-key-example' ){
				$cek = $this->sitemodel->update("tr_applicant", ["is_sent"=>"S"], ["candidat_id"=>$cnd, "applicant_status"=>"Passed"]);				
				$msg['type'] = 'done';
			}
			else{
				$msg['msg'] = "Invalid key";
			}
			
			echo json_encode($msg);
		}
	}