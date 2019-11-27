<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Tipsntricks extends SITE_Controller
{
    function __construct(){
      parent::__construct();
    }

    function index(){
        $data['page'] = 'tipsntricks';
        $data['data_editorial'] = $this->sitemodel->view("tab_tipsntrick", "*", false, false, "date DESC", 3, 0);
        $this->load->view('site/front/new-main-site', $data);
    }

    function getPage($page)
    {
		$start = ceil($page * 3);
        $data['data_editorial'] = $this->sitemodel->view("tab_tipsntrick", "*", false, false, "date DESC", $start, 3);
        echo json_encode($data);
    }
}