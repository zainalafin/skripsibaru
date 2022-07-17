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
// koneksi ke database
require '../functions.php';

$username = $_SESSION['username'];

//query data menggunakan id
$ambil = query(" SELECT * FROM user WHERE username = '$username'")[0];

//proses ganti password
    if (isset($_POST['submit'])) {
    $username         = $_POST['username'];
    $password_lama    = $_POST['pwlama'];
    $password_baru    = $_POST['password'];
    $konf_password    = $_POST['password2'];
    $password_hash    = password_hash($password_baru, PASSWORD_DEFAULT);
    //cek old password
    $query = "SELECT * FROM user WHERE username='$username' AND password='$password_lama'";
    $sql = mysqli_query ($conn, $query);
    $hasil = mysqli_fetch_assoc ($sql);
    if(password_verify($password_lama,$hasil['password'])){
        echo"<script>
          alert('Password lama tidak sesuai!, silahkan ulang kembali!');
          document.location.href= 'changepw.php';
          </script>"; 
        
    }
    //validasi data data kosong
    else if (empty($_POST['password']) || empty($_POST['password2'])) {
            echo "<script>
          alert(Ganti Password Gagal! Data Tidak Boleh Kosong!');
          document.location.href= 'changepw.php';
          </script>";    
    }
    //validasi input konfirm password
    else if (($_POST['password']) != ($_POST['password2'])) {
            echo "<script>
          alert('Ganti Password Gagal!, Password Baru Harus Sama dengan Konfirmasi Password!');
          document.location.href= 'changepw.php';
          </script>";    
    }
    else {
    //update data
    $query = "UPDATE user SET password='$password_hash' WHERE username='$username'";
    $sql = mysqli_query ($conn, $query);
    //setelah berhasil update
    if ($sql) {
        echo "<script>
          alert('Password Berhasil Diubah!');
          document.location.href= 'changepw.php';
          </script>";    
    } else {
        echo "<script>
          alert('Password Gagal Diubah!');
          document.location.href= 'changepw.php';
          </script>";    
    }
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
      <a href="../dashboard/index.php"><i class="fas fa-desktop"></i><span>Dashboard</span></a>
      <a href="index.php"><i class="fas fa-user-circle"></i><span>Profile</span></a>
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
     <a href="../dashboard/index.php"><i class="fas fa-desktop"></i><span>Dashboard</span></a>
      <a href="index.php"><i class="fas fa-user-circle"></i><span>Profile</span></a>
      <a href="../lihat/index.php"><i class="fas fa-fingerprint"></i><span>Lihat Absensi</span></a>
      <a href="../cuti/index.php"><i class="fas fa-table"></i><span>Ajukan Cuti</span></a>
      <a href="../izin/index.php"><i class="fas fa-th"></i><span>Ajukan Izin</span></a>

    </div>
    <!--sidebar end-->

    <div class="content">
      <div class="card">

        <h2>GANTI PASSWORD</h2>
        <style>
          /* The message box is shown when the user clicks on the password field */
          #message {
          display:none;
          background: #f1f1f1;
          color: #000;
          position: relative;
          padding: 0px;
          margin-top: 10px;
          }

          #message p {
          padding: 1px 35px;
          font-size: 12px;
          }
          /* Add a green text color and a checkmark when the requirements are right */
          .valid {
            color: green;
          }

          .valid:before {
            position: relative;
            left: -35px;
            content: "✔";
          }

          /* Add a red text color and an "x" when the requirements are wrong */
          .invalid {
          color: red;
          }

          .invalid:before {
          position: relative;
          left: -35px;
          content: "✖";
          }         
        </style>

        <form action="" method="post">
            <ul>
              <li>
                <label for="username">Username : </label>
                <input type="username" name="username" id="username" value="<?= $ambil["username"] ?>">
              </li>
              <li>
                <label for="pwlama">Password Lama : </label>
                <input type="password" name="pwlama" id="pwlama" required placeholder="Password Lama" >
              </li>
              <li>
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Masukkan Password" id="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
              </li>
              <li>
                <label for="password2">Konfirmasi Password</label>
                <input type="password" name="password2" class="form-control" placeholder="Konfirmasi Password" id="password2" required>
              </li>
            <div id="message">
              <b>*Password must contain the following:</b>
              <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
              <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
              <p id="number" class="invalid">A <b>number</b></p>
              <p id="length" class="invalid">Minimum <b>8 characters</b></p>
            </div>
              <li>
                <button type="submit" name="submit">Ganti Password</button>
              </li>
            </ul>

          </form>

          <a href="index.php">Kembali</a>

        
      </div>

    </div>

    <script type="text/javascript">
    $(document).ready(function(){
      $('.nav_btn').click(function(){
        $('.mobile_nav_items').toggleClass('active');
      });
    });
    </script>

<script>
var myInput = document.getElementById("password");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");

// When the user clicks on the password field, show the message box
myInput.onfocus = function() {
  document.getElementById("message").style.display = "block";
}

// When the user clicks outside of the password field, hide the message box
myInput.onblur = function() {
  document.getElementById("message").style.display = "none";
}

// When the user starts to type something inside the password field
myInput.onkeyup = function() {
  // Validate lowercase letters
  var lowerCaseLetters = /[a-z]/g;
  if(myInput.value.match(lowerCaseLetters)) {  
    letter.classList.remove("invalid");
    letter.classList.add("valid");
  } else {
    letter.classList.remove("valid");
    letter.classList.add("invalid");
  }
  
  // Validate capital letters
  var upperCaseLetters = /[A-Z]/g;
  if(myInput.value.match(upperCaseLetters)) {  
    capital.classList.remove("invalid");
    capital.classList.add("valid");
  } else {
    capital.classList.remove("valid");
    capital.classList.add("invalid");
  }

  // Validate numbers
  var numbers = /[0-9]/g;
  if(myInput.value.match(numbers)) {  
    number.classList.remove("invalid");
    number.classList.add("valid");
  } else {
    number.classList.remove("valid");
    number.classList.add("invalid");
  }
  
  // Validate length
  if(myInput.value.length >= 8) {
    length.classList.remove("invalid");
    length.classList.add("valid");
  } else {
    length.classList.remove("valid");
    length.classList.add("invalid");
  }
}
</script>
  </body>
</html>