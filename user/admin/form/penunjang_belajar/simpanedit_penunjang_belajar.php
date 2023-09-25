<?php 
include "../../../../assets/koneksi.php";

$id=$_POST['id'];
$nama=$_POST['nama'];
$ket=$_POST['ket'];
$biaya=$_POST['biaya'];

	$q1=mysqli_query($conn, "UPDATE penunjang_belajar set 
		
		
		 nama_penunjang='$nama',
		 keterangan='$ket',
		 biaya = '$biaya'

		 where id_penunjang = '$id'
		
		")or die(mysqli_error()); 
?>

	<script type="text/javascript">
		alert('Data penunjang belajar berhasil diperbaharui');
		window.location.href="../../?a=penunjang"

	</script>
