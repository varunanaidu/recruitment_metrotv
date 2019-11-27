<?php if ( !defined('BASEPATH') )exit('No direct script access allowed');
class Qr_code extends CI_Controller{
    function __construct(){
        parent::__construct();
    }
    
    function index(){
        if (!isLogin()) redirect ( base_url().SYS_AUTH );           
        $data['css_loader'] = 'qr_code.css';
        $data['header_menu'] = "qr_code";          
        $data['page'] = 'qr_code/view-qrcode';       
        $this->load->view(SYS_FILE."main-site", $data);
    } 
}