<?php
session_start();
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "absensi_karyawan");
//function query
function query($query){
	global $conn;
	$result = mysqli_query($conn, $query);
	//mysqli_error();
	$rows = [];
	while ($row = mysqli_fetch_assoc($result)){
		$rows[] = $row;
	}
	return $rows;
}

// //ambil data dari database
$data = query("SELECT * FROM absensi ORDER BY id DESC")[0];
//$data['kode'] = strval($data['kode']);

$array = array(
"kode" => $data['kode'],
"username" => $data['username'],
"nama" => $data['Nama'],
"tanggal" => $data['tanggal'],
"masuk" => $data['masuk'],
"keluar" => $data['keluar'],
"random" => $data['random'],
"valid" => $data['valid']
);
// Merubah data kedalam JSON 
$json = json_encode($array);
echo $json;
