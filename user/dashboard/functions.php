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
	$query = "INSERT INTO user VALUES
				('$username', '$nama', '$tmpt', '$tgl', '$alamat', '$hp', '$jabatan', '$gender', '$pw') ";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}
 function hapus($id){
 	global $conn;
 	mysqli_query($conn, "DELETE FROM user WHERE id = $id");

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
				Gender = '$gender'

				WHERE id = $id


				";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);

}

function ubahpw ($data){
	global $conn;

	$username = htmlspecialchars($data["username"]);
	$pwlama = htmlspecialchars($data["pwlama"]);
	$pwbaru = htmlspecialchars($data["pwbaru"]);
	$konpw = htmlspecialchars($data["konfir"]);

	//query update password
	$query = "SELECT username, password FROM user WHERE username = '$username' AND password = '$pwlama'";
	mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);
}

//function absensi
function simpan_absen_masuk()
{
	global $conn;
	$username = $_POST['username'];
	$nama = $_POST['Nama'];
	$tanggal = $_POST['tanggal'];
	$jam = $_POST['masuk'];
	$keluar = 0;
	$suhu = 0;
	$kode = $_POST['kode'];
	$random = rand();
	$valid = 'FALSE';

	// Validasi tanggal
	$data = "SELECT * FROM absensi WHERE username='$username' AND tanggal='$tanggal'";
	$select = mysqli_query($conn, $data);
	$row = mysqli_num_rows($select);


	if ($row) {
		echo '<script>alert("anda sudah absen untuk hari ini, absen lagi besok!")</script>';
		return FALSE;
	}else{
		$query = "INSERT INTO absensi ( username, Nama, tanggal, masuk, keluar, suhu, kode, random, valid ) 
					VALUES 
		 			('$username', 
		 			'$nama', 
		 			'$tanggal', 
		 			'$jam', 
		 			'$keluar', 
		 			'$suhu', 
		 			'$kode', 
		 			'$random', 
		 			'$valid') 
		 			";
		 mysqli_query($conn, $query);
		 return TRUE;


	



		 //return mysqli_error($conn);
		// if(mysqli_affected_rows($conn)>0){
		// 	echo '<script>alert("thankyou. Absensi Berhasil!")</script>';
		// } else{
		// 	echo '<script>alert("data tidak masuk! anda sudah absen hari ini!!")</script>';
		// }
	}
	// $query = "SELECT * FROM absensi ORDER BY id LIMIT 1 DESC ";
	// $result = mysqli_query($conn, $query);
	// $data = mysqli_fetch_assoc($result);
	// $ket = $data["ket"];
	// if($ket == "masuk"){
	// 	echo "<script>alert('terima kasih. Absensi Berhasil!')
	// 	document.location.href='masuk.php';
	// 	</script>";

	// } else if($ket == "sakit"){
	// echo "<script>alert('Data Tidak Masuk!')
	// 	document.location.href='masuk.php';
	// 	</script>";
	// } else{
	// 		echo "<script>alert('suhu tidak normal!. silahkan istirahat dirumah!')
	// 	document.location.href='masuk.php';
	// 	</script>";
	// }




	
	

			// $query = "INSERT INTO absensi VALUES 
			// 			('', '$username', '$nama', '$tanggal', '$jam', '', '$suhu') ";

			// mysqli_query($conn, $query);

			// if(mysqli_affected_rows($conn)>0){
			// 	echo '<script>alert("terima kasih. Absensi Berhasil!")</script>';
			// }else{
			// 	echo '<script>alert("Anda Sudah Absen untuk Hari Ini, Absen Lagi Besok!")</script>';
			// }
	// if ($row) {
	// 	echo '<script>alert("anda sudah absen untuk hari ini, absen lagi besok!")</script>';
	// }else{
	// 	echo '<script>alert("terima kasih")</script>';
	// 	$
	// 	$res =  mysqli_query($conn, "INSERT INTO absensi SET  username='$username', Nama='$nama', tanggal='$tanggal', jam='$jam', suhu='$suhu'");
	// }

}
function ambil_data_awal()
{
	global $conn;
	$query = "SELECT * FROM absensi ORDER BY id DESC LIMIT 1";
	$result = mysqli_query($conn, $query);
	$data = mysqli_fetch_assoc($result);
	$ket = $data["ket"];
	if($ket == "masuk"){
		echo "<script>alert('terima kasih. Absensi Berhasil!')
		document.location.href='masuk.php';
		</script>";

	} else if($ket == "sakit"){
	echo "<script>alert('suhu tidak normal!. silahkan istirahat dirumah!')
		document.location.href='masuk.php';
		</script>";
	} 
}



function simpan_absen_keluar()
{
	global $conn;
	$username = $_POST['username'];
	$nama = $_POST['Nama'];
	$tanggal = $_POST['tanggal'];
	$jam = $_POST['keluar'];
	$suhu = $_POST['suhu'];

	// Validasi tanggal
	$valid = "SELECT * FROM absensi WHERE username='$username' AND tanggal='$tanggal'";
	$select = mysqli_query($conn,$valid );
	$row = mysqli_num_rows($select);

	if ($row) {
		echo '<script>alert("terima kasih. Absensi Berhasil!")</script>';
		$query = "UPDATE absensi SET keluar = '$jam' WHERE $username = '$username' AND tanggal = '$tanggal'";
		$res =  mysqli_query($conn, $query);
		
	}else{
		echo '<script>alert("Anda Belum Absen Masuk! Silahkan Absen Masuk Terlebih Dahulu!")</script>';
	}


// 			$query = "UPDATE absensi SET keluar = '$jam' WHERE username = $username";
// // 
// 			mysqli_query($conn, $query);
// 			if(mysqli_affected_rows($conn)>0){
// 				echo '<script>alert("terima kasih")</script>';
// 			}else{
// 				echo '<script>alert("anda sudah absen untuk hari ini, absen lagi besok!")</script>';
// 			}
	// if ($row) {
	// 	echo '<script>alert("anda sudah absen untuk hari ini, absen lagi besok!")</script>';
	// }else{
	// 	echo '<script>alert("terima kasih")</script>';
	// 	$
	// 	$res =  mysqli_query($conn, "INSERT INTO absensi SET  username='$username', Nama='$nama', tanggal='$tanggal', jam='$jam', suhu='$suhu'");
	// }
}
?>