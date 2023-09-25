
<?php
include "../../../../assets/koneksi.php";


$nama		= $_POST['mapel'];
$kkm		= $_POST['kkm'];
$id		= $_POST['id_kelas'];

if ($kkm>100) { ?>
	<script type='text/javascript'>
	alert('Mata pelajaran gagal disimpan\nKKM tidak boleh lebih dari 100');
	window.location.href="../../index.php?a=manage_kelas&id=<?php echo $id ?>"
</script>
	
<?php }else{

$sql = "INSERT into mapel (id_kelas,nama_mapel, kkm)
values('$id','$nama','$kkm')";




mysqli_query($conn, $sql);
?>
<script type='text/javascript'>
	alert('Mata pelajaran berhasil disimpan');
	window.location.href="../../index.php?a=manage_kelas&id=<?php echo $id ?>"
</script>
<?php } ?>