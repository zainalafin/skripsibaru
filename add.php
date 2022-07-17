<?php
	require "functions.php";
	// $conn = mysqli_connect("localhost", "root", "", "skripsi");
	$username = $_GET['username'];
    $kode = $_GET['kode'];
    // $nama = $_GET['nama'];
	$tanggal = $_GET['tanggal'];
	$masuk = $_GET['masuk'];
	$keluar = $_GET['keluar'];
	$suhu =  $_GET['suhu'];
	$random = $_GET['randoms'];
	$ket = $_GET['ket'];
//tambahkan data baru ke tabel histori
	$query = "UPDATE absensi SET
			 suhu = '$suhu', valid = 'TRUE', ket = '$ket' WHERE random = '$random'
	";

	mysqli_query($conn,$query);
	

?>
