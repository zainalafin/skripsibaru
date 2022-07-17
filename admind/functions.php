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
//mulai folder absensi
//cari absensi
function cari_absen($keyword){
	$query = "SELECT * FROM absensi WHERE 

				username = '$keyword'  OR 
				Nama LIKE '%$keyword%' ";

	return query($query);
}
//cari cuti
function cari_cuti($keyword){
	$query = "SELECT * FROM cuti WHERE 

				username = '$keyword'  OR  
				nama_krywn LIKE '%keyword%'";

	return query($query);
}
//cari izin
function cari_izin($keyword){
	$query = "SELECT * FROM izin WHERE 

				username = '$keyword'  OR  
				nama_krywn LIKE '%keyword%'";

	return query($query);
}
//selesai folder absensi

//mulai folder data
//tambah karyawan
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
	$role = htmlspecialchars($data["role"]);
	$password_hash = password_hash($pw, PASSWORD_DEFAULT);

		//query insert data
	$query = "INSERT INTO user VALUES
				('', '$username', '$nama', '$tmpt', '$tgl', '$alamat', '$hp', '$jabatan', '$gender', '$password_hash', '$role') ";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}
//hapus karyawan
 function hapus($id){
 	global $conn;
 	mysqli_query($conn, "DELETE FROM user WHERE id = $id");

 	return mysqli_affected_rows($conn);
 }
// ubah data karyawan
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
	
	$query = "UPDATE user SET

				username = '$username',
				nama_krywn = '$nama',
				tmpt_lahir = '$tmpt',
				tgl_lhr = '$tgl',
				alamat = '$alamat',
				no_hp = '$hp',
				kd_jabatan = '$jabatan',
				Gender = '$gender'

				WHERE id = $id";


	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);

}
//cari data karyawan
function cari_karyawan($keyword,$awaldata,$dataperhalaman){
	$query = "SELECT * FROM user WHERE 

				username LIKE '%$keyword%' OR 
				nama_krywn LIKE '%$keyword%' 
				LIMIT $awaldata, $dataperhalaman" ;

	return query($query);
}
// function reset($data){

// 	global $conn;

// 	$username=$_POST['username'];
//  	$password=$_POST['pwbaru'];

// 	$query="SELECT * FROM admin WHERE username='$username'";
	
//  	mysqli_query($conn, $query);



// }
//selesai folder data
?>