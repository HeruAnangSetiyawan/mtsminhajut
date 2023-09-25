<?php
include '../../../../koneksi.php';
$id=$_GET['id'];




$sql="DELETE from guru where id_guru='$id'";
$result=mysqli_query($conn, $sql) or die ('GAGAL');
?>
<script type="text/javascript">
	alert('Data guru dihapus');
	window.location.href='../../?a=guru'
</script>