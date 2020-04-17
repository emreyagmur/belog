
<div class="card mb-4 mt-3 no-border">
    <div class="card-body share-post">
        <div class="form-group mb-0">
            <textarea class="form-control" id="description" rows="3" placeholder="Example textarea"></textarea>
        </div>
        
    </div>
    <div class="card-footer text-muted">
        <div class="float-left">
            <button type="button" class="btn btn-secondary btn-sm btn-post"><i class="fa fa-share"></i> <?=_SHARE?></button>
        </div>
        
        <div class="float-right">
            <button type="button" class="btn"><i class="fa fa-lg fa-camera"></i></button>
        </div>
    </div>
</div>


<div id="listPost">
    <a href="<?=base_url()?>posts/getPosts/1">next</a>
</div>

<script type="text/javascript">
    
    function getPost(page) {
        var pageUrl = "posts/getPosts/" + page;
        $.ajax({
            type: "POST",
            url: '<?=base_url()?>' + pageUrl,
            dataType: "html",
            cache: false,
            success: function(data) {
                $("#listPost").empty();
                $("#listPost").html(data);
                //$.each(data.posts, function( index, value ) {
                    //console.log( value.description );
                //});
            }
        });    
    }
    
    $(function(){
                
        $(".btn-post").on("click", function(e){
            
            var description = $("#description").val();
            
            $.ajax({
                type: "POST",
                url: "<?=base_url('posts')?>",
                data: {"description": description},
                dataType: "json",
                cache: false,
                beforeSend: function() {
                    $("#description").val("");    
                },
                success: function(data) {
                    //console.log(data);
                    getPost(1);
                }
            });
            
        });
        
        $('#listPost').jscroll({
            loadingHtml: '<div class="text-center"><i class="fa fa-spin fa-spinner"></i> <?=_LOADING?></div>',
            autoTrigger: true,
            callback: function(){
                
                
                $(".delete-post").on("click", function(e){
                    
                    e.preventDefault();
                    
                    var dataId = $(this).data("id");
                    $.ajax({
                        type: "POST",
                        url: "<?=base_url()?>posts/deletePost/" + dataId,
                        dataType: "json",
                        cache: false,
                        success: function(data) {
                            if(data.message.success) $("#postDiv"+dataId).fadeOut();
                        }
                    });

                });
                
                $(".like-post").on("click", function(e){
                    
                    e.preventDefault();
                    var dataId = $(this).data("id");
                    var likeBtn = $(this);
                    if(likeBtn.hasClass("text-secondary"))
                    {
                        $.ajax({
                            type: "POST",
                            url: "<?=base_url()?>posts/likePost/" + dataId,
                            dataType: "json",
                            cache: false,
                            success: function(data) {
                                if(data.message.success)
                                {
                                    likeBtn.removeClass("text-secondary");
                                    likeBtn.addClass("text-danger");
                                }
                            }
                        });    
                    }
                    else
                    {
                        $.ajax({
                            type: "POST",
                            url: "<?=base_url()?>posts/dislikePost/" + dataId,
                            dataType: "json",
                            cache: false,
                            success: function(data) {
                                if(data.message.success)
                                {
                                    likeBtn.removeClass("text-danger");
                                    likeBtn.addClass("text-secondary");
                                }
                            }
                        });
                    }
                    
                });
            }
        });
        
        
        
    });

</script>


      