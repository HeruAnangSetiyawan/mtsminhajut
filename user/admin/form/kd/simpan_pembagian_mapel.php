
<?php
include "../../../../assets/koneksi.php";


$id		= $_POST['id'];
$mapel		= $_POST['mapel'];
$jdata = count($mapel);
if ($jdata==0) { ?>

<script type='text/javascript'>
	alert('Anda belum memilih mapel');
	window.location.href="../../?a=kelola_mapel&id=<?php echo $id ?>";
</script>
<?php
	
}
else{
		$qdelete = mysqli_query($conn, "DELETE from pembagian_mapel where id_kelas='$id' ");
	foreach ($mapel as $idmapel) {
			$qinsert = mysqli_query($conn, "INSERT Into pembagian_mapel set id_mapel='$idmapel', id_kelas='$id'");
	}
?>


<script type='text/javascript'>
	alert('Data pembagian mapel diperbahari');
	window.location.href="../../index.php?a=pembagian_mapel";
</script>
<?php } ?>