<?php 
require_once('wp-book/config.php');
session_start();
session_destroy();
header('location:index.php');
exit;


?>