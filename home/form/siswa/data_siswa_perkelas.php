<?php 
include "../../koneksi.php";
$id=$_GET['id'];
$qkelas = mysqli_query($conn, "SELECT * from kelas where id_kelas = '$id'");
$dkelas= mysqli_fetch_array($qkelas);
?>
<div class="box-header with-border">
  <h3 class="box-title">
    Data Siswa Kelas <?php echo $dkelas['nama_kelas'] ?>
  </h3>
  <div class="pull-right">
    <a href="form/siswa/print_siswa_perkelas.php?id=<?php echo $id ?>" class=" btn btn-info btn-sm" target="_blank">Print</a>
    <a href="?a=tambah_siswa&id=<?php echo $id ?>" class=" btn btn-info btn-sm" >Tambah Siswa</a>
    <a href="?a=siswa_kelas" class=" btn btn-info btn-sm" >Kembali</a>
  </div>
  
</div>




<?php


  
  $perintah="SELECT * From siswa join kelas on kelas.id_kelas=siswa.id_kelas where kelas.id_kelas='$id'";
  $jalan=mysqli_query($conn, $perintah)or die(mysqli_error());

  $total = mysqli_num_rows($jalan);
  $no=1;
?>
<table class="table table-striped table-bordered" id="example1">
	<thead>
	<tr>
		<td>No</td>
    <td>NIS</td>
    <td>Nama siswa</td>
    <td>Tempat / Tgl Lahir</td>
    <td>Jenis Kelamin</td>
    <td>Alamat</td>
    <td>No HP</td>
    <td>Email</td>
		<!-- <td>Mata Pelajaran</td> -->
		
		<td>Option</td>
	</tr>
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
	<td><?php echo $data['nama_siswa']; ?></td>
	<td><?php echo $data['tmpl'].' / '.$tgll; ?></td>
	<td><?php echo $data['alamat']; ?></td>
	<td><?php echo $data['no_telp']; ?></td>
	<td><?php echo $data['email_siswa']; ?></td>
	
  <!-- <td><?php echo $kelas; ?></td> -->
	
	<td>
    <a href="?a=edit_siswa&id=<?php echo $data['id_siswa'] ?>" class="btn btn-warning btn-xs">Edit</a> 
    <a href="form/siswa/hapus_siswa.php?id=<?php echo $data['id_siswa'] ?>&kelas=<?php echo $data['id_kelas'] ?>" class="btn btn-danger btn-xs" onclick="return confirm('Apakah anda akan menghapus <?php echo $data['nama_siswa'] ?> dari data siswa?')">Hapus</a> 
	</td>
		</tr>

		<?php } ?>
				
	</table>
