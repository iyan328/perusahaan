
<?php
		include "koneksi.php";
		if (isset($_POST['register'])){
			$username = $_POST['username'];
			$password = $_POST['password'];
			$perusahaan = $_POST['perusahaan'];
			$alamat = $_POST['alamat'];
			$no_hp = $_POST['no_hp'];
			$sql = "INSERT INTO akun values('$username','$password','perusahaan')";
			$kueri = mysql_query($sql);
			$sql2 = "SELECT* from akun where username = '$username'";
			$kueri2 = mysql_query($sql2);
			$data2 = mysql_fetch_array($kueri2);
			$akun2 = $data2['username'];
			$sql1 = "INSERT INTO perusahaan values('$username','$perusahaan','$alamat','$no_hp',NULL,NULL,NULL)";
			$kueri1 = mysql_query($sql1);
			if ($kueri && $kueri1){
				echo "<script> alert('Data berhasil dimasukkan ke database');document.location='index.html'</script>";
			}
			else {
				echo "<script> alert('Data gagal dimasukkan ke database');document.location='index.html'</script>";
				echo mysql_error();
			}
		}
		?>