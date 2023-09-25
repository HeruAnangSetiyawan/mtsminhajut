
<?php 
include "../../../../assets/koneksi.php";
$id=$_GET['id'];

	$q1=mysqli_query($conn, "DELETE from penunjang_belajar where id_penunjang='$id'") or die(mysqli_error()); 
	
?>

	<script type="text/javascript">
		alert('Data penunjang belajar dihapus');
		window.location.href="../../?a=penunjang"

	</script>