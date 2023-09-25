
<?php 
include "../../../../assets/koneksi.php";
$id=$_GET['id'];
$status="Selesai";
	$q1=mysqli_query($conn, "UPDATE tahun_ajaran set status_ta='$status'where no='$id'") or die(mysqli_error()); 

	
?>

	<script type="text/javascript">
		alert('Tahun ajaran aktif diperbaharui');
		window.location.href="../../?a=tahun_ajaran"

	</script>