<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My_account extends CI_Controller {

    public $viewFolder = "";
    //public $user;
    
    public function __construct()
    {
        parent::__construct();
        if(!get_active_user())
        {
            redirect(base_url("login"));
        }
        
        $dil = $this->session->userdata("lang");
        if(!$dil)
        {
            $dil = $this->session->set_userdata("lang", "tr");
        }
        $this->lang->load($dil, $dil);
        
        $this->load->model("user_model");
        
        $this->viewFolder = "my_account_v";
        
    }
    
	public function index()
	{        
        $viewData = new stdClass();
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "index";
        
        
		$this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
	}
    
    public function editProfile($id)
	{
        $user = $this->user_model->get(array('id' => $id));
        
        $viewData = new stdClass();
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "edit";
        $viewData->user_info = $user;
        
        
		$this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
	}
    
    public function update_profile($id)
    {
        $this->load->library("form_validation");

        // Kurallar yazilir..
        $this->form_validation->set_rules("fullname", _NAME_SURNAME, "required|trim");
        $this->form_validation->set_rules("email", "E-posta", "required|trim|valid_email");
        
        $this->form_validation->set_message(
            array(
                "required"    => "{field} alanı doldurulmalıdır",
                "valid_email" => "Lütfen geçerli bir e-posta adresi giriniz",
            )
        );
        
        if($this->form_validation->run() == FALSE)
        {
            $viewData = new stdClass();

            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "edit";
            $viewData->form_error = true;

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }
        else
        {
            $userFullName = $this->input->post("fullname");
            $email = $this->input->post("email");
            $user_bio = $this->input->post("bio");
            $phone = $this->input->post("phone");
            $gender = $this->input->post("gender");
            
            $update = $this->user_model->update(
                array(
                    'id'    => $id
                ),
                array(
                    'full_name'     => $userFullName,
                    'email'         => $email,
                    'user_bio'      => $user_bio,
                    'phone_number'  => $phone,
                    'gender'        => $gender
                )
            );
            
            if($update)
            {
                redirect(base_url("my_account"));
            }
            else 
            {
                redirect(base_url("my_account/editProfile"));
            }
            
        }
        
    }
    
    public function changeUserName()
    {
        $user_name = $_POST["username"];
        
        $control = $this->user_model->get(array('user_name' => $user_name));
        
        if(!empty($control))
        {
            echo '<span style="color: red;">Gecersiz</span>';
        }
        else
        {
            echo '<span style="color: green;">Uygun</span>';
        }
        
    }
    
}






