<?php 
require '../functions.php';

//baca isi tabel sensor
$sql = mysqli_query($conn, "SELECT * FROM absensi");
$data = mysqli_fetch_array($sql);
$nilai = $data["suhu"];

echo $nilai;
 ?>