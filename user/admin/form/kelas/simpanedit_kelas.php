
<?php
include "../../../../assets/koneksi.php";


$id		= $_POST['id'];
$nama		= $_POST['kelas'];

$tingkat		= $_POST['tingkat'];


$sql="UPDATE kelas set nama_kelas='$nama', tingkat='$tingkat'  where id_kelas='$id'";

mysqli_query($conn, $sql);
?>
<script type='text/javascript'>
	alert('Data kelas diperbaharui');
	window.location.href="../../index.php?a=kelas"
</script>