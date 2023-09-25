<?php
include '../../../../assets/koneksi.php';
$id=$_GET['id'];





$sql="DELETE from siswa where id_siswa='$id'";
$sql2="DELETE from nilai where id_siswa='$id'";
$sql3="DELETE from absensi where id_siswa='$id'";
$sql4="DELETE from kelas_siswa where id_siswa='$id'";
$result=mysqli_query($conn, $sql) or die ('GAGAL');
$result2=mysqli_query($conn, $sql2) or die ('GAGAL');
$result3=mysqli_query($conn, $sql3) or die ('GAGAL');
$result4=mysqli_query($conn, $sql4) or die ('GAGAL');
?>
<script type="text/javascript">
	alert('Data siswa dihapus');
	window.location.href='../../?a=calon_siswa'
</script>