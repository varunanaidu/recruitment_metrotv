<?php if ( !defined('BASEPATH') )exit('No direct script access allowed');
class Vacant extends CI_Controller{
    function __construct(){
        parent::__construct();
        if ( !isLogin() )redirect(redirect(base_url().SYS_AUTH));
    }

    function index(){
        $data['header_menu'] = "vacant";
        $data['header_child'] = 'vacant';
        $data['css_loader'] = 'view-vacant.css';
        $data['page'] = 'vacant/view-vacant';
        $data['data'] = $this->sitemodel->view("tr_vacant a", "*", null, ["tr_vacant_group b" => "a.vacant_group_id=b.vacant_group_id,", "tr_vacant_unit c" => "b.vacant_unit_id=c.vacant_unit_id,"], "a.created_date DESC");
        $data['vacant_unit'] = $this->sitemodel->view("tr_vacant_unit", "*");
        $this->load->view(SYS_FILE."main-site", $data);
    }

    function ajax_validation(){
        $msg = array();
        if ( isLogin() ) {
            if ( $_POST ){
                $id = $this->input->post("id");
                $type = $this->input->post("type");
                $v_title = $this->input->post("v_title");
                $v_group_id = $this->input->post("v_group_id");
                $v_code = $this->input->post("v_code");
                $v_req = $this->input->post("v_req");
                $v_stat = $this->input->post("v_stat");
                $range_date = $this->input->post("range_date");
                $candidat_needed = $this->input->post("candidat_needed");
                if ( empty($type) or empty($v_title) or empty($v_code) or empty($v_req) or empty($v_stat) or empty($range_date) or empty($candidat_needed)){
                    $msg['type'] = 'failed';
                    $msg['msg'] = 'Input all required data.';
                }
                else{
                    //cek range-date valid or not
                    $exp = explode(" - ", $range_date);
                    if ( count($exp) != 2 ){
                        $msg['type'] = 'Invalid range date.';
                    }
                    else{
                        if ( $type == "add" ){
                            if (isset($_FILES['v_poster']['name'])){
                                $file = $_FILES['v_poster']['name'];
                                $ext = explode(".", $file);
                                $end = strtolower(end($ext));
                                $allowed = array("png", "jpg", "jpeg");
                                if ( in_array($end, $allowed) ){
                                    if($_FILES['v_poster']['name'] > 200000){
                                        $msg['type'] = 'failed';
                                        $msg['msg'] = 'Maximum image can be upload is 200 Kb.';
                                    }else{
                                        $fileUpload = md5($file.date("YmdHis")).".".$end;
                                        $data = array(
                                            "vacant_title" => $v_title,
                                            "vacant_code"	=> $v_code,
                                            "vacant_group_id"	=> $v_group_id,
                                            "vacant_criteria"=> $v_req,
                                            "vacant_status"	=> $v_stat,
                                            "url_poster"    => $fileUpload,
                                            "created_by"	=> $this->session->userdata(SES_END)->log_id,
                                            "open_date"		=> $exp[0],
                                            "close_date"	=> $exp[1],
                                            "candidat_needed"=> $candidat_needed,
                                            "created_date"	=> date("Y-m-d H:i:s")
                                        );
                                        $this->compress_image($_FILES['v_poster']['tmp_name'], "assets/vacancy/".$fileUpload, 75);
                                        $this->sitemodel->insert("tr_vacant", $data);
                                        $msg['type'] = 'done';
                                        $msg['msg'] = "Successfully add Vacant.";
                                    }
                                }else{
                                    $msg['type'] = 'failed';
                                    $msg['msg'] = "Invalid image extension.";
                                }
                            }else{
                                $msg['type'] = 'failed';
                                $msg['msg'] = "Input all required data.";
                            }
                        }
                        else if ( $type == "edit" ){
                            if ( empty($id) ){
                                $msg['type'] = 'failed';
                                $msg['msg'] = 'Input all required data.';
                            }
                            else{
                                $data = array(
                                    "vacant_title" => $v_title,
                                    "vacant_code"	=> $v_code,
                                    "vacant_group_id"	=> $v_group_id,
                                    "vacant_criteria"=> $v_req,
                                    "vacant_status"	=> $v_stat,
                                    "open_date"		=> $exp[0],
                                    "close_date"	=> $exp[1],
                                    "candidat_needed"=> $candidat_needed,
                                    "modified_by"	=> $this->session->userdata(SES_END)->log_id,
                                    "modified_date"	=> date("Y-m-d H:i:s")
                                );

                                if ( isset($_FILES['v_poster']['name']) ){
                                    $file = $_FILES['v_poster']['name'];
                                    $exp = explode(".", $file);
                                    $end = strtolower(end($exp));
                                    $allowed = array("png", "jpg", "jpeg");
                                    if ( in_array($end, $allowed) ){
                                        if ( $_FILES['v_poster']['size'] > 200000 ){
                                            $msg['type'] = 'failed';
                                            $msg['msg'] = 'Maximum image can be upload is 200 Kb.';
                                        }
                                        else{
                                            $fileUpload = md5($file.date("YmdHis")).".".$end;
                                            $data["url_poster"] = $fileUpload;

                                            $this->compress_image($_FILES['v_poster']['tmp_name'], "assets/vacancy/".$fileUpload, 75);
                                            $this->sitemodel->update("tr_vacant", $data, array("vacant_id"=>$id));
                                            $msg['type'] = 'done';
                                            $msg['msg'] = "Successfully update vacancy.";
                                        }
                                    }
                                    else{
                                        $msg['type'] = 'failed';
                                        $msg['msg'] = "Invalid image extension.";
                                    }
                                }
                                else{
                                    $this->sitemodel->update("tr_vacant", $data, array("vacant_id"=>$id));
                                    $msg['type'] = 'done';
                                    $msg['msg'] = "Successfully update Vacant.";
                                }
                            }
                        }
                        else{
                            $msg['type'] = 'failed';
                            $msg['msg'] = 'Invalid parameter';
                        }
                    }
                }
            }
            else{
                $msg['type'] = 'failed';
                $msg['msg'] = 'Invalid parameter';
            }
        }
        else{
            $msg['type'] = 'failed';
            $msg['msg'] = "Login expired, please refresh your browser.";
        }
        echo json_encode($msg);
    }

    function find_data(){
        $msg = array();
        if ( isLogin() ){
            if ( $_POST ){
                $key = $this->input->post("key");
                if ( empty($key) ){
                    $msg['type'] = 'failed';
                    $msg['msg'] = 'Invalid parameter.';
                }
                else{
                    $data = $this->sitemodel->view("tr_vacant a", "vacant_id a, a.vacant_group_id i, b.vacant_unit_id k, vacant_title b, vacant_criteria c, vacant_status d, vacant_code e, open_date as f, close_date as g, candidat_needed as h, url_poster j", array("vacant_id"=>$key), ["tr_vacant_group b" => "a.vacant_group_id=b.vacant_group_id,"]);
                    if ( $data == '0' ){
                        $msg['type'] = 'failed';
                        $msg['msg'] = 'No vacant found.';
                    }
                    else{
                        $msg['type'] = 'done';
                        $msg['msg'] = $data;
                    }
                }
            }
            else{
                $msg['type'] = 'failed';
                $msg['msg'] = 'Invalid parameter.';
            }
        }
        else{
            $msg['type'] = 'failed';
            $msg['msg'] = "Login expired, please refresh your browser.";
        }
        echo json_encode($msg);
    }

    function ajax_remove(){
        $msg = array();
        if ( isLogin() ){
            if ( $_POST ){
                $key = $this->input->post("key");
                if ( empty($key) ){
                    $msg['type'] = 'failed';
                    $msg['msg'] = 'Invalid parameter.';
                }
                else{
                    $cek = $this->sitemodel->view("tr_vacant", "*", array("vacant_id"=>$key));
                    if ( $cek == '0' ){
                        $msg['type'] = 'failed';
                        $msg['msg'] = "No vacant found.";
                    }
                    else{
                        $this->sitemodel->delete("tr_vacant", array("vacant_id"=>$key));
                        $msg['type'] = 'done';
                        $msg['msg'] = "Successfully remove vacant.";
                    }
                }
            }
            else{
                $msg['type'] = 'failed';
                $msg['msg'] = 'Invalid parameter.';
            }
        }
        else{
            $msg['type'] = 'failed';
            $msg['msg'] = "Login expired, please refresh your browser.";
        }
        echo json_encode($msg);
    }

    function compress_image($source_url, $destination_url, $quality) {
        $info = getimagesize($source_url);

        if ($info['mime'] == 'image/jpeg')
            $image = imagecreatefromjpeg($source_url);
        elseif ($info['mime'] == 'image/gif')
            $image = imagecreatefromgif($source_url);
        elseif ($info['mime'] == 'image/png')
            $image = imagecreatefrompng($source_url);
        imagejpeg($image, $destination_url, $quality);

        return true;
    }

    function get_vacantGroup()
    {
        $key = $this->input->post("key");
        $result = $this->sitemodel->view('tr_vacant_group', '*', ['vacant_unit_id' => $key]);
        $data = array();
        if ($result != '0'){
            foreach ($result as $key) {
                $sub_data = array();
                $sub_data['vacant_group_id']	= $key->vacant_group_id;
                $sub_data['name']	= $key->name;
                $data[] = $sub_data;
            }
        }
        echo json_encode($data);
    }

    function get_vacantUnit()
    {
        $result = $this->sitemodel->view('tr_vacant_unit', '*');
        $data = array();
        if ($result != '0'){
            foreach ($result as $key) {
                $sub_data = array();
                $sub_data['vacant_unit_id']    = $key->vacant_unit_id;
                $sub_data['unit_name']   = $key->unit_name;
                $data[] = $sub_data;
            }
        }
        echo json_encode($data);
    }
}