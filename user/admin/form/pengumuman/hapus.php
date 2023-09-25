<?php
include '../../../../assets/koneksi.php';

$idj=$_GET['id'];


$sql2="DELETE from pengumuman where id_pengumuman='$idj' ";
$result2=mysqli_query($conn, $sql2) or die(mysqli_error()) ;


?>

<script type="text/javascript">
	alert('Pengumuman dihapus');
	window.location.href="../../?a=pengumuman"
</script>
