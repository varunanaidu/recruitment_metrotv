<?php defined('BASEPATH') OR exit ( "No direct script access allowed");


class Candidate_model extends CI_Model{
	
	function __construct(){
		parent::__construct();
	}

	/*** DATATABLE SERVER SIDE FOR APPLICANT ***/
	function _get_applicant_query(){
		$__order 			= array('candidat_id' => 'DESC');
		$__column_search 	= array('candidat_id', 'candidat_name');
        $__column_order     = array('candidat_id', 'candidat_name');

		$this->db->select('tc. candidat_id, candidat_foto, candidat_cv, candidat_name, gender, TIMESTAMPDIFF(YEAR, dob, CURDATE()) as usia, marital_status, edu_title, edu_institute, edu_major, gpa, ca_city, company_name, last_salary');
		$this->db->from('tab_candidat tc')
		->join(' (SELECT * FROM `candidat_edu` WHERE edu_start IN ( SELECT MAX(edu_start) FROM candidat_edu GROUP BY candidat_id )) AS ce  ', 'tc.candidat_id=ce.candidat_id', 'LEFT')
		->join(' (SELECT * FROM `candidat_work_exp` WHERE work_exp_from IN ( SELECT MAX(work_exp_from) FROM candidat_work_exp GROUP BY candidat_id )) AS cwe ', 'tc.candidat_id=cwe.candidat_id', 'LEFT');

        $i = 0;
        $search_value = $this->input->post('search')['value'];
        foreach ($__column_search as $item){
            if ($search_value){
                if ($i === 0){ // looping awal
                    $this->db->group_start(); 
                    $this->db->like("UPPER({$item})", strtoupper($search_value), FALSE);
                }
                else{
                    $this->db->or_like("UPPER({$item})", strtoupper($search_value), FALSE);
                }
                if (count($__column_search) - 1 == $i) $this->db->group_end(); 
            }
            $i++;
        }

        /* order by */
        if ($this->input->post('order') != null){
            $this->db->order_by($__column_order[$this->input->post('order')['0']['column']], $this->input->post('order')['0']['dir']);
        } 
        else if (isset($__order)){
            $order = $__order;
            $this->db->order_by(key($order), $order[key($order)]);
        }

    }
	
	function get_applicant(){
        $this->_get_applicant_query();
        if ($this->input->post('length') != -1) $this->db->limit($this->input->post('length'), $this->input->post('start'));
        $query = $this->db->get();
        return $query->result();
    }
 
    function get_applicant_count_filtered(){
        $this->_get_applicant_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    function get_applicant_count_all(){
        $this->db->from('tr_applicant');
        return $this->db->count_all_results();
    }
}