<div class="box-header with-border">
  <h3 class="box-title">
    Data Kompetensi Dasar
  </h3>
  <div class="pull-right">
    
  </div>
  
</div>

<div class="clearfix"></div>



<?php



  
  $perintah="SELECT * From kelas  left join ptk on ptk.id_ptk = kelas.id_ptk ";
  $jalan=mysqli_query($conn, $perintah)or die(mysqli_error());

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
		<td>Mata Pelajaran</td>
		
		<td>Option</td>
	</tr>
</thead>
	

<?php

while ($data=mysqli_fetch_array($jalan))
{ 
$id = $data['id_kelas']

?>
	<tr>
		<td><?php echo $no++; ?></td>
	

		
  <td><?php echo $data['tingkat']; ?></td>
  <td><?php echo $data['nama_kelas']; ?></td>
	<td><?php echo $data['nama_ptk']; ?></td>
  
  <td>
    <?php 
    $qkelas = mysqli_query($conn, "SELECT * from pembagian_mapel join mapel on mapel.id_mapel=pembagian_mapel.id_mapel where id_kelas='$id'");
    $jkelas = mysqli_num_rows($qkelas);
    if ($jkelas==0) {
      echo "Tidak ada mata pelajaran aktif";
    }else{
              $no=1;
              while ($dkelas=mysqli_fetch_array($qkelas)) {
                echo $no++.'. '.$dkelas['nama_mapel'].'<br>';               
              }
    }
               ?>
  </td>
	
	<td>
   Coming Soon <!-- <a href="?a=kelola_mapel&id=<?php echo $id ?>" class="btn btn-default btn-xs">Kelola</a>  -->
    
	</td>
		</tr>

		<?php } ?>
				
	</table>
