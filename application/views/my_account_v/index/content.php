<?php
$user = objectToArray(get_active_user());
$user_id = $user["id"];
?>

    <div class="col-md-4">
        
        <div class="well well-sm">
            <div class="media">
                <div class="user-image">
                    <img class="img-responsive img-circle" src="<?=base_url("assets")?>/assets/images/user1.png" height="60" width="60" alt="">
                </div>
                <div class="media-body">
                    <h4 class="media-heading"><?=$user["user_name"]?></h4>
                	<p><span class="label label-info">888 gonderi</span> <span class="label label-success">888 takipci</span> <span class="label label-warning">150 takip</span></p>
                    <p>
                        <a href="<?=base_url("my_account/editProfile/$user_id")?>" class="btn btn-xs btn-default btn-block"><i class="fa fa-edit"></i> <?=_EDIT_PROFILE?></a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-8">
        <nav class="nav-justified ">
            <div class="nav nav-tabs " id="nav-tab" role="tablist">
                <a class="nav-item nav-link color-gr active" id="pop1-tab" data-toggle="tab" href="#pop1" role="tab" aria-controls="pop1" aria-selected="true"><i class="fa fa-th"></i> <span class="hide-text"><?=_POSTS?></span></a>
                <a class="nav-item nav-link color-gr" id="pop2-tab" data-toggle="tab" href="#pop2" role="tab" aria-controls="pop2" aria-selected="false"><i class="fa fa-heart"></i> <span class="hide-text"><?=_LIKED_POSTS?></span></a>
                <a class="nav-item nav-link color-gr" id="pop3-tab" data-toggle="tab" href="#pop3" role="tab" aria-controls="pop3" aria-selected="false"><i class="fa fa-bookmark-o"></i> <span class="hide-text"><?=_SAVED?></span></a>        
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            
            <div class="tab-pane fade show active" id="pop1" role="tabpanel" aria-labelledby="pop1-tab">
                <div class="pt-3"></div>
                <p> gonderiler</p>
            </div>
            
            <div class="tab-pane fade" id="pop2" role="tabpanel" aria-labelledby="pop2-tab">
                <div class="pt-3"></div>
                <p>begenilen gonderiler</p>      
            </div>
            
            <div class="tab-pane fade" id="pop3" role="tabpanel" aria-labelledby="pop3-tab">
                <div class="pt-3"></div>
                <p> kaydedilenler</p>                      
            </div>
            
        </div>
    </div>
