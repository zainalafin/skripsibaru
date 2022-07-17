<?php 
session_start();
if(!isset($_SESSION["Login"])){
	header("Location:../login.php");
	exit;
}
// koneksi ke database
require '../functions.php';

//ambil data di url
$id = $_GET["id"];
//query data menggunakan id
$ambil = query(" SELECT * FROM karyawan WHERE id = $id")[0];

//cek tombol submit
if(isset($_POST["submit"])){
	//cek data berhasil atau tidak
	if (ubah($_POST) > 0) {
		echo "
				<script>
					alert('Data Berhasil Diubah!');
					document.location.href= 'karyawan.php';
					</script>
			";
	} else{"
				<script>
					alert('Data Gagal Diubah!');
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
						<a href="dashboard.php" class="menu-btn">
							<i class="fas fa-desktop"></i><span>Dashboard</span>
						</a>
					</li>
					<li class="item" id="profile">
						<a href="#profile" class="menu-btn">
							<i class="fas fa-table"></i><span>Master Data <i class="fas fa-chevron-down drop-down"></i></span>
						</a>
						<div class="sub-menu">
							<a href="../data/karyawan.php"><i class="fas fa-dice-d6"></i> <span>Data Karyawan</span></a>
							<a href="../data/jabatan.php"><i class="fas fa-border-all"></i><span>Data Jabatan</span></a>
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
				<div class="card">
					<h1>Ubah Data Karyawan</h1>
				</div>
				<div class="card">
					<form action="" method="post">
						<input type="hidden" name="id" value="<?= $ambil["id"]; ?>">
						<ul>
							<li>
								<label for="username">Username :</label>
								<input type="text" name="username" id="username"required value="<?= $ambil["username"] ?>">
							</li>
							<li>
								<label for="nama_krywn">Nama Karyawan :</label>
								<input type="text" name="nama_krywn" id="nama_krywn" required value="<?= $ambil["nama_krywn"] ?>">
							</li>
							<li>
								<label for="tmpt_lahir">Tempat Lahir :</label>
								<input type="text" name="tmpt_lahir" id="tmpt_lahir"required value="<?= $ambil["tmpt_lahir"] ?>">
							</li>
							<li>
								<label for="tgl_lhr">Tanggal Lahir :</label>
								<input type="text" name="tgl_lhr" id="tgl_lhr"required value="<?= $ambil["tgl_lhr"] ?>">
							</li>
							<li>
								<label for="alamat">Alamat :</label>
								<input type="text" name="alamat" id="alamat"required value="<?= $ambil["alamat"] ?>">
							</li>
							<li>
								<label for="no_hp">Nomor Handphone :</label>
								<input type="text" name="no_hp" id="no_hp"required value="<?= $ambil["no_hp"] ?>">
							</li>
							<li>
								<label for="kd_jabatan">Jabatan :</label>
								<input type="text" name="kd_jabatan" id="kd_jabatan"required value="<?= $ambil["kd_jabatan"] ?>">
							</li>
							<li>
								<label for="Gender">Gender:</label>
								<input type="text" name="Gender" id="Gender"required value="<?= $ambil["Gender"] ?>">
							</li>
							<li>
								<label for="password">Password :</label>
								<input type="text" name="password" id="password"required value="<?= $ambil["password"] ?>">
							</li>
							<li>
								<button type="submit" name="submit">Ubah</button>
							</li>
						</ul>

					</form>
				</div>
				
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
	