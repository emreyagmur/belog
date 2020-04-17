<?php
$user = objectToArray(get_active_user());
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <div class="media" style="color: #fff;">
          <img class="mr-3 img-circle" src="<?=base_url("assets")?>/assets/images/user1.png" width="40">
          <div class="media-body">
            <h5 class="mt-0" style="margin-bottom: 0px;"><?=$user["full_name"]?></h5>
              test
          </div>
        </div>
        <?php
        /*
        <a class="navbar-brand" href="#">BeLog | <?=$user["full_name"]?></a>
        
        
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        */
        ?>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?=base_url("home_page")?>">
                        <i class="fa fa-fw fa-home"></i> <?=_HOME?>
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fa fa-fw fa-info-circle"></i> <?=_ABOUT?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fa fa-fw fa-cogs"></i> <?=_SERVICES?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?=base_url("my_account")?>"><i class="fa fa-fw fa-user"></i> <?=_MY_ACCOUNT?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?=base_url("logout")?>"><i class="fa fa-fw fa-sign-out"></i> <?=_LOGOUT?></a>
                </li>
               
                
            </ul>
        </div>
    </div>
</nav>
