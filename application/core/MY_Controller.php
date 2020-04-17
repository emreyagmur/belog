<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

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
        
        //$this->user = get_active_user();
        if(!get_active_user())
        {
            redirect(base_url("login"));
        }
        
    }
    
}
