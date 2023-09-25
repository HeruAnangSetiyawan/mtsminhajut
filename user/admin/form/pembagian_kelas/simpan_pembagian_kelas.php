
<?php
include "../../../koneksi.php";


$id		= $_POST['id'];
$kelas		= $_POST['kelas'];
$jdata = count($kelas);
if ($jdata==0) { ?>

<script type='text/javascript'>
	alert('Anda belum memilih kelas');
	window.location.href="../../?a=kelola_kelas&id=<?php echo $id ?>";
</script>
<?php
	
}
else{
		$qdelete = mysqli_query($conn, "DELETE from pembagian_kelas where id_guru='$id' ");
	foreach ($kelas as $idkelas) {
			$qinsert = mysqli_query($conn, "INSERT Into pembagian_kelas set id_kelas='$idkelas', id_guru='$id'");
	}
?>


<script type='text/javascript'>
	alert('Data pembagian kelas diperbahari');
	window.location.href="../../index.php?a=pembagian_kelas";
</script>
<?php } ?>