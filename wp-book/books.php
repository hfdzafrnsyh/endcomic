<?php
require_once('config.php');
session_start();

if($_SESSION['status'] != "login"){
    header('location:login.php');
}elseif($_SESSION['role'] == "users"){
    header('location:../index.php');
}

if(isset($_POST['insert-book'])){
  if(insertBook($_POST) > 0 ){
    echo "<script>alert('Buku berhasil ditambah!')
    window.location='http://localhost/endcomic/wp-book/books.php'
    </script>";
  }else{
    echo "<script>alert('Buku Gagal ditambah!')
 
    </script>";
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Books</title>

    <!-- Custom fonts for this template-->
    <link href="asset/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="asset/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-book"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Wp-Book</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="dashboard.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="users.php">
                    <i class="fas fa-fw fa-user"></i>
                    <span>User</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="roleUser.php">
                    <i class="fas fa-fw fa-level-up-alt"></i>
                    <span>Role</span></a>
            </li>
            <li class="nav-item   active">
                <a class="nav-link" href="books.php">
                    <i class="fas fa-fw fa-book"></i>
                    <span>Books</span></a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="category.php">
                    <i class="fas fa-fw fa-list"></i>
                    <span>Category</span></a>
            </li>
      
      
      
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">


                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['email']?></span>
                                <img class="img-profile rounded-circle"
                                    src="asset/image/user_image/<?php echo $_SESSION['avatar']?>">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                           
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Book</h1>
              
                <!-- Button trigger modal -->
            <button type="button" class="btn btn-success mt-3 mb-3" data-toggle="modal" data-target="#exampleModal">
             Tambah Book
            </button>

                              
          <table class="table table-striped table-dark">
                        <thead>
                            <tr>
                            <th scope="col">No</th>
                            <th scope="col">Title</th>
                            <th scope="col">Author</th>
                            <th scope="col">Date</th>
                            <th scope="col">Category</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        require_once('config.php');

                        $totalPage=6;
                        $page=isset($_GET['page']) ? (int) $_GET['page']:1;

                        $start=($page>1) ? ($page * $totalPage) - $totalPage:0;
                        $i=1;
                        $result=mysqli_query($connect,"SELECT books.* , category.name_category FROM books
                        INNER JOIN category ON books.id_category = category.id
                      ");

                                              
                          $total=mysqli_num_rows($result);
                          $pages=ceil($total/$totalPage);

                          $resultData=mysqli_query($connect,"SELECT books.* , category.name_category FROM books
                          INNER JOIN category ON books.id_category = category.id
                         LIMIT $start,$totalPage");

                     $no=$start+1;

                        while($book=mysqli_fetch_array($resultData)) {
                        
                        ?>
                            <tr>
                            <th scope="row"><?php echo $i++ ?></th>
                            <td><?php echo $book['title_book']?></td>
                            <td><?php echo $book['author_book']?></td>
                            <td><?php echo $book['date_book']?></td>
                            <td><?php echo $book['name_category']?></td>
                            <td>
                            <a href="updateBook.php?id=<?php echo $book['id']?>" class="btn btn-warning btn-circle"><i class="fas fa-edit"></i></a>
                            <a href="deleteBook.php?id=<?php echo $book['id']?>" onclick="return confirm('Anda yakin ingin menghapus?');"class="btn btn-danger btn-circle"><i class="fas fa-trash-alt"></i></a>
                            </td>
                            </tr>
                        </tbody>

                          <?php } ?>
                        </table>
          
          

          <nav aria-label="Page navigation example ">
          <ul class="pagination justify-content-center">
          <?php 
          for($j=1;$j<=$pages; $j++){
          ?>
       
            <li class="page-item ml-1 mr-1"><a class="page-link" href="books.php?page=<?php echo $j ?>"><?php echo $j; ?></a></li>
          
           <?php } ?>
          </ul>
        </nav>




                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Buku</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     
      <form method="POST">
        <div class="form-group">
          <label for="exampleInputEmail1">Title</label>
          <input type="text" class="form-control"  required name="title-book" >
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Author</label>
          <input type="text" class="form-control"  required name="author-book" >
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Date</label>
          <input type="date" class="form-control"  required name="date-book" >
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Category</label>
          <input type="number" class="form-control"  required name="category-book" >
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="insert-book">Save</button>
      </div>
     
      </form>

      </div>
      
    </div>
  </div>
</div>


    <!-- Bootstrap core JavaScript-->
    <script src="asset/vendor/jquery/jquery.min.js"></script>
    <script src="asset/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="asset/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="asset/js/sb-admin-2.min.js"></script>

</body>

</html>