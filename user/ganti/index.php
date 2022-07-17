<?php 
session_start();
if(!isset($_SESSION["Login"])){
  header("Location:../login.php");
  exit;
} 
if (isset($_SESSION['role'])) {
  if($_SESSION['role']!= 'user'){
     header("Location:../login.php");
  exit;
}
}
// koneksi ke database
require 'functions.php';

$username = $_SESSION['username'];

//query data menggunakan id
$ambil = query(" SELECT * FROM user WHERE username = '$username'")[0];

// //ambil data di url
// $id = $_GET["id"];
// //query data menggunakan id
// $data = query(" SELECT * FROM user WHERE id = $id")[0];

//cek tombol submit
if(isset($_POST["submit"])){
  //cek data berhasil atau tidak
  if (ubah($_POST) > 0) {
    echo "
        <script>
          alert('Data Berhasil Diubah!');
          document.location.href= 'index.php';
          </script>
      ";
  } else{"
        <script>
          alert('Data Gagal Diubah!');
          document.location.href= 'index.php';
          </script>
      ";
  }
}
 ?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi Karyawan</title>
    <link rel="stylesheet" href="style_index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
  </head>
  <body>

    <input type="checkbox" id="check">
    <!--header area start-->
    <header>
      <label for="check">
        <i class="fas fa-bars" id="sidebar_btn"></i>
      </label>
      <div class="left_area">
        <h3>Absensi <span>Karyawan</span></h3>
      </div>
      <div class="right_area">
        <a href="../logout.php" class="logout_btn">Logout</a>
      </div>
    </header>
    <!--header area end-->
    <!--mobile navigation bar start-->
    <div class="mobile_nav">
      <div class="nav_bar">
        <img src="unnamed.png" class="mobile_profile_image" alt="">
        <i class="fa fa-bars nav_btn"></i>
      </div>
      <div class="mobile_nav_items">
      <a href="../dashboard/index.php"><i class="fas fa-desktop"></i><span>Dashboard</span></a>
      <a href="index.php"><i class="fas fa-user-circle"></i><span>Profile</span></a>
      <a href="../lihat/index.php"><i class="fas fa-fingerprint"></i><span>Lihat Absensi</span></a>
      <a href="../cuti/index.php"><i class="fas fa-table"></i><span>Ajukan Cuti</span></a>
      <a href="../izin/index.php"><i class="fas fa-th"></i><span>Ajukan Izin</span></a>

      </div>
    </div>
    <!--mobile navigation bar end-->
    <!--sidebar start-->
    <div class="sidebar">
      <div class="profile_info">
        <img src="unnamed.png" class="profile_image" alt="">
      </div>
     <a href="../dashboard/index.php"><i class="fas fa-desktop"></i><span>Dashboard</span></a>
      <a href="index.php"><i class="fas fa-user-circle"></i><span>Profile</span></a>
      <a href="../lihat/index.php"><i class="fas fa-fingerprint"></i><span>Lihat Absensi</span></a>
      <a href="../cuti/index.php"><i class="fas fa-table"></i><span>Ajukan Cuti</span></a>
      <a href="../izin/index.php"><i class="fas fa-th"></i><span>Ajukan Izin</span></a>

    </div>
    <!--sidebar end-->

    <div class="content">
      <div class="card">
        <h2>EDIT PROFILE</h2>

        <form action="" method="post">
            <input type="hidden" name="id" value="<?= $ambil["id"]; ?>">
            <ul>
              <li>
                <label for="username">Username : </label>
                <input type="text" name="username" id="username"required value="<?= $ambil["username"] ?>" readonly>
              </li>
              <li>
                <label for="nama_krywn">Nama Karyawan :</label>
                <input type="text" name="nama_krywn" id="nama_krywn" required value="<?= $ambil["nama_krywn"] ?>" onkeypress="return hanyahuruf(event)">
              </li>
              <li>
                <label for="tmpt_lahir">Tempat Lahir :</label>
                <input type="text" name="tmpt_lahir" id="tmpt_lahir"required value="<?= $ambil["tmpt_lahir"] ?>" onkeypress="return hanyahuruf(event)">
              </li>
              <li>
                <label for="tgl_lhr">Tanggal Lahir :</label>
                <input type="date" name="tgl_lhr" id="tgl_lhr"required value="<?= $ambil["tgl_lhr"] ?>">
              </li>
              <li>
                <label for="alamat">Alamat :</label>
                <input type="text" name="alamat" id="alamat"required value="<?= $ambil["alamat"] ?>">
              </li>
              <li>
                <label for="no_hp">Nomor Handphone :</label>
                <input type="text" name="no_hp" id="no_hp"required value="<?= $ambil["no_hp"] ?>" onkeypress="return hanyaangka(event)">
              </li>
              <li>
                <label for="kd_jabatan">Jabatan :</label>
                <input type="text" name="kd_jabatan" id="kd_jabatan"required value="<?= $ambil["kd_jabatan"] ?>"  onkeypress="return hanyahuruf(event)">
              </li>
              <li>
                <label for="Gender">Gender:</label>
                <input type="text" name="Gender" id="Gender"required value="<?= $ambil["Gender"] ?>">
              </li>
              <li>
                <button type="submit" name="submit">Ubah Data!</button>
              </li>
            </ul>

          </form>

          <a href="changepw.php">Ganti Password</a>
        
      </div>

    </div>

    <script type="text/javascript">
    $(document).ready(function(){
      $('.nav_btn').click(function(){
        $('.mobile_nav_items').toggleClass('active');
      });
    });
    </script>

    <script type="text/javascript">
      function hanyaangka(evt){
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode<48 || charCode>57))
          return false;
        return true;
      }
      function hanyahuruf(evt){
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode<48 || charCode>57))
          return true;
        return false;
      }

    </script>

  </body>
</html>