<?php 
include "../../../../assets/koneksi.php";

$nama=$_POST['nama'];
$ket=$_POST['ket'];
$biaya=$_POST['biaya'];
	$q1=mysqli_query($conn, "INSERT into penunjang_belajar set 
		
		
		  
		 nama_penunjang='$nama',
		 keterangan = '$ket',
		 biaya = '$biaya'
		")or die(mysqli_error()); 
?>

	<script type="text/javascript">
		alert('Data penunjang belajar berhasil disimpan');
		window.location.href="../../?a=penunjang"

	</script>
