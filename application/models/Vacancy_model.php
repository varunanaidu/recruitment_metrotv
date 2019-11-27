<?php defined('BASEPATH') OR exit ( "No direct script access allowed");
/***
*
* @Author		: Andi Putra
* @Date Create	: 01 October 2019
* @Date Revise	: 
* @Version		: 1.0.0
* @Notes		: -
*
***/
class Vacancy_model extends CI_Model{
	
	function __construct(){
		parent::__construct();
	}

	function get_vacancy_unit($param = array()){
		$this->db->where('is_deleted', '0');
		if (isset($param['vacant_unit_id'])) $this->db->where('vacant_unit_id', $param['vacant_unit_id']);
		return $this->db->get('tr_vacant_unit')->result();
	}

	function get_vacancy_group($param = array()){
		$this->db->where('is_deleted', '0');
		if (isset($param['vacant_group_id'])) $this->db->where('vacant_group_id', $param['vacant_group_id']);
		if (isset($param['vacant_unit_id'])) $this->db->where('vacant_unit_id', $param['vacant_unit_id']);
		return $this->db->get('tr_vacant_group')->result();
	}

	function get_vacancy($param = array(), $order_by = FALSE, $limit = FALSE, $offset = FALSE){
		$select = "tv.vacant_id as a, tvg.vacant_group_id as b, tv.vacant_title as c, 
			tvg.name as d, tv.vacant_code as e, tv.vacant_criteria as f, 
			tv.open_date as g, tv.close_date as h, tv.candidat_needed as i, tv.vacant_status as j";
		$this->db
			->select($select)
			->from('tr_vacant tv')
			->join('tr_vacant_group tvg', 'tvg.vacant_group_id=tv.vacant_group_id')
			->join('tr_vacant_unit tvu', 'tvu.vacant_unit_id=tvg.vacant_unit_id')
			->where('tv.vacant_status', 'ACTIVE')
			->where('tvg.is_deleted', '0')
			->where('tvu.is_deleted', '0');
		if (isset($param['vacant_title'])) $this->db->like('tv.vacant_title', $param['vacant_title']);				//CONDITION LIKE
		if (isset($param['vacant_group_id'])) $this->db->where('tv.vacant_group_id', $param['vacant_group_id']);
		if (isset($param['vacant_unit_id'])) $this->db->where('tvg.vacant_unit_id', $param['vacant_unit_id']);
		if (isset($param['unit_name'])) $this->db->where('tvu.unit_name', $param['unit_name']);
		if ($order_by) $this->db->order_by($order_by);
		if ($limit){
			($offset != 0) ? $this->db->limit($limit, $offset) : $this->db->limit($limit);
		}
		return $this->db->get()->result();
	}
}