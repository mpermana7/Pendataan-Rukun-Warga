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
    <title>Warga - Rukun Warga 09</title>
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
                    <li class="nav-item"><a class="nav-link link-dark" href="beranda.php"><i class="fas fa-tachometer-alt text-dark"></i><span>Dashboard</span></a></li>
                    <li class="nav-item"><a class="nav-link link-dark" href="kartu_keluarga.php"><i class="far fa-id-card text-dark"></i><span>Kartu Keluarga</span></a></li>
                    <li class="nav-item"><a class="nav-link active link-dark" href="data_warga.php"><i class="far fa-address-card text-dark"></i><span>Data Warga</span></a></li>
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
                    <h3 class="text-dark mb-4">Warga</h3>
                                    <?php
                                    if(isset($_SESSION['ktp_error'])) {
                                        echo $_SESSION['ktp_error'];
                                        unset($_SESSION['ktp_error']);
                                    }
                                    ?>
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <div class="row">
                                <div class="col">
                                    <p class="text-dark m-0 fw-bold" style="color: rgb(252,242,221);">Data Warga</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                                <div class="row">
                                    <div class="col"><button class="btn btn-primary link-dark" type="button" style="background: rgb(252,242,221);border-color: rgb(252,242,221);" data-bs-toggle="modal" data-bs-target="#modalTambah"><i class="fas fa-plus"></i>&nbsp;Tambah Data Warga</button>
                                        <div class="modal fade" role="dialog" tabindex="-1" id="modalTambah">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title text-dark">Tambah Warga</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form method="post" action="action.php">
                                                    <div class="modal-body">
                                                            <label class="form-label text-dark">No Kartu Tanda Penduduk :</label>
                                                            <input class="form-control" type="text" placeholder="No Kartu Tanda Penduduk" name="no_kartu_tanda_penduduk" required="" minlength="0" maxlength="16" pattern="^\d{16}$">
                                                            <label class="form-label text-dark mt-3">Nama Lengkap :</label>
                                                            <input class="form-control" type="text" placeholder="Nama Lengkap" name="nama_lengkap" required="">
                                                            <label class="form-label text-dark mt-3">Tempat, Tanggal Lahir :</label>
                                                            <input class="form-control" type="text" placeholder="Ex : Bandung, 13 Mei 2000" name="ttl" required="">
                                                            <label class="form-label text-dark mt-3">Alamat :</label>
                                                            <textarea class="form-control" name="alamat" placeholder="Alamat" required></textarea>
                                                            <label class="form-label text-dark mt-3">RT :</label>
                                                            <select class="form-select" name="rt" required>
                                                                <option value="">-- Pilih RT --</option>
                                                                <?php
                                                                include "koneksi.php";
                                                                $query_rt2 = mysqli_query($koneksi, "SELECT * FROM rt");
                                                                while($result_rt = mysqli_fetch_assoc($query_rt2)){
                                                                    $rt2 = $result_rt['no_rt'];
                                                                ?>
                                                                <option value="<?php echo $rt2 ?>"><?php echo $rt2 ?></option>
                                                                <?php
                                                                }
                                                                ?>
                                                            </select>
                                                            <label class="form-label text-dark mt-3">Desa / Kelurahan :</label>
                                                            <input class="form-control" type="text" placeholder="Desa / Kelurahan" name="desa_kelurahan" required="">
                                                            <label class="form-label text-dark mt-3">Kecamatan :</label>
                                                            <input class="form-control" type="text" placeholder="Kecamatan" name="kecamatan" required="">
                                                            <label class="form-label text-dark mt-3">Kabupaten / Kota :</label>
                                                            <input class="form-control" type="text" placeholder="Kabupaten / Kota" name="kabupaten_kota" required="">
                                                            <label class="form-label text-dark mt-3">Provinsi :</label>
                                                            <input class="form-control" type="text" placeholder="Provinsi" name="provinsi" required="">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-light" type="reset"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="1em" height="1em" fill="currentColor">
                                                                <!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                                                                <path d="M480 256c0 123.4-100.5 223.9-223.9 223.9c-48.84 0-95.17-15.58-134.2-44.86c-14.12-10.59-16.97-30.66-6.375-44.81c10.59-14.12 30.62-16.94 44.81-6.375c27.84 20.91 61 31.94 95.88 31.94C344.3 415.8 416 344.1 416 256s-71.69-159.8-159.8-159.8c-37.46 0-73.09 13.49-101.3 36.64l45.12 45.14c17.01 17.02 4.955 46.1-19.1 46.1H35.17C24.58 224.1 16 215.5 16 204.9V59.04c0-24.04 29.07-36.08 46.07-19.07l47.6 47.63C149.9 52.71 201.5 32.11 256.1 32.11C379.5 32.11 480 132.6 480 256z"></path>
                                                            </svg>&nbsp;Reset</button>
                                                            <button class="btn btn-success link-light" name="tambah_ktp" type="submit"><i class="fas fa-save"></i>&nbsp;Save</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xl-3 offset-xl-4">
                                        <form method="post">
                                        <div class="text-md-end dataTables_filter" id="dataTable_filter"><label class="form-label"><input class="form-control form-control form-control-sm" type="search" aria-controls="dataTable" placeholder="Search" name="cari"></label></div>
                                    </div>
                                    <div class="col-xl-1 offset-xl-0"><button class="btn btn-primary btn-sm link-dark" type="submit" name="pencarian" style="background: rgb(252,242,221);border-color: rgb(252,242,221);"><i class="fas fa-search"></i></button>
                                                            </form>
                                </div>
                                </div>
                            <div class="table-responsive table mt-2 text-center" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <table class="table my-0" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>No Kartu Tanda Penduduk</th>
                                            <th>Nama Lengkap</th>
                                            <th>Tempat, Tanggal Lahir</th>
                                            <th>Alamat</th>
                                            <th>RT</th>
                                            <th>Desa / Kelurahan</th>
                                            <th>Kecamatan</th>
                                            <th>Kabupaten / Kota</th>
                                            <th>Provinsi</th>
                                            <th>#</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include "koneksi.php";
                                        if(isset($_POST['pencarian'])){
                                            $cari = $_POST['cari'];
                                            $query_ktp = mysqli_query($koneksi, "select * from warga WHERE no_kartu_tanda_penduduk LIKE '%$cari%' OR
                                                                                                            nama_lengkap LIKE '%$cari%' OR
                                                                                                            ttl LIKE '%$cari%' OR
                                                                                                            alamat LIKE '%$cari%' OR
                                                                                                            rt LIKE '%$cari%' OR
                                                                                                            desa_kelurahan LIKE '%$cari%' OR
                                                                                                            kecamatan LIKE '%$cari%' OR
                                                                                                            kabupaten_kota LIKE '%$cari%' OR
                                                                                                            provinsi LIKE '%$cari%'");
                                        }else{
                                            $query_ktp = mysqli_query($koneksi, "select * from warga");
                                        }
                                        while($result_ktp = mysqli_fetch_assoc($query_ktp)){
                                            $no_kartu_tanda_penduduk = $result_ktp['no_kartu_tanda_penduduk'];
                                            $nama_lengkap = $result_ktp['nama_lengkap'];
                                            $ttl = $result_ktp['ttl'];
                                            $alamat = $result_ktp['alamat'];
                                            $rt = $result_ktp['rt'];
                                            $desa_kelurahan = $result_ktp['desa_kelurahan'];
                                            $kecamatan = $result_ktp['kecamatan'];
                                            $kabupaten_kota = $result_ktp['kabupaten_kota'];
                                            $provinsi  = $result_ktp['provinsi'];
                                        ?>
                                        <tr>
                                            <td><?php echo $no_kartu_tanda_penduduk ?></td>
                                            <td><?php echo $nama_lengkap ?></td>
                                            <td><?php echo $ttl ?></td>
                                            <td><?php echo $alamat ?></td>
                                            <td><?php echo $rt ?></td>
                                            <td><?php echo $desa_kelurahan ?></td>
                                            <td><?php echo $kecamatan ?></td>
                                            <td><?php echo $kabupaten_kota ?><br></td>
                                            <td><?php echo $provinsi ?></td>
                                            <td>
                                                <p><button class="btn btn-warning btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#modalEdit<?php echo $no_kartu_tanda_penduduk ?>"><i class="far fa-edit"></i></button>&nbsp;&nbsp;<button class="btn btn-danger btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#modalHapus<?php echo $no_kartu_tanda_penduduk ?>"><i class="fas fa-trash-alt"></i></button></p>
                                                <div class="modal fade text-start" role="dialog" tabindex="-1" id="modalEdit<?php echo $no_kartu_tanda_penduduk ?>">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title text-dark">Edit Warga</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form method="post" action="action.php">
                                                            <div class="modal-body">
                                                                    <label class="form-label text-dark">No Kartu Tanda Penduduk :</label>
                                                                    <input class="form-control" type="text" placeholder="No Kartu Tanda Penduduk" required="" minlength="0" name="no_kartu_tanda_penduduk" maxlength="16" value="<?php echo $no_kartu_tanda_penduduk ?>" pattern="^\d{16}$">
                                                                    <label class="form-label text-dark mt-3">Nama Lengkap :</label>
                                                                    <input class="form-control" type="text" placeholder="Nama Lengkap" name="nama_lengkap" value="<?php echo $nama_lengkap ?>" required="">
                                                                    <label class="form-label text-dark mt-3">Tempat, Tanggal Lahir :</label>
                                                                    <input class="form-control" type="text" placeholder="Ex : Bandung, 13 Mei 2000" name="ttl" value="<?php echo $ttl ?>" required="">
                                                                    <label class="form-label text-dark mt-3">Alamat :</label>
                                                                    <textarea class="form-control" name="alamat" placeholder="Alamat" required><?php echo $alamat ?></textarea>
                                                                    <label class="form-label text-dark mt-3">RT :</label>
                                                                    <select name="rt" class="form-select" required>
                                                                        <option value="">-- Pilih RT --</option>
                                                                        <?php
                                                                                include "koneksi.php";
                                                                                $query_rt = mysqli_query($koneksi,"SELECT * FROM rt");
                                                                                while($result_get_rt = mysqli_fetch_assoc($query_rt)) {
                                                                                    $no_rt = $result_get_rt['no_rt'];

                                                                                    if($rt == $no_rt){
                                                                                        $kondisi_rt = "selected";
                                                                                    }else{
                                                                                        $kondisi_rt =  "";
                                                                                    }
                                                                                ?>
                                                                                <option value="<?php echo $no_rt ?>" <?php echo $kondisi_rt ?>><?php echo $no_rt ?></option>
                                                                                <?php
                                                                                }
                                                                                ?>
                                                                    </select>
                                                                    <label class="form-label text-dark mt-3">Desa / Kelurahan :</label>
                                                                    <input class="form-control" type="text" placeholder="Desa / Kelurahan" name="desa_kelurahan" value="<?php echo $desa_kelurahan ?>" required="">
                                                                    <label class="form-label text-dark mt-3">Kecamatan :</label>
                                                                    <input class="form-control" type="text" placeholder="Kecamatan" name="kecamatan" value="<?php echo $kecamatan ?>" required="">
                                                                    <label class="form-label text-dark mt-3">Kabupaten / Kota :</label>
                                                                    <input class="form-control" type="text" placeholder="Kabupaten / Kota" name="kabupaten_kota" value="<?php echo $kabupaten_kota ?>" required="">
                                                                    <label class="form-label text-dark mt-3">Provinsi :</label>
                                                                    <input class="form-control" type="text" placeholder="Provinsi" name="provinsi" value="<?php echo $provinsi ?>" required="">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button class="btn btn-light" type="reset"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="1em" height="1em" fill="currentColor">
                                                                        <!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                                                                        <path d="M480 256c0 123.4-100.5 223.9-223.9 223.9c-48.84 0-95.17-15.58-134.2-44.86c-14.12-10.59-16.97-30.66-6.375-44.81c10.59-14.12 30.62-16.94 44.81-6.375c27.84 20.91 61 31.94 95.88 31.94C344.3 415.8 416 344.1 416 256s-71.69-159.8-159.8-159.8c-37.46 0-73.09 13.49-101.3 36.64l45.12 45.14c17.01 17.02 4.955 46.1-19.1 46.1H35.17C24.58 224.1 16 215.5 16 204.9V59.04c0-24.04 29.07-36.08 46.07-19.07l47.6 47.63C149.9 52.71 201.5 32.11 256.1 32.11C379.5 32.11 480 132.6 480 256z"></path>
                                                                    </svg>&nbsp;Reset</button>
                                                                    <button class="btn btn-warning link-dark" name="update_ktp" type="submit"><i class="fas fa-save"></i>&nbsp;Update</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal fade" role="dialog" tabindex="-1" id="modalHapus<?php echo $no_kartu_tanda_penduduk ?>">
                                                    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Konfirmasi Hapus</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <h1 class="display-1 text-dark"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="1em" height="1em" fill="currentColor">
                                                                        <!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                                                                        <path d="M506.3 417l-213.3-364c-16.33-28-57.54-28-73.98 0l-213.2 364C-10.59 444.9 9.849 480 42.74 480h426.6C502.1 480 522.6 445 506.3 417zM232 168c0-13.25 10.75-24 24-24S280 154.8 280 168v128c0 13.25-10.75 24-23.1 24S232 309.3 232 296V168zM256 416c-17.36 0-31.44-14.08-31.44-31.44c0-17.36 14.07-31.44 31.44-31.44s31.44 14.08 31.44 31.44C287.4 401.9 273.4 416 256 416z"></path>
                                                                    </svg></h1>
                                                                <h5 class="mt-3">Apakah anda yakin ingin menghapus ?</h5>
                                                            </div>
                                                            <div class="modal-footer"><button class="btn btn-light" type="button" data-bs-dismiss="modal">Close</button>
                                                                <form method="post" action="action.php">
                                                                    <input type="text" name="id" value="<?php echo $no_kartu_tanda_penduduk ?>" hidden>
                                                                    <button class="btn btn-danger" name="hapus_ktp" type="submit">Yes, Delete</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td><strong>No Kartu Tanda Penduduk</strong></td>
                                            <td><strong>Nama Lengkap</strong></td>
                                            <td><strong>Tempat, Tanggal Lahir</strong></td>
                                            <td><strong>Alamat</strong></td>
                                            <td><strong>RT</strong></td>
                                            <td><strong>Desa / Kelurahan</strong></td>
                                            <td><strong>Kecamatan</strong></td>
                                            <td><strong>Kabupaten / Kota</strong></td>
                                            <td><strong>Provinsi</strong></td>
                                            <td><strong>#</strong></td>
                                        </tr>
                                    </tfoot>
                                </table>
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