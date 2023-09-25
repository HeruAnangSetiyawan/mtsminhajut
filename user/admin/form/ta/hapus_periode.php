
<?php 
include "../../../../assets/koneksi.php";
$id=$_GET['id'];
	$q1=mysqli_query($conn, "DELETE from periode where id_periode='$id'") or die(mysqli_error()); 

	
?>

	<script type="text/javascript">
		alert('Data periode dihapus');
		window.location.href="../../?a=periode"

	</script>