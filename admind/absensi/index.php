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
						<li><a href="logout.php"> <span>Logout</span></a></li>
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
						<a href="dashboard/dashboard.php" class="menu-btn">
							<i class="fas fa-desktop"></i><span>Dashboard</span>
						</a>
					</li>
					<li class="item" id="profile">
						<a href="#profile" class="menu-btn">
							<i class="fas fa-table"></i><span>Master Data <i class="fas fa-chevron-down drop-down"></i></span>
						</a>
						<div class="sub-menu">
							<a href="data/karyawan.php"><i class="fas fa-dice-d6"></i> <span>Data Karyawan</span></a>
							<a href="data/jabatan.php"><i class="fas fa-border-all"></i><span>Data Jabatan</span></a>
						</div>
					</li>
					<li class="item" id="messages">
						<a href="#messages" class="menu-btn">
							<i class="fas fa-database"></i><span>Data Absensi <i class="fas fa-chevron-down drop-down"></i></span>
						</a>
						<div class="sub-menu">
							<a href="absensi/absensi.php"><i class="fas fa-box"></i> <span> Absensi</span></a>
							<a href="absensi/cuti.php"><i class="fas fa-th"></i><span>Cuti</span></a>
							<a href="absensi/izin.php"><i class="fas fa-receipt"></i><span>Izin</span></a>
						</div>
					</li>
					<li class="item">
						<a href="monitoring/suhu.php" class="menu-btn">
							<i class="fas fa-thermometer-three-quarters"></i><span>Monitoring</span>
						</a>
					</li>
					<li class="item">
						<a href="laporan/laporan.php" class="menu-btn">
							<i class="fas fa-file-alt"></i><span>Laporan</span>
						</a>
					</li>
				</div>
			</div>
			<!--sidebar end-->
			<!--main container start-->
			<div class="main-container">
				<div class="card">
					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
				</div>
				<div class="card">
					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
				</div>
				<div class="card">
					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
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
