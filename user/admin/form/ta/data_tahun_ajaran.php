
<?php 

 $semester = [1=>'Ganjil','Genap'];
  $q1=mysqli_query($conn, "SELECT * from tahun_ajaran where status_ta in('Prepare','Aktif')");


  $j1=mysqli_num_rows($q1);
  $no=1;
 ?>

<?php if ($j1==0){ ?>
 <div class="box-header with-border">
  <h3 class="box-title">Data Tahun Ajaran</h3>

  <div class="box-tools pull-right">
    <a href="#" class="btn btn-info btn-sm"  data-toggle="modal" data-target="#to">Tahun Ajaran Baru</a>
  </div>
</div>

<form action="form/ta/simpan_ta.php" method="post" enctype="multipart/form-data">
<div class="modal fade" id="to">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah tahun ajaran</h4>
              </div>
              <div class="modal-body">
              <div class="form-group">
                  <label>Tahun Ajaran</label>
                  <input type="text" name="nama" class="form-control">
              </div> 
              
           
              
             
            </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" onclick="return confirm('Apakah data yang anda masukan sudah benar.?')">Simpan Data tahun ajaran</button>
               
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
</form>

<hr>
<?php 
  $q2=mysqli_query($conn, "SELECT * from tahun_ajaran  where status_ta in ('Selesai')");
  $no=1;
 ?>


 <table class="table table-striped table-bordered" id="example1">
    <thead>
      <tr>
        <td>No</td>
        
        
        <td>Nama periode</td>
      
        <td>Semester</td>
        <td>Status</td>
       
        <td>Option</td>
      </tr>
    </thead>
  <?php 
  while ($d1=mysqli_fetch_array($q2)) { 
    ?>
  <tr>
    <td><?php echo $no++ ?></td>
   
  
 
    <td><?php echo $d1['nama_ta'] ?></td>
    <td><?php echo $semester[$d1['semester']] ?></td>
  
    <td><?php echo $d1['status_ta'] ?></td>
     <td>
    <a href="?a=history_kelas&id_ta=<?php echo $d1['id_ta'] ?>" class="btn btn-info btn-xs">Lihat Kelas</a>
    </td>
  </tr>
  <?php } ?>
</table>

<?php }else{ 
 
  $d1 = mysqli_fetch_array($q1); ?>
  <div class="box-header with-border">
  <h3 class="box-title">Data Tahun Ajaran</h3>

 
</div>
  <div class="alert alert-info">
    <h4>Tahun Ajaran saat ini adalah <?php echo $d1['nama_ta'] ?> <br>
      Semester <?php echo $semester[$d1['semester']] ?> <br>
      Status <?php echo $d1['status_ta']?> <br>
</h4>
    <?php if ($d1['semester']=='1') { ?>
      <a href="form/ta/ganti_semester.php?id=<?php echo $d1['no'] ?>" class="btn btn-default" style="color:black;" onclick="return confirm('Apakah anda sudah selesai kegiatan belajar mengajar semester ganjil dan mulai kegiatan semester Genap.?')">Selesai semester <?php echo $semester[$d1['semester']] ?></a>
      
    
    <?php }else{ ?>
      <a href="form/ta/selesai.php?id=<?php echo $d1['no'] ?>" class="btn btn-default" style="color:black;" onclick="return confirm('Apakah anda sudah selesai kegiatan belajar mengajar semester Genap.?')">Tahun ajaran selesai</a>
    <?php } ?>
  </div>

<?php 
  $q2=mysqli_query($conn, "SELECT * from tahun_ajaran  where status_ta in ('Selesai')");
  $no=1;
 ?>
<hr>
 <div class="box-header with-border">
  <h3 class="box-title">Tahun Ajaran Selesai</h3>

 
</div>

 <table class="table table-striped table-bordered" id="example1">
    <thead>
      <tr>
        <td>No</td>
        
        
        <td>Nama periode</td>
        <td>Semester</td>
      
        <td>Status</td>
       
        <td>Option</td>
      </tr>
    </thead>
  <?php 
  while ($d1=mysqli_fetch_array($q2)) { 
    ?>
  <tr>
    <td><?php echo $no++ ?></td>
   
  
 
    <td><?php echo $d1['nama_ta'] ?></td>
    <td><?php echo $semester[$d1['semester']] ?></td>
   
  
    <td><?php echo $d1['status_ta'] ?></td>
    <td>
    <a href="?a=history_kelas&id_ta=<?php echo $d1['id_ta'] ?>" class="btn btn-info btn-xs">Lihat Kelas</a>
    </td>
  </tr>
  <?php } ?>
</table>
<?php } ?>