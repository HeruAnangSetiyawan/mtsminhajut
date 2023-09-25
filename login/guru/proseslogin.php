<?php 
session_start();
include "../../koneksi.php";
$user=$_POST['username'];
$pass=$_POST['password'];

$sql= "SELECT * from guru where username='$user' and password='$pass'";
$q=mysqli_query($conn, $sql)or die(mysqli_error());
$data=mysqli_fetch_array($q);
 if ($user==$data['username'] and $pass==$data['password']) {
 	$_SESSION['login']=true;
	$_SESSION['id_user']=$data['id_guru'];
	$_SESSION['id_ptk']=$data['id_ptk'];
	$_SESSION['id_mapel']=$data['id_mapel'];
	$_SESSION['level']='Guru';
	header("Location:../../user/guru/");
 }
 else{ ?>
 	<script type="text/javascript">
 		alert('Login gagal\nUsername dan password salah');
 		window.location.href="index.html";
 	</script>
 <?php } ?>