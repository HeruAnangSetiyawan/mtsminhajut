<?php 
include "../../../../assets/koneksi.php";

session_start();

$nama = $_POST['nama'];

$status = 'Aktif';

$semester =1;
	
$q_cek = mysqli_query($conn, "SELECT max(id_ta) as urutan from tahun_ajaran");
$d_cek = mysqli_fetch_array($q_cek);
$id_ta = $d_cek['urutan']=='' ? 0 : $d_cek['urutan'];
$next_id_ta = $id_ta +1;
	$q1=mysqli_query($conn, "INSERT into tahun_ajaran set 
		id_ta='$next_id_ta',
		nama_ta='$nama',
		status_ta='$status',
		semester='$semester'
		")or die(mysqli_error()); 
?>

	<script type="text/javascript">
		alert('Data tahun ajaran berhasil disimpan');
		window.location.href="../../?a=tahun_ajaran"

	</script>