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

//ambil data di url
$id = $_GET["id"];
//query data menggunakan id
$ambil = query(" SELECT * FROM user WHERE id = $id")[0];



// //cek tombol submit
if(isset($_POST["submit"])){
	$id 			  = $data["id"];
	$username         = $_POST['username'];
    $password_baru    = $_POST['pwbaru'];
    $konf_password    = $_POST['konfir'];
    $password_hash    = password_hash($password_baru, PASSWORD_DEFAULT);
//cek konfir pw dan pw baru
if (($_POST['pwbaru']) != ($_POST['konfir'])) {
            echo "<script>
          alert('Reset Password Gagal!, Password Baru Harus Sama dengan Konfirmasi Password!');
          document.location.href= 'changepw.php';
          </script>";    
    }  else {
    //update data
    $query = "UPDATE user SET password='$password_hash' WHERE id='$id'";
    $sql = mysqli_query ($conn, $query);
		}
    //setelah berhasil update
    if ($sql) {
        echo "<script>
          alert('Password Berhasil Diubah!');
          document.location.href= 'karyawan.php';
          </script>";    
    } else {
        echo "<script>
          alert('Password Gagal Diubah!');
          document.location.href= 'karyawan.php';
          </script>";    
    }
    }
	
// 	//cek data berhasil atau tidak
// 	if (reset($_POST) > 0) {
// 		echo "
// 				<script>
// 					alert('Data Berhasil Ditambahkan!');
// 					// document.location.href= 'karyawan.php';
// 					</script>
// 			";
// 	} else{"
// 				<script>
// 					alert('Data Gagal Ditambahkan!');
// 					document.location.href= 'karyawan.php';
// 					</script>
// 			";
// 	}
// }
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
        <h1>Reset Password User</h1>
      </div>
      <div class="card">
          <form action="" method="post">
            <input type="hidden" name="id" value="<?= $_GET["id"]; ?>">
            <ul>
              <li>
                <label for="username">Username :</label>
                <input type="text" name="username" id="username"required value="<?= $ambil["username"] ?>">
              </li>
              <li>
                        <label for="pwbaru">Password Baru :</label>
                        <input type="password" name="pwbaru" id="pwbaru" required placeholder="Password Baru">
                      </li>
                      <li>
                         <label for="konfir">Konfirmasi Password :</label>
                         <input type="password" name="konfir" id="konfir"required placeholder="Konfirmasi Password">
                      </li>
                      <li>
                        <button type="submit" name="submit">Ganti Password</button>
                      </li>
              
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
	