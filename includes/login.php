<?php session_start();?>
<?php include "db.php"; ?>
<?php include "function.php"; ?>

<?php

    if(isset($_POST['login'])){
        
        login_user( $_POST['username'], $_POST['password']);
        
        
        
    }//if(isset($_POST['login']))
        
    
?>


