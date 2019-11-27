<?php if ( !defined('BASEPATH') )exit('No direct script access allowed');
	class Sitemodel extends CI_Model{
/*
		$table = String
		$join = Array
		$select = String
		$where = Array
		$order_by = String
*/
		function view($table, $select, $where=false, $join=false, $order_by=false, $limit=false, $start=false, $ex_select = true, $group_by=false){
			$this->db->select($select, $ex_select);
			$this->db->from($table);
			if ( $where )
				$this->db->where($where);
			
			if ( $order_by )
				$this->db->order_by($order_by);
			
			if ( $join ){
				foreach($join as $key => $value){
					$exp = explode(',', $value);
					$this->db->join($key, $exp[0], $exp[1]);
				}
			}
			
			if ( $limit ){
				if ( $start != 0) {
					$this->db->limit($limit, $start);
				}else{	
					$this->db->limit($limit);
				}
			}
			
			if ( $group_by )
				$this->db->group_by($group_by);
			
			$q = $this->db->get();
			if ( $q->num_rows() > 0 )
				return $q->result();
			else
				return '0';
		}
		
		function custom_query($sql, $where=false){
			if ( $where )
				$q = $this->db->query($sql, $where);
			else
				$q = $this->db->query($sql);
			
			if ( $q->num_rows() > 0 )
				return $q->result();
			else
				return '0';
		}
		
		function insert($table, $data){
			$this->db->insert($table, $data);
			$ret = $this->db->insert_id();
			return $ret;
		}
		
		function update($table, $data, $where){
			$this->db->trans_start();
				$this->db->where($where);
				$this->db->update($table, $data);
			$this->db->trans_complete();
			
			if ( $this->db->trans_status() === FALSE )
				return '0';
			else
				return '1';
		}
		
		function delete($table, $where){
			$this->db->trans_start();
				$this->db->where($where);
				$this->db->delete($table);
			$this->db->trans_complete();
			
			if ( $this->db->trans_status() === FALSE )
				return '0';
			else
				return '1';
		}
		
		function insert_applicant($lastid=''){
			$this->db->query("INSERT INTO tr_applicant(vacant_id, candidat_id, applicant_status, applicant_date_res, applicant_ket, applicant_user_id, iu_stat, iu_date, iu_lokasi, iu_pic, iu_user_id, iu_ket, ihr_stat, ihr_date, ihr_lokasi, ihr_pic, ihr_user_id, ihr_ket, ihr_date_res, psikotest_stat, psikotest_date, psikotest_lokasi, psikotest_pic, psikotest_user_id, psikotest_ket, psikotest_date_res, ia_stat, ia_date, ia_lokasi, ia_pic, ia_user_id, ia_ket, ia_date_res, mcu_stat, mcu_date, mcu_lokasi, mcu_pic, mcu_user_id, mcu_ket, mcu_date_res, final_stat, final_date, final_lokasi, final_pic, final_user_id, final_ket, final_date_res, apply_date) SELECT vacant_id, candidat_id, applicant_status, applicant_date_res, applicant_ket, applicant_user_id, iu_stat, iu_date, iu_lokasi, iu_pic, iu_user_id, iu_ket, ihr_stat, ihr_date, ihr_lokasi, ihr_pic, ihr_user_id, ihr_ket, ihr_date_res, psikotest_stat, psikotest_date, psikotest_lokasi, psikotest_pic, psikotest_user_id, psikotest_ket, psikotest_date_res, ia_stat, ia_date, ia_lokasi, ia_pic, ia_user_id, ia_ket, ia_date_res, mcu_stat, mcu_date, mcu_lokasi, mcu_pic, mcu_user_id, mcu_ket, mcu_date_res, final_stat, final_date, final_lokasi, final_pic, final_user_id, final_ket, final_date_res, apply_date FROM tr_applicant WHERE applicant_id = '{$lastid}'");
			$ret = $this->db->insert_id();
			return $ret;
		}
	}