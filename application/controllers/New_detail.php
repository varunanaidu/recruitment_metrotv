<?php defined('BASEPATH') OR exit('No direct script access allowed');


class New_detail extends SITE_Controller
{
    function __construct(){
      parent::__construct();
    }

    function index(){
        $data['page'] = 'detail';
        $data['data_editorial'] = $this->sitemodel->view("tab_tipsntrick", "*");
        $data['data_testimoni'] = $this->sitemodel->view("tab_testimoni", "*", false, false, "created_date DESC");
        $this->load->view('site/front/new-main-site', $data);
    }

    function detailTips($tipsntrick_id){
        $data['page'] = 'detail';
        $data['data_editorial'] = $this->sitemodel->view("tab_tipsntrick", "*",  array("tipsntrick_id ="=> $tipsntrick_id));
        $data['data_testimoni'] = $this->sitemodel->view("tab_testimoni", "*", false, false, "created_date DESC");
        $this->load->view('site/front/new-main-site', $data);
    }
    function detailAct($activity_id){
        $data['page'] = 'detail';
        $data['data_activity'] = $this->sitemodel->view("tab_activity", "*",  array("activity_id ="=> $activity_id));
        $data['data_testimoni'] = $this->sitemodel->view("tab_testimoni", "*", false, false, "created_date DESC");
        $this->load->view('site/front/new-main-site', $data);
    }
}