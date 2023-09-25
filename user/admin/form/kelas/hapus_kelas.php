<?php
include '../../../../assets/koneksi.php';
$id=$_GET['id'];




$sql="DELETE from kelas where id_kelas='$id'";
$result=mysqli_query($conn, $sql) or die ('GAGAL');
?>
<script type="text/javascript">
	alert('Data Kelas Dihapus');
	window.location.href='../../?a=kelas'
</script>