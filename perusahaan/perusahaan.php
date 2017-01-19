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
                            Dashboard <small><?php echo $perusahaan?></small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Dashboard
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-info alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<?php
							if($email=="" && $kuota=="" && $ket==""){
								?>
								 <i class="fa fa-info-circle"></i> e-mail belum diisi!
								 <i class="fa fa-info-circle"></i> belum melakukan request magang!
							<?php
							}elseif ($email==""){
								?>
								 <i class="fa fa-info-circle"></i> e-mail belum diisi!
							<?php
							}elseif ($kuota=="" && $ket==""){
								?>
								 <i class="fa fa-info-circle"></i> belum melakukan request magang!
							<?php
							}
							else {
								?>

								 <i class="fa fa-info-circle"></i>
							<?php
							}
						?>
                            
                             <!--  <strong>Like SB Admin?</strong> Try out <a href="http://startbootstrap.com/template-overviews/sb-admin-2" class="alert-link">SB Admin 2</a> for additional features! -->
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                <!--<div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
							<?php
								include "koneksi.php";
								$sql_sp = "select * from sp WHERE perusahaan='$perusahaan'";
								$cek_sp = mysql_query($sql_sp);
								$data_sp = mysql_fetch_array($cek_sp);
								
								if($data_sp!=""){
								
								$sql1 = "select Count(*)  AS jumlah from magang WHERE perusahaan='$perusahaan' and verifikasi='Sudah'";
								$kueri1 = mysql_query($sql1);
								$data1 = mysql_fetch_array($kueri1);
								$jml = $data1['jumlah'];
								} else {
									$jml = 0;
								}
							?>
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-tasks fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $jml?></div>
                                        <div>Pendaftaran!</div>
                                    </div>
                                </div>
                            </div>
							<?php
								include "koneksi.php";
								if($kuota=="" and $ket==""){
								
								}
								else{
									?>
									<a href="http://localhost/ta2/upload-download-files/pendaftaran.php">
										<div class="panel-footer">
											<span class="pull-left">View Details</span>
											<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
											<div class="clearfix"></div>
										</div>
									</a>
									<?php	
										}
									?>
                        </div>
                    </div> -->
                    <!--<div class="col-lg-6 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
								<?php
								include "koneksi.php";
	
								$sql2 = "select Count(*)  AS jumlah from sp WHERE s_peru = 'Belum di Verifikasi'";
								$kueri2 = mysql_query($sql2);
								$data2 = mysql_fetch_array($kueri2);
								?>
                                    <div class="col-xs-3">
                                        <i class="fa fa-tasks fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $data2['jumlah']?></div>
                                        <div>Surat Pengantar!</div>
                                    </div>
                                </div>
                            </div>
							<?php
								include "koneksi.php";
								if($kuota=="" and $ket==""){
								
								}
								else{
									?>
									<a href="http://localhost/ta2/upload-download-files/sp.php">
										<div class="panel-footer">
											<span class="pull-left">View Details</span>
											<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
											<div class="clearfix"></div>
										</div>
									</a>
									<?php	
										}
									?>
                        </div>
                    </div> -->

                </div>
                <!-- /.row -->

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
