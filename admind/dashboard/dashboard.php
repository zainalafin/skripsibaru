<?php 
session_start();
if(!isset($_SESSION["Login"])){
  header("Location:../../login.php");
  exit;
} 
if (isset($_SESSION['role'])) {
  if($_SESSION['role']!= 'admin'){
     header("Location:../../login.php");
  exit;
}
}
require '../functions.php';
// tampilkan jumlah kolom admin dan karyawan
	  $admind = mysqli_query($conn,"SELECT * FROM user WHERE role = 'admin'");
	  $data = mysqli_num_rows($admind);

	  $karyawan = mysqli_query($conn,"SELECT * FROM user WHERE role = 'user'");
	  $panggil = mysqli_num_rows($karyawan);
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
      <a href="dashboard.php" ><i class="fas fa-desktop"></i><span>Dashboard</span></a>
      <a href="../data/karyawan.php"><i class="fas fa-dice-d6"></i> <span>Data Karyawan</span></a>
      <a href="../absensi/absensi.php"><i class="fas fa-box"></i> <span> Data Absensi</span></a>
      <a href="../absensi/cuti.php"><i class="fas fa-th"></i><span>Data Cuti</span></a>
      <a href="../absensi/izin.php"><i class="fas fa-receipt"></i><span>Data Izin</span></a>
      <a href="../laporan/laporan.php" ><i class="fas fa-file-alt"></i><span>Laporan</span></a>

      </div>
    </div>
    <!--mobile navigation bar end-->
    <!--sidebar start-->
    <div class="sidebar">
      <div class="profile_info">
        <img src="unnamed.png" class="profile_image" alt="">
      </div>
      <a href="dashboard.php" ><i class="fas fa-desktop"></i><span>Dashboard</span></a>
      <a href="../data/karyawan.php"><i class="fas fa-dice-d6"></i> <span>Data Karyawan</span></a>
      <a href="../absensi/absensi.php"><i class="fas fa-box"></i> <span> Data Absensi</span></a>
      <a href="../absensi/cuti.php"><i class="fas fa-th"></i><span>Data Cuti</span></a>
      <a href="../absensi/izin.php"><i class="fas fa-receipt"></i><span>Data Izin</span></a>
      <a href="../laporan/laporan.php" ><i class="fas fa-file-alt"></i><span>Laporan</span></a>

    </div>
    <!--sidebar end-->

    <div class="content">
      <div class="card">
        <p>SELAMAT DATANG ADMIN SILAHKAN PILIH MENU YANG ADA UNTUK MENGOPRASIKAN WEBSITE INI</p>
      </div>
      <br>
        <br>
        <br>
      <div class="card">
          <table border="1" cellpadding="10" cellspacing="0">
            <th>Admin Aktif : <?=$data;?> </th>
            <th>Karyawan Aktif : <?=$panggil;?> </th>
          </table>
        </div>
      </div>

    <script type="text/javascript">
    $(document).ready(function(){
      $('.nav_btn').click(function(){
        $('.mobile_nav_items').toggleClass('active');
      });
    });
    </script>

  </body>
</html>
