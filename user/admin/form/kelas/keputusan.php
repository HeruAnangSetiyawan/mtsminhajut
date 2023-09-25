<?php
include '../../../../assets/koneksi.php';
$id=$_GET['id'];
$status_ks=$_GET['status_ks'];
$id_ta=$_GET['id_ta'];
$id_kelas=$_GET['id_kelas'];




$sql="UPDATE kelas_siswa set status_ks='$status_ks' where id_ks='$id'";
$result=mysqli_query($conn, $sql) or die ('GAGAL');
?>
<script type="text/javascript">
	alert('Data Keputusan Disimpan');
	window.location.href='../../?a=manage_history_kelas&id=<?php echo $id_kelas ?>&id_ta=<?php echo $id_ta ?>'
</script>