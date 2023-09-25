
<?php 
include "../../../../assets/koneksi.php";
$id_siswa=$_GET['id_siswa'];
$id=$_GET['id'];
$kat=$_GET['kategori'];
if ($kat=='Pengambilan') {
	$q1=mysqli_query($conn, "DELETE from pengambilan where id_pengambilan='$id'") or die(mysqli_error()); 
}else{
	$q1=mysqli_query($conn, "DELETE from pembayaran where id_pembayaran='$id'") or die(mysqli_error()); 

}

	
?>

	<script type="text/javascript">
		alert('Data <?php echo $kat ?> dihapus');
		window.location.href="../../?a=detail_pengambilan&id_siswa=<?php echo $id_siswa ?>"

	</script>