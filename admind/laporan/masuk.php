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
	// koneksi ke database
require '../functions.php';

// ambil data dari tabel absensi atau query data
//$result = mysqli_query($conn, "SELECT * FROM absensi");
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
      <a href="../dashboard/dashboard.php" ><i class="fas fa-desktop"></i><span>Dashboard</span></a>
      <a href="../data/karyawan.php"><i class="fas fa-dice-d6"></i> <span>Data Karyawan</span></a>
      <a href="../absensi/absensi.php"><i class="fas fa-box"></i> <span> Data Absensi</span></a>
      <a href="../absensi/cuti.php"><i class="fas fa-th"></i><span>Data Cuti</span></a>
      <a href="../absensi/izin.php"><i class="fas fa-receipt"></i><span>Data Izin</span></a>
      <a href="laporan.php" ><i class="fas fa-file-alt"></i><span>Laporan</span></a>


      </div>
    </div>
    <!--mobile navigation bar end-->
    <!--sidebar start-->
    <div class="sidebar">
      <div class="profile_info">
        <img src="unnamed.png" class="profile_image" alt="">
      </div>
      <a href="../dashboard/dashboard.php" ><i class="fas fa-desktop"></i><span>Dashboard</span></a>
      <a href="../data/karyawan.php"><i class="fas fa-dice-d6"></i> <span>Data Karyawan</span></a>
      <a href="../absensi/absensi.php"><i class="fas fa-box"></i> <span> Data Absensi</span></a>
      <a href="../absensi/cuti.php"><i class="fas fa-th"></i><span>Data Cuti</span></a>
      <a href="../absensi/izin.php"><i class="fas fa-receipt"></i><span>Data Izin</span></a>
      <a href="laporan.php" ><i class="fas fa-file-alt"></i><span>Laporan</span></a>


    </div>
    <!--sidebar end-->
            <div class="content">
      <div class="card">
        <h1>LAPORAN BULANAN</h1>
      </div>
      <form method="post">
          <table>
          <tr>
            <td>Dari Tanggal</td>
            <td><input type="date" name="dari_tgl" required="required"></td>
            <td>Sampai Tanggal</td>
            <td><input type="date" name="sampai_tgl" required="required"></td>
            <td><input type="submit"  name="filter" value="Filter"></td>
          </tr>
        </table>
        <a href=" sakit.php"style="background-color: white"> Absensi Sakit</a> || <a href=" masuk.php"style="background-color: white"> Absensi Masuk</a>
        </form>
      
        <div class="card">  
          <table border="1" cellpadding="10" cellspacing="0">
          <br>
          <?php 
          if (isset($_POST['filter'])) {
            $dari_tgl = mysqli_real_escape_string($conn, $_POST['dari_tgl']);
            $sampai_tgl = mysqli_real_escape_string($conn, $_POST['sampai_tgl']);
            echo "Data Absen Dari tanggal ".$dari_tgl." Sampai Tanggal ".$sampai_tgl;
           } ?>
  
          <tr>
            <th>No.</th>
            <th>No Absen</th>
            <th>Username</th>
            <th>Nama Karyawan</th>
            <th>Tanggal </th>
            <th>Jam Masuk</th>
            <th>Jam Keluar</th>
            <th>Suhu Badan</th>
            <th>Keterangan</th>


          </tr>
          <?php $i=1;
           
          if (isset($_POST['filter'])) {
            $dari_tgl = mysqli_real_escape_string($conn, $_POST['dari_tgl']);
            $sampai_tgl = mysqli_real_escape_string($conn, $_POST['sampai_tgl']);
            $result = mysqli_query($conn, "SELECT * FROM absensi WHERE tanggal BETWEEN '$dari_tgl' AND '$sampai_tgl'");

          }
          else{
            $result = mysqli_query($conn, "SELECT * FROM absensi WHERE ket ='masuk' ");
          }

          //$result = mysqli_query($conn, "SELECT * FROM absensi");


          while($row = mysqli_fetch_array($result)):?>  
          <tr>
            <td><?= $i;?></td>

            <td><?= $row["id"];?></td>
            <td><?= $row["username"];?></td>
            <td><?= $row["Nama"];?></td>
            <td><?= $row["tanggal"];?></td>
            <td><?= $row["masuk"];?></td>
            <td><?= $row["keluar"];?></td>
            <td><?= $row["suhu"];?></td>
            <td><?= $row["ket"];?></td>
            </tr>
          <?php $i++;?>
          <?php endwhile?>
        </table>
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
