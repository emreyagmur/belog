<!DOCTYPE html>
<html>
<head>
    <?php
    $this->load->view("includes/head");
    ?>
        
    <?php
    $this->load->view("includes/include_script");    
    ?>
</head>
<body>
    <?php
    $this->load->view("includes/navbar"); 
    ?> 
           
    <div class="container">
        
        <div class="col-3 left-fixed mobile-hidden">
            
            <div class="card mb-4 mt-3">
                
                <div class="card-header">
                    tset
                </div>    
                <div class="card-body left-fixed-container-body">
                    <?php
                    $dbi = dbi();
                    $user = objectToArray(get_active_user());
                    $user_id = $user["id"];
                    
                    $getFollowUsers = $dbi->subQuery();
                    $getFollowUsers->where("followingUserId", $user_id);
                    $getFollowUsers->get("user_following", null, "followedUserId");
                    
                    $dbi->where("id", $getFollowUsers, "NOT IN");
                    $users = $dbi->get("users");
                    
                    foreach($users as $user)
                    {
                        if($user["id"] != $user_id)
                        {
                        ?>
                        <div class="media">
                            <img class="mr-3 img-circle" src="<?=base_url("assets")?>/assets/images/user1.png" width="40">
                            <div class="media-body">
                                <h6 class="mt-0" style="margin-bottom: 0px;"><?=$user["user_name"]?></h6>
                                <?=$user["full_name"]?>
                                <div class="float-right"><a href="#" class="btn-follow btn-follow<?=$user["id"]?>" data-user-id="<?=$user["id"]?>"><?=_FOLLOW?></a></div>
                            </div>
                        </div>
                        <hr>
                        <?php
                        }
                    }
                    
                    ?>
                    
                </div>
            </div>
                
        </div>
        <div class="row content-container">
            
            
            <!-- content -->
            <div class="col-md-8 right-content">

                <?php
                    $this->load->view("{$viewFolder}/{$subViewFolder}/content");
                ?>
                
            </div>
            
            <!-- end content -->
        </div>
    </div>
        
    <?php
    $this->load->view("includes/footer"); 
    ?>
    
    <script type="text/javascript">
        
        $(function(){
            
            $(".btn-follow").on("click", function(e){
                
                e.preventDefault();
                var uid = $(this).data("user-id");

                $.ajax({
                    type: "POST",
                    url: "<?=base_url()?>/users/follow/"+uid,
                    dataType: "json",
                    cache: false,
                    success: function(data) {
                        if(data.message.success === 1)
                        {
                            $(".btn-follow"+uid).addClass("text-secondary");
                            $(".btn-follow"+uid).html("<?=_FOLLOWING?>");
                        }
                        else if(data.message.success === 2)
                        {
                            $(".btn-follow"+uid).addClass("text-secondary");
                            $(".btn-follow"+uid).html("<?=_REQUEST_SENT?>");
                        }
                        else
                        {
                            $(".btn-follow"+uid).removeClass("text-secondary");
                            $(".btn-follow"+uid).html("<?=_FOLLOW?>");    
                        }    
                    }
                });

            });
            
        });
        
    </script>
        
</body>
</html>
