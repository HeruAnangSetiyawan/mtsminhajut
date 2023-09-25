
<?php
include "../../../../assets/koneksi.php";



$id_siswa		= $_POST['id_siswa'];
$id_kelas		= $_POST['id_kelas'];
$id_ta		= $_POST['id_ta'];


$qwk = mysqli_query($conn, "SELECT id_walikelas from wali_kelas where id_kelas = '$id_kelas' and status_wali_kelas='1'");
$dwk = mysqli_fetch_array($qwk);
$id_wk = $dwk['id_walikelas'];
//status_ks pada tabel adalah status kelas siswa apakah dia sedang aktif, tinggal, atau naik
$sql = "INSERT into kelas_siswa set
id_siswa='$id_siswa',
id_kelas='$id_kelas',
id_wali_kelas='$id_wk',
id_ta='$id_ta',
status_ks='Aktif'

";

$sql2 = mysqli_query($conn, "UPDATE siswa set status_siswa='Aktif' where id_siswa='$id_siswa'");
mysqli_query($conn, $sql)or die(mysqli_error());
?>
<script type='text/javascript'>
	alert('Data calon siswa berhasil disimpan');
	window.location.href="../../index.php?a=calon_siswa"
</script>
