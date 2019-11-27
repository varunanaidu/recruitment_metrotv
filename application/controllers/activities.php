<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Activities extends SITE_Controller
{
    function __construct(){
      parent::__construct();
    }

    function index(){
        $data['page'] = 'activities';
        $data['data_activities'] = $this->sitemodel->view("tab_activity", "*", false, false, false, 3, 0);
        $this->load->view('site/front/new-main-site', $data);
    }

    function getPage($page)
    {
		$start = ceil($page * 3);
        $data['data_activities'] = $this->sitemodel->view("tab_activity", "*", false, false, false, $start, 3);
        echo json_encode($data);
    }
}