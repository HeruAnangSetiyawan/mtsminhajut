<div class="box-header with-border">
  <h3 class="box-title">Edit Akun</h3>

  <div class="box-tools pull-right">
    <a href="?a=produk" class="btn btn-info" >Kembali</a>
  </div>
</div>


<?php 
$iduser = $_SESSION['id_user'];
$level = $_SESSION['level'];


echo $iduser;

if ($level=='Administrator') {
  $quser = mysqli_query($conn, "SELECT * from admin where id='$iduser'")or die(mysqli_error());
  $duser = mysqli_fetch_array($quser);
  $username=$duser['username'];
  $password=$duser['password'];
}
elseif ($level=='Siswa') {
  $quser = mysqli_query($conn, "SELECT * from siswa where id_siswa='$iduser'")or die(mysqli_error());
  $duser = mysqli_fetch_array($quser);
  $username=$duser['nis'];
  $password=$duser['password'];
}
else{
  $quser = mysqli_query($conn, "SELECT * from wali_kelas where id_guru='$iduser'")or die(mysqli_error());
  $duser = mysqli_fetch_array($quser);
  $username=$duser['username'];
  $password=$duser['password'];
}

 ?>

<br>

<form action="form/dashboard/simpanedit_akun.php" method="post" enctype="multipart/form-data">
 
    
                <div class="form-group">
                  <label>Username</label>
                  <input type="text" name="username" class="form-control" value="<?php echo $username ?>" <?php if ($level=='Siswa') {echo "readonly";} ?>>
              </div> 
              
              <div class="form-group">
                  <label>Password</label>
                  <input type="password" name="password" required class="form-control" value="<?php echo $password ?>">
              </div> 
              
              <div class="form-group">
                 <input type="submit" class="btn btn-info" onclick="return confirm('apakah data yang anda masukan sudah benar.?')" value="Simpan Perubahan Data">
              </div> 

</form>