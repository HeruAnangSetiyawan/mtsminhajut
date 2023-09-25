<?php 


?>
<div class="box-header with-border">
  <h3 class="box-title">
    Data Siswa Aktif 
  </h3>
  <div class="pull-right">
    
    <!-- <a href="?a=tambah_siswa" class=" btn btn-info btn-sm" >Tambah Siswa</a> -->
    
  </div>
  
</div>


<br>

<?php


  
  $perintah="SELECT * From siswa where status_siswa='Aktif'";
  $jalan=mysqli_query($conn, $perintah)or die(mysqli_error());

  $total = mysqli_num_rows($jalan);
  $no=1;
?>
<table class="table table-striped table-bordered" id="example1">
	<thead>
		<tr>
		<td >No</td>
	    <td >NIS</td>
	    <td >NISN</td>
	    <td >Nama siswa</td>
	    <td >Jenis Kelamin</td>
	    <td >Kelas Saat Ini</td>
		<td >Option</td>
		</tr>
		<!-- <tr>
			<td>Ayah</td>
			<td>Ibu</td>
			<td>Ayah</td>
			<td>Ibu</td>
		</tr> -->
	</thead>
	

<?php

while ($data=mysqli_fetch_array($jalan))
{ 
	$id_siswa = $data['id_siswa'];
	$kelas_aktif = mysqli_query($conn, "SELECT k.nama_kelas, k.tingkat from kelas_siswa ks left join kelas k  on ks.id_kelas = k.id_kelas where  ks.id_siswa='$id_siswa'group by ks.id_ta order by id_ks limit 1");
	$d_kelas_sktif = mysqli_fetch_array($kelas_aktif);
$pt = explode('-', $data['tgll']);
$tgll = $pt[2].'-'.$pt[1].'-'.$pt[0];


?>
	<tr>
		<td><?php echo $no++; ?></td>
	

		
	<td><?php echo $data['nis']; ?></td>
	<td><?php echo $data['nisn']; ?></td>
	<td><?php echo $data['nama_siswa']; ?></td>
	<td><?php echo $data['jk']; ?></td>
	<td><?php echo $d_kelas_sktif['tingkat'].' - '.$d_kelas_sktif['nama_kelas']; ?></td>
	
	<td>
    <a href="?a=detail_siswa&id=<?php echo $data['id_siswa'] ?>&t=0&status=1" class="btn btn-info btn-xs">Detail Siswa</a> 
	</td>
		</tr>

		<?php } ?>
				
	</table>
