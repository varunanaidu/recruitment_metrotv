<?php defined('BASEPATH') OR exit('No direct script access allowed');


class New_tos extends SITE_Controller
{
    function __construct(){
      parent::__construct();
    }

    function index(){
        $data['page'] = 'tos';
        $this->load->view('site/front/new-main-site', $data);

    }
}