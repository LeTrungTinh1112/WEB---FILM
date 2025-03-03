<?php 
    session_start();
    if(isset($_SESSION['TenDN'])){
        unset($_SESSION['TenDN']);
    }
    header('location:../index.php');
?>