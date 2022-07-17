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
require '../functions.php';

$username = $_SESSION['username'];

$ambil = query(" SELECT * FROM user WHERE username = '$username'")[0];

//cek tombol submit
if(isset($_POST["submit"])){
  //cek data berhasil atau tidak
  if (izin($_POST) > 0) {
    echo "
        <script>
          alert('Data Berhasil Ditambahkan!');
          // document.location.href= 'index.php';
          </script>
      ";
  } else{"
        <script>
          alert('Data Gagal Ditambahkan!');
          document.location.href= 'index.php';
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
      <a href="../dashboardindex.php"><i class="fas fa-desktop"></i><span>Dashboard</span></a>
      <a href="../ganti/index.php"><i class="fas fa-user-circle"></i><span>Profile</span></a>
      <a href="../lihat/index.php"><i class="fas fa-fingerprint"></i><span>Lihat Absensi</span></a>
      <a href="../cuti/index.php"><i class="fas fa-table"></i><span>Ajukan Cuti</span></a>
      <a href="index.php"><i class="fas fa-th"></i><span>Ajukan Izin</span></a>

      </div>
    </div>
    <!--mobile navigation bar end-->
    <!--sidebar start-->
    <div class="sidebar">
      <div class="profile_info">
        <img src="unnamed.png" class="profile_image" alt="">
      </div>
      <a href="../dashboardindex.php"><i class="fas fa-desktop"></i><span>Dashboard</span></a>
      <a href="../ganti/index.php"><i class="fas fa-user-circle"></i><span>Profile</span></a>
      <a href="../lihat/index.php"><i class="fas fa-fingerprint"></i><span>Lihat Absensi</span></a>
      <a href="../cuti/index.php"><i class="fas fa-table"></i><span>Ajukan Cuti</span></a>
      <a href="index.php"><i class="fas fa-th"></i><span>Ajukan Izin</span></a>

    </div>
    <!--sidebar end-->

    <div class="content">
      <div class="card">
        <h2>AJUKAN IZIN</h2>
        <form action="" method="post">
            <ul>
              <li>
                <label for="username">Username :</label>
                <input type="text" name="username" id="username" value="<?php echo $username ?>">
              </li>
              <li>
                <label for="nama_krywn">Nama Karyawan :</label>
                <input type="text" name="nama_krywn" id="nama_krywn" value="<?php echo $ambil['nama_krywn']; ?>">
              </li>
              <li>
                <label for="tgl_mulai">Tanggal Mulai :</label>
                <input type="date" name="tgl_mulai" id="tgl_mulai"required>
              </li>
              <li>
                <label for="tgl_selesai">Tanggal Selesai :</label>
                <input type="date" name="tgl_selesai" id="tgl_selesai"required>
              </li>
              <li>
                <button type="submit" name="submit">Ajukan Izin!</button>
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