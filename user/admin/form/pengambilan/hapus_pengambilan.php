
<?php 
include "../../../../assets/koneksi.php";
$id=$_GET['id'];

	$q1=mysqli_query($conn, "DELETE from pengambilan where id_pengambilan='$id'") or die(mysqli_error()); 
	
?>

	<script type="text/javascript">
		alert('Data pengambilan dihapus');
		window.location.href="../../?a=pengambilan"

	</script>