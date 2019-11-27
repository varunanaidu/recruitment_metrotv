<?php defined('BASEPATH') OR exit ( "No direct script access allowed");
/***
*
* @Author		: Andi Putra
* @Date Create	: 11 June 2019
* @Date Revise	: 
* @Version		: 1.0.0
* @Notes		: -
*
* - to be used in admin page (filter applicant)
* 
***/
class Adm_applicant_model extends CI_Model{
	
	function __construct(){
		parent::__construct();
	}

	/*** DATATABLE SERVER SIDE FOR APPLICANT ***/
	function _get_applicant_query($type = 'manage', $key = 'ALL'){
		$__column_order 	= array('applicant_id', 'candidat_name'); //field yang ada di table
		$__column_search 	= array('applicant_id', 'candidat_name'); //field yang diizin untuk pencarian 
		$__order 			= array('applicant_id' => 'desc'); // default order 	
		/* query */
		if ($key == 'ALL' and $type == 'manage'){
			$this->db->select("applicant_id, GROUP_CONCAT(vacant_code SEPARATOR ', ') vacant_code, a.candidat_id, candidat_name, candidat_foto, candidat_cv, TIMESTAMPDIFF(YEAR, dob, CURDATE()) as usia, gender, marital_status, ca_city, GROUP_CONCAT(applicant_status SEPARATOR ',') as applicant_status, edu_title, edu_institute, edu_major, gpa, company_name, last_salary, iu_stat, ihr_stat, psikotest_stat, ia_stat, mcu_stat, final_stat, is_visited");
		}
		else {
			$this->db->select("applicant_id, vacant_code, a.candidat_id, candidat_name, candidat_foto, candidat_cv, TIMESTAMPDIFF(YEAR, dob, CURDATE()) as usia, gender, marital_status, ca_city, applicant_status, edu_title, edu_institute, edu_major, gpa, company_name, last_salary, iu_stat, ihr_stat, psikotest_stat, ia_stat, mcu_stat, final_stat, is_visited");
		}
		$this->db
			->from('tr_applicant a')
			->join('tr_vacant b', 'a.vacant_id=b.vacant_id', 'LEFT')
			->join('tab_candidat c', 'a.candidat_id=c.candidat_id', 'LEFT')
			// ->join("(SELECT * FROM candidat_edu GROUP BY candidat_id ORDER BY FIELD(edu_title, 'S2', 'S1', 'D3', 'SMU'))AS d", 'c.candidat_id=d.candidat_id', 'LEFT')
			->join("(SELECT * FROM candidat_edu GROUP BY candidat_id HAVING MAX(cedu_id) ORDER BY candidat_id DESC) AS d", 'c.candidat_id=d.candidat_id', 'LEFT')
			// ->join("(SELECT * FROM candidat_work_exp GROUP BY candidat_id ORDER BY work_exp_id)AS e", 'c.candidat_id=e.candidat_id', 'LEFT');
			->join(" (SELECT * FROM candidat_work_exp GROUP BY candidat_id HAVING MAX(work_exp_id) ORDER BY candidat_id DESC) AS e", 'c.candidat_id=e.candidat_id', 'LEFT');
		$where = array();
		if ($type == "manage"){
			$where = [
				"applicant_status IN ('On Going', 'N/A')" => null,
				"c.candidat_status" => "N/A"
			];						
		}
		else if ($type == "history"){
			$where = [
				"applicant_status IN ('Failed', 'Passed')" => null
			];	
		}
		if ($key != "ALL") $where["a.vacant_id"] = $key;
		$this->db->where($where);
		/* end query */
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
		/* group by */
		$this->db->group_by('a.candidat_id');
		/* order by */
        if ($this->input->post('order') != null){
            $this->db->order_by($__column_order[$this->input->post('order')['0']['column']], $this->input->post('order')['0']['dir']);
        } 
        else if (isset($__order)){
            $order = $__order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
	
	function get_applicant($type, $key){
        $this->_get_applicant_query($type, $key);
        if ($this->input->post('length') != -1) $this->db->limit($this->input->post('length'), $this->input->post('start'));
        $query = $this->db->get();
        return $query->result();
    }
 
    function get_applicant_count_filtered($type, $key){
        $this->_get_applicant_query($type, $key);
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    function get_applicant_count_all(){
        $this->db->from('tr_applicant');
        return $this->db->count_all_results();
    }
}