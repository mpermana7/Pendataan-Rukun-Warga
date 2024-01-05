<?php
session_start();
include "koneksi.php";

// Login
if(isset($_POST['masuk'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $remember = $_POST['remember'];
    $query = mysqli_query($koneksi, "select * from akun where username='$username' and password='$password'");
    $result = mysqli_num_rows($query);
    $result2 = mysqli_fetch_assoc($query);
    $username = $result2['username'];
    $foto = $result2['foto'];

    if($result == 1) {
        $_SESSION['username'] = $username;
        header("location: beranda.php");
    } else {
        $query_username = mysqli_query($koneksi, "select * from akun where username='$username'");
        $query_password = mysqli_query($koneksi, "select * from akun where password='$password'");
        $result_username = mysqli_num_rows($query_username);
        $result_password = mysqli_num_rows($query_password);

        if($result_password == 0 && $result_username == 1) {
            $_SESSION['login_error'] = "<div class='alert alert-warning rounded-pill alert-dismissible fade show' role='alert'>
            <strong>Password Anda Salah!</strong>, Silahkan coba lagi dengan benar.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
            header("location: index.php");
        } elseif($result_username == 0 && $result_password == 1) {
            $_SESSION['login_error'] = "<div class='alert alert-warning rounded-pill alert-dismissible fade show' role='alert'>
            <strong>username Anda Salah!</strong>, Silahkan coba lagi dengan benar.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
            header("location: index.php");
        } else {
            $_SESSION['login_error'] = "<div class='alert alert-danger rounded-pill alert-dismissible fade show' role='alert'>
            <strong>username dan Password Anda Salah!</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
            header("location: index.php");
        }
    }
}

//Tambah Kartu Keluarga
if(isset($_POST['tambah_kk'])){
    $no_kartu_keluarga = $_POST['no_kartu_keluarga'];
    $nama_kepala_keluarga = $_POST['nama_kepala_keluarga'];
    $alamat = $_POST['alamat'];
    $rt = $_POST['rt'];
    $desa_kelurahan = $_POST['desa_kelurahan'];
    $kecamatan = $_POST['kecamatan'];
    $kabupaten_kota = $_POST['kabupaten_kota'];
    $provinsi = $_POST['provinsi'];

    $query_kk = mysqli_query($koneksi, "select * from kartu_keluarga where no_kartu_keluarga='$no_kartu_keluarga'");
    $result_kk = mysqli_fetch_assoc($query_kk);
    $no_kartu_keluarga2 = $result_kk['no_kartu_keluarga'];

    if($no_kartu_keluarga == $no_kartu_keluarga2){
        $_SESSION['kk_error'] = "<div class='alert alert-warning rounded-pill alert-dismissible fade show' role='alert'>
        <strong>Data Kartu Keluarga Sudah Ada!</strong>
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
      header("location: kartu_keluarga.php"); 
    }else{
        mysqli_query($koneksi, "insert into kartu_keluarga(no_kartu_keluarga, nama_kepala_keluarga, alamat, rt, desa_kelurahan, kecamatan, kabupaten_kota, provinsi) VALUES('$no_kartu_keluarga','$nama_kepala_keluarga','$alamat','$rt','$desa_kelurahan','$kecamatan', '$kabupaten_kota', '$provinsi')");
        $_SESSION['kk_error'] = "<div class='alert alert-success rounded-pill alert-dismissible fade show' role='alert'>
        <strong>Data Kartu Keluarga Berhasil ditambahkan!</strong>
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
      header("location: kartu_keluarga.php");
    }
}

//Update Kartu Keluarga
if(isset($_POST['update_kk'])){
    $no_kartu_keluarga = $_POST['no_kartu_keluarga'];
    $nama_kepala_keluarga = $_POST['nama_kepala_keluarga'];
    $alamat = $_POST['alamat'];
    $rt = $_POST['rt'];
    $desa_kelurahan = $_POST['desa_kelurahan'];
    $kecamatan = $_POST['kecamatan'];
    $kabupaten_kota = $_POST['kabupaten_kota'];
    $provinsi = $_POST['provinsi'];

    $query_kk = mysqli_query($koneksi, "select * from kartu_keluarga where no_kartu_keluarga='$no_kartu_keluarga'");
    $result_kk = mysqli_fetch_assoc($query_kk);
    $no_kartu_keluarga2 = $result_kk['no_kartu_keluarga'];

    if($no_kartu_keluarga == $no_kartu_keluarga2){
        mysqli_query($koneksi, "UPDATE kartu_keluarga set nama_kepala_keluarga='$nama_kepala_keluarga', alamat='$alamat', rt='$rt', desa_kelurahan='$desa_kelurahan', kecamatan='$kecamatan', kabupaten_kota='$kabupaten_kota', provinsi='$provinsi' WHERE no_kartu_keluarga='$no_kartu_keluarga'");
        $_SESSION['kk_error'] = "<div class='alert alert-success rounded-pill alert-dismissible fade show' role='alert'>
        <strong>Data Kartu Keluarga Berhasil diperbaharui!</strong>
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
      header("location: kartu_keluarga.php");
    }else{
        mysqli_query($koneksi, "UPDATE kartu_keluarga set no_kartu_keluarga='$no_kartu_keluarga', nama_kepala_keluarga='$nama_kepala_keluarga', alamat='$alamat', rt='$rt', desa_kelurahan='$desa_kelurahan', kecamatan='$kecamatan', kabupaten_kota='$kabupaten_kota', provinsi='$provinsi' WHERE no_kartu_keluarga='$no_kartu_keluarga'");
        $_SESSION['kk_error'] = "<div class='alert alert-success rounded-pill alert-dismissible fade show' role='alert'>
        <strong>Data Kartu Keluarga Berhasil diperbaharui!</strong>
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
      header("location: kartu_keluarga.php");
    }
}

// Hapus Kartu Keluarga
if(isset($_POST['hapus_kk'])){
$id = $_POST['id'];
mysqli_query($koneksi, "delete from kartu_keluarga WHERE no_kartu_keluarga='$id'");
$_SESSION['kk_error'] = "<div class='alert alert-danger rounded-pill alert-dismissible fade show' role='alert'>
<strong>Data Kartu Keluarga Berhasil dihapus!</strong>
<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
header("location: kartu_keluarga.php");
}

// Tambah Kartu Tanda Penduduk
if(isset($_POST['tambah_ktp'])){
    $no_kartu_tanda_penduduk = $_POST['no_kartu_tanda_penduduk'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $ttl = $_POST['ttl'];
    $alamat = $_POST['alamat'];
    $rt = $_POST['rt'];
    $desa_kelurahan = $_POST['desa_kelurahan'];
    $kecamatan = $_POST['kecamatan'];
    $kabupaten_kota = $_POST['kabupaten_kota'];
    $provinsi = $_POST['provinsi'];

    $query_ktp = mysqli_query($koneksi, "select * from warga where no_kartu_tanda_penduduk='$no_kartu_tanda_penduduk'");
    $result_ktp = mysqli_fetch_assoc($query_ktp);
    $no_kartu_tanda_penduduk2 = $result_ktp['no_kartu_tanda_penduduk'];

    if($no_kartu_tanda_penduduk == $no_kartu_tanda_penduduk2){
        $_SESSION['ktp_error'] = "<div class='alert alert-warning rounded-pill alert-dismissible fade show' role='alert'>
        <strong>Data No Kartu Tanda Penduduk Sudah Ada!</strong>
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
      header("location: data_warga.php"); 
    }else{
        mysqli_query($koneksi, "INSERT INTO warga(no_kartu_tanda_penduduk, nama_lengkap, ttl, alamat, rt, desa_kelurahan, kecamatan, kabupaten_kota, provinsi)VALUES('$no_kartu_tanda_penduduk','$nama_lengkap','$ttl','$alamat', '$rt','$desa_kelurahan','$kecamatan','$kabupaten_kota','$provinsi')");
        $_SESSION['ktp_error'] = "<div class='alert alert-success rounded-pill alert-dismissible fade show' role='alert'>
        <strong>Data Warga Berhasil ditambahkan!</strong>
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
      header("location: data_warga.php");
    }
}

// Edit Kartu Tanda Penduduk
if(isset($_POST['update_ktp'])){
    $no_kartu_tanda_penduduk = $_POST['no_kartu_tanda_penduduk'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $ttl = $_POST['ttl'];
    $alamat = $_POST['alamat'];
    $rt = $_POST['rt'];
    $desa_kelurahan = $_POST['desa_kelurahan'];
    $kecamatan = $_POST['kecamatan'];
    $kabupaten_kota = $_POST['kabupaten_kota'];
    $provinsi = $_POST['provinsi'];

    $query_ktp = mysqli_query($koneksi, "select * from warga where no_kartu_tanda_penduduk='$no_kartu_tanda_penduduk'");
    $result_ktp = mysqli_fetch_assoc($query_ktp);
    $no_kartu_tanda_penduduk2 = $result_ktp['no_kartu_tanda_penduduk'];

    if($no_kartu_tanda_penduduk == $no_kartu_tanda_penduduk2){
        mysqli_query($koneksi, "UPDATE warga set nama_lengkap='$nama_lengkap', ttl='$ttl', alamat='$alamat', rt='$rt', desa_kelurahan='$desa_kelurahan', kecamatan='$kecamatan', kabupaten_kota='$kabupaten_kota', provinsi='$provinsi' WHERE no_kartu_tanda_penduduk='$no_kartu_tanda_penduduk'");
        $_SESSION['ktp_error'] = "<div class='alert alert-success rounded-pill alert-dismissible fade show' role='alert'>
        <strong>Data Warga Berhasil diperbaharui!</strong>
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
      header("location: data_warga.php"); 
    }else{
        mysqli_query($koneksi, "UPDATE warga set no_kartu_tanda_penduduk='$no_kartu_tanda_penduduk', nama_lengkap='$nama_lengkap', ttl='$ttl', alamat='$alamat', rt='$rt', desa_kelurahan='$desa_kelurahan', kecamatan='$kecamatan', kabupaten_kota='$kabupaten_kota', provinsi='$provinsi' WHERE no_kartu_tanda_penduduk='$no_kartu_tanda_penduduk'");
        $_SESSION['ktp_error'] = "<div class='alert alert-success rounded-pill alert-dismissible fade show' role='alert'>
        <strong>Data Warga Berhasil diperbaharui!</strong>
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
      header("location: data_warga.php");
    }
}

// Hapus Kartu Tanda Penduduk
if(isset($_POST['hapus_ktp'])){
    $id = $_POST['id'];
    mysqli_query($koneksi, "delete from warga WHERE no_kartu_tanda_penduduk='$id'");
    $_SESSION['ktp_error'] = "<div class='alert alert-danger rounded-pill alert-dismissible fade show' role='alert'>
    <strong>Data Warga Berhasil dihapus!</strong>
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
    header("location: data_warga.php");
}

// Tambah Rukun Tetangga
if(isset($_POST['tambah_rt'])){
    $no_rt = $_POST['no_rt'];
    $nama_ketua_rt = $_POST['nama_ketua_rt'];

    $query_rt = mysqli_query($koneksi, "select * from rt where no_rt='$no_rt'");
    $result_rt = mysqli_fetch_assoc($query_rt);
    $no_rt2 = $result_rt['no_rt'];

    if($no_rt == $no_rt2){
        $_SESSION['rt_error'] = "<div class='alert alert-warning rounded-pill alert-dismissible fade show' role='alert'>
        <strong>Data Rukun Tetangga Sudah Ada!</strong>
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
      header("location: data_rt.php"); 
    }else{
        mysqli_query($koneksi, "INSERT INTO rt(no_rt, nama_ketua_rt)VALUES('$no_rt','$nama_ketua_rt')");
        $_SESSION['rt_error'] = "<div class='alert alert-success rounded-pill alert-dismissible fade show' role='alert'>
        <strong>Data Rukun Tetangga Berhasil ditambahkan!</strong>
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
      header("location: data_rt.php");
    }
}

// Edit Rukun Tetangga
if(isset($_POST['update_rt'])){
    $id_rt = $_POST['id_rt'];
    $no_rt = $_POST['no_rt'];
    $nama_ketua_rt = $_POST['nama_ketua_rt'];

    $query_rt = mysqli_query($koneksi, "select * from rt where no_rt='$no_rt'");
    $result_rt = mysqli_fetch_assoc($query_rt);
    $no_rt2 = $result_rt['no_rt'];

    if($no_rt == $no_rt2){
        mysqli_query($koneksi, "UPDATE rt SET nama_ketua_rt='$nama_ketua_rt' WHERE id_rt='$id_rt'");
        $_SESSION['rt_error'] = "<div class='alert alert-success rounded-pill alert-dismissible fade show' role='alert'>
        <strong>Data Rukun Tetangga Berhasil diperbaharui!</strong>
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
      header("location: data_rt.php");
    }else{
        mysqli_query($koneksi, "UPDATE rt SET no_rt='$no_rt', nama_ketua_rt='$nama_ketua_rt' WHERE id_rt='$id_rt'");
        $_SESSION['rt_error'] = "<div class='alert alert-success rounded-pill alert-dismissible fade show' role='alert'>
        <strong>Data Rukun Tetangga Berhasil diperbaharui!</strong>
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
      header("location: data_rt.php");
    }
}

// Hapus Rukun Tetangga
if(isset($_POST['hapus_rt'])){
    $id = $_POST['id'];
    mysqli_query($koneksi, "delete from rt WHERE id_rt='$id'");
    $_SESSION['rt_error'] = "<div class='alert alert-danger rounded-pill alert-dismissible fade show' role='alert'>
    <strong>Data Rukun Tetangga Berhasil dihapus!</strong>
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
    header("location: data_rt.php");
}
?>