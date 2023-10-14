<?php
include "auth.php";
$db=new auth();
$db->koneksi();
$db->notloggedin();
$db->notcrossuser();
if (isset($_POST["tambahadmin"])) {
    $data = array(
        'id'=>$_POST["nip"],
        'nama'=>$_POST["namaadmin"],
        'username'=>$_POST["namaadmin"],
        'password' =>password_hash($_POST["nip"], PASSWORD_DEFAULT),
        'status' =>'admin',
        'email'=>$_POST["email"],
        'no_hp'=>$_POST["nohp"]
        ); 
        $db->cekakun($_POST["namaadmin"],$_POST["email"],$_POST["nohp"],$data,'user');
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

    <title>Admin - Dashboard</title>

     <!-- Bootstrap -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <script src="https://kit.fontawesome.com/bf4a29feae.js" crossorigin="anonymous"></script>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/datetime/1.4.1/css/dataTables.dateTime.min.css" rel="stylesheet">


    

   

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

         <!-- Sidebar -->
        <ul class="navbar-nav bg-info sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="admin.php">
    <div class="sidebar-brand-icon ">
        <i class="fas fa-user"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Admin</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item">
    <a class="nav-link" href="admin.php">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
<a class="nav-link" href="tambahadmin.php">
        <i class="fas fa-fw fa-users"></i>
        <span> Tambah Admin</span>
    </a>
</li>
<li class="nav-item">
<a class="nav-link" href="tambahgejala.php">
        <i class="fas fa-fw fa-head-side-cough"></i>
        <span> Tambah Gejala</span>
    </a>
</li>
<li class="nav-item">
<a class="nav-link" href="tambahpengetahuan.php">
        <i class="fas fa-fw fa-info"></i>
        <span> Tambah Pengetahuan</span>
    </a>
</li>

<li class="nav-item">
<a class="nav-link" href="tambahpenyakit.php">
        <i class="fas fa-fw fa-syringe"></i>
        <span> Tambah Penyakit</span>
    </a>
</li>
<li class="nav-item active">
<a class="nav-link" href="rekammedis.php">
<i class="fas fa-fw fa-user"></i>
<span>Rekam Medis User</span>
</a>
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
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                    <div class="topbar-divider d-none d-sm-block"></div>
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-3 d-none d-lg-inline text-gray-600 small">
                                    <?php
                                     echo $_SESSION["nama"];
                                    ?>
                                </span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <form action="" method="post">
                                <button name="logout" class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </button>
                                </form>
                                <?php
                                if (isset($_POST["gantipass"])) {
                                    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=gantipassadmin.php">';
                                }
                                    if (isset($_POST["logout"])) {
                                        $user = new auth();
                                        $user->logout ();
                                    }
                                ?>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

            
                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Rekam Medis Pengguna</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="example" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Nama</th>
                                            <th>Nilai</th>
                                            <th>Penyakit</th>
                                            <th>Tanggal Diagnosa</th>
                                            <!-- <th>Aksi</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($db->select('catatanmedis') as $show ) { ?>
                                    <tr>
                                        <td><?php echo $show['id']?></td>
                                        <td><?php echo $show['nama']?></td>
                                        <td><?php echo $show['nilai']?></td>
                                        <td><?php echo $show['penyakit']?></td>
                                        <td><?php echo $show['tgl_diagnosa']?></td>
                                    </tr><?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
            </div>
            
                        <!-- Footer -->
                        <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                        <span>Copyright &copy;  Kelompok 3</span>
                        </div>
                    </div>
                 </footer>
            <!-- End of Footer -->
        </div>


    </div>
                <!-- Scroll to Top Button-->
                <a class="scroll-to-top rounded" href="#page-top">
                    <i class="fas fa-angle-up"></i>
                </a>



                <!-- Bootstrap core JavaScript-->
                <script src="vendor/jquery/jquery.min.js"></script>
                <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
                <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

                <!-- Core plugin JavaScript-->
                <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

                <!-- Custom scripts for all pages-->
                <script src="js/sb-admin-2.min.js"></script>

                <!-- Page level plugins -->
                <script src="vendor/chart.js/Chart.min.js"></script>

                <!-- Page level custom scripts -->
                <script src="js/demo/chart-area-demo.js"></script>
                <script src="js/demo/chart-pie-demo.js"></script>

                <!-- Data table -->
                <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
                <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
                <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
                <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
                <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
                <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
                <script src="https://cdn.datatables.net/datetime/1.4.1/js/dataTables.dateTime.min.js"></script>
                <script>
        $(document).ready(function() {
            $('#example').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                initComplete: function() {
                    var api = this.api();

                    // Create a date input field
                    var dateFilter = $('<input type="date" placeholder="Filter by date" aria-controls="example">')
                        .appendTo($('#example_filter').empty())
                        .on('change', function() {
                            var val = $(this).val();
                            api.column(4).search(val ? '^' + val + '$' : '', true, false).draw();
                        });

                    // Apply the datepicker plugin to the input field
                    dateFilter.datepicker();
                }
            });
        });
    </script>

                <!-- <script>
                    
                    $(document).ready(function () {
                     $('#example').DataTable({
                        dom: 'Bfrtip',
                         buttons: [
                            'copy', 'csv', 'excel', 'pdf', 'print'
                        ]
                        
                     });
                    });


                </script> -->
                
  

</body>

</html>