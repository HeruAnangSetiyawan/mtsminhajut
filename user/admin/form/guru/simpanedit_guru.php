
<?php
include "../../../../assets/koneksi.php";


$id		= $_POST['id'];
$nama		= $_POST['nama'];
$jk		= $_POST['jk'];
$tmpl		= $_POST['tmpl'];
$tgll		= $_POST['tgll'];
$nip		= $_POST['nip'];
$jabatan		= $_POST['jabatan'];
$gol		= $_POST['gol'];
$tmt		= $_POST['tmt'];
$alamat		= $_POST['alamat'];
$nohp		= $_POST['nohp'];
$ijazah		= $_POST['ijazah'];


	$sql = "UPDATE guru set 	
	nama_guru = '$nama',
	jk = '$jk',
	tmpl = '$tmpl',
	tgll = '$tgll',
	nip = '$nip',
	gol = '$jabatan',
	jabatan = '$gol',
	tmt = '$tmt',
	alamat = '$alamat',
	nohp = '$nohp',
	ijazah_tahun  = '$ijazah'
	where id_guru='$id'
	
";

mysqli_query($conn, $sql)or die (mysqli_error());
?>
<script type='text/javascript'>
	alert('Data guru berhasil disimpan');
	window.location.href="../../index.php?a=guru"
</script>