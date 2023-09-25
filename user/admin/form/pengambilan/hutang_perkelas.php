<?php

$id=$_POST['id_kelas'];
$ta=$_POST['ta'];

  $perintah="SELECT * From kelas where id_kelas='$id'";
  $jalan=mysqli_query($conn, $perintah);
  $d1=mysqli_fetch_array($jalan);
  $no=1;
 $tingkat = $d1['tingkat'] -1;
 $tingkat_kelas = $d1['tingkat'];
 $qta = mysqli_query($conn, "SELECT * from tahun_ajaran where id_ta='$ta'");
          $jta = mysqli_num_rows ($qta);
          $dta = mysqli_fetch_array($qta);
          $id_ta = $dta['id_ta'];

  $qcekwk = mysqli_query($conn, "SELECT b.nama_guru, a.status_wali_kelas, a.id_guru, b.nip, a.username, a.id_walikelas from wali_kelas a left join guru b on a.id_guru = b.id_guru where a.id_kelas='$id' and a.status_wali_kelas='1'");
      $jcekwk = mysqli_num_rows($qcekwk);
      $dcekwk = mysqli_fetch_array($qcekwk);
      $id_wk_aktif = $dcekwk['id_guru'];
?>
<div class="box-header with-border">
  <h3 class="box-title">
    Manajemen Kelas <?php echo $d1['nama_kelas'] ?> <br>
    Tahun Ajaran <?php echo $dta['nama_ta'] ?>

  </h3>
<div class="pull-right">
      <a href="?a=pengambilan" class="btn btn-info btn-sm"  >Kembali</a>
    </div>
  
</div>
<div class="clearfix"></div>



<?php



  
 
  $no=1;
?>
<div class="col-md-4">
   <div class="box-header with-border">
      <h3 class="box-title">
        Wali Kelas 

      </h3>
      
      
      
    </div>
    <div class="box-body">
      <?php 
      
      if ($jcekwk==1) { ?>
        <table class="table">
          <tr>
            <td>Nama</td>
            <td><?php echo $dcekwk['nama_guru'] ?></td>
          </tr>
          <tr>
            <td>NIP</td>
            <td><?php echo $dcekwk['nip'] ?></td>
          </tr>
          <tr>
            <td>Username</td>
            <td><?php echo $dcekwk['username'] ?></td>
          </tr>
        </table>
        <?php 
        // ta = tahun ajaran  
          $qta = mysqli_query($conn, "SELECT * from tahun_ajaran where status_ta='Aktif'");
          $jta = mysqli_num_rows ($qta);
          $dta = mysqli_fetch_array($qta);
          $id_ta = $dta['id_ta'];
         }else{ ?>
        
      <?php } ?>
    </div>



</div>
<div class="col-md-8">
  <div class="box-header with-border">
    <h3 class="box-title">
      Data Siswa 

    </h3>
    <div class="pull-right">
     
    </div>
    
  </div>

  <table class="table table-striped table-bordered" id="example1">
  	<thead>
  	<tr>
  		<td>No</td>
      <td>Nama</td>
      <td>Hutang</td>
      <td>Dibayar</td>
      <td>Sisa</td>
  		<td>Option</td>
  	</tr>
  </thead>
  	

  <?php
$q_siswa = mysqli_query($conn, "SELECT ks.*, s.nama_siswa, s.nis, s.nisn from kelas_siswa ks
left join siswa s on ks.id_siswa = s.id_siswa where ks.id_kelas='$id'  and ks.id_ta='$ta' order by s.nama_siswa asc");
  while ($data=mysqli_fetch_array($q_siswa))
  { 
    $id_siswa = $data['id_siswa'];
 $q2=mysqli_query($conn, "SELECT count(id_pengambilan) as qty, sum(biaya) as biaya from pengambilan where id_siswa='$id_siswa'
    ");
      $d2 = mysqli_fetch_array($q2);
      $q3=mysqli_query($conn, "SELECT sum(jumlah) as dibayar from pembayaran where id_siswa='$id_siswa'
    ");
      $d3 = mysqli_fetch_array($q3);
        $hutang = $d2['biaya'];
    $dibayar = $d3['dibayar'] =='' ? 0 : $d3['dibayar'];
    $sisa = $hutang - $dibayar;
  ?>
  	<tr>
  		<td><?php echo $no++; ?></td>
    <td><?php echo $data['nama_siswa']; ?></td>
    <td><?php echo number_format($hutang) ?></td>
    <td><?php echo number_format($dibayar) ?></td>
    <td><?php echo number_format($sisa) ?></td>  
  	
  	<td>
      <a href="?a=detail_pengambilan&id_siswa=<?php echo $data['id_siswa'] ?>&menu=filter&id_kelas=<?php echo $id ?>&id_ta=<?php echo $ta ?>" class="btn btn-info btn-xs">Detail Hutang Piutang</a>
  	</td>
  		</tr>

  		<?php } ?>
  				
  	</table>
</div>