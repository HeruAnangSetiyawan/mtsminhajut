<div class="box-header with-border">
  <h3 class="box-title">
    Data Siswa Per Kelas
  </h3>
  
</div>



<?php


include "../../koneksi.php";
  
  $perintah="SELECT * From kelas";
  $jalan=mysqli_query($conn, $perintah);

  $total = mysqli_num_rows($jalan);
  $no=1;
?>
<table class="table table-striped table-bordered" id="example1">
	<thead>
	<tr>
		<td>No</td>
    <td>Nama Kelas</td>
		<td>Jumlah Siswa</td>
		
		<td>Option</td>
	</tr>
</thead>
	

<?php

while ($data=mysqli_fetch_array($jalan))
{ 
$id=$data['id_kelas'];
  $qsiswa = mysqli_query($conn, "SELECT * from siswa where id_kelas='$id'");
  $jsiswa = mysqli_num_rows($qsiswa);
$kelas=$data['nama_kelas'];
;

?>
	<tr>
		<td><?php echo $no++; ?></td>
	

		
  <td><?php echo $kelas; ?></td>
	<td><?php echo $jsiswa ?></td>
	
	<td>
    <a href="?a=data_siswa&id=<?php echo $id ?>" class="btn btn-info btn-xs">Lihat Data Siswa</a> 
    
	</td>
		</tr>

		<?php } ?>
				
	</table>
