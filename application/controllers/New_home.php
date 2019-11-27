<?php defined('BASEPATH') OR exit('No direct script access allowed');


class New_home extends SITE_Controller
{
    private $perPage = 3;
    
    function __construct(){
      parent::__construct();
    }

    function index(){
        $data['page'] = 'home';			
		$data['data_slideshow'] = $this->sitemodel->view("tab_slideshow", "*");

        $data['data_vacancies'] = $this->sitemodel->view("tr_vacant tv", "tv.vacant_id as a, tvg.vacant_group_id as b, tv.vacant_title as c, tvg.name as d, tv.vacant_code as e, tv.vacant_criteria as f, tv.open_date as g, tv.close_date as h, tv.candidat_needed as i, tv.vacant_status as j", false, array("tr_vacant_group tvg" => "tvg.vacant_group_id=tv.vacant_group_id,"), false, $this->perPage, 0);

        $data['data_editorial'] = $this->sitemodel->view("tab_tipsntrick", "*", false, false, "date DESC", 3, 0);
        $data['data_testimoni'] = $this->sitemodel->view("tab_testimoni", "*", false, false, "created_date DESC");
        $data['data_activities'] = $this->sitemodel->view("tab_activity", "*", false, false, false, 3, 0);
        $data['data_faq'] = $this->sitemodel->view("tab_faq_general", "*", false, false, false, 3, 0);
        $data['tr_vacant_unit'] = $this->sitemodel->view("tr_vacant_unit", "*"); 
        $data['tr_vacant_group'] = $this->sitemodel->view("tr_vacant_group", "*"); 
        $this->load->view('site/front/new-main-site', $data);
    }
}