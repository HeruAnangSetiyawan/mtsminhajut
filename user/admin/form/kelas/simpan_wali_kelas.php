
<?php
include "../../../../assets/koneksi.php";


$id_kelas		= $_POST['id_kelas'];
@$wali		= $_POST['wali'];
	
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


$sql = "INSERT into wali_kelas (id_guru, id_kelas, username, password, status_wali_kelas)
values('$wali', '$id_kelas','$nip','123','1')";

mysqli_query($conn, $sql);
?>
<script type='text/javascript'>
	alert('Data wali kelas berhasil disimpan');
	window.location.href="../../index.php?a=manage_kelas&id=<?php echo $id_kelas ?>"
</script>
<?php } ?>