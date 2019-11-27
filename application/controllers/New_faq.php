<?php defined('BASEPATH') OR exit('No direct script access allowed');


class New_faq extends SITE_Controller
{
    function __construct(){
      parent::__construct();
    }

    function index(){
        $data['page'] = 'faq';
        $data['data_faq'] = $this->sitemodel->view("tab_faq_general", "*", false, false, false, 3, 0);
        $data['data_testimoni'] = $this->sitemodel->view("tab_testimoni", "*", false, false, "created_date DESC");
        $this->load->view('site/front/new-main-site', $data);

    }

    function getPage($page)
    {
		$start = ceil($page * 3);
        $data['data_faq'] = $this->sitemodel->view("tab_faq_general", "*", false, false, false, $start, 3);
        echo json_encode($data);
    }
}