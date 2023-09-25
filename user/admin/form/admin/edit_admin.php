
<?php 
$id=$_GET['id'];

  $q1=mysqli_query($conn, "SELECT * from admin where id='$id'") or die(mysqli_error());
  $d1=mysqli_fetch_array($q1);


 ?>
<div class="box-header with-border">
   <h3 class="box-title">Perbaharui Data admin </h3>

  <div class="box-tools pull-right">
    <a href="?a=admin" class="btn btn-info" >Kembali</a>
  </div>
</div>


<br>

<form action="form/admin/simpanedit_admin.php" method="post" enctype="multipart/form-data">
    <div class="form-group">
                  <label>Nama User</label>
                  <input type="hidden" name="id" class="form-control" value="<?php echo $id ?>">
                  
                  <input type="text" name="nama" class="form-control" value="<?php echo $d1['nama'] ?>">
              </div> 
              <div class="form-group">
                  <label>Username</label>
                  <input type="text" name="username" class="form-control" value="<?php echo $d1['username'] ?>">
              </div> 
              <div class="form-group">
                  <label>Password</label>
                  <input type="password" name="password" class="form-control" value="<?php echo $d1['password'] ?>">
              </div> 
              <div class="form-group">
                  <button type="submit" class="btn btn-primary" onclick="return confirm('Apakah data yang anda masukan sudah benar.?')">Simpan Admin</button>
              </div> 


                
          
</form>