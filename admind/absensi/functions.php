<?php
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "absensi_karyawan");

// fungsi memanggil query
function query($query){
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while ($row = mysqli_fetch_assoc($result)){
		$rows[] = $row;
	}
	return $rows;
}

function cari($keyword){
	$query = "SELECT * FROM absensi WHERE 

				username = '$keyword'  OR 
				Nama LIKE '%$keyword%' ";

	return query($query);
}


?>