<?php
session_start();
if(!isset($_SESSION['username'])){
    header("location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Dashboard - Rukun Warga 09</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
</head>

<body id="page-top">
    <div id="wrapper">
        <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0" style="background: #fcf2dd;">
            <div class="container-fluid d-flex flex-column p-0"><a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                    <div class="sidebar-brand-icon rotate-n-15"><img class="img-fluid" src="assets/img/_a38dcd53-a043-4c4f-9374-60b093f1fa30.jpg" width="80px"></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="navbar-nav" id="accordionSidebar">
                    <li class="nav-item"><a class="nav-link link-dark active" href="beranda.php"><i class="fas fa-tachometer-alt text-dark"></i><span>Dashboard</span></a></li>
                    <li class="nav-item"><a class="nav-link link-dark" href="kartu_keluarga.php"><i class="far fa-id-card text-dark"></i><span>Kartu Keluarga</span></a></li>
                    <li class="nav-item"><a class="nav-link link-dark" href="data_warga.php"><i class="far fa-address-card text-dark"></i><span>Data Warga</span></a></li>
                    <li class="nav-item"><a class="nav-link link-dark" href="data_rt.php"><i class="fas fa-user-tie text-dark"></i><span>Data RT</span></a></li>
                </ul>
                <div class="text-center text-dark d-none d-md-inline"><button class="btn btn-dark rounded-circle border-0" id="sidebarToggle" type="button" style="background: rgb(58,59,69);"></button></div>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                        <ul class="navbar-nav flex-nowrap ms-auto">
                            <li class="nav-item dropdown no-arrow">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><span class="d-none d-lg-inline me-2 text-gray-600 small"><?php echo $_SESSION['username']; ?></span><img class="border rounded-circle img-profile" src="assets/img/avatars/avatar1.jpeg"></a>
                                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in"><a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Logout</a></div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="container-fluid">
                    <div class="d-sm-flex justify-content-between align-items-center mb-4">
                        <h3 class="text-dark mb-0">Dashboard</h3>
                    </div>
                    <div class="row">
                        <div class="col-xl-3 offset-xl-4 text-center"><img class="img-fluid" src="assets/img/_a38dcd53-a043-4c4f-9374-60b093f1fa30.jpg">
                            <h4 class="text-dark mt-3 mb-5">Rukun Warga 09</h4>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-start-primary py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-primary fw-bold text-xs mb-1"><span>Kartu keluarga</span></div>
                                                    <?php
                                                    include "koneksi.php";
                                                    $query_kartu_keluarga = mysqli_query($koneksi, "select COUNT(*) as total_kk FROM kartu_keluarga");
                                                    $result_kartu_keluarga = mysqli_fetch_assoc($query_kartu_keluarga);
                                                    $total_kartu_keluarga = $result_kartu_keluarga['total_kk'];
                                                    ?>
                                            <div class="text-dark fw-bold h5 mb-0"><span><?php echo $total_kartu_keluarga ?></span></div>
                                        </div>
                                        <div class="col-auto"><i class="far fa-id-card fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-start-success py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-success fw-bold text-xs mb-1"><span>Data Warga</span></div>
                                                    <?php
                                                    include "koneksi.php";
                                                    $query_kartu_tanda_penduduk = mysqli_query($koneksi, "select COUNT(*) as total_ktp FROM warga");
                                                    $result_kartu_tanda_penduduk = mysqli_fetch_assoc($query_kartu_tanda_penduduk);
                                                    $total_kartu_tanda_penduduk = $result_kartu_tanda_penduduk['total_ktp'];
                                                    ?>
                                            <div class="text-dark fw-bold h5 mb-0"><span><?php echo $total_kartu_tanda_penduduk ?></span></div>
                                        </div>
                                        <div class="col-auto"><i class="far fa-address-card fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-start-warning py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-warning fw-bold text-xs mb-1"><span>Data RT</span></div>
                                                    <?php
                                                    include "koneksi.php";
                                                    $query_rt = mysqli_query($koneksi, "select COUNT(*) as total_rt FROM rt");
                                                    $result_rt = mysqli_fetch_assoc($query_rt);
                                                    $total_rt = $result_rt['total_rt'];
                                                    ?>
                                            <div class="text-dark fw-bold h5 mb-0"><span><?php echo $total_rt ?></span></div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-user-tie fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"><span>Copyright © Rukun Warga 09</span></div>
                </div>
            </footer>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>