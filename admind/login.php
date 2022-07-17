<?php 
session_start();
require 'functions.php';

//cek cookie
if (isset($_COOKIE['id'] ) && isset($_COOKIE['key'] )) {
	$id = $_COOKIE['id'];
	$key = $_COOKIE['key'];

	//ambil username berdasarkan id
	$result = mysqli_query( $conn, "SELECT username FROM admin WHERE username= $id" );
	$row = mysqli_fetch_assoc($result);

	//cek cookie dan username
	if( $key === hash('sha256', $row['username'])) {
		$_SESSION['Login'] = true; 
	}

}



if(isset($_SESSION["Login"])){
	header("Location: index.php");
	exit;
}


if(isset($_POST["Login"])){
	$username = $_POST["username"];
	$password = $_POST["password"];

	$result = mysqli_query($conn, "SELECT * FROM admin WHERE username = '$username'");
	$data = mysqli_fetch_assoc($result);

	//cek username
	if (mysqli_num_rows($result)=== 1) { 

		//cek password
		$row= mysqli_fetch_assoc($result);
		if($password==$data['password']){
			//set session
			$_SESSION["Login"] = true;

			//cek remember me
			if ( isset($_POST['remember'])) {
				//buat cookie
				setcookie('id', $data['username'] , time() + 60);
				setcookie('key', hash('sha256', $data['username']), time() + 60);

			}

			header("Location: index.php");
			exit;
		}
		
	}

	$eror = true;
}

 ?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Login Form</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="title"><h1>login </h1></div>
	<div class="container">
		<div class="left">
			<img  src="unnamed.png">
		</div>
		<div class="righ">
			<div class="formBox">
				<form action="" method="post">
					<p>username</p>
					<input type="text" name="username" id="username" placeholder="Enter Your Username">
					<p>Password</p>
					<input type="Password" name="password" id="password" placeholder="Enter Your Password">
					<label for="remember">Remember me</label><input type="checkbox" name="remember" id="remember">
					<input type="submit" name="Login" value="Login">
					<br>
					<a href="#">Forget Password</a>
						<?php if(isset($eror)):?>
	<p style="color: red; font-style: italic;">username/password salah</p>
	<?php endif; ?>

				</form>
				
			</div>
		</div>
	</div>

</body>
</html>