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

//cek tombol submit
if(isset($_POST["submit"])){
	
	
	//cek data berhasil atau tidak
	if (tambah($_POST) > 0) {
		echo "
				<script>
					alert('Data Berhasil Ditambahkan!');
					// document.location.href= 'karyawan.php';
					</script>
			";
	} else{"
				<script>
					alert('Data Gagal Ditambahkan!');
					document.location.href= 'karyawan.php';
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
      <a href="../dashboard/dashboard.php" ><i class="fas fa-desktop"></i><span>Dashboard</span></a>
      <a href="karyawan.php"><i class="fas fa-dice-d6"></i> <span>Data Karyawan</span></a>
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
      <a href="karyawan.php"><i class="fas fa-dice-d6"></i> <span>Data Karyawan</span></a>
      <a href="../absensi/absensi.php"><i class="fas fa-box"></i> <span> Data Absensi</span></a>
      <a href="../absensi/cuti.php"><i class="fas fa-th"></i><span>Data Cuti</span></a>
      <a href="../absensi/izin.php"><i class="fas fa-receipt"></i><span>Data Izin</span></a>
      <a href="../laporan/laporan.php" ><i class="fas fa-file-alt"></i><span>Laporan</span></a>

    </div>
    <!--sidebar end-->
  <div class="content">
      <div class="card">
        <h1>Tambah Data Karyawan</h1>
      </div>
      <div class="card">
          <form action="" method="post">
            <ul>
              <li>
                <label for="username">Username :</label>
                <input type="text" name="username" id="username"required onkeypress="return hanyaangka(event)">
              </li>
              <li>
                <label for="nama_krywn">Nama Karyawan :</label>
                <input type="text" name="nama_krywn" id="nama_krywn" required onkeypress="return hanyahuruf(event)">
              </li>
              <li>
                <label for="tmpt_lahir">Tempat Lahir :</label>
                <input type="text" name="tmpt_lahir" id="tmpt_lahir"required onkeypress="return hanyahuruf(event)">
              </li>
              <li>
                <label for="tgl_lhr">Tanggal Lahir :</label>
                <input type="date" name="tgl_lhr" id="tgl_lhr"required>
              </li>
              <li>
                <label for="alamat">Alamat :</label>
                <input type="text" name="alamat" id="alamat"required>
              </li>
              <li>
                <label for="no_hp">Nomor Handphone :</label>
                <input type="text" name="no_hp" id="no_hp"required onkeypress="return hanyaangka(event)">
              </li>
              <li>
                <label for="kd_jabatan">Jabatan :</label>
                <input type="text" name="kd_jabatan" id="kd_jabatan"required required onkeypress="return hanyahuruf(event)">
              </li>
              <li>
                <label for="Gender">Gender:</label>
                <input type="text" name="Gender" id="Gender"required required onkeypress="return hanyahuruf(event)">
              </li>
              <li>
                <label for="password">Password :</label>
                <input type="text" name="password" id="password"required>
              </li>
              <li>
                <label for="role">Role :</label>
                <input type="text" name="role" id="role"required required onkeypress="return hanyahuruf(event)">
              </li>
              <li>
                <button type="submit" name="submit">Tambah</button>
              </li>
            </ul>

          </form>
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