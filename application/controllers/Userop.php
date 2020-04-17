<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Userop extends CI_Controller {

    public $viewFolder = "";
    
    public function __construct()
    {
        parent::__construct();
        
        
        $dil = $this->session->userdata("lang");
        if(!$dil)
        {
            $dil = $this->session->set_userdata("lang", "tr");
        }
        $this->lang->load($dil, $dil);
        
        $this->viewFolder = "users_v";
        
        $this->load->model("user_model");
        $this->load->model("login_model");
        
    }
    
    public function login()
    {
        $this->session->set_userdata("lang", "tr");
        
        
        if(get_active_user())
        {
            redirect(base_url());
        }
        
        
        $viewData = new stdClass();
        
        /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "login";

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }
    
    public function do_login(){
        
        if(get_active_user())
        {
            redirect(base_url());
        }
        $dbi = dbi();
        
        $userid = $_POST["userid"];
        $pass = $_POST["pass"];
        
        $dbi->where("email", $userid);
        $userEmail = $dbi->getOne("users");
        
        $dbi->where("user_name", $userid);
        $userName = $dbi->getOne("users");
        
        if(empty($userEmail) && empty($userName))
        {
            die(json_encode(array("message" => array("error" => "kullanici bulunamadi"))));
        }
        else if(!empty($userEmail) && empty($userName))
        {
            if($userEmail["email"] == $userid && $userEmail["password"] == $pass)
            {
                $this->session->set_userdata("user", $userEmail);
                die(json_encode(array("message" => array("success" => "true"))));
            }
            else die(json_encode(array("message" => array("error" => "Bilgiler hatalı"))));
 
        }
        else if(empty($userEmail) && !empty($userName))
        {
            if($userName["user_name"] == $userid && $userName["password"] == $pass)
            {
                $this->session->set_userdata("user", $userName);
                die(json_encode(array("message" => array("success" => "true"))));
            }
            else die(json_encode(array("message" => array("error" => "Bilgiler hatalı"))));
            
        }
    }
    
    public function logout()
    {
        $this->session->unset_userdata("user");
        redirect(base_url("login"));
        
    }
    
    
}

?>