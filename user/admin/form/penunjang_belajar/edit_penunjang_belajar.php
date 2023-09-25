<div class="box-header with-border">
  <h3 class="box-title">Edit Data Penunjang Belajar</h3>

  <div class="box-tools pull-right">
    <a href="?a=penunjang_belajar" class="btn btn-info" >Kembali</a>
  </div>
</div>


<?php 
$id=$_GET['id'];
  $q1=mysqli_query($conn, "SELECT * from penunjang_belajar where id_penunjang='$id'") or die(mysqli_error());
  $d1=mysqli_fetch_array($q1);
  $j1=mysqli_num_rows($q1);
 ?>

<br>

<form action="form/penunjang_belajar/simpanedit_penunjang_belajar.php" method="post" enctype="multipart/form-data">
                  <input type="hidden" name="id" class="form-control" value="<?php echo $d1['id_penunjang'] ?>">
                
              <div class="form-group">
                  <label>Nama Penunjang Belajar</label>
                  <input type="text" name="nama" class="form-control" required value="<?php echo $d1['nama_penunjang'] ?>">
              </div> 
              <div class="form-group">
                   <label>Keterangan</label>
                  <textarea name="ket" class="form-control"><?php echo $d1['keterangan'] ?></textarea>
              </div> 
              <div class="form-group">
                  <label>Biaya</label>
                  <input type="number" name="biaya" class="form-control" required value="<?php echo $d1['biaya'] ?>">
              </div> 
              


              <div class="form-group">
                 <input type="submit" class="btn btn-info"  value="Simpan Perubahan Data">
              </div> 

              
          
</form>