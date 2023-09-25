
<?php
include "../../../../assets/koneksi.php";


$nama		= $_POST['mapel'];
$kkm		= $_POST['kkm'];
$tingkat		= $_POST['tingkat'];

if ($kkm>100) { ?>
	<script type='text/javascript'>
	alert('Mata pelajaran gagal disimpan\nKKM tidak boleh lebih dari 100');
	window.location.href="../../index.php?a=manage_mapel&tingkat=<?php echo $tingkat ?>"
</script>
	
<?php }else{

$sql = "INSERT into mapel (tingkat,nama_mapel, kkm)
values('$tingkat','$nama','$kkm')";




mysqli_query($conn, $sql);
?>
<script type='text/javascript'>
	alert('Mata pelajaran berhasil disimpan');
	window.location.href="../../index.php?a=manage_mapel&tingkat=<?php echo $tingkat ?>"
</script>
<?php } ?>