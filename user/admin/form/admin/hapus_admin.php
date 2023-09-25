
<?php 
include "../../../../assets/koneksi.php";
$id=$_GET['id'];


	$q1=mysqli_query($conn, "DELETE from admin where id='$id'") or die(mysqli_error()); 

	
	
?>

	<script type="text/javascript">
		alert('Data Admin dihapus');
		window.location.href="../../?a=admin"

	</script>