<?php
include '../../../../assets/koneksi.php';
$id=$_GET['id_mp'];
$tingkat=$_GET['tingkat'];




$sql="DELETE from mapel where id_mapel='$id'";
$result=mysqli_query($conn, $sql) or die ('GAGAL');
?>
<script type="text/javascript">
	alert('Data mata pelajaran Dihapus');
	window.location.href='../../?a=manage_mapel&tingkat=<?php echo $tingkat ?>'
</script>