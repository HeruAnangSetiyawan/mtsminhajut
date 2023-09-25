
<?php 
$id = $_GET['id'];

  $q1=mysqli_query($conn, "SELECT * from periode where id_periode='$id'");

  $j1=mysqli_num_rows($q1);
  $d = mysqli_fetch_array($q1);
  $no=1;
 ?>

 <div class="box-header with-border">
  <h3 class="box-title">Edit periode kepengurusan <br><?php echo $_SESSION['ukm'] ?></h3>


</div>

<form action="form/periode/simpanedit_periode.php" method="post" enctype="multipart/form-data">
 <div class="form-group">
                  <label>Nama periode</label>
                  <input type="hidden" name="id" class="form-control" value="<?php echo  $d['id_periode'] ?>" >
                  <input type="text" name="nama" class="form-control" value="<?php echo  $d['nama_periode'] ?>" >
              </div> 
              
            
            
            
              <div class="form-group">
                  <label>Status</label>
                  <input type="text" name="status" readonly class="form-control" value="<?php echo  $d['status'] ?>" >
              </div> 
             
              
             
              <div class="form-group">
                <button type="submit" class="btn btn-info">Simpan</button>
              </div>
</form>

