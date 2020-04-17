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
        $this->load->view("{$viewFolder}/{$subViewFolder}/content");
    ?>
        
</body>
</html>
