<?php if ( !defined('BASEPATH') )exit( 'No direct script access allowed' );
class Slideshow extends CI_Controller{
    function __construct(){
        parent::__construct();
    }

    function index(){
        if (!isLogin()) redirect ( base_url().SYS_AUTH );
        $data['header_menu'] = "settings";
        $data['header_child'] = "slideshow";
        $data['css_loader'] = 'slideshow.css';
        $data['page'] = 'slideshow/view-slideshow';
        $data['data'] = $this->sitemodel->view("tab_slideshow", "*");
        $this->load->view(SYS_FILE."main-site", $data);
    }

    function ajax_validation(){
        $msg = array();
        if ( isLogin() ) {
            if ( $_POST ){
                $id = $this->input->post("id");
                $type = $this->input->post("type");
                $text_slide = $this->input->post("text_slide");

                if ( empty($type) or empty($text_slide) ){
                    $msg['type'] = 'failed';
                    $msg['msg'] = "Input all required data.";
                }
                else{
                    if ( $type == "add" ){
                        if ( isset($_FILES['file']['name']) ){
                            $file = $_FILES['file']['name'];
                            $filesize = getimagesize($_FILES['file']['tmp_name']);
                            /*echo '<pre>';print_r($filesize);die;*/
                            $width = $filesize[0];
                            $height = $filesize[1];
                            $exp = explode(".", $file);
                            $end = strtolower(end($exp));
                            $allowed = array("png", "jpg", "jpeg");
                            if ( in_array($end, $allowed) ){
                                if ( $_FILES['file']['size'] > 200000 ){
                                    $msg['type'] = 'failed';
                                    $msg['msg'] = 'Maximum image can be upload is 200 Kb.';
                                }
                                else if ($width < 1200 || $height < 560) {
                                    $msg['type'] = 'failed';
                                    $msg['msg'] = "Image dimension should be within 1200 x 560";
                                }
                                else{
                                    $fileUpload = md5($file.date("YmdHis")).".".$end;
                                    $data = array(
                                        "slideshow_img" => $fileUpload,
                                        "slideshow_text"=> $text_slide
                                    );
                                    $this->compress_image($_FILES['file']['tmp_name'], "assets/slideshow/".$fileUpload, 75);
                                    $this->sitemodel->insert("tab_slideshow", $data);
                                    $msg['type'] = 'done';
                                    $msg['msg'] = "Successfully add slideshow.";
                                }
                            }
                            else{
                                $msg['type'] = 'failed';
                                $msg['msg'] = "Invalid image extension.";
                            }
                        }
                        else{
                            $msg['type'] = 'failed';
                            $msg['msg'] = "Input all required data.";
                        }
                    }
                    else if ( $type == "edit" ){
                        if ( empty($id) ){
                            $msg['type'] = 'failed';
                            $msg['msg'] = "Input all required data.";
                        }
                        else{
                            $data = array(
                                "slideshow_text" => $text_slide
                            );

                            if ( isset($_FILES['file']['name']) ){
                                $file = $_FILES['file']['name'];
                                $filesize = getimagesize($_FILES['file']['tmp_name']);
                                /*echo '<pre>';print_r($filesize);die;*/
                                $width = $filesize[0];
                                $height = $filesize[1];
                                $exp = explode(".", $file);
                                $end = strtolower(end($exp));
                                $allowed = array("png", "jpg", "jpeg");
                                if ( in_array($end, $allowed) ){
                                    if ( $_FILES['file']['size'] > 200000 ){
                                        $msg['type'] = 'failed';
                                        $msg['msg'] = 'Maximum image can be upload is 200 Kb.';
                                    }
                                    else if ($width < 1200 && $height < 560) {
                                        $msg['type'] = 'failed';
                                        $msg['msg'] = "Image dimension should be within 1200 x 560";
                                    }
                                    else{
                                        $fileUpload = md5($file.date("YmdHis")).".".$end;
                                        $data["slideshow_img"] = $fileUpload;

                                        $this->compress_image($_FILES['file']['tmp_name'], "assets/slideshow/".$fileUpload, 100);
                                        $this->sitemodel->update("tab_slideshow", $data, array("slideshow_id"=>$id));
                                        $msg['type'] = 'done';
                                        $msg['msg'] = "Successfully update slideshow.";
                                    }
                                }
                                else{
                                    $msg['type'] = 'failed';
                                    $msg['msg'] = "Invalid image extension.";
                                }
                            }
                            else{
                                $this->sitemodel->update("tab_slideshow", $data, array("slideshow_id"=>$id));
                                $msg['type'] = 'done';
                                $msg['msg'] = "Successfully update slideshow.";
                            }
                        }
                    }
                    else{
                        $msg['type'] = 'failed';
                        $msg['msg'] = "Invalid parameter.";
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

    function ajax_finder(){
        $msg = array();
        if ( isLogin() ) {
            if ( $_POST ){
                $key = $this->input->post("key");
                if ( empty($key) ){
                    $msg['type'] = 'failed';
                    $msg['msg'] = "Invalid parameter.";
                }
                else{
                    $cek = $this->sitemodel->view("tab_slideshow", "slideshow_id a, slideshow_text b, slideshow_img c", array("slideshow_id"=>$key));
                    if ( $cek == '0' ){
                        $msg['type'] = 'failed';
                        $msg['msg'] = "No slideshow found.";
                    }
                    else{
                        $msg['type'] ='done';
                        $msg['msg'] = $cek;
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

    function ajax_remove(){
        $msg = array();
        if ( isLogin() ) {
            if ( $_POST ){
                $key = $this->input->post("key");
                if ( empty($key) ){
                    $msg['type'] = 'failed';
                    $msg['msg'] = "Invalid parameter.";
                }
                else{
                    $cek = $this->sitemodel->view("tab_slideshow", "*", array("slideshow_id"=>$key));
                    if ( $cek == '0' ){
                        $msg['type'] = 'failed';
                        $msg['msg'] = "No Slideshow found.";
                    }
                    else{
                        $this->sitemodel->delete("tab_slideshow", array('slideshow_id'=>$key));
                        $msg['type'] = 'done';
                        $msg['msg'] = "Successfully remove slideshow.";
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
}