<div class="box-header with-border">
  <h3 class="box-title">Data Admin</h3>

  <div class="box-tools pull-right">
    <!-- <a href="" class="btn btn-default btn-sm"  target="_blank">Print Data Paket</a> -->
    <a href="#" class="btn btn-info btn-sm"  data-toggle="modal" data-target="#addballroom">Tambah Admin</a>
  </div>
</div>

<form action="form/admin/simpan_admin.php" method="post" enctype="multipart/form-data">
<div class="modal fade" id="addballroom">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Admin</h4>
              </div>
              <div class="modal-body">
          
                
              <div class="form-group">
                  <label>Nama Admin</label>
                  <input type="hidden" name="id" class="form-control" value="<?php echo $id ?>">
                  <input type="text" name="nama" class="form-control">
              </div> 
              <div class="form-group">
                  <label>Username</label>
                  <input type="text" name="username" class="form-control">
              </div> 
              <div class="form-group">
                  <label>Password</label>
                  <input type="password" name="password" class="form-control">
              </div> 
              
             
            </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" onclick="return confirm('Apakah data yang anda masukan sudah benar.?')">Simpan Admin</button>
               
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
</form>




<hr>
<?php 
  $q1=mysqli_query($conn, "SELECT * from admin");
  $no=1;
 ?>

 <table class="table table-striped table-bordered" id="example1">
    <thead>
      <tr>
        <td>No</td>
        
        <td>Nama Admin</td>
        <td>Username</td>
        <td>Password</td>
        <td>Level</td>
       
        <td>Option</td>
      </tr>
    </thead>
  <?php 
  while ($d1=mysqli_fetch_array($q1)) { 
    ?>
  <tr>
    <td><?php echo $no++ ?></td>
    <td><?php echo $d1['nama'] ?></td>
    <td><?php echo $d1['username'] ?></td>
    <td><?php echo $d1['password'] ?></td>
    <td><?php echo $d1['level'] ?></td>
   
   
    <td>
      <?php if ($_SESSION['id_user']==$d1['id']) {
        echo "Sedang Aktif";
      }else{ ?>
      <a href="form/admin/hapus_admin.php?id=<?php echo $d1['id'] ?>" class="btn btn-info btn-xs" onclick="return confirm('Apakah anda yakin..??')">Hapus</a>    
      <a href="?a=edit_admin&id=<?php echo $d1['id'] ?>" class="btn btn-info btn-xs">Edit</a>    
    <?php } ?>
    </td>
  </tr>
  <?php } ?>
</table>