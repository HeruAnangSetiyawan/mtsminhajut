<?php 
session_start();
include "../../koneksi.php";
$user=$_POST['username'];
$pass=$_POST['password'];

$sql= "SELECT * from siswa where email_siswa='$user' and password='$pass'";
$q=mysqli_query($conn, $sql)or die(mysqli_error());
$data=mysqli_fetch_array($q);
 if ($user==$data['email_siswa'] and $pass==$data['password']) {
 	$_SESSION['login']=true;
	$_SESSION['id_user']=$data['id_siswa'];

	$_SESSION['level']='Siswa';
	header("Location:../../user/siswa/");
 }
 else{ ?>
 	<script type="text/javascript">
 		alert('Login gagal\nUsername dan password salah');
 		window.location.href="index.html";
 	</script>
 <?php } ?>