<?php 


require_once('config.php');

if(isset($_POST['login'])){

    $email=$_POST['email'];
    $password=$_POST['password'];

    $result = mysqli_query($connect , "SELECT * FROM users WHERE email='$email'");

    if(mysqli_num_rows($result) === 1){

      $data = mysqli_fetch_assoc($result);

      if(password_verify($password , $data['password'])){
        session_start();
        $_SESSION['status']="login";
        if($data['id_role'] == 1){
          $_SESSION['email']=$email;
          $_SESSION['avatar']=$data['avatar'];
          $_SESSION['role']="admin";
      
          header('location:dashboard.php');
          exit;
        }else{
          $_SESSION['email']=$email;
          $_SESSION['avatar']=$data['avatar'];
          $_SESSION['role']="users";
          header('location:../index.php');
          exit;
        }
      }else{
        echo "<script>alert('Email atau Password Salah!')
        </script>";
      }
    }else{
      echo "<script>alert('User tidak terdaftar!')
      </script>";
    }

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books | Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="asset/css/style.css">
</head>
<body>
    
<nav class="navbar navbar-expand-lg navbar-light bg-primary">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="../index.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="login.php">Login</a>
      </li>
    
  </div>
</nav>    

<div class="wrapper">
  <div class="container">
  
    <div class="col-lg-12 text-center mt-5 mb-2">
    
          <form method="POST">
        <div class="form-group">
          <label for="exampleInputEmail1">Email</label>
          <input type="email" class="form-control" id="exampleInputEmail1" required name="email" aria-describedby="emailHelp">
          <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Password</label>
          <input type="password" class="form-control" id="exampleInputPassword1" required name="password">
        </div>
        <button type="submit" class="btn btn-primary" name="login">Login</button>
      </form>
    </div>
  
  </div>

</div>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
  
</body>
</html>