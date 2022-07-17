<?php 
session_start();
require 'functions.php';

//cek cookie
if (isset($_COOKIE['id'] ) && isset($_COOKIE['key'] )) {
  $id = $_COOKIE['id'];
  $key = $_COOKIE['key'];

  //ambil username berdasarkan id
  $result = mysqli_query( $conn, "SELECT username FROM user WHERE username= $id" );
  $row = mysqli_fetch_assoc($result);

  //cek cookie dan username
  if( $key === hash('sha256', $row['username'])) {
    $_SESSION['Login'] = true;  

  }

}



if(isset($_POST["Login"])){
  $username = $_POST["username"];
  $password = $_POST["password"];

  $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
  $data = mysqli_fetch_assoc($result);

  //cek username
  if (mysqli_num_rows($result)=== 1) { 

    //cek password
    if($password == $data["password"]){
      //set session
      $_SESSION["Login"] = true;
      $_SESSION['username'] = $data['username'];
      $_SESSION['role'] = $data['role'];


      //cek remember me
      if ( isset($_POST['remember'])) {
        //buat cookie
        setcookie('id', $data['username'] , time() + 60);
        setcookie('key', hash('sha256', $data['username']), time() + 60);

      }

      if($_SESSION["role"]=='admin') {

        header("Location: admind/dashboard/dashboard.php");

      } elseif($_SESSION["role"]=='user'){
        header("Location: user/dashboard/index.php");

      }
    }
    
  }

  $eror = true;
}

 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
  </head>
  <body>
    <div class="container">
      <div class="wrapper">
        <div class="title"><span>Login Form</span></div>
        <form action="" method="post">
          <div class="row">
            <i class="fas fa-user"></i>
            <input type="text" name="username" id="username" placeholder="Enter Your Username">
          </div>
          <div class="row">
            <i class="fas fa-lock"></i>
            <input type="Password" name="password" id="password" placeholder="Enter Your Password">
          </div>
          <label for="remember">Remember me</label><input type="checkbox" name="remember" id="remember">

          <div class="row button">
            <input type="submit" name="Login" value="Login">
          <br>
          </div>
          <?php if(isset($eror)):?>
  <p style="color: red; font-style: italic;">username/password salah</p>
  <?php endif; ?>
          
        </form>
      </div>
    </div>

  </body>
</html>
