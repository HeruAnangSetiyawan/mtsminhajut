<?php 
session_start();
include "../../../../assets/koneksi.php";
$id_wali_kelas = $_SESSION['id_user'];
$id_kelas = $_POST['id_kelas'];
$id_siswa = $_POST['id_siswa'];
$id_ta = $_POST['id_ta'];
$status_wali_kelas = $_POST['status_wali_kelas'];
$tingkat = $_POST['tingkat'];
$keputusan = $_POST['keputusan'];
$catatan = nl2br($_POST['catatan']);

$q = mysqli_query($conn, "UPDATE kelas_siswa set 
  status_ks='$keputusan',
  catatan_wali_kelas='$catatan'
  where id_siswa='$id_siswa' and id_kelas='$id_kelas' and id_ta='$id_ta'

  ");
 ?>
 <script type="text/javascript">
   alert('Keputusan kelulusan disimpan');
   window.location.href="../../?a=detail_siswa&id=<?php echo $id_siswa ?>&t=1&id_kelas=<?php echo $id_kelas ?>&id_ta=<?php echo $id_ta ?>&tingkat=<?php echo $tingkat ?>&status_wali_kelas=<?php echo $status_wali_kelas ?>&status_ks=<?php echo $keputusan ?>"

 </script>