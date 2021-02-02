<?php
require_once('config.php');

session_start();

if($_SESSION['status'] == "login" && $_SESSION['role'] == "admin"){
    echo "<script>alert('Disabled');
    window.location='http://localhost/endcomic/wp-book/category.php'
    </script>";
}else{
    header('location:login.php');
}


?>