
<?php
include "../../../../assets/koneksi.php";


$id		= $_POST['id'];
$nama		= $_POST['mapel'];
$kkm		= $_POST['kkm'];

$sql="UPDATE mapel set nama_mapel='$nama', kkm='$kkm' where id_mapel='$id'";

mysqli_query($conn, $sql);
?>
<script type='text/javascript'>
	alert('Mata pelajaran berhasil diperbaharui');
	window.location.href="../../index.php?a=mapel"
</script>