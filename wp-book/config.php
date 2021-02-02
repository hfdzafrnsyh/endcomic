<?php 


$server="localhost";
$username="root";
$password="";
$db_name="db-books";


$connect = mysqli_connect($server,$username,$password,$db_name);


if(!$connect){
    echo "<script>alert('Db-Failed')</script>" . mysqli_connect_error();
}


function register($data){
    global $connect;

    $name=$data['name'];
    $email=$data['email'];
    $password=$data['password'];
    $avatar="default.png";
    $id_category=2;

    $result = mysqli_query($connect , "SELECT email FROM users WHERE email='$email'");

    if(mysqli_fetch_assoc($result)){
        echo "<script>
        alert('User telah terdaftar!');
        </script>";
        return false;
    }

    // enkripsi

    $password = password_hash($password , PASSWORD_DEFAULT);
    
    mysqli_query($connect , "INSERT INTO users VALUES ('' ,'$name' , '$email' ,'$avatar' , '$password' , '$id_category')");

    return mysqli_affected_rows($connect);

}


function insertBook($data){
    global $connect;

    $title = $data['title-book'];
    $author = $data['author-book'];
    $date = $data['date-book'];
    $category = $data['category-book'];

    $result = mysqli_query($connect , "SELECT title_book FROM books WHERE title_book='$title'");

    if(mysqli_fetch_assoc($result)){
        echo "<script>
        alert('Buku telah tersedia!');
        </script>";
        return false;
    }


    mysqli_query($connect , "INSERT INTO books VALUES ('' , '$title' , '$author' , '$date' , '$category')");

    return mysqli_affected_rows($connect);
}

function insertCategory($data){
    global $connect;

    $category = $data['name-category'];

    $result = mysqli_query($connect , "SELECT name_category FROM category WHERE name_category='$category'");

    if(mysqli_fetch_assoc($result)){
        echo "<script>
        alert('Category telah Ada!');
        </script>";
        return false;
    }


    mysqli_query($connect , "INSERT INTO category VALUES ('' , '$category')");

    return mysqli_affected_rows($connect);
}


?>