<?php

$id=$_GET['id'];

  $perintah="SELECT * From siswa where id_siswa='$id'";
  $jalan=mysqli_query($conn, $perintah);
  $d1=mysqli_fetch_array($jalan);
  $no=1;

$qta = mysqli_query($conn, "SELECT * from tahun_ajaran where status_ta='Aktif'");
$dta = mysqli_fetch_array($qta);
$jta = mysqli_num_rows($qta);

  $qcekwk = mysqli_query($conn, "SELECT b.nama_guru, a.status_wali_kelas, a.id_guru, b.nip, a.username, a.id_walikelas from wali_kelas a left join guru b on a.id_guru = b.id_guru where a.id_kelas='$id' and a.status_wali_kelas='1'");
      $jcekwk = mysqli_num_rows($qcekwk);
      $dcekwk = mysqli_fetch_array($qcekwk);
      $id_wk_aktif = $dcekwk['id_guru'];
?>
<div class="box-header with-border">
  <h3 class="box-title">
   Detail Alumni 

  </h3>
<div class="pull-right">
      
    </div>
  
</div>



<div class="clearfix"></div>



<?php

$qkelas = mysqli_query($conn, "SELECT 
  a.status_ks, a.id_ks, a.id_siswa, a.id_wali_kelas,
  b.nama_ta, c.nama_kelas, c.tingkat,
  e.nama_guru,
  f.nama_kelas as next_kelas

  from kelas_siswa a 
  left join tahun_ajaran b on a.id_ta = b.id_ta
  left join kelas c on a.id_kelas = c.id_kelas
  left join wali_kelas d on a.id_wali_kelas = d.id_walikelas
  left join guru e on d.id_guru = e.id_guru
  left join kelas f on a.id_next_kelas = f.id_kelas
  where a.id_siswa = '$id' group by a.id_ta");
$jkelas = mysqli_num_rows($qkelas);
?>
<div class="col-md-3">
  
    <div class="box-body">
      <?php 
      if ($d1['foto']=="") {
        $foto = "default.jpg";
      }else{
        $foto = $d1['foto'];
      }
       ?>
      
      <img src="form/siswa/foto/<?php echo $foto ?>" width=100%>
      <h4><?php echo $d1['nama_siswa'] ?></h4>
     
     <a href="?a=alumni" class="btn btn-info btn-xs"  >Kembali</a>
    </div>



</div>
<div class="col-md-9">
  <div class="box-header with-border">
    <h3 class="box-title">
      Biodata

    </h3>
    
    
  </div>
  <div class="box-body">
    <div class="col-md-6">
      <table class="table">
        <tr>
          <td>Nama</td>
          <td>:</td>
          <td><?php echo $d1['nama_siswa'] ?></td>
        </tr>
        <tr>
          <td>NIS</td>
          <td>:</td>
          <td><?php echo $d1['nis'] ?></td>
        </tr>
        <tr>
          <td>NISN</td>
          <td>:</td>
          <td><?php echo $d1['nisn'] ?></td>
        </tr>
        <tr>
          <td>Tempat Lahir</td>
          <td>:</td>
          <td><?php echo $d1['tmpl'] ?></td>
        </tr>
        <tr>
          <td>Tanggal Lahir</td>
          <td>:</td>
          <td><?php echo $d1['tgll'] ?></td>
        </tr>
        <tr>
          <td>Jenis Kelamin</td>
          <td>:</td>
          <td><?php echo $d1['jk'] ?></td>
        </tr>
        <tr>
          <td>Agama</td>
          <td>:</td>
          <td><?php echo $d1['agama'] ?></td>
        </tr>
      
       
      </table>
    </div>
    <div class="col-md-6">
      <table class="table">
        <tr>
          <td>Pendidikan Sebelumnya</td>
          <td>:</td>
          <td><?php echo $d1['pendidikan_sebelumnya'] ?></td>
        </tr>
        <tr>
          <td>Alamat</td>
          <td>:</td>
          <td><?php echo $d1['alamat'] ?></td>
        </tr>
        <tr>
          <td>No HP</td>
          <td>:</td>
          <td><?php echo $d1['no_telp'] ?></td>
        </tr>
        <tr>
          <td>Nama Ayah</td>
          <td>:</td>
          <td><?php echo $d1['nama_ayah'] ?></td>
        </tr>
        <tr>
          <td>Nama Ibu</td>
          <td>:</td>
          <td><?php echo $d1['nama_ibu'] ?></td>
        </tr>
        <tr>
          <td>Pekerjaan Ayah</td>
          <td>:</td>
          <td><?php echo $d1['kerja_ayah'] ?></td>
        </tr>
        <tr>
          <td>Pekerjaan Ibu</td>
          <td>:</td>
          <td><?php echo $d1['kerja_ibu'] ?></td>
        </tr>
      </table>
    </div>
    <div class="clearfix"></div>
    
    
  </div>

</div>
  <div class="clearfix"></div>
<hr>

 <div class="box-header with-border">
    <h3 class="box-title">
      History Kelas Siswa

    </h3>
    
    
  </div>
  <div class="box-body">
     
         
         <div class="box-body">
            <table class="table"  id="example1">
              <thead>
                <tr>
                  <td>No</td>
                  <td>Kelas</td>
                  <td>Lokal</td>
                  <td>Wali Kelas</td>
                  <td>Tahun Ajaran</td>
                  <td>Status</td>
                </tr>
              </thead>
              <?php 
              $no=1;
              while ($dkelas = mysqli_fetch_array($qkelas)) { ?>
              
              <tr>
                <td><?php echo $no++ ?></td>
                <td><?php echo $dkelas['tingkat'] ?></td>
                <td><?php echo $dkelas['nama_kelas'] ?></td>
                <td><?php echo $dkelas['nama_guru'] ?></td>
                <td><?php echo $dkelas['nama_ta'] ?></td>
                <td>
                  <?php 
                  $kelas_selanjutnya = $dkelas['next_kelas'] =='' ? $dkelas['tingkat'] +1  : $dkelas['next_kelas'];
                  if ($dkelas['status_ks']=='Lanjut') {
                    $keterangan = "Naik Ke Kelas ".$kelas_selanjutnya;
                  }
                  elseif ($dkelas['status_ks']=='Tinggal') {
                    $keterangan = "Tinggal di Kelas ".$kelas_selanjutnya;
                  }
                  elseif ($dkelas['status_ks']=='Lulus') {
                    $keterangan = "Lulus ke tingkat pendidikan selanjutnya";
                  }else{
                    $keterangan = "Aktif";
                  }
                  echo $keterangan;
                   ?>
                  
                    
                  </td>
              </tr>
              <?PHP } ?>
            </table>
          </div>

  </div>
