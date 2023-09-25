<div class="box-header with-border">
  <h3 class="box-title">
    Perbaharui Mata Pelajaran
  </h3>
  <div class="pull-right">
  </div>
  
</div>


<div class="clearfix"></div>



<?php

$id=$_GET['id'];
include "../../koneksi.php";
  
  $perintah="SELECT * From mapel where id_mapel='$id'";
  $jalan=mysqli_query($conn, $perintah);
  $d1=mysqli_fetch_array($jalan);
  $no=1;
?>
<br>
<div class="col-md-12">
  
<form action="form/mapel/simpanedit_mapel.php" method="post">
  <div class="form-group">
    <label>Nama Mata Pelajaran</label>
    <input type="hidden" name="id" class="form-control" value="<?php echo $d1['id_mapel'] ?>">
    <input type="text" name="mapel" class="form-control" value="<?php echo $d1['nama_mapel'] ?>">
  </div>
  <div class="form-group">
    <button class="btn btn-info btn-sm">Simpan Perubahan</button>
    <a href="?a=mapel" class=" btn btn-info btn-sm" >Kembali</a>
  </div>
</form>
</div>