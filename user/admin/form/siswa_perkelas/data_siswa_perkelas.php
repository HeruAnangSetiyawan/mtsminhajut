<?php 
// ta = tahun ajaran  
$id_ta_aktif = $_GET['id_ta'];
$id_kelas = $_GET['id_kelas'];
$id_wk = $_GET['id_wk'];
  $qta = mysqli_query($conn, "SELECT * from tahun_ajaran where id_ta='$id_ta_aktif'");
  $jta = mysqli_num_rows ($qta);
  $dta = mysqli_fetch_array($qta);
  $id_ta = $dta['id_ta'];
  $qkelas = mysqli_query($conn, "SELECT * from kelas where id_kelas='$id_kelas'");
  $dkelas = mysqli_fetch_array($qkelas);


   $qcekwk = mysqli_query($conn, "SELECT b.nama_guru, a.status_wali_kelas, a.id_guru, b.nip, a.username, a.id_walikelas from wali_kelas a left join guru b on a.id_guru = b.id_guru where a.id_walikelas ='$id_wk' and a.status_wali_kelas='1'");
      $jcekwk = mysqli_num_rows($qcekwk);
      $dcekwk = mysqli_fetch_array($qcekwk);
      $id_wk_aktif = $dcekwk['id_guru'];
 ?>

<div class="box-header with-border">
  <h3 class="box-title">
    Data Siswa Kelas <?php echo $dkelas['nama_kelas'] ?> <br> 
    Tahun Ajaran <?php echo   $dta['nama_ta'] ?>
  </h3>
  
  
</div>























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
        <?php }else{ ?>
        Wali kelas belum ditentukan <br>Silahkan tentukan di menu wali kelas
      <?php } ?>
    </div>



</div>
<div class="col-md-8">
  <div class="box-header with-border">
    <h3 class="box-title">
      Data Siswa

    </h3>
   
  </div>

  <table class="table table-striped table-bordered" id="example1">
    <thead>
      <tr>
      <td >No</td>
        <td >NIS</td>
        <td >NISN</td>
        <td >Nama siswa</td>
        <td >Jenis Kelamin</td>
       
      <td >Option</td>
      </tr>
      
    </thead>
    

  <?php
  $no=1;
$mapel = mysqli_query($conn, "SELECT a.status_ks, a.id_siswa,  b.nama_siswa, b.nis, b.nisn, b.jk, b.agama, b.tmpl, b.tgll
 from kelas_siswa a
 left join siswa b on a.id_siswa = b.id_siswa
  where a.id_kelas='$id_kelas' and a.id_ta='$id_ta_aktif'");
  while ($data=mysqli_fetch_array($mapel))
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
  
  
  <td>
    <a href="?a=detail_siswa&id=<?php echo $data['id_siswa'] ?>&t=1&id_kelas=<?php echo $id_kelas ?>&id_ta=<?php echo $id_ta_aktif ?>&id_wk=<?php echo $id_wk ?>" class="btn btn-info btn-xs">Detail Siswa</a> 
  </td>
    </tr>

    <?php } ?>
        
          
    </table>
</div>