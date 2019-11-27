<?php defined('BASEPATH') OR exit('No direct script access allowed');


class New_user_profile extends SITE_Controller
{
    function __construct(){
      parent::__construct();
    }

    function index(){
        $data['page'] = 'user_profile';
        $this->load->view('site/front/new-main-site', $data);
    }
}