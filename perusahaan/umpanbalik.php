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
	
	//$sql = "SELECT * FROM mhs WHERE username='$nm'";
	//$kueri = mysql_query($sql);
	//$data = mysql_fetch_array($kueri);
	//$nama = $data['nama'];
	//$nim = $data['nim'];
	//$prodi = $data['prodi'];
	$sql = "SELECT * FROM perusahaan WHERE username='$nm'";
	$kueri = mysql_query($sql);
	$data = mysql_fetch_array($kueri);
	$perusahaan = $data['perusahaan'];
	$alamat= $data['alamat'];
	$no_hp= $data['no_hp'];
	$kuota = $data['kuota'];
	$email = $data['email'];
	$ket = $data['keterangan'];
	?>
	<?php
	$sql1 = "SELECT * FROM akun WHERE username='$nm'";
	$kueri1 = mysql_query($sql1);
	$data1 = mysql_fetch_array($kueri1);
	$user = $data1['username'];
	$pass= $data1['password'];
	$hak= $data1['hak_akses'];
	?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Home Page Perusahaan</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<script type="text/javascript" src="js/jquery.min.js"></script>
					<script type="text/javascript">
					function limit_checkbox(max, identifier)
					{
						var checkbox =$("input[name="'+identifier+"[]']");
						var checked=$("input[name="'+identifier+"[]']:checked").length;
						checkbox.filter(':not(:checked)').prop('disabled',checked >=max);
					}
				</script>

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="perusahaan.php">Perusahaan</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
			
			
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $perusahaan?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <!-- <li>
                            <a href="profile.php"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li> -->
                        <li>
                            <a href="setting.php"><i class="fa fa-fw fa-gear"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="active">
                        <a href="perusahaan.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
					
                        <a href="javascript:;" data-toggle="collapse" data-target="#magang"><i class="fa fa-fw fa-th-list"></i> Magang <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="magang" class="collapse">
							<li>
                                <a href="request.php"><i class="fa fa-fw fa-envelope"></i>Request Magang</a>
                            </li>
							<?php
								include "koneksi.php";
								if($kuota=="" and $ket==""){
								
								}
								else{
							?>
							<li>
                                <a href="../upload-download-files/pendaftaran.php"><i class="fa fa-fw fa-info"></i>Pendaftaran</a>
                            </li>
                            <li>
                                <a href="../upload-download-files/sp.php"><i class="fa fa-fw fa-tag"></i>Surat Pengantar</a>
                            </li>
							<li>
                                <a href="umpanbalik.php"><i class="fa fa-fw fa-check"></i>Umpan Balik</a>
                            </li>
							<?php	
								}
							?>
                            
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Umpan Balik <small><?php echo $perusahaan?></small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i><a href="perusahaan.php"> Dashboard </a>
                            </li>
							<li class="active">
                                <i class="fa fa-check"></i> Umpan Balik
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
				<div class="row">
                    <div class="col-lg-4">
                        <form role="form" action="" method="post">
							<h4><b>A.	Data Peserta Magang </b></h4>
							<div class="form-group">
                                <label for="disabledSelect">Nama</label>
                                <select class="form-control form-group" name="nim" required>
									<option value>Pilih Mahasiswa</option>
									<?php
									include "koneksi.php";
									$sql = "SELECT * FROM magang where perusahaan='$nm' and s_seleksi='Diterima'";
									$kueri = mysql_query($sql);
									$no=1;
									while($data = mysql_fetch_array($kueri)){
										$nim_1=$data['nim'];
										$nama="SELECT * FROM mahasiswa where nim = '$nim_1'";
										$cek_nama=mysql_query($nama);
										$data_nama=mysql_fetch_array($cek_nama);
									?>
									<option value="<?php echo $data_nama['nim']?>"><?php echo $data_nama['nama']?></option>
									<?php
									$no++;}
									?>
								</select>
                            </div>
							<!--<div class="form-group">
								<label>Nim</label>
								<input name="nim" type="text" class="form-control" value="<?php echo $nim?>" readonly>
								<!-- <p class="help-block">Example block-level help text here.</p> 
                            </div>
							<div class="form-group">
								<label>Prodi</label>
								<input name="prodi" type="text" class="form-control" value="<?php echo $prodi?>" readonly>
								<!-- <p class="help-block">Example block-level help text here.</p>
                            </div>-->
							<div class="form-group">
								<label>Tempat Magang</label>
								<input name="tempat" type="text" class="form-control" value="<?php echo $perusahaan?>" readonly>
								<!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>
							<div class="form-group">
								<label>Tahun</label>
								<input name="tahun" type="text" class="form-control" placeholder="Tahun" required>
								<!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>

					</div>
				</div>
                <!-- /.row -->

				<div class="row">
                    <div class="col-lg-12">
							<h4><b>B.	Parameter Penilaian </b></h4>
							<h5>1.	Checklist pada kolom yang sesuai </h5>
							<div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Parameter</th>
                                        <th>Baik Sekali</th>
										<th>Baik</th>
										<th>Cukup</th>
										<th>Kurang</th>
                                    </tr>
                                </thead>
                                <tbody>
									<tr>
										<td>1</td>
										<td>Tingkat kedisiplinan</td>
										<td align = "center"><input name="no1[]" type="checkbox" value="Baik sekali"></td>
										<td align = "center"><input name="no1[]" type="checkbox" value="Baik" ></td>
										<td align = "center"><input name="no1[]" type="checkbox" value="Cukup" ></td>
										<td align = "center"><input name="no1[]" type="checkbox" value="Kurang" ></td>

									</tr>
									<tr>
										<td>2</td>
										<td>Integritas (etika dan moral)</td>
										<td align = "center"><input name="no2[]" type="checkbox" value="Baik sekali"></td>
										<td align = "center"><input name="no2[]" type="checkbox" value="Baik"></td>
										<td align = "center"><input name="no2[]" type="checkbox" value="Cukup"></td>
										<td align = "center"><input name="no2[]" type="checkbox" value="Kurang"></td>

									</tr>
									<tr>
										<td>3</td>
										<td>Keahlian berdasarkan bidang ilmu (kompetensi utama)</td>
										<td align = "center"><input name="no3[]" type="checkbox" value="Baik sekali"></td>
										<td align = "center"><input name="no3[]" type="checkbox" value="Baik"></td>
										<td align = "center"><input name="no3[]" type="checkbox" value="Cukup"></td>
										<td align = "center"><input name="no3[]" type="checkbox" value="Kurang"></td>

									</tr>
									<tr>
										<td>4</td>
										<td>Bahasa Inggris</td>
										<td align = "center"><input name="no4[]" type="checkbox" value="Baik sekali"></td>
										<td align = "center"><input name="no4[]" type="checkbox" value="Baik"></td>
										<td align = "center"><input name="no4[]" type="checkbox" value="Cukup"></td>
										<td align = "center"><input name="no4[]" type="checkbox" value="Kurang"></td>

									</tr>
									<tr>
										<td>5</td>
										<td>Penggunaan teknologi informasi</td>
										<td align = "center"><input name="no5[]" type="checkbox" value="Baik sekali"></td>
										<td align = "center"><input name="no5[]" type="checkbox" value="Baik"></td>
										<td align = "center"><input name="no5[]" type="checkbox" value="Cukup"></td>
										<td align = "center"><input name="no5[]" type="checkbox" value="Kurang"></td>

									</tr>
									<tr>
										<td>6</td>
										<td>Komunikasi</td>
										<td align = "center"><input name="no6[]" type="checkbox" value="Baik sekali"></td>
										<td align = "center"><input name="no6[]" type="checkbox" value="Baik"></td>
										<td align = "center"><input name="no6[]" type="checkbox" value="Cukup"></td>
										<td align = "center"><input name="no6[]" type="checkbox" value="Kurang"></td>

									</tr>
									<tr>
										<td>7</td>
										<td>Kerjasama tim</td>
										<td align = "center"><input name="no7[]" type="checkbox" value="Baik sekali"></td>
										<td align = "center"><input name="no7[]" type="checkbox" value="Baik"></td>
										<td align = "center"><input name="no7[]" type="checkbox" value="Cukup"></td>
										<td align = "center"><input name="no7[]" type="checkbox" value="Kurang"></td>

									</tr>
									<tr>
										<td>8</td>
										<td>Pengembangan diri</td>
										<td align = "center"><input name="no8[]" type="checkbox" value="Baik sekali"></td>
										<td align = "center"><input name="no8[]" type="checkbox" value="Baik"></td>
										<td align = "center"><input name="no8[]" type="checkbox" value="Cukup"></td>
										<td align = "center"><input name="no8[]" type="checkbox" value="Kurang"></td>

									</tr>
									<tr>
										<td>9</td>
										<td>Kerapihan</td>
										<td align = "center"><input name="no9[]" type="checkbox" value="Baik sekali"></td>
										<td align = "center"><input name="no9[]" type="checkbox" value="Baik"></td>
										<td align = "center"><input name="no9[]" type="checkbox" value="Cukup"></td>
										<td align = "center"><input name="no9[]" type="checkbox" value="Kurang"></td>

									</tr>
                                </tbody>
                            </table>
                        </div>

					</div>
				</div>
                
                <!-- /.row -->
				<div class="row">
					<div class="col-lg-12">
						<h5>2. Penilaian terhadap mahasiswa MAGANG secara umum (dalam skala 1-100)</h5>
						<input name="nilai" class="form-control" placeholder="1-100" required>
					</div>
				</div>
				<div class="row">
                    <div class="col-lg-6">							
							<h4><b>C.	Catatan Bagi Mahasiswa dan Politeknik Batam </b></h4>
							<div class="form-group">
                                <label for="disabledSelect">1. Bagi mahasiswa</label>
                                <textarea name="c1" class="form-control"></textarea>
                            </div>
							<div class="form-group">
								<label>2. Bagi Politeknik Batam mengenai pelaksanaan MAGANG:</label>
								<textarea name="c2" class="form-control" ></textarea>
								<!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>
							<div class="form-group">
								<label>3. Apakah mahasiswa yang melaksanakan magang di perusahaan/instansi akan langsung diterima di tempat anda setelah selesai melaksanakan MAGANG </label>
								<textarea name="c3" class="form-control" ></textarea>
								<!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>
							
							<button name="tblEdit" type="submit" class="btn btn-default">Simpan</button>
							<button name="batal" type="submit" class="btn btn-default">Batal</button>
						</form>
					</div>
				</div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>

</body>

</html>
<?php
		include "koneksi.php";
		if (isset($_POST['tblEdit'])){
			$tahun = $_POST['tahun'];
			$nim = $_POST['nim'];
			$perusahaan=$_POST['tempat'];
			$no1 = $_POST['no1'];
			$no2 = $_POST['no2'];
			$no3 = $_POST['no3'];
			$no4 = $_POST['no4'];
			$no5 = $_POST['no5'];
			$no6 = $_POST['no6'];
			$no7 = $_POST['no7'];
			$no8 = $_POST['no8'];
			$no9 = $_POST['no9'];
			$nilai=$_POST['nilai'];
			$c1 = $_POST['c1'];
			$c2 = $_POST['c2'];
			$c3 = $_POST['c3'];
			$date=date('y-m-d');
			for ($i=0; $i<1;$i++){
				$sql3 = "INSERT INTO umpanbalik_i values(NULL,'$nim','$perusahaan', '$tahun','$no1[$i]','$no2[$i]','$no3[$i]','$no4[$i]','$no5[$i]','$no6[$i]','$no7[$i]','$no8[$i]','$no9[$i]', '$nilai','$c1','$c2','$c3', '$date')";
			$kueri3 = mysql_query($sql3);
			}
				if ($kueri3){
					echo "<script> alert('Berhasil mengisi umpan balik');document.location='perusahaan.php'</script>";
							}
				else {
					echo "<script> alert('Gagal mengisi umpan balik');document.location='umpanbalik.php'</script>";
					echo mysql_error();
					}
				
		} 
		if (isset($_POST['batal'])){
		echo "<script> document.location='perusahaan.php'</script>";
		
		}
						
		?>