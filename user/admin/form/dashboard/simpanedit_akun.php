<?php 
include "../../../../assets/koneksi.php";

session_start();


$id = $_SESSION['id_user'];
$level = $_SESSION['level'];


$username = $_POST['username'];
$password = $_POST['password'];



if ($level=='Wali Kelas') {
	$cek_username = mysqli_query($conn, "SELECT username from wali_kelas where username='$username' and id_guru !='$id'");
	$j_username = mysqli_num_rows($cek_username);
	if ($j_username==0) {
 		$q1=mysqli_query($conn, "UPDATE wali_kelas set 
		username='$username',
		password='$password'
		where id_guru='$id'
		")or die(mysqli_error()); 
		$alert = "Data diperbaharui";
	}else{
		$alert = "Data gagal diperbaharui. Username sudah dipakai";
	}
}
elseif ($level=='Siswa') {
	$q1=mysqli_query($conn, "UPDATE siswa set 
		password='$password'
		where id_siswa='$id'
		")or die(mysqli_error()); 
		$alert = "Data diperbaharui";
 
}
else{
	$cek_username = mysqli_query($conn, "SELECT username from admin where username='$username' and id !='$id'");
	$j_username = mysqli_num_rows($cek_username);
	if ($j_username==0) {
 		$q1=mysqli_query($conn, "UPDATE admin set 
		username='$username',
		password='$password'
		where id='$id'
		")or die(mysqli_error()); 
		$alert = "Data diperbaharui";
		# code...
	}else{
		$alert = "Data gagal diperbaharui. Username sudah dipakai";
	}
	
}

?>
			<script type="text/javascript">
		alert('<?php echo $alert ?>');
		window.location.href="../../";

	</script>
	