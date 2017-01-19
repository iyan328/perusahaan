<?php
session_start();

//cek apakah user sudah login
if(!isset($_SESSION['username'])){
die("Anda belum login");//jika belum login jangan lanjut..
}
else{
	$nm = $_SESSION['username'];
}

//cek level user
if($_SESSION['hak_akses']!="perusahaan"){
die("Anda bukan Perusahaan");//jika bukan admin jangan lanjut
}
?>
<?php
	include "koneksi.php";
	if(isset($_GET['kode'])){
		$kode = $_GET['kode'];
		$sql = "UPDATE sp set s_peru='Disetujui' where perusahaan='$kode'";
			$kueri = mysql_query($sql);
			if ($kueri){
				echo "<script> alert('Berhasil');document.location='http://localhost/ta2/upload-download-files/sp.php'</script>";
			}
			else {
				echo "<script> alert('Gagal');document.location='http://localhost/ta2/upload-download-files/sp.php'</script>";
				echo mysql_error();
			}
	} else {
		echo "<script>alert('Data Belum Dipilih');document.location='http://localhost/ta2/upload-download-files/sp.php'</script>";
	}

	?>