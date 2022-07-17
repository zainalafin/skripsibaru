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

//pagination
$dataperhalaman = 5;
$jumlahdata= count(query("SELECT * FROM cuti"));
$jumlahhalaman =  ceil($jumlahdata / $dataperhalaman);
$halamanaktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$awaldata = ( $dataperhalaman * $halamanaktif ) - $dataperhalaman;

// ambil data dari tabel absensi atau query data
$query= "SELECT * FROM cuti LIMIT $awaldata, $dataperhalaman";
$result = mysqli_query($conn, $query);

// tombol cari di tekan
if (isset($_POST["cari_cuti"])) {
	$result = cari($_POST["keyword"]);

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
      <a href="../dashboard/dashboard.php" ><i class="fas fa-desktop"></i><span>Dashboard</span></a>
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
      <a href="../dashboard/dashboard.php" ><i class="fas fa-desktop"></i><span>Dashboard</span></a>
      <a href="../data/karyawan.php"><i class="fas fa-dice-d6"></i> <span>Data Karyawan</span></a>
      <a href="../absensi/absensi.php"><i class="fas fa-box"></i> <span> Data Absensi</span></a>
      <a href="../absensi/cuti.php"><i class="fas fa-th"></i><span>Data Cuti</span></a>
      <a href="../absensi/izin.php"><i class="fas fa-receipt"></i><span>Data Izin</span></a>
      <a href="../laporan/laporan.php" ><i class="fas fa-file-alt"></i><span>Laporan</span></a>

    </div>
    <!--sidebar end-->

              <div class="content">
      <div class="card">
        <h1>DATA CUTI</h1>
      </div>
      <!--<div class="card">
          <form action="" method="post">
            <input type="text" name=" keyword" size="40" autofocus placeholder="cari id.." autocomplete="off">
            <button type="submit" name="cari"> Cari!</button>
          </form>

        </div>-->
        <br>
        <?php if (mysqli_affected_rows($conn) > 0) {
          ?>

        
      
        <div class="card">  
          <table border="1" cellpadding="10" cellspacing="0">
  
          <tr>
            <th>No.</th>
            <th>No.Cuti</th>
            <th>Username</th>
            <th>Nama Karyawan</th>
            <th>Tanggal Mulai </th>
            <th>Tanggal Selesai</th>
            <th>Keterangan</th>


          </tr>
          <?php $i=1;?>
          <?php foreach($result as $row):
             ?> 
          <tr>
            <td><?= $i;?></td>

            <td><?= $row["id"];?></td>
            <td><?= $row["username"];?></td>
            <td><?= $row["nama_krywn"];?></td>
            <td><?= $row["mulai"];?></td>
            <td><?= $row["selesai"];?></td>
            <td><?= $row["ket"];?></td>
            </tr>
          <?php $i++;?>
          <?php endforeach?>

        </table>

        <!-- Navigasi pagination-->
        <?php if ( $halamanaktif>1): ?>
          <a href="?halaman=<?=$halamanaktif-1; ?>">&laquo;</a>
        <?php endif; ?>
        <?php for( $i = 1; $i <= $jumlahhalaman; $i++) : ?>
          <?php if( $i == $halamanaktif) : ?>
          <a href="?halaman=<?= $i;?>" style="font-weight: bold;color: blue;"><?= $i; ?></a>
          <?php else : ?>
            <a href="?halaman=<?= $i;?>" style="background-color: white"><?= $i; ?></a>
          <?php endif; ?>
        <?php endfor; ?>
        <?php if ( $halamanaktif< $jumlahhalaman): ?>
          <a href="?halaman=<?=$halamanaktif+1; ?>">&raquo;</a>
        <?php endif; ?>

      </div>  
      
      </div>
      <?php 
      //var_dump (mysqli_num_rows($result));


      } 
       
      else {
        echo "Data Tidak Ditemukan!!";
      } ?>

    <script type="text/javascript">
    $(document).ready(function(){
      $('.nav_btn').click(function(){
        $('.mobile_nav_items').toggleClass('active');
      });
    });
    </script>

  </body>
</html>