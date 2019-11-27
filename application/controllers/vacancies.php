<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Vacancies extends SITE_Controller
{
	private $perPage = 3;
	function __construct(){
		parent::__construct();
	}

	function index(){
		$data['page'] = 'vacancies';
		$data['data_vacancies'] = $this->sitemodel->view("tr_vacant tv", "tv.vacant_id as a, tvg.vacant_group_id as b, tv.vacant_title as c, tvg.name as d, tv.vacant_code as e, tv.vacant_criteria as f, tv.open_date as g, tv.close_date as h, tv.candidat_needed as i, tv.vacant_status as j", false, array("tr_vacant_group tvg" => "tvg.vacant_group_id=tv.vacant_group_id,"), false, $this->perPage, 0);
        $data['tr_vacant_unit'] = $this->sitemodel->view("tr_vacant_unit", "*"); 
        $data['tr_vacant_group'] = $this->sitemodel->view("tr_vacant_group", "*"); 
		$this->load->view('site/front/new-main-site', $data);

	}

	function getPage($page)
	{
		$start = ceil($page * $this->perPage);
		$data['data_vacancies'] = $this->sitemodel->view("tr_vacant tv", "tv.vacant_id as a, tvg.vacant_group_id as b, tv.vacant_title as c, tvg.name as d, tv.vacant_code as e, tv.vacant_criteria as f, tv.open_date as g, tv.close_date as h, tv.candidat_needed as i, tv.vacant_status as j", false, array("tr_vacant_group tvg" => "tvg.vacant_group_id=tv.vacant_group_id,"), false, $start, $this->perPage);
		echo json_encode($data);
	}
}