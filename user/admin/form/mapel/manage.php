<?php

$tingkat=$_GET['tingkat'];


?>
<div class="box-header with-border">
  <h3 class="box-title">
    Manajemen Mata Pelajaran Untuk Kelas <?php echo $tingkat ?> <br>

  </h3>
<div class="pull-right">
      <a href="?a=kelas" class="btn btn-info btn-sm"  >Kembali</a>
      <a href="" class=" btn btn-info btn-sm"  data-toggle="modal" data-target="#addmapel">Tambah Mata Pelajaran</a>
    </div>
  
</div>



<form action="form/mapel/simpan_mapel.php" method="post"  enctype="multipart/form-data">
<div class="modal fade" id="addmapel">
          <div class="modal-dialog ">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Mata Pelajaran</h4>
              </div>
              <div class="modal-body">
                <div class="form-group">
                   <table class="table">
                          <tr>
                            <td>Mata Pelajaran</td>
                            <td>:</td>
                            <td>
                              <input type="hidden" name="tingkat" class="form-control" value="<?php echo $tingkat ?>">
                              <input type="text" name="mapel" class="form-control">
                            </td>
                          </tr>
                          <tr>
                            <td>KKM</td>
                            <td>:</td>
                            <td>
                              <input type="number" name="kkm" class="form-control">
                            </td>
                          </tr>
                        </table>
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



  
 
  $no=1;
?>
<br>
  <table class="table table-striped table-bordered" id="example1">
  	<thead>
  	<tr>
  		<td>No</td>
      <td>Mata Pelajaran</td>
      <td>KKM</td>
  		<td>Option</td>
  	</tr>
  </thead>
  	

  <?php
$mapel = mysqli_query($conn, "SELECT * from mapel where tingkat='$tingkat'");
  while ($data=mysqli_fetch_array($mapel))
  { 
    $id_mapel = $data['id_mapel'];
    $qmapel = mysqli_query($conn, "SELECT * from mapel where id_mapel = '$id_mapel'");
    $dmapel = mysqli_fetch_array($qmapel);

  ?>






  	<tr>
  		<td><?php echo $no++; ?></td>
  	

  		
    
    <td><?php echo $data['nama_mapel']; ?></td>
    <td><?php echo $data['kkm']; ?></td>
   
  	
  	<td>
              <a href="" class=" btn btn-warning btn-xs"  data-toggle="modal" data-target="#editmapel_<?php echo $data['id_mapel'] ?>">Edit</a>
      <a href="form/mapel/hapus_mapel.php?id_mp=<?php echo $data['id_mapel'] ?>&tingkat=<?php echo $tingkat ?>" class="btn btn-danger btn-xs" onclick="return confirm('Hapus mata pelajaran..?')">Hapus</a> 
      
      <form action="form/mapel/simpanedit_mapel.php" method="post"  enctype="multipart/form-data">
        <div class="modal fade" id="editmapel_<?php echo $data['id_mapel'] ?>">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Edit Mata Pelajaran</h4>
                      </div>
                      <div class="modal-body">
                        <table class="table">
                          <tr>
                            <td>Mata Pelajaran</td>
                            <td>:</td>
                            <input type="hidden" name="id_mapel" class="form-control" value="<?php echo $id_mapel ?>">
                            <input type="hidden" name="tingkat" class="form-control" value="<?php echo $tingkat ?>">
                            <td><input type="text" name="mapel" class="form-control" value="<?php echo $dmapel['nama_mapel'] ?>" style="width:100%"></td>
                          </tr>
                          <tr>
                            <td>KKM</td>
                            <td>:</td>
                            <td><input type="number" name="kkm" class="form-control" value="<?php echo $dmapel['kkm'] ?>" style="width:100%"></td>
                          </tr>
                        </table>
                        
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
  	</td>
  		</tr>



  		<?php } ?>
  				
  	</table>