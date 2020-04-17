<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

    public $viewFolder = "";
    //public $user;
    
    public function __construct()
    {
        parent::__construct();
        
        $dil = $this->session->userdata("lang");
        if(!$dil)
        {
            $dil = $this->session->set_userdata("lang", "tr");
        }
        $this->lang->load($dil, $dil);
        
        
        $this->viewFolder = "register_v";
        $this->load->model("user_model");
        
        
    }
    
	public function index()
	{        
        $viewData = new stdClass();
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "index";
        
        
		$this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
	}
    
    public function save()
    {
        $this->load->library("form_validation");

        // Kurallar yazilir..
        $this->form_validation->set_rules("fullName", _NAME_SURNAME, "required|trim");
        $this->form_validation->set_rules("email", "E-posta", "required|trim|valid_email");
        $this->form_validation->set_rules("password", "Şifre", "required|trim|min_length[4]|max_length[10]");

        $this->form_validation->set_message(
            array(
                "required"    => "{field} alanı doldurulmalıdır",
                "valid_email" => "Lütfen geçerli bir e-posta adresi giriniz",
                "min_length"  => "{field} en az 4 karakterden oluşmalıdır",
                "max_length"  => "{field} en fazla 8 karakterden oluşmalıdır",
            )
        );
        
        if($this->form_validation->run() == FALSE)
        {
            $viewData = new stdClass();

            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "index";
            $viewData->form_error = true;

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }
        else
        {
            $userFullName = $this->input->post("fullName");
            $eposta = $this->input->post("email");
            $pass = $this->input->post("password");
            $userName = generate_username(convertToSeo($userFullName), 999);
            $insert = $this->user_model->add(
            array(
                "user_name"     => $userName,
                "full_name"     => $userFullName,
                "email"         => $eposta,
                "password"      => md5($pass),
                "pwdPlain"      => $pass,
                "isActive"      => 1,
                "createdAt"     => date("Y-m-d H:i:s"),
                "user_role_id"  => 4
                )
            );

            if($insert){
                $user = array(
                    "user_name"     => $userName,
                    "full_name"     => $userFullName,
                    "email"         => $eposta,
                    "password"      => md5($pass),
                    "pwdPlain"      => $pass,
                    "isActive"      => 1,
                    "createdAt"     => date("Y-m-d H:i:s"),
                    "user_role_id"  => 4
                );
                $this->session->set_userdata("user", $user);
                redirect(base_url());

            } 
            
        }
    }
    
}






