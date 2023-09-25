<?php 


?>
<div class="box-header with-border">
  <h3 class="box-title">
    Data Calon Siswa 
  </h3>
  <div class="pull-right">
    
    <a href="?a=tambah_siswa" class=" btn btn-info btn-sm" >Tambah Siswa</a>
    
  </div>
  
</div>


<br>

<?php


  
  $perintah="SELECT * From siswa where status_siswa='Calon Siswa'";
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
	    <td >Tempat / Tgl Lahir</td>
	    <td >Agama</td>
	  <!--   <td >Pendidikan Sebelumnya</td>
	    <td colspan="2">Nama Orang Tua</td>
	    <td colspan="2">Pekerjaan Orang Tua</td>
		<td >Alamat</td>
		<td >No HP</td> -->
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
$pt = explode('-', $data['tgll']);
$tgll = $pt[2].'-'.$pt[1].'-'.$pt[0];


?>
	<tr>
		<td><?php echo $no++; ?></td>
	

		
	<td><?php echo $data['nis']; ?></td>
	<td><?php echo $data['nisn']; ?></td>
	<td><?php echo $data['nama_siswa']; ?></td>
	<td><?php echo $data['jk']; ?></td>
	<td><?php echo $data['tmpl'].' / '.$tgll; ?></td>
	<td><?php echo $data['agama']; ?></td>
	<!-- <td><?php echo $data['pendidikan_sebelumnya']; ?></td>
	<td><?php echo $data['nama_ayah']; ?></td>
	<td><?php echo $data['nama_ibu']; ?></td>
	<td><?php echo $data['kerja_ayah']; ?></td>
	<td><?php echo $data['kerja_ibu']; ?></td>
	<td><?php echo $data['alamat']; ?></td>
	<td><?php echo $data['no_telp']; ?></td>	 -->
	
  <!-- <td><?php echo $kelas; ?></td> -->
	
	<td>
    <a href="?a=detail_siswa&id=<?php echo $data['id_siswa'] ?>&t=0&status=0" class="btn btn-info btn-xs">Detail Siswa</a> 
	</td>
		</tr>

		<?php } ?>
				
	</table>
