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
<body style="padding-top: 0 !important;">
         
      
                <?php
                    $this->load->view("{$viewFolder}/{$subViewFolder}/content");
                ?>
                
        
    <?php
    $this->load->view("includes/footer"); 
    ?>
    
        
</body>
</html>
