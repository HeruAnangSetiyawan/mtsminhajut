<?php 
include "../../../../assets/koneksi.php";

session_start();
$id = $_POST['id'];
$nama = $_POST['nama'];

$status = $_POST['status'];


			
	$q1=mysqli_query($conn, "UPDATE periode set 
		nama_periode='$nama',

		status='$status'
		where id_periode='$id'

		
		
		")or die(mysqli_error()); 
?>

	<script type="text/javascript">
		alert('Data periode berhasil disimpan');
		window.location.href="../../?a=periode"

	</script>