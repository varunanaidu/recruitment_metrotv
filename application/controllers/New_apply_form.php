<?php defined('BASEPATH') OR exit('No direct script access allowed');


class New_apply_form extends SITE_Controller
{
    function __construct(){
      parent::__construct();
    }

    function index(){
        $data['page'] = 'apply_form';
        $this->load->view('site/front/new-main-site', $data);
    }
}