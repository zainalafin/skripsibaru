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
      <a href="index.php"><i class="fas fa-desktop"></i><span>Dashboard</span></a>
      <a href="../ganti/index.php"><i class="fas fa-user-circle"></i><span>Profile</span></a>
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
      <a href="index.php"><i class="fas fa-desktop"></i><span>Dashboard</span></a>
      <a href="../ganti/index.php"><i class="fas fa-user-circle"></i><span>Profile</span></a>
      <a href="../lihat/index.php"><i class="fas fa-fingerprint"></i><span>Lihat Absensi</span></a>
      <a href="../cuti/index.php"><i class="fas fa-table"></i><span>Ajukan Cuti</span></a>
      <a href="../izin/index.php"><i class="fas fa-th"></i><span>Ajukan Izin</span></a>

    </div>
    <!--sidebar end-->

    <div class="content">
      <div class="card">
        <p>SELAMAT DATANG SILAHKAN ABSEN DIBAWAH INI.</p>
      </div>
      <div class="card">
        <table border="1" cellpadding="10" cellspacing="0">
          <th><a href="masuk.php">Absen Masuk</a></th>
          <th><a href="keluar.php">Absen Keluar</a></th>
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