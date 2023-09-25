<div class="box-header with-border">
  <h3 class="box-title">
    Data Mata Pelajaran
  </h3>
  <div class="pull-right">
    <a href="" class=" btn btn-info btn-sm"  data-toggle="modal" data-target="#addmapel">Tambah Mata Pelajaran</a>
  </div>
  
</div>

<form action="form/mapel/simpan_mapel.php" method="post"  enctype="multipart/form-data">
<div class="modal fade" id="addmapel">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Mata Pelajaran</h4>
              </div>
              <div class="modal-body">
              <div class="form-group">
                  <label>Nama Mata Pelajaran</label>
                  <input type="text" name="mapel" class="form-control">
              </div>
              <div class="form-group">
                  <label>KKM</label>
                  <input type="number" name="kkm" class="form-control">
              </div>
            </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan Mata Pelajaran</button>
               
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
</form>

<div class="clearfix"></div>



<?php



  
  $perintah="SELECT * From mapel";
  $jalan=mysqli_query($conn, $perintah);

  $total = mysqli_num_rows($jalan);
  $no=1;
?>
<table class="table table-striped table-bordered" id="example1">
	<thead>
	<tr>
		<td>No</td>
    <td>Nama Mata Pelajaran</td>
		<td>KKM</td>
		
		<td>Option</td>
	</tr>
</thead>
	

<?php

while ($data=mysqli_fetch_array($jalan))
{ 
$id=$data['id_mapel'];
$mapel=$data['nama_mapel'];
$kkm=$data['kkm'];


?>
	<tr>
		<td><?php echo $no++; ?></td>
	

		
  <td><?php echo $mapel; ?></td>
	<td><?php echo $kkm; ?></td>
	
	<td>
    <a href="?a=edit_mapel&id=<?php echo $id ?>" class="btn btn-warning btn-xs">Edit</a> 
    <a href="form/mapel/hapus_mapel.php?id=<?php echo $id ?>" class="btn btn-danger btn-xs" onclick="return confirm('Apakah anda akan menghapus mata pelajaran <?php echo $mapel ?>.?')">Hapus</a> 
    <!-- <a href="form/mapel/addpaket.php?id=<?php echo $id ?>" class="btn btn-danger btn-xs" onclick="return confirm('Apakah anda akan menghapus mata pelajaran <?php echo $mapel ?>.?')">Aktifkan Ujian</a>  -->
	</td>
		</tr>

		<?php } ?>
				
	</table>
