<?php 
session_start();
if(!isset($_SESSION["Login"])){
  header("Location:../login.php");
  exit;
} 
if (isset($_SESSION['role'])) {
  if($_SESSION['role']!= 'admin'){
     header("Location:../login.php");
  exit;
}
}
	// koneksi ke database
require 'functionsjab.php';

// ambil data dari tabel absensi atau query data
$result = mysqli_query($conn, "SELECT * FROM jabatan");

// tombol cari di tekan
if (isset($_POST["cari"])) {
	$result = cari($_POST["keyword"]);

}


 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title>Absensi Karyawan</title>
		<link rel="stylesheet" href="style_index.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
	</head>
	<body>

		<!--wrapper start-->
		<div class="wrapper">
			<!--header menu start-->
			<div class="header">
				<div class="header-menu">
					<div class="title">Absensi <span>Karyawan</span></div>
					<div class="sidebar-btn">
						<i class="fas fa-bars"></i>
					</div>
					<ul>
						<li><a href="../logout.php"> <span>Logout</span></a></li>
					</ul>
				</div>
			</div>
			<!--header menu end-->
			<!--sidebar start-->
			<div class="sidebar">
				<div class="sidebar-menu">
					<center class="profile">
						<img src="unnamed.png" alt="">
					</center>
					<li class="item">
						<a href="../dashboard/dashboard.php" class="menu-btn">
							<i class="fas fa-desktop"></i><span>Dashboard</span>
						</a>
					</li>
					<li class="item" id="profile">
						<a href="#profile" class="menu-btn">
							<i class="fas fa-table"></i><span>Master Data <i class="fas fa-chevron-down drop-down"></i></span>
						</a>
						<div class="sub-menu">
							<a href="karyawan.php"><i class="fas fa-dice-d6"></i> <span>Data Karyawan</span></a>
							<a href="jabatan.php"><i class="fas fa-border-all"></i><span>Data Jabatan</span></a>
						</div>
					</li>
					<li class="item" id="messages">
						<a href="#messages" class="menu-btn">
							<i class="fas fa-database"></i><span>Data Absensi <i class="fas fa-chevron-down drop-down"></i></span>
						</a>
						<div class="sub-menu">
							<a href="../absensi/absensi.php"><i class="fas fa-box"></i> <span> Absensi</span></a>
							<a href="../absensi/cuti.php"><i class="fas fa-th"></i><span>Cuti</span></a>
							<a href="../absensi/izin.php"><i class="fas fa-receipt"></i><span>Izin</span></a>
						</div>
					</li>
					<li class="item">
						<a href="../monitoring/suhu.php" class="menu-btn">
							<i class="fas fa-thermometer-three-quarters"></i><span>Monitoring</span>
						</a>
					</li>
					<li class="item">
						<a href="../laporan/laporan.php" class="menu-btn">
							<i class="fas fa-file-alt"></i><span>Laporan</span>
						</a>
					</li>
				</div>
			</div>
			<!--sidebar end-->
			<!--main container start-->
			<div class="main-container">
					<h1>DATA JABATAN</h1>

					<form action="" method="post">
						<input type="text" name=" keyword" size="40" autofocus placeholder="cari id.." autocomplete="off">
						<button type="submit" name="cari"> Cari!</button>
					</form>
					
			
				<table border="1" cellpadding="10" cellspacing="0">
	
					<tr>
						<th>No.</th>
						<th>Kode Jabatan</th>
						<th>Nama Jabatan</th>

					</tr>
					<?php $i=1;?>
					<?php foreach($result as $row):
						 ?>	
					<tr>
						<td><?= $i;?></td>

						<td><?= $row["kd_jabatan"];?></td>
						<td><?= $row["nama_jabatan"];?></td>

						</tr>


					<?php $i++;?>
					<?php endforeach ?>
				</table>
			</div>
			<!--main container end-->
		</div>
		<!--wrapper end-->

		<script type="text/javascript">
		$(document).ready(function(){
			$(".sidebar-btn").click(function(){
				$(".wrapper").toggleClass("collapse");
			});
		});
		</script>

	</body>
</html>
