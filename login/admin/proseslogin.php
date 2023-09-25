<?php 
session_start();
include "../../koneksi.php";
$user=$_POST['username'];
$pass=$_POST['password'];

$sql= "SELECT * from admin where username='$user' and password='$pass'";
$q=mysqli_query($conn, $sql);
$data=mysqli_fetch_array($q);
 if ($user==$data['username'] and $pass==$data['password']) {
 	$_SESSION['login']=true;
	$_SESSION['id_user']=$data['id'];
	$_SESSION['level']=$data['level'];
	header("Location:../../user/admin/");
 }
 else{ ?>
 	<script type="text/javascript">
 		alert('Login gagal\nUsername dan password salah');
 		window.location.href="index.html";
 	</script>
 <?php } ?>