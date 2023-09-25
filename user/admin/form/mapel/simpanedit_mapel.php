
<?php
include "../../../../assets/koneksi.php";


$id		= $_POST['id_mapel'];
$tingkat		= $_POST['tingkat'];
$nama		= $_POST['mapel'];
$kkm		= $_POST['kkm'];

if ($kkm>100) { ?>
	<script type='text/javascript'>
	alert('Mata pelajaran gagal disimpan\nKKM tidak boleh lebih dari 100');
	window.location.href="../../index.php?a=manage_mapel&tingkat=<?php echo $tingkat ?>"
</script>
	
<?php }else{

$sql="UPDATE mapel set nama_mapel='$nama', kkm='$kkm' where id_mapel='$id'";

mysqli_query($conn, $sql);
?>

<script type='text/javascript'>
	alert('Mata pelajaran berhasil disimpan');
	window.location.href="../../index.php?a=manage_mapel&tingkat=<?php echo $tingkat ?>"
</script>
<?php } ?>