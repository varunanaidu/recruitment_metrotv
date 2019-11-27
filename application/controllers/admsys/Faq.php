<?php if ( !defined('BASEPATH') )exit('No direct script access allowed');
class Faq extends CI_Controller{
    function __construct(){
        parent::__construct();
    }

    function index(){
        if (!isLogin()) redirect ( base_url().SYS_AUTH );
        $data['header_menu'] = "settings";
        $data['header_child'] = "faq";
        $data['css_loader'] = 'view-faq.css';
        $data['page'] = 'faq/view-faq';

        $data['data'] = $this->sitemodel->view("tab_faq_general", "*");

        $this->load->view(SYS_FILE."main-site", $data);
    }

    function ajax_validation(){
        $msg = array();
        $msg['type'] = 'failed';
        if ( isLogin() ) {
            if ( $_POST ){
                $id = $this->input->post("id");
                $type = $this->input->post("type");
                $question = $this->input->post("question");
                $answer = $this->input->post("answer");

                if ( empty($question) or empty($type) or empty(($answer)) )
                    $msg['msg'] = "Please Input all required data.";
                else{
                    if ( $type == "add" ){
                        $data = [
                            "question"	=> $question,
                            "answer"	=> $answer,
                            "created_by"    => $this->session->userdata(SES_END)->log_id,
                            "created_date"  => date("Y-m-d H:i:s")  
                        ];

                        $this->sitemodel->insert("tab_faq_general", $data);
                        $msg['type'] = 'done';
                        $msg['msg'] = "Successfully add FAQ.";
                    }
                    else if ( $type == "edit" ){
                        if ( empty($id) )
                            $msg['msg'] = "please input all required data.";
                        else{
                            $data = [
                                "question"	=> $question,
                                "answer"	=> $answer,
                                "modified_by"   => $this->session->userdata(SES_END)->log_id,
                                "modified_date" => date("Y-m-d H:i:s")  
                            ];

                            $this->sitemodel->update("tab_faq_general", $data, array("faq_id"=>$id));
                            $msg['type'] = 'done';
                            $msg['msg'] = "Successfully update FAQ.";
                        }
                    }
                    else
                        $msg['msg'] = "Invalid paramter.";
                }
            }
            else
                $msg['msg'] = 'Invalid parameter';
        }
        else
            $msg['msg'] = "Login expired, please refresh your browser.";

        echo json_encode($msg);
    }

    function ajax_finder(){
        $msg = array();
        $msg['type'] = 'failed';
        if ( isLogin() ) {
            if ( $_POST ){
                $key = $this->input->post("key");
                if ( empty($key) )
                    $msg['msg'] = "Invalid parameter.";
                else{
                    $cek = $this->sitemodel->view("tab_faq_general", "faq_id a, question b, answer c", array("faq_id"=>$key));
                    if ( $cek == '0' )
                        $msg['msg'] = "No faq found.";
                    else{
                        $msg['type'] = 'done';
                        $msg['msg'] = $cek;
                    }
                }
            }
            else
                $msg['msg'] = 'Invalid parameter';
        }
        else
            $msg['msg'] = "Login expired, please refresh your browser.";

        echo json_encode($msg);
    }

    function ajax_remove(){
        $msg = array();
        $msg['type'] = 'failed';
        if ( isLogin() ) {
            if ( $_POST ){
                $key = $this->input->post("key");
                if ( empty($key) )
                    $msg['msg'] = "Invalid parameter.";
                else{
                    $cek = $this->sitemodel->view("tab_faq_general", "*", array("faq_id"=>$key));
                    if ( $cek == '0' )
                        $msg['msg'] = "No FAQ found.";
                    else{
                        $this->sitemodel->delete("tab_faq_general", array("faq_id"=>$key));
                        $msg['type'] = 'done';
                        $msg['msg'] = "Successfully remove FAQ.";
                    }
                }
            }
            else
                $msg['msg'] = 'Invalid parameter';
        }
        else
            $msg['msg'] = "Login expired, please refresh your browser.";

        echo json_encode($msg);
    }
}