<?php
session_start();

if (isset($_SESSION['login'])) {
	$daftar_via =  "Offline";
	# code...
}else{
	$daftar_via =  "Online";
}
include "../../../../assets/koneksi.php";
$nama_siswa		= $_POST['nama_siswa'];
$nis		= $_POST['nis'];
// $nisn		= $_POST['nisn'];
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
$status		= $_POST['status_siswa'];
$keterangan		= $_POST['keterangan'];
$kelas		= $_POST['kelas'];


$password		= 123;

	$ekstensi_diperbolehkan	= array('png','jpg','PNG','JPG','JPEG');
			$nama = $_FILES['file']['name'];
			$x = explode('.', $nama);
			$ekstensi = strtolower(end($x));
			$ukuran	= $_FILES['file']['size'];
			$file_tmp = $_FILES['file']['tmp_name'];
			$namabaru = date('ymdhis').$nama;
 
			if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
					move_uploaded_file($file_tmp, 'foto/'.$namabaru);

$sql = "INSERT into siswa set
nama_siswa='$nama_siswa',

nis='$nis',

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
status_siswa='$status',
daftar_via='$daftar_via',
foto='$namabaru',
keterangan='$keterangan',
kelas_awal='$kelas'
";

mysqli_query($conn, $sql)or die(mysqli_error());
?>
<script type='text/javascript'>
	alert('Data calon siswa berhasil disimpan');
	window.location.href="../../index.php?a=calon_siswa"
</script>
<?php }else{ ?>
	<script type="text/javascript">
		alert('Calon siswa gagal disimpan\nharap pilih file gambar dengan benar');
		window.location.href="../../?a=tambah_siswa"

	</script>
<?php } ?>