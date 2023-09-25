<?php
include '../../../../assets/koneksi.php';
$id=$_GET['id'];
$id_kelas=$_GET['id_kelas'];




$sql="DELETE from kelas_siswa where id_ks='$id'";
$result=mysqli_query($conn, $sql) or die ('GAGAL');
?>
<script type="text/javascript">
	alert('Data Siswa Dihapus');
	window.location.href='../../?a=manage_kelas&id=<?php echo $id_kelas ?>'
</script>