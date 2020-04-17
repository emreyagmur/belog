<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Posts extends CI_Controller {

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
        
        
    }
    
	public function index()
	{
        $dbi = dbi();
        $user = objectToArray(get_active_user());
        $user_id = $user["id"];
        
        $description = $_POST["description"];
        
        if(!empty($description))
        {
            $queryData = array(
                "senderId"      => $user_id,
                "description"   => $description,
                "postDate"      => date("Y-m-d H:i:s"),
            );
            
            $insert = $dbi->insert("posts", $queryData);
            
            if($insert) die(json_encode(array("message" => array("success"))));
            else die(json_encode(array("message" => array("error"))));
            
        }    
        
	}
    
    public function deletePost($id)
	{
        $dbi = dbi();
        $user = objectToArray(get_active_user());
        $user_id = $user["id"];
        
        $dbi->where("id", $id);
        $delete = $dbi->delete("posts");
        
        if($delete) die(json_encode(array("message" => array("success" => _DELETED))));
        else die(json_encode(array("message" => array("error" => _ERROR))));
        
    }
    public function likePost($id)
	{
        $dbi = dbi();
        $user = objectToArray(get_active_user());
        $user_id = $user["id"];
        
        $queryData = array(
            "postId"    => $id,
            "userId"    => $user_id
        );
        
        $dbi->where("postId", $id);
        $dbi->where("userId", $user_id);
        $getPostInfo = $dbi->getOne("postLikes");
        
        if(empty($getPostInfo))
        {
            $like = $dbi->insert("postLikes", $queryData);
        
            if($like)
            {
                $dbi->where("id", $id);
                $getNumberLike = $dbi->getOne("posts");
                $numberOfLike = $getNumberLike["like"] + 1;
                $queryData = array("like" => $numberOfLike);

                $dbi->where("id", $id);
                $updateLike = $dbi->update("posts", $queryData);

                die(json_encode(array("message" => array("success" => _DELETED))));
            }    
            else die(json_encode(array("message" => array("error" => _ERROR))));    
        }
        
        
    }
    public function dislikePost($id)
	{
        $dbi = dbi();
        $user = objectToArray(get_active_user());
        $user_id = $user["id"];
        
        $queryData = array(
            "postId"    => $id,
            "userId"    => $user_id
        );
        
        $dbi->where("postId", $id);
        $dbi->where("userId", $user_id);
        $deleteLike = $dbi->delete("postLikes");
        
        if($deleteLike)
        {
            $dbi->where("id", $id);
            $getNumberLike = $dbi->getOne("posts");
            $numberOfLike = $getNumberLike["like"] - 1;
            $queryData = array("like" => $numberOfLike);
            
            $dbi->where("id", $id);
            $updateLike = $dbi->update("posts", $queryData);
            
            die(json_encode(array("message" => array("success" => _DELETED))));
        }    
        else die(json_encode(array("message" => array("error" => _ERROR))));
        
    }
    public function getPosts($page)
	{
        $dbi = dbi();
        $user = objectToArray(get_active_user());
        $user_id = $user["id"];
        $gPost = array();
        
        $getFollowUsers = $dbi->subQuery();
        $getFollowUsers->where("followingUserId", $user_id);
        $getFollowUsers->get("user_following", null, "followedUserId");
        
        $dbi->pageLimit = 5;
        $dbi->orderBy("postDate", "DESC");
        $dbi->where("senderId", $getFollowUsers, "IN");
        $dbi->orWhere("senderId", $user_id);
        $getPost = $dbi->paginate("posts", $page);
        
        if(!empty($getPost))
        {
            foreach($getPost as $k => $p)
            {
                $dbi->where("userId", $user_id);
                $dbi->where("postId", $p["id"]);
                $postInfo = $dbi->getOne("postLikes");
                
                if($p["like"] > 0) 
                {
                    if(!empty($postInfo))
                    {
                        $textClass = "text-danger";    
                    }
                    else
                    {
                        $textClass = "text-secondary";
                    }
                    $smallLikeText = '<i class="fa fa-heart"></i> '.$p["like"].' '. _LIKES;
                }
                else
                {
                    $textClass = "text-secondary";
                    $smallLikeText = "";
                }
                
                if($p["senderId"] == $user_id)
                {
                    $deleteButton = '<a class="dropdown-item text-danger delete-post" data-id="'.$p["id"].'" href="#">'._DELETE.'</a>';
                }
                else
                {
                    $deleteButton = "";
                }
                
                echo '<div class="card mb-2 no-border posts" id="postDiv'.$p["id"].'">
                        <div class="card-header post-p10">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="mr-2">
                                        <img class="rounded-circle" width="45" src="https://picsum.photos/50/50" alt="">
                                    </div>
                                    <div class="ml-2">
                                        <div class="h5 m-0">'.userName($p["senderId"]).'</div>
                                        <div class="h7 text-muted">Miracles Lee Cross</div>
                                    </div>
                                </div>
                                <div>
                                    <div class="dropdown">
                                        <button class="btn" type="button" id="gedf-drop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-ellipsis-h"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right post-dropdown" aria-labelledby="gedf-drop1">
                                            <a class="dropdown-item" href="#">'._SAVE.'</a>
                                            <a class="dropdown-item" href="#">'._HIDE.'</a>
                                            '.$deleteButton.'
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-body post-body">
                            <p class="card-text">'.$p["description"].'</p>
                        </div>
                        <div class="post-body-f">
                            <small class="text-secondary mr-2"><i class="far fa-clock"></i> '.postTime($p["postDate"]).'  '.'</small>
                            <small class="text-secondary">'.$smallLikeText.'</small>
                        </div>
                        <div class="card-footer post-p10">
                            <a href="#" class="'.$textClass.' like-post" data-id="'.$p["id"].'"><i class="fa fw-10 fa-2x fa-heart"></i></a>
                            <a href="#" class="text-secondary"><i class="fa fw-10 fa-2x fa-comment"></i></a>
                        </div>
                    </div>';

            }
            $p = intval($page) + 1;
            $url = base_url()."posts/getPosts/".$p;
            echo '<a class="hidden" style="color: #fff;" href="'.$url.'">next</a>';
        }
        //die(json_encode(array("posts" => $gPost, "senderId" => $user_id)));
        
	}
    
}






