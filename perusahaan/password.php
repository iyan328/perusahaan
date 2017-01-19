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
	$sql = "SELECT * FROM akun WHERE username='$nm'";
	$kueri = mysql_query($sql);
	$data = mysql_fetch_array($kueri);
	$user1 = $data['username'];
	$pass= $data['password'];
	$hak= $data['hak_akses'];
	
	$sql1 = "SELECT * FROM perusahaan WHERE username='$nm'";
	$kueri1 = mysql_query($sql1);
	$data1 = mysql_fetch_array($kueri1);
	$perusahaan = $data1['perusahaan'];
	$alamat= $data1['alamat'];
	$no_hp= $data1['no_hp'];
	$kuota = $data1['kuota'];
	$ket = $data1['keterangan'];
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
                        <li>
                            <a href="profile.php"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li>
                            <a href="password.php"><i class="fa fa-fw fa-gear"></i> Settings</a>
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
                    <li>
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
					<li class = "active">
                        <a href="setting.php"><i class="fa fa-fw fa-gear"></i> Setting</a>
						<ul>
							<li class = "active">
								<a href="password.php"><i class="fa fa-fw fa-edit"></i>Ubah Password</a>
							</li>
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
                            Ubah Password <small><?php echo $perusahaan?></small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
								<i class="fa fa-dashboard"></i>  <a href="perusahaan.php">Dashboard</a>
                            </li>
							<li>
                                <i class="fa fa-gear"></i> <a href="setting.php">Setting</a>
                            </li>
							<li class="active">
                                <i class="fa fa-edit"></i> Ubah Password
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->  
				<div class="row">
                    <div class="col-lg-4">
                        <form role="form" action="" method="post">
							<div class="form-group">
                                <label for="disabledSelect">Username</label>
                                <input name="user" class="form-control" id="disabledInput" type="text" value="<?php echo $user1?>" readonly>
                            </div>
							<div class="form-group">
								<label>Password</label>
								<input name="pass" type="password" class="form-control" placeholder="Password Baru">
								<!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>
							
							<button name="tblEdit" type="submit" class="btn btn-default">Ubah Password</button>
							<button name="batal" type="submit" class="btn btn-default">Batal</button>
						</form>
					</div>
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
			$user = $_POST['user'];
			$pass = $_POST['pass'];
			$hak = $_POST['hakakses'];
			if(empty($_POST['pass'])){
				echo "<script> alert('Password tidak boleh kosong');document.location='password.php'</script>";
			} else{
			$sql = "UPDATE akun set password='$pass' where username='$user'";
			$kueri = mysql_query($sql);
			if ($kueri){
				echo "<script> alert('Password berhasil diubah');document.location='setting.php'</script>";
			}
			else {
				echo "<script> alert('Pasword gagal diubah');document.location='password.php'</script>";
				echo mysql_error();
			}
			}
		}if (isset($_POST['batal'])){
			echo "<script>document.location='setting.php'</script>";
		}
						
		?>