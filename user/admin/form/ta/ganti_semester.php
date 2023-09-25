
<?php 
include "../../../../assets/koneksi.php";
$id=$_GET['id'];
$status="Selesai";
	$q1=mysqli_query($conn, "SELECT * from tahun_ajaran where no='$id'") or die(mysqli_error()); 
	$d1 = mysqli_fetch_array($q1);
	$nama_ta = $d1['nama_ta'];
	$id_ta = $d1['id_ta'];
	$semester = 2;

	$q_i = mysqli_query($conn, "INSERT into tahun_ajaran set
		id_ta='$id_ta',
		nama_ta='$nama_ta',
		semester = '$semester',
		status_ta = 'Aktif'
		");
	$q_u=mysqli_query($conn, "UPDATE tahun_ajaran set status_ta='$status'where no='$id'") or die(mysqli_error()); 

	
?>

	<script type="text/javascript">
		alert('Tahun ajaran aktif diperbaharui');
		window.location.href="../../?a=tahun_ajaran"

	</script>