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

function tambah($data) {
	global $conn;
	$username = htmlspecialchars($data["username"]);
	$nama = htmlspecialchars($data["nama_krywn"]);
	$tmpt = htmlspecialchars($data["tmpt_lahir"]);
	$tgl = htmlspecialchars($data["tgl_lhr"]);
	$alamat = htmlspecialchars($data["alamat"]);
	$hp = htmlspecialchars($data["no_hp"]);
	$jabatan = htmlspecialchars($data["kd_jabatan"]);
	$gender = htmlspecialchars($data["Gender"]);
	$pw = htmlspecialchars($data["password"]);

		//query insert data
	$query = "INSERT INTO karyawan VALUES
				('', '$username', '$nama', '$tmpt', '$tgl', '$alamat', '$hp', '$jabatan', '$gender', '$pw') ";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}
 function hapus($id){
 	global $conn;
 	mysqli_query($conn, "DELETE FROM karyawan WHERE id = $id");

 	return mysqli_affected_rows($conn);
 }



function ubah($data){

	global $conn;

	$id = $data["id"];
	$username = htmlspecialchars($data["username"]);
	$nama = htmlspecialchars($data["nama_krywn"]);
	$tmpt = htmlspecialchars($data["tmpt_lahir"]);
	$tgl = htmlspecialchars($data["tgl_lhr"]);
	$alamat = htmlspecialchars($data["alamat"]);
	$hp = htmlspecialchars($data["no_hp"]);
	$jabatan = htmlspecialchars($data["kd_jabatan"]);
	$gender = htmlspecialchars($data["Gender"]);
	$pw = htmlspecialchars($data["password"]);

		//query insert data
	$query = "UPDATE karyawan SET 
				username = '$username',
				nama_krywn = '$nama',
				tmpt_lahir = '$tmpt',
				tgl_lhr = '$tgl',
				alamat = '$alamat',
				no_hp = '$hp',
				kd_jabatan = '$jabatan',
				Gender = '$gender',
				password = '$pw',

				WHERE id = $id


				";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);

}
?>