
<?php
include "../../../../assets/koneksi.php";


$id_wali_kelas		= $_POST['id_wali_kelas'];
$id_kelas		= $_POST['id_kelas'];
$id_siswa		= $_POST['id_siswa'];
$id_ta		= $_POST['id_ta'];
$tingkat		= $_POST['tingkat'];


$status = 'Aktif';
// jenis status : Aktif, lanjut, tinggal
foreach ($id_siswa as $v) {
	// untuk naik kelas
	$tingkat_sebelumnya = $tingkat -1;
	$q_kelas_sebelumnya = mysqli_query($conn, "SELECT ks.id_kelas, ks.id_ta, k.tingkat from kelas_siswa ks 
		left join kelas k on ks.id_kelas = k.id_kelas
		where ks.id_siswa='$v' and ks.status_ks='Lanjut' and k.tingkat = '$tingkat'")or die(mysqli_error());
	$d_kelas_sebelumnya = mysqli_fetch_array($q_kelas_sebelumnya);
	$kelas_sebelumnya =  $d_kelas_sebelumnya['id_kelas'];
	$ta_sebelumnya =  $d_kelas_sebelumnya['id_ta'];
	$q_i = mysqli_query($conn, "INSERT into kelas_siswa set
		id_siswa = '$v',
		id_kelas = '$id_kelas',
		id_wali_kelas = '$id_wali_kelas',
		id_ta = '$id_ta',
		status_ks = '$status'
		")or die(mysqli_error());

	$u_status_siswa = mysqli_query($conn, "UPDATE siswa set status_siswa='Aktif' where id_siswa='$v'");


	$q_u = mysqli_query($conn, "UPDATE kelas_siswa set
		id_next_kelas='$id_kelas',
		id_ta_next='$id_ta'
		where id_siswa = '$v' and status_ks ='Lanjut' and id_kelas='$kelas_sebelumnya' and id_next_kelas =''
		")or die(mysqli_error());

	// untuk tinggal kelas


	$tingkat_sebelumnya = $tingkat +1 ;
	$q_kelas_sebelumnya = mysqli_query($conn, "SELECT ks.id_kelas, ks.id_ta, k.tingkat from kelas_siswa ks 
		left join kelas k on ks.id_kelas = k.id_kelas
		where ks.id_siswa='$v' and ks.status_ks='Tinggal' and k.tingkat = '$tingkat_sebelumnya'")or die(mysqli_error());
	$d_kelas_sebelumnya = mysqli_fetch_array($q_kelas_sebelumnya);
	$kelas_sebelumnya =  $d_kelas_sebelumnya['id_kelas'];
	$ta_sebelumnya =  $d_kelas_sebelumnya['id_ta'];
	$q_u = mysqli_query($conn, "UPDATE kelas_siswa set
		id_next_kelas='$id_kelas',
		id_ta_next='$id_ta'
		where id_siswa = '$v' and status_ks ='Tinggal' and id_kelas='$kelas_sebelumnya' and id_next_kelas =''
		")or die(mysqli_error());
}



?>
<script type='text/javascript'>
	alert('Data siswa berhasil disimpan');
	window.location.href="../../index.php?a=manage_kelas&id=<?php echo $id_kelas ?>"
</script>