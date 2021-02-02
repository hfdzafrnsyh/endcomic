<?php 

require_once('config.php');
session_start();

if($_SESSION['status'] == "login" && $_SESSION['role'] == "admin"){

       $data=mysqli_query($connect,"SELECT * FROM books WHERE id='$_GET[id]'");
        $book=$data->fetch_assoc();

        mysqli_query($connect,"DELETE FROM books WHERE id='$_GET[id]'");
        echo "<script>alert('Data berhasil dihapus!')</script>";
        echo "<script>window.location='http://localhost/endcomic/wp-book/books.php'</script>";

}else{
    header('location:../index.php');
}


?>