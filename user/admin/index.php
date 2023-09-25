<?php 
session_start();
include "../../assets/koneksi.php";
// include "../../assets/phpqrcode/qrlib.php";
if ($_SESSION['login']!=true) {
  header("location:../../");
}else{
$lv = $_SESSION['level'];
$iduser = $_SESSION['id_user'];
if ($lv=="Wali Kelas") {
  $quser = mysqli_query($conn, "SELECT * from wali_kelas a left join guru b on a.id_guru = b.id_guru 
    left join kelas c on a.id_kelas = c.id_kelas
    where a.id_guru='$iduser'")or die(mysqli_error());
  $duser = mysqli_fetch_array($quser);
  $namauser= $duser['nama_guru'];
  $level = $lv.' '.$duser['nama_kelas'];
}
elseif ($lv=="Siswa") {
  $quser = mysqli_query($conn, "SELECT * from siswa where id_siswa='$iduser'")or die(mysqli_error());
  $duser = mysqli_fetch_array($quser);
  $namauser= $duser['nama_siswa'];
  $level = $lv;
}else{
  $quser = mysqli_query($conn, "SELECT * from admin where id='$iduser'")or die(mysqli_error());
  $duser = mysqli_fetch_array($quser);
  $namauser= $duser['nama_admin'];
  $level = $lv;

}

// $namauser= $duser['nama'];
  $gambar = "../../assets/user.jpg";



 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Administrator Page</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../../assets/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../assets/adminlte/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../../assets/adminlte/bower_components/Ionicons/css/ionicons.min.css">

    <!-- fullCalendar -->
  <link rel="stylesheet" href="../../assets/adminlte/bower_components/fullcalendar/dist/fullcalendar.min.css">
  <link rel="stylesheet" href="../../assets/adminlte/bower_components/fullcalendar/dist/fullcalendar.print.min.css" media="print">
  
<script src="../../assets/adminlte/bower_components/jquery/dist/jquery.min.js"></script>
  <!-- DataTables -->
  <link rel="stylesheet" href="../../assets/adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  
  <!-- Theme style -->
  <link rel="stylesheet" href="../../assets/adminlte/dist/css/AdminLTE.min.css">

 <script type="text/javascript" src="../../assets/adminlte/js/jquery.js"></script>

 <script type="text/javascript" src="../../assets/ckeditor/ckeditor.js"></script>


 
<!--  <script type="text/javascript" src="../../library/ckeditor/ckeditor.js"></script>
    <script src="../sweetalert/dist/sweetalert-dev.js"></script>
  <link rel="stylesheet" href="../sweetalert/dist/sweetalert.css"> -->
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../../assets/adminlte/dist/css/skins/_all-skins.min.css">






  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="../../assets/adminlte/index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><i class="fa fa-map"></i></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>SDN 15</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          
          <!-- Notifications: style can be found in dropdown.less -->
          
          <!-- Tasks: style can be found in dropdown.less -->
          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo  $gambar ?>" class="user-image" alt="<?php echo  $gambar ?>">
              <span class="hidden-xs"><?php echo $namauser; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- <?php echo   $gambar ?> -->
              <li class="user-header">
                <img src="<?php echo  $gambar ?>" class="img" alt="<?php echo   $gambar ?>">

                <p>
                  <?php echo $namauser; ?>  <br> <?php echo $level; ?>
                </p>
              </li>
              <!-- Menu Body -->
            
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="?a=edit_akun&id=<?php echo $_SESSION['id_user'] ?>" class="btn btn-default btn-flat">Ganti Password</a>
                  
                </div>
                <div class="pull-right">
                  <a href="../logout.php" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
        
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo  $gambar ?>" class="img" alt="<?php echo   $gambar ?>">
        </div>
        <div class="pull-left info">
          <p><?php echo $namauser; ?></p>
          <a href="#"><?php echo $level ?> </a>
        </div>
      </div>
      <!-- search form -->
     

      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Menu</li>
       
    <?php 
        if ($_SESSION['level']=="Administrator") { ?>
   <li class="treeview">
              <a href="#">
                <i class="fa fa-table"></i> <span>Data Siswa</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="?a=calon_siswa"><i class="fa fa-circle-o"></i>Calon Siswa (ok)</a></li>
                <li><a href="?a=siswa_aktif"><i class="fa fa-circle-o"></i>Data Siswa Aktif (ok)</a></li>
                <li><a href="?a=alumni"><i class="fa fa-circle-o"></i>Data Alumni</a></li>
              
                
              </ul>
            </li>     
       
        <li><a href="?a=guru"><i class="fa fa-book"></i> <span>Data Guru (ok)</span></a></li>      
        <li><a href="?a=kelas"><i class="fa fa-book"></i> <span>Kelas (ok)</span></a></li>      
        <li><a href="?a=mapel"><i class="fa fa-book"></i> <span>Mata Pelajaran (ok)</span></a></li>      
        <li><a href="?a=tahun_ajaran"><i class="fa fa-book"></i> <span>Tahun Ajaran (ok) </span></a></li>      
        <li><a href="?a=pengumuman"><i class="fa fa-book"></i> <span>Pengumuman (ok)</span></a></li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-table"></i> <span>Keuangan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="?a=penunjang"><i class="fa fa-circle-o"></i>Penunjang Belajar (ok)</a></li>
            <li><a href="?a=pengambilan"><i class="fa fa-circle-o"></i>Hutang Piutang</a></li>
            <!-- <li><a href="?a= q"><i class="fa fa-circle-o"></i>Hutang Piutang</a></li> -->
         <!--    <li class="treeview">
              <a href="#">
                <i class="fa fa-table"></i> <span>Daftar Harga</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="?a=calon_siswa"><i class="fa fa-circle-o"></i>Pengambilan LKS</a></li>
                
              
                
              </ul>
            </li>   -->
             
            
          </ul>
        </li>
        <?php }
        else if ($_SESSION['level']=="Siswa") { ?>
        <li><a href="index.php"><i class="fa fa-book"></i> <span>Dashboard (ok)</span></a></li>  
        <li><a href="?a=pengumuman"><i class="fa fa-book"></i> <span>Pengumuman (ok)</span></a></li>  
        <li><a href="?a=history_kelas"><i class="fa fa-book"></i> <span>History Kelas (ok)</span></a></li>      
        <li><a href="?a=detail_pengambilan&id_siswa=<?php echo $_SESSION['id_user'] ?>"><i class="fa fa-book"></i> <span>Hutang Piutang (ok)</span></a></li>      
        <?php }else{ ?>
        <li><a href="?a=pengumuman"><i class="fa fa-book"></i> <span>Pengumuman (ok)</span></a></li>  
        <li><a href="?a=siswa_pj_wk"><i class="fa fa-book"></i> <span>Nilai Siswa (ok)</span></a></li>      
        <li><a href="?a=absensi"><i class="fa fa-book"></i> <span>Absensi Siswa (ok)</span></a></li> 
        <!--  <li class="treeview">
          <a href="#">
            <i class="fa fa-table"></i> <span>Laporan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="?a=laporan_nilai"><i class="fa fa-circle-o"></i>Laporan Nilai Siswa</a></li>
          </ul>
        </li>      -->
        
             
        
        <?php }
         ?>
      
              

      
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          
          <!-- /.box -->

          <div class="box">
            <!-- <div class="box-header">
              <h3 class="box-title" id="judul_konten">Wellcome To Administrator Page</h3>
              <h3 class="box-title" id="btn_tambah" style="float:right;"></h3>
            </div> -->
            <!-- /.box-header -->
            <div class="box-body" >
             <?php 
             include "konten.php" ;
             ?>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.18
    </div>
    <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
 
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->

</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="../../assets/adminlte/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../../assets/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="../../assets/adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../../assets/adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="../../assets/adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../../assets/adminlte/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../assets/adminlte/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../assets/adminlte/dist/js/demo.js"></script>
<!-- page script -->






<!-- fullCalendar -->
<script src="../../assets/adminlte/bower_components/moment/moment.js"></script>
<script src="../../assets/adminlte/bower_components/fullcalendar/dist/fullcalendar.min.js"></script>






<script>
  $(function () {
    $('#example1').DataTable();
    $('#example3').DataTable()
    $('#tabelscrol').DataTable( {
    "scrollX": true
    } );
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
</body>
</html>

<?php } ?>