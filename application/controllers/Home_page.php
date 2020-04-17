<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_page extends CI_Controller {

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
        
        
        $this->viewFolder = "home_page_v";
        
    }
    
	public function index()
	{        
        $viewData = new stdClass();
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "home_page";
        
        
		$this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
	}
    
}






