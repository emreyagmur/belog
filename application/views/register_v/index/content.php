<div class="col-md-12">
<div class="register-page">
    
    <div class="register-items">
        <div class="register-head">
            BeLog
        </div>
        <div class="register-body">
            <form action="<?=base_url("register/save")?>" method="post">

                <div class="form-group">
                    <label><?=_NAME_SURNAME?></label>
                    <input type="text" name="fullName" class="form-control">
                    <?php
                    if(isset($form_error))
                    {
                    ?>
                    <div style="padding-top: 5px; color: red;"><span><?=form_error("fullName");?></span></div>
                    <?php
                    }
                    ?>
                </div>

                <div class="form-group">
                    <label><?=_EMAIL?></label>
                    <input type="email" name="email" class="form-control">
                    <?php
                    if(isset($form_error))
                    {
                    ?>
                    <div style="padding-top: 5px; color: red;"><span><?=form_error("email");?></span></div>
                    <?php
                    }
                    ?>
                </div>

                <div class="form-group">
                    <label><?=_PASSWORD?></label>
                    <input type="password" name="password" class="form-control">
                    <?php
                    if(isset($form_error))
                    {
                    ?>
                    <div style="padding-top: 5px; color: red;"><span><?=form_error("password");?></span></div>
                    <?php
                    }
                    ?>
                </div>

                <div class="form-group">
                    <label><?=_CONFIRM_PASSWORD?></label>
                    <input type="password" name="confirm_password" class="form-control">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-block"><i class="fa fa-fw fa-user-plus"></i> <?=_REGISTER?></button>
                </div>

            </form>

            <div class="form-group">
                <a class="btn btn-primary btn-block" href="<?=base_url("login")?>"><i class="fa fa-fw fa-sign-in"></i> <?=_LOGIN?></a>
            </div>
        </div>
    </div>
        </div>
</div>
<script type="text/javascript">
    /*
    (function($){
        $(document).on("keyup", "#username",function(){
            
            var url = $(this).data("url"); 
            
            $.post( url, { username: $(this).val() } )
                .done(function( data ) {
                    $(".result").html(data);
            });
        });
    })(jQuery);
    */
</script>
