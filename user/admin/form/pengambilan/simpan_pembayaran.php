<?php 
include "../../../../assets/koneksi.php";

$id_siswa=$_POST['id_siswa'];
$sisa=$_POST['sisa'];
$bayar=$_POST['bayar'];
$ket=$_POST['ket'];
$tgls = date('Y-m-d');
if ($bayar > $sisa) {
	$pesan = 'Data pembayaran gagal disimpan. \nJumlah pembayaran melebihi sisa pembayaran';
}else{

	$q1=mysqli_query($conn, "INSERT into pembayaran set 
		
		
		  
		 id_siswa='$id_siswa',
		 keterangan = '$ket',
		 jumlah = '$bayar',
		 tanggal_bayar = '$tgls'
		")or die(mysqli_error()); 
	$pesan = 'Data pembayaran disimpan';
}
?>

	<script type="text/javascript">
		alert("<?php echo $pesan ?>");
		window.location.href="../../?a=detail_pengambilan&id_siswa=<?php echo $id_siswa ?>"

	</script>
