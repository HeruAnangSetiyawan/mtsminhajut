
<?php
include "../../../../assets/koneksi.php";


$id_kelas		= $_POST['id_kelas'];
$wali		= $_POST['wali'];
$id_wali_sebelumnya		= $_POST['id_wali_sebelumnya'];
$q  =mysqli_query($conn, "SELECT * from guru where id_guru='$wali'");
$d = mysqli_fetch_array($q);
$nip = $d['nip'];
if ($wali=="") { ?>

<script type='text/javascript'>
	alert('Data wali kelas gagal disimpan\nHarap pilih wali kelas');
	window.location.href="../../index.php?a=manage_kelas&id=<?php echo $id_kelas ?>"
</script>
<?php 
}else{
$q = mysqli_query($conn, "UPDATE wali_kelas set status_wali_kelas='0' where id_kelas='$id_kelas' and id_guru='$id_wali_sebelumnya'");

$sql = "INSERT into wali_kelas (id_guru, id_kelas, username, password, status_wali_kelas)
values('$wali', '$id_kelas','$nip','123','1')";

mysqli_query($conn, $sql);
?>
<script type='text/javascript'>
	alert('Data wali kelas berhasil disimpan');
	window.location.href="../../index.php?a=manage_kelas&id=<?php echo $id_kelas ?>"
</script>
<?php } ?>