<?php
include '../../../../assets/koneksi.php';
$id_mp=$_GET['id_mp'];
$id_kelas=$_GET['id_kelas'];




$sql="DELETE from mapel where id_mapel='$id_mp'";
$result=mysqli_query($conn, $sql) or die ('GAGAL');
?>
<script type="text/javascript">
	alert('Mata pelajaran dihapus');
	window.location.href="../../index.php?a=manage_kelas&id=<?php echo $id_kelas ?>"
</script>