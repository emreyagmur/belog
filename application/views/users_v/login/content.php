<div class="register-page">
    <div class="register-items">
            <div class="form-group">
                <label><?=_USER_NAME?></label>
                <input type="text" name="username" id="email" class="form-control">
            </div>

            <div class="form-group">
                <label><?=_PASSWORD?></label>
                <input type="password" name="password" id="password" class="form-control">
            </div>

            <div class="form-group">
                <button type="button" class="btn btn-success btn-block btn-login"><i class="fa fa-fw fa-sign-in"></i> <?=_LOGIN?></button>
            </div>
        
        <div class="form-group">
            <a class="btn btn-primary btn-block" href="<?=base_url("register")?>"><i class="fa fa-fw fa-user-plus"></i> <?=_REGISTER?></a>
        </div>
        
        <div class="alert alert-danger hidden alert-message">
        </div>
    
    </div>
</div>

<script type="text/javascript">
    
    $(function(){
        
        $(".btn-login").on("click", function(e){
            
            e.preventDefault();
            
            var userid = $("#email").val();
            var password = $("#password").val();
            
            if(userid === "" || password === "")
            {
                $(".alert-message").html("bilgiler bos olamaz");   
                $(".alert-message").removeClass("hidden");   
                setTimeout(function(){
                    $(".alert-message").addClass("hidden");
                }, 3000);
            }
            else
            {
                $.ajax({
                    type: "POST",
                    url: "<?=base_url("userop/do_login")?>",
                    data: {"userid": userid, "pass": password},
                    dataType: "json",
                    cache: false,
                    beforeSend: function() {
                        $(".btn-login").removeClass("btn-primary");
                        $(".btn-login").addClass("btn-warning");
                        $(".btn-login").html('<i class="fas fa-spin fa-circle-notch"></i> <?=_WAITING?>');
                    },
                    success: function(data) {
                        
                        if(data.message.error)
                        {
                            $(".btn-login").removeClass("btn-warning");
                            $(".btn-login").addClass("btn-primary");
                            $(".btn-login").html('Sign In');

                            $(".alert-message").html(data.message.error);   
                            $(".alert-message").removeClass("hidden");   
                            setTimeout(function(){
                                $(".alert-message").addClass("hidden");
                            }, 3000);
                        }
                        else
                        {
                            $(".btn-login").removeClass("btn-warning");
                            $(".btn-login").addClass("btn-success");
                            $(".btn-login").html('<i class="fas fa-spin fa-circle-notch"></i> <?=_LOGIN_SUCCESS?>');
                            
                            setTimeout(function(){
                                window.location.href = "<?=base_url()?>";
                            }, 3000);
                        }
                    }
                });
            }
        });
        
    });

</script>