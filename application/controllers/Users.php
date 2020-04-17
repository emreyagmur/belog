<?php

class Users extends CI_Controller
{
    public $viewFolder = "";

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
        
        $this->viewFolder = "users_v";

        $this->load->model("user_model");
        $this->load->model("user_roles_model");
        
    }

    public function index(){

        $viewData = new stdClass();

        /** Tablodan Verilerin Getirilmesi.. */
        $items = $this->user_model->get_all(array());
        
        $roles = $this->user_roles_model->get_all(array());

        /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "list";
        $viewData->items = $items;
        $viewData->roles = $roles;

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function new_form(){

        $viewData = new stdClass();
        
        $user_types = $this->user_roles_model->get_all(array());

        /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "add";
        $viewData->user_types = $user_types;

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);

    }

    public function save(){

        if($this->input->post("isActive") == "on") $active = 1;
        else $active = 0;
            
        $userName = $this->input->post("user_name");
        $userFullName = $this->input->post("full_name");
        $eposta = $this->input->post("email");
        $pass = $this->input->post("password");
        $user_type = $this->input->post("user_type");

        
        
        if($userName == "" || $userFullName == "" || $eposta == "" || $pass == "" || $user_type == "")
        {
            $alert = array(
                "message" => "Bilgiler Bos Olamaz",
                "type"    => "error"
            );

            $this->session->set_flashdata("alert", $alert);

            redirect(base_url("users/new_form"));
            
            die();
        }
        
        $insert = $this->user_model->add(
            array(
                "user_name"     => $userName,
                "full_name"     => $userFullName,
                "email"         => $eposta,
                "password"      => md5($pass),
                "pwdPlain"      => $pass,
                "isActive"      => $active,
                "createdAt"     => date("Y-m-d H:i:s"),
                "user_role_id"  => $user_type
                )
            );

            if($insert){

                $alert = array(
                    "message" => "Kayıt başarılı bir şekilde eklendi",
                    "type"    => "success"
                );

            } 
            else 
            {
                $alert = array(
                    "message" => "Veritabani Hatasi Aldiniz",
                    "type"    => "error"
                );
            }
        
            $this->session->set_flashdata("alert", $alert);

            redirect(base_url("users"));
        /*
        if($validate){

            // Upload Süreci...

            $file_name = convertToSEO(pathinfo($_FILES["img_url"]["name"], PATHINFO_FILENAME)) . "." . pathinfo($_FILES["img_url"]["name"], PATHINFO_EXTENSION);

            $config["allowed_types"] = "jpg|jpeg|png";
            $config["upload_path"]   = "uploads/$this->viewFolder/";
            $config["file_name"] = $file_name;

            $this->load->library("upload", $config);

            $upload = $this->upload->do_upload("img_url");

            if($upload){

                $uploaded_file = $this->upload->data("file_name");

                $insert = $this->user_model->add(
                    array(
                        "title"         => $this->input->post("title"),
                        "description"   => $this->input->post("description"),
                        "url"           => convertToSEO($this->input->post("title")),
                        "img_url"       => $uploaded_file,
                        "rank"          => 0,
                        "isActive"      => 1,
                        "createdAt"     => date("Y-m-d H:i:s")
                    )
                );

                // TODO Alert sistemi eklenecek...
                if($insert){

                    $alert = array(
                        "title" => "İşlem Başarılı",
                        "text" => "Kayıt başarılı bir şekilde eklendi",
                        "type"  => "success"
                    );

                } else {

                    $alert = array(
                        "title" => "İşlem Başarısız",
                        "text" => "Kayıt Ekleme sırasında bir problem oluştu",
                        "type"  => "error"
                    );
                }

            } else {

                $alert = array(
                    "title" => "İşlem Başarısız",
                    "text" => "Görsel yüklenirken bir problem oluştu",
                    "type"  => "error"
                );

                $this->session->set_flashdata("alert", $alert);

                redirect(base_url("references/new_form"));

                die();

            }

            // İşlemin Sonucunu Session'a yazma işlemi...
            $this->session->set_flashdata("alert", $alert);

            redirect(base_url("references"));

        } else {

            $viewData = new stdClass();

            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "add";
            $viewData->form_error = true;

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }
        */

    }

    public function update_form($id){

        $viewData = new stdClass();

        $user_types = $this->user_roles_model->get_all(array());
        
        /** Tablodan Verilerin Getirilmesi.. */
        $item = $this->user_model->get(
            array(
                "id"    => $id,
            )
        );
        
        /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "update";
        $viewData->item = $item;
        $viewData->user_types = $user_types;

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);


    }


    public function update($id){
        
        if($this->input->post("isActive") == "on") $active = 1;
        else $active = 0;
            
        $userName = $this->input->post("user_name");
        $userFullName = $this->input->post("full_name");
        $eposta = $this->input->post("email");
        
        if($userName == "" || $userFullName == "" || $eposta == "")
        {
            $alert = array(
                "message" => "Bilgiler Bos Olamaz",
                "type"    => "error"
            );

            $this->session->set_flashdata("alert", $alert);

            redirect(base_url("users/new_form"));
            
            die();
        }
        
        $update = $this->user_model->update(
            array(
                "id"    => $id
            ),
            array(
                "user_name"     => $userName,
                "full_name"     => $userFullName,
                "email"         => $eposta,
                "isActive"      => $active,
                )
            );

            if($update){

                $alert = array(
                    "message" => "Kayıt başarılı bir şekilde guncellendi",
                    "type"    => "success"
                );

            } 
            else 
            {
                $alert = array(
                    "message" => "Veritabani Hatasi Aldiniz",
                    "type"    => "error"
                );
            }
        
            $this->session->set_flashdata("alert", $alert);

            redirect(base_url("users"));
    }

    public function delete($id){
        
        $user = $this->user_model->get(
            array(
                "id"    => $id,
            )
        );
        
        if($user->user_role_id == 1)
        {
            $alert = array(
                "message"  => "Yonetici Silinemez",
                "type"     => "error"
            );
        }
        else
        {
           $delete = $this->user_model->delete(
                array(
                    "id"    => $id
                )
            );

            if($delete){

                $alert = array(
                    "message" => "Kullanici Silindi",
                    "type"    => "succes"
                );

            } else {

                $alert = array(
                    "message"  => "Kayıt silme sırasında bir problem oluştu",
                    "type"  => "error"
                );


            } 
        }

        $this->session->set_flashdata("alert", $alert);
        redirect(base_url("users"));

    }
    
    public function follow($id)
	{
        $dbi = dbi();
        $user = objectToArray(get_active_user());
        $user_id = $user["id"];
        
        
        $dbi->where("id", $id);
        $userInfo = $dbi->getOne("users");
        
        
        $dbi->where("followingUserId", $user_id);
        $dbi->where("followedUserId", $id);
        $followInfo = $dbi->getOne("user_following");
            
        if(empty($followInfo))
        {
            if($userInfo["pravicy"] != "1")
            {
                $queryData = array(
                    "followingUserId"   => $user_id,
                    "followedUserId"    => $id,
                    "approval"          => "1"
                );

                $insert = $dbi->insert("user_following", $queryData);

                if($insert) die(json_encode(array("message" => array("success" => 1))));
                else die(json_encode(array("message" => array("error" => _ERROR))));
            }
            else
            {
                $queryData = array(
                    "followingUserId"   => $user_id,
                    "followedUserId"    => $id,
                    "approval"          => "0"
                );

                $insert = $dbi->insert("user_following", $queryData);

                if($insert) die(json_encode(array("message" => array("success" => 2))));
                else die(json_encode(array("message" => array("error" => _ERROR))));
            }
        }
        else
        {
            $dbi->where("followingUserId", $user_id);
            $dbi->where("followedUserId", $id);
            $delete = $dbi->delete("user_following");
            
            if($delete) die(json_encode(array("message" => array("success" => 3))));
            else die(json_encode(array("message" => array("error" => _ERROR))));
        }
        
        
        
        //die(json_encode(array("message" => array("success" => $id))));
        
        //if($delete) die(json_encode(array("message" => array("success" => _DELETED))));
        //else die(json_encode(array("message" => array("error" => _ERROR))));
        
    }
    
}
