<div class="box-header with-border">
  <h3 class="box-title">
    Data Pembagian Kelas
  </h3>
  <div class="pull-right">
    <!-- <a href="#" class=" btn btn-info btn-sm"  data-toggle="modal" data-target="#addguru">Tambah Guru</a> -->
  </div>
  
</div>

<!-- <form action="form/guru/simpan_guru.php" method="post"  enctype="multipart/form-data">
<div class="modal fade" id="addguru">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Data Guru</h4>
              </div>
              <div class="modal-body">
              <div class="form-group">
                  <label>Nama</label>
                  <input type="text" name="nama" class="form-control">
              </div>
              <div class="form-group">
                  <label>Mata Pelajaran Yang Diajarkan</label>
                  <select name="mapel" class="form-control">
                    <?php 
                    $qmapel = mysqli_query($conn, "SELECT * from mapel");
                    while($dmapel = mysqli_fetch_array($qmapel)){ ?>
                      <option value="<?php echo $dmapel['id_mapel'] ?>"><?php echo $dmapel['nama_mapel'] ?></option>
                    <?php } ?>
                  </select>
              </div>
            </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan Mata Pelajaran</button>
               
              </div>
            </div>
          </div>
        </div>
</form> -->

<div class="clearfix"></div>



<?php


include "../../koneksi.php";
  
  $perintah="SELECT * From guru join mapel on mapel.id_mapel=guru.id_mapel";
  $jalan=mysqli_query($conn, $perintah)or die(mysqli_error());

  $total = mysqli_num_rows($jalan);
  $no=1;
?>
<table class="table table-striped table-bordered" id="example1">
	<thead>
	<tr>
		<td>No</td>
    <td>Nama Guru</td>
    <td>Mata Pelajaran</td>
		<td>Kelas Yang Diajar</td>
		
		<td>Option</td>
	</tr>
</thead>
	

<?php

while ($data=mysqli_fetch_array($jalan))
{ 
$id=$data['id_guru'];
$mapel=$data['nama_mapel'];
$guru=$data['nama_guru'];
;

?>
	<tr>
		<td><?php echo $no++; ?></td>
	

		
	<td><?php echo $guru; ?></td>
  <td><?php echo $mapel; ?></td>
  <td>
    <?php 
    $qkelas = mysqli_query($conn, "SELECT * from pembagian_kelas join kelas on kelas.id_kelas=pembagian_kelas.id_kelas where id_guru='$id'");
    $jkelas = mysqli_num_rows($qkelas);
    if ($jkelas==0) {
      echo "Tidak ada jatah mengajar";
    }else{
              $no=1;
              while ($dkelas=mysqli_fetch_array($qkelas)) {
                echo $no++.'. '.$dkelas['nama_kelas'].'<br>';               
              }
    }
               ?>
  </td>
	
	<td>
    <a href="?a=kelola_kelas&id=<?php echo $id ?>" class="btn btn-default btn-xs">Kelola</a> 
    
	</td>
		</tr>

		<?php } ?>
				
	</table>
