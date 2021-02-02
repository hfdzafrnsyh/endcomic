<?php 
require_once('config.php');
session_start();
session_destroy();
header('location:../index.php');
exit;


?>