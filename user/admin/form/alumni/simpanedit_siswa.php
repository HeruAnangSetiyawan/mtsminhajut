
<?php
include "../../../../assets/koneksi.php";



$id		= $_POST['id'];
$nama_siswa		= $_POST['nama_siswa'];
$nis		= $_POST['nis'];
$nisn		= $_POST['nisn'];
$tmpl		= $_POST['tmpl'];
$tgll		= $_POST['tgll'];
$jk		= $_POST['jk'];
$agama		= $_POST['agama'];

$alamat		= $_POST['alamat'];
$no_telp		= $_POST['no_telp'];
$pendidikan_sebelumnya		= $_POST['pendidikan_sebelumnya'];
$nama_ayah		= $_POST['nama_ayah'];
$nama_ibu		= $_POST['nama_ibu'];
$kerja_ayah		= $_POST['kerja_ayah'];
$kerja_ibu		= $_POST['kerja_ibu'];
$fotolama		= $_POST['fotolama'];
$t		= $_POST['t'];
$status_siswa		= $_POST['status_siswa'];


$password		= 123;

	$ekstensi_diperbolehkan	= array('png','jpg','PNG','JPG','JPEG');
			$nama = $_FILES['file']['name'];
			$x = explode('.', $nama);
			$ekstensi = strtolower(end($x));
			$ukuran	= $_FILES['file']['size'];
			$file_tmp = $_FILES['file']['tmp_name'];
			$namabaru = date('ymdhis').$nama;
 if ($nama) {
 	







 		if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
					move_uploaded_file($file_tmp, 'foto/'.$namabaru);

$sql = "UPDATE siswa set
nama_siswa='$nama_siswa',

nis='$nis',
nisn='$nisn',
tmpl='$tmpl',
tgll='$tgll',
jk='$jk',
agama='$agama',

alamat='$alamat',
no_telp='$no_telp',
pendidikan_sebelumnya='$pendidikan_sebelumnya',
nama_ayah='$nama_ayah',
nama_ibu='$nama_ibu',
kerja_ayah='$kerja_ayah',
kerja_ibu='$kerja_ibu',
password='$password',
status_siswa='Calon Siswa',
daftar_via='Offline',
foto='$namabaru'
where id_siswa='$id'
";


mysqli_query($conn, $sql)or die(mysqli_error());
@unlink('foto/'.$fotolama);
?>
<script type='text/javascript'>
	alert('Data calon siswa berhasil diperbaharui');
	window.location.href="../../index.php?a=detail_siswa&id=<?php echo $id ?>&t=<?php echo $t ?>&status=<?php echo $status_siswa ?>"
</script>
<?php }else{ ?>
	<script type="text/javascript">
		alert('Calon siswa gagal diperbaharui\nharap pilih file gambar dengan benar');
		window.location.href="../../?a=edit_siswa&id=<?php echo $id ?>"

	</script>
<?php } ?>




<?php }else{
 	$sql = "UPDATE siswa set
nama_siswa='$nama_siswa',

nis='$nis',
nisn='$nisn',
tmpl='$tmpl',
tgll='$tgll',
jk='$jk',
agama='$agama',

alamat='$alamat',
no_telp='$no_telp',
pendidikan_sebelumnya='$pendidikan_sebelumnya',
nama_ayah='$nama_ayah',
nama_ibu='$nama_ibu',
kerja_ayah='$kerja_ayah',
kerja_ibu='$kerja_ibu',
password='$password',
status_siswa='Calon Siswa',
daftar_via='Offline'
where id_siswa='$id'
";

mysqli_query($conn, $sql)or die(mysqli_error());
?>
<script type='text/javascript'>
	alert('Data calon siswa berhasil diperbaharui');
	window.location.href="../../index.php?a=detail_siswa&id=<?php echo $id ?>&t=<?php echo $t ?>&status=<?php echo $status_siswa ?>"
</script>
<?php 
 } ?>
