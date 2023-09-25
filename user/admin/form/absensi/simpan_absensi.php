<?php 
session_start();
include "../../../../assets/koneksi.php";
$id_wali_kelas = $_SESSION['id_user'];

$sakit = $_POST['sakit'];
$izin = $_POST['izin'];
$alfa = $_POST['alfa'];
$id_kelas = $_POST['id_kelas'];
$id_siswa = $_POST['id_siswa'];
$id_ta = $_POST['id_ta'];
$semester = $_POST['semester'];

$q_absen = mysqli_query($conn, "SELECT * from absensi where id_kelas='$id_kelas' and id_siswa='$id_siswa' and id_ta='$id_ta' and semester='$semester'");
$j_absen = mysqli_num_rows($q_absen);

if ($j_absen=='0') {
  $q_i = mysqli_query($conn, "INSERT into absensi set 
    id_kelas='$id_kelas',
    id_ta='$id_ta',
    semester='$semester',
    id_siswa='$id_siswa',
    sakit='$sakit',
    izin='$izin',
    alfa='$alfa'
    ")or die(mysqli_error());
}else{
  $q_u = mysqli_query($conn, "UPDATE absensi set 
    sakit='$sakit',
    izin='$izin',
    alfa='$alfa'
    where id_kelas='$id_kelas' and
    id_ta='$id_ta' and
    id_siswa='$id_siswa'
    ")or die(mysqli_error());
}
 ?>
 <script type="text/javascript">
   alert('Data absensi siswa disimpan');
   window.location.href="../../?a=data_absensi_siswa_perkelas&id_kelas=<?php echo $id_kelas ?>&id_ta=<?php echo $id_ta ?>&semester=<?php echo $semester ?>"

 </script>