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
        <div class="row">
            <!-- content -->
            <div class="col-md-12 my-4 right-content">

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
        
</body>
</html>
