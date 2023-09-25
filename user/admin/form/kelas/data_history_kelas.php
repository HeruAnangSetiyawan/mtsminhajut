<?php 
$idta = $_GET['id_ta'];
 $qta = mysqli_query($conn, "SELECT * from tahun_ajaran where id_ta='$idta'");
          $jta = mysqli_num_rows ($qta);
          $dta = mysqli_fetch_array($qta);
          $id_ta = $dta['id_ta'];


           ?><div class="box-header with-border">
  <h3 class="box-title">
    Data Kelas <br>
    Tahun Ajaran <?php echo $dta['nama_ta'] ?>
  </h3>
  <div class="pull-right">
    
  </div>
  
</div>

<form action="form/kelas/simpan_kelas.php" method="post"  enctype="multipart/form-data">
<div class="modal fade" id="addkelas">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Kelas</h4>
              </div>
              <div class="modal-body">

              <div class="form-group">
                  <label>Kelas</label>
                  <select name="tingkat" class="form-control">
                    <?php
                      $kelas = [1,2,3,4,5,6];
                      foreach ($kelas as $kls) { ?>
                        <option value="<?php echo$kls ?>"><?php echo $kls ?></option>
                      <?php } ?>
                    
                  </select>
              </div>
              <div class="form-group">
                  <label>Lokal</label>
                  <input type="text" name="kelas" class="form-control">
              </div>
            
            </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan Kelas</button>
               
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
</form>

<div class="clearfix"></div>



<?php



  
  $perintah="SELECT * From kelas ";
  $jalan=mysqli_query($conn, $perintah);

  $total = mysqli_num_rows($jalan);
  $no=1;
?>
<table class="table table-striped table-bordered" id="example1">
	<thead>
	<tr>
		<td>No</td>
    <td>Kelas</td>
    <td>Lokal</td>
    
		<td>Wali Kelas</td>
    <td>Jumlah Siswa</td>
		
		<td>Option</td>
	</tr>
</thead>
	

<?php

while ($data=mysqli_fetch_array($jalan))
{ 
  $idkelas = $data['id_kelas'];
$q = mysqli_query($conn, "SELECT b.nama_guru, a.status_wali_kelas from wali_kelas a left join guru b on a.id_guru = b.id_guru where a.status_wali_kelas='1' and a.id_kelas = '$idkelas'");
$d = mysqli_fetch_array($q);
$j = mysqli_num_rows($q);

$qmapel = mysqli_query($conn, "SELECT * from kelas_siswa where id_kelas='$idkelas' and id_ta='$id_ta'");
$jmapel = mysqli_num_rows($qmapel);
$status_wali_kelas = $d['status_wali_kelas'];
if ($status_wali_kelas>0) {
  $walikelas = $d['nama_guru'];
}else{
  $walikelas = "Wali kelas belum ditentukan";

}
$id=$data['id_kelas'];
$kelas=$data['nama_kelas'];
;

?>
	<tr>
		<td><?php echo $no++; ?></td>
	

		
  
  <td><?php echo $data['tingkat']; ?></td>
  <td><?php echo $kelas; ?></td>
  <td>  <?php echo  $walikelas; ?></td>
  <td>  <?php echo  $jmapel; ?></td>
	
	<td>
    <a href="?a=manage_history_kelas&id=<?php echo $id ?>&id_ta=<?php echo $idta ?>" class="btn btn-info btn-xs">Management kelas</a> 
	</td>
		</tr>

		<?php } ?>
				
	</table>
