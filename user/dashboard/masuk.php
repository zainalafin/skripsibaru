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
require"functions.php";
date_default_timezone_set("Asia/Jakarta");
$tanggalSekarang = date("Y-m-d");
$jam2 = date("hi");
$jamSekarang = date("h:i:sa");

//ambil username dari session
$username = $_SESSION['username'];

//query data menggunakan id
$ambil = query(" SELECT * FROM user WHERE username = '$username'")[0];
if (isset($_GET["alert"])){
  ambil_data_awal();
}

if(isset($_POST["submit"])){
	if(simpan_absen_masuk()){
  echo "
    <script>
      document.location.href='loading.php';
    </script>
    ";
    }
 // simpan_absen_masuk();
  //var_dump($_POST);
	
	
	// //cek data berhasil atau tidak
	// if (simpan_absen_masuk($_POST) > 0) {
	// 	echo "
	// 			<script>
	// 				alert('anda sudah absen untuk hari ini, absen lagi besok!');
	// 				// document.location.href= 'masuk.php';
	// 				</script>
	// 		";
	// } else{"
	// 			<script>
	// 				alert('Absen berhasil! Terimakasih!');
	// 				document.location.href= 'masuk.php';
	// 				</script>
	// 		";
			
	// }
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
        	<form action="" method="post">
				<ul>
					<li>
						<label for="username">Username :</label>
						<input type="text" name="username" id="username" value="<?= $ambil["username"] ?>"  readonly>
					</li>
					<li>
						<label for="Nama">Nama Karyawan :</label>
						<input type="text" name="Nama" id="Nama" value="<?= $ambil["nama_krywn"] ?>" readonly>
					</li>
					<li>
						<label for="tanggal">Tanggal :</label>
						<input type="text" name="tanggal" id="tanggal" value="<?php echo $tanggalSekarang ?>" readonly>
					</li>
					<li>
						<label for="masuk">Jam masuk :</label>
						<input type="text" name="masuk" id="masuk" value="<?php echo $jamSekarang ?>"readonly>
					</li>
						<label for="kode">Kode :</label>
						<input type="text" name="kode" id="kode" required>
					</li>
					<li>
						<button type="submit" name="submit">Input Absen!</button>
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

  </body>
</html>