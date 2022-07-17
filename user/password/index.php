<?php 
session_start();
if(!isset($_SESSION["Login"])){
	header("Location:../login.php");
	exit;
} ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title>Absensi Karyawan</title>
		<link rel="stylesheet" href="style.css">
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
						<a href="index.php" class="menu-btn">
							<i class="fas fa-desktop"></i><span>Dashboard</span>
						</a>
					</li>
					<li class="item">
						<a href="../ganti/index.php" class="menu-btn">
							<i class="fas fa-user-circle"></i><span>Edit Profile</span>
						</a>
					</li>
					<li class="item">
						<a href="../lihat/index.php" class="menu-btn">
							<i class="fas fa-fingerprint"></i><span>Lihat Absensi</span>
						</a>
					</li>
					<li class="item">
						<a href="../cuti/index.php" class="menu-btn">
							<i class="fas fa-table"></i><span>Ajukan Cuti</span>
						</a>
					</li>
					<li class="item">
						<a href="../izin/index.php" class="menu-btn">
							<i class="fas fa-th"></i><span>Ajukan Izin</span>
						</a>
					</li>
					<li class="item">
						<a href="index.php" class="menu-btn">
							<i class="fas fa-key"></i><span>Ganti Password</span>
						</a>
					</li>
				</div>
			</div>
			<!--sidebar end-->
			<!--main container start-->
			<div class="main-container">
				<div class="header">
					<h4>SILAHKAN ABSEN</h4>
				</div>
				<div class="card">
					<table border="1" cellpadding="10" cellspacing="0">
						<tr>
							<td>Absen Masuk</td>
							<td><a href="#">Absen</a></td>
						</tr>
						<tr>
							<td>Absen Pulang</td>
							<td><a href="#">Absen</a></td>
						</tr>
						
						</td>
					</table>

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