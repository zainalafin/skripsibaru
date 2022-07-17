<?php 
require '../functions.php';
//baca data yang dikirim oleh nodemcu
$nilai = $_GET["sensor"];

//update data didatabase 
mysqli_query($conn, "UPDATE absensi set suhu ='$nilai'");


 ?>