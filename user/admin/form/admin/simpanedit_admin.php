<?php 
include "../../../../assets/koneksi.php";

session_start();
$id = $_POST['id'];
$nama = $_POST['nama'];
$username = $_POST['username'];
$password = $_POST['password'];

$cek = mysqli_query($conn, "SELECT * from admin where username='$username' and password='$password'");
$jcek = mysqli_num_rows($cek);
if ($jcek==0) {
						
	$q1=mysqli_query($conn, "UPDATE admin set 
		
		
		nama='$nama',
		username='$username',
		password='$password'
		where id = '$id'
		
		
		")or die(mysqli_error()); 
?>

	<script type="text/javascript">
		alert('Data admin berhasil disimpan');
		window.location.href="../../?a=admin"

	</script>
	<?php }else{ 
		?>
		<script type="text/javascript">
		alert('Data admin gagal disimpan\nusername dan password sudah digunakan\nsilahkan menggunakan username dan password lain');
		window.location.href="../../?a=admin"

	</script>


<?php 	} ?>