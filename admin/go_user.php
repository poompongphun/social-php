<?php
    session_start();
    if($_GET['user'] != "" && isset($_SESSION['admin_id']))
    {
         $user_id = $_GET['user'];
         $_SESSION['user_id'] = $user_id;
         header("Location: ../index.php");
    }
    else
    {
        header("Location: ../login.php");
    }
   
    
?>