
<?php
include "../../../../assets/koneksi.php";


$nama		= $_POST['kelas'];
$tingkat		= $_POST['tingkat'];


$sql = "INSERT into kelas (nama_kelas, tingkat)
values('$nama', '$tingkat')";

mysqli_query($conn, $sql);
?>
<script type='text/javascript'>
	alert('Data kelas berhasil disimpan');
	window.location.href="../../index.php?a=kelas"
</script>