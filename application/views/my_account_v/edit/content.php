<?php
$user = objectToArray(get_active_user());
?>
<nav class="nav-justified ">
    <div class="nav nav-tabs " id="nav-tab" role="tablist">
        <a class="nav-item nav-link color-gr active" id="pop1-tab" data-toggle="tab" href="#pop1" role="tab" aria-controls="pop1" aria-selected="true"><i class="fa fa-user"></i> <span class="hide-text"><?=_EDIT_PROFILE?></span></a>
        <a class="nav-item nav-link color-gr" id="pop4-tab" data-toggle="tab" href="#pop4" role="tab" aria-controls="pop4" aria-selected="false"><i class="fa fa-edit"></i> <span class="hide-text"><?=_CHANGE_USER_NAME?></span></a>
        <a class="nav-item nav-link color-gr" id="pop2-tab" data-toggle="tab" href="#pop2" role="tab" aria-controls="pop2" aria-selected="false"><i class="fa fa-key"></i> <span class="hide-text"><?=_CHANGE_PASSWORD?></span></a>
        <a class="nav-item nav-link color-gr" id="pop3-tab" data-toggle="tab" href="#pop3" role="tab" aria-controls="pop3" aria-selected="false"><i class="fa fa-lock"></i> <span class="hide-text"><?=_PRAVICY_SECURITY?></span></a>        
    </div>
</nav>
<div class="tab-content" id="nav-tabContent">
            
    <div class="tab-pane fade show active" id="pop1" role="tabpanel" aria-labelledby="pop1-tab">
        
    </div>
    
    <div class="tab-pane fade" id="pop4" role="tabpanel" aria-labelledby="pop4-tab">
        <div class="pt-3"></div>
        
        </div>      
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

<script type="text/javascript">
    
    (function($){
        $(document).on("keyup", "#user_name",function(){
            
            var url = $(this).data("url"); 
            
            $.post( url, { username: $(this).val() } )
                .done(function( data ) {
                    $(".result").html(data);
            });
        });
    })(jQuery);
    
</script>
