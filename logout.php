<?php
    session_start();
    session_unset();
    session_destroy();

    $msg = '<script> alert ("You are Logout Succesfully!")</script>';
   
    header("Location: ".$_SERVER['HTTP_ORIGIN']."/index.php?call=$msg");
    
?>