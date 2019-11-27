<?php defined('BASEPATH') OR exit('No direct script access allowed');


class New_detail_vacancies extends SITE_Controller
{
    function __construct(){
      parent::__construct();
    }

    function index(){
        $data['page'] = 'detail_vacancies';
        # vacancy_id
        if ($this->input->get('v')) {
            $data['data_vacancies'] = $this->sitemodel->view('tr_vacant', '*', ['vacant_id' => $this->input->get('v')]);
        }else{
            $data['data_vacancies'] = $this->sitemodel->view("tr_vacant", "*");
        }
        $this->load->view('site/front/new-main-site', $data);
    }

    function detailVacant($vacant_id){
        $data['page'] = 'detail_vacancies';
        $data['data_vacancies'] = $this->sitemodel->view("tr_vacant", "*",  array("vacant_id ="=> $vacant_id));
        $this->load->view('site/front/new-main-site', $data);
    }
}