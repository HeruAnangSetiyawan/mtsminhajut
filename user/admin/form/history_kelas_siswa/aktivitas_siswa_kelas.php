<?php

$id=$_GET['id'];
$status_wali_kelas='';
$tingkat = $_GET['tingkat'];
$status_ks = $_GET['status_ks'];
$semester = $_GET['semester'];
$status_ta = $_GET['status_ta'];
$nama_semester = [1=>'Ganjil','Genap'];
$semester_aktif = $nama_semester[$semester];


  $perintah="SELECT * From siswa where id_siswa='$id'";
  $jalan=mysqli_query($conn, $perintah);
  $d1=mysqli_fetch_array($jalan);
  $no=1;

$id_ta_aktif = $_GET['id_ta'];
        $id_kelas = $_GET['id_kelas'];
        


  $qmapel = mysqli_query($conn, "SELECT * from mapel where tingkat='$tingkat' ");
  $jmapel = mysqli_num_rows($qmapel);
  $qmapelinput = mysqli_query($conn, "SELECT * from mapel where tingkat='$tingkat' ");  

  $kumpulkan_mapel = [];
    while($dmapel=mysqli_fetch_array($qmapel)){  
      $isi = [
        'id_mapel' =>$dmapel['id_mapel'],
        'nama_mapel' =>$dmapel['nama_mapel'],
        'kkm' =>$dmapel['kkm'],

      ];
      array_push($kumpulkan_mapel, $isi);
    }

$id_siswa = $d1['id_siswa'];
$q_kelas_siswa = mysqli_query($conn, "SELECT * from kelas_siswa ks
  left join tahun_ajaran ta on ks.id_ta = ta.id_ta
  left join kelas k on ks.id_kelas = k.id_kelas
  where ks.id_siswa='$id_siswa' and ks.id_kelas='$id_kelas' and ks.id_ta='$id_ta_aktif'
  ");
$d_kelas_siswa = mysqli_fetch_array($q_kelas_siswa);

?>

<div class="box-header with-border">
  <h3 class="box-title">
  Identitas PBM

  </h3>
<div class="pull-right">
      <a href="?a=history_kelas" class="btn btn-info btn-sm"  >Kembali</a>
    </div>
  
</div>





<div class="clearfix"></div>

<div class="col-md-6">
  
      <table class="table">
        
        <tr>
          <td>Tahun Ajaran</td>
          <td>:</td>
          <td><?php echo $d_kelas_siswa['nama_ta'] ?></td>
        </tr>
        <tr>
          <td>Kelas</td>
          <td>:</td>
          <td><?php echo $d_kelas_siswa['nama_kelas'] ?></td>
        </tr>
        <tr>
          <td>Status Tahun Ajaran</td>
          <td>:</td>
          <td><?php echo $d_kelas_siswa['status_ta'] ?></td>
        </tr>
        <?php if ($status_ta=="Aktif"): ?>
          
        <tr>
          <td>Semester Aktif</td>
          <td>:</td>
          <td><?php echo $nama_semester[$semester] ?></td>
        </tr>
        <?php endif ?>
      </table>
</div>
<div class="clearfix"></div>


<hr>

<div class="col-md-6">
  

  <div class="box-header with-border">
    <h3 class="box-title">
     Semester Ganjil

    </h3>





  <?php      
          $no=1;

  $id_wali_kelas = $_SESSION['id_user'];
  ?>

  </div>

  <div class="box-body">
    <label>Absensi : </label> 
      <?php $q_absensi = mysqli_query($conn, "SELECT * from absensi where id_siswa='$id' and id_kelas='$id_kelas' and id_ta='$id_ta_aktif' and semester='1'"); 
      $j_absensi = mysqli_num_rows($q_absensi);
      $d_absensi = mysqli_fetch_array($q_absensi);
      if ($j_absensi >0) { ?>
        <br>
    <table class="table">
      <tr>
        <td>Sakit</td>
        <td>Izin</td>
        <td>Tanpa Keterangan</td>
      </tr>
      <tr>
        <td><?php echo $d_absensi['sakit'] ?></td>
        <td><?php echo $d_absensi['izin'] ?></td>
        <td><?php echo $d_absensi['alfa'] ?></td>
      </tr>
    </table>
  <?php }else{ ?>
     Belum ada data absensi
  <?php } ?>
    <hr>
    <label>Nilai : </label>
    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>No</th>
          <th>Mata Pelajaran</th>
          <th>KKM</th>
          <th>Nilai</th>
          <!-- <th>Predikat</th> -->
        </tr>
      </thead>
      <tbody>
        <?php 
        $total_nilai = 0;
        $tuntas = 0;
        $tidak_tuntas = 0;
          foreach ($kumpulkan_mapel as $dmapel){    ?>
        <tr>
          <td><?php echo $no++ ?></td>
          <td><?php echo $dmapel['nama_mapel'] ?></td>
          <td><?php echo $dmapel['kkm'] ?></td>
          
          <td>
            <?php 
            $id_mapel = $dmapel['id_mapel'];
            
            $qnilai = mysqli_query($conn, "SELECT * from nilai where id_kelas='$id_kelas' and id_ta='$id_ta_aktif' and id_mapel='$id_mapel' and id_siswa='$id' and semester='1'");
            $dnilai = mysqli_fetch_array($qnilai);
            $nilai = $dnilai['nilai'];
            $total_nilai += $nilai;
            if ($nilai<$dmapel['kkm']) {
              $warna = "red";
              $satu = 1;
              $tidak_tuntas +=$satu;
            }else{
              $warna = "green";
              $satu = 1;
              $tuntas +=$satu;
            }
             ?>
             <p style="color: <?php echo $warna ?>"><?php echo $nilai ?></p>
            
          </td>
          <!-- <td> ???? </td> -->
        </tr>
      <?php } ?>
      <tr>
        <td colspan="3">Total Nilai</td>
        <td><?php echo $total_nilai ==0 ? '' : $total_nilai ?></td>
      </tr>
      <tr>
        <td colspan="3">Rata Rata</td>
        <td><?php 
        $ratarata = round($total_nilai / $jmapel, 2);
        echo $ratarata == 0 ? '' : $ratarata ?></td>
      </tr>
     
      <tr>
        <td colspan="4"><u>Catatan Guru</u> <br>
          <?php echo $d_kelas_siswa['catatan_wali_kelas_semester_1'] ?>
       
        </td>
      </tr>
        
      </tbody>
    </table>
    <br>
    <a href="form/history_kelas_siswa/print_rapor_siswa.php?id=<?php echo $id ?>&id_kelas=<?php echo $id_kelas ?>&id_ta=<?php echo $id_ta_aktif ?>&status_ks=<?php echo $status_ks ?>&semester=1&tingkat=<?php echo $tingkat ?>&status_ta=<?php echo $status_ta ?>" class="btn btn-info btn-sm" target="_blank">Print Rapor Semester <?php echo $nama_semester[1] ?></a>
  </div>

</div>

<?php if ($semester==2) { ?>
<div class="col-md-6">
  <div class="box-header with-border">
    <h3 class="box-title">
     Semester Genap

    </h3>





  <?php      
          $no=1;

  $id_wali_kelas = $_SESSION['id_user'];
  ?>

  </div>

  <div class="box-body">
    <label>Absensi : </label> 
      <?php $q_absensi = mysqli_query($conn, "SELECT * from absensi where id_siswa='$id' and id_kelas='$id_kelas' and id_ta='$id_ta_aktif' and semester='2'"); 
      $j_absensi = mysqli_num_rows($q_absensi);
      $d_absensi = mysqli_fetch_array($q_absensi);
      if ($j_absensi >0) { ?>
        <br>
    <table class="table">
      <tr>
        <td>Sakit</td>
        <td>Izin</td>
        <td>Tanpa Keterangan</td>
      </tr>
      <tr>
        <td><?php echo $d_absensi['sakit'] ?></td>
        <td><?php echo $d_absensi['izin'] ?></td>
        <td><?php echo $d_absensi['alfa'] ?></td>
      </tr>
    </table>
  <?php }else{ ?>
     Belum ada data absensi
  <?php } ?>
    <hr>
    <label>Nilai : </label>
    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>No</th>
          <th>Mata Pelajaran</th>
          <th>KKM</th>
          <th>Nilai</th>
          <!-- <th>Predikat</th> -->
        </tr>
      </thead>
      <tbody>
        <?php 
        $total_nilai = 0;
        $tuntas = 0;
        $tidak_tuntas = 0;
          foreach ($kumpulkan_mapel as $dmapel){    ?>
        <tr>
          <td><?php echo $no++ ?></td>
          <td><?php echo $dmapel['nama_mapel'] ?></td>
          <td><?php echo $dmapel['kkm'] ?></td>
          
          <td>
            <?php 
            $id_mapel = $dmapel['id_mapel'];
            
            $qnilai = mysqli_query($conn, "SELECT * from nilai where id_kelas='$id_kelas' and id_ta='$id_ta_aktif' and id_mapel='$id_mapel' and id_siswa='$id' and semester='2'");
            $dnilai = mysqli_fetch_array($qnilai);
            $nilai = $dnilai['nilai'];
            $total_nilai += $nilai;
            if ($nilai<$dmapel['kkm']) {
              $warna = "red";
              $satu = 1;
              $tidak_tuntas +=$satu;
            }else{
              $warna = "green";
              $satu = 1;
              $tuntas +=$satu;
            }
             ?>
             <p style="color: <?php echo $warna ?>"><?php echo $nilai ?></p>
            
          </td>
          <!-- <td> ???? </td> -->
        </tr>
      <?php } ?>
      <tr>
        <td colspan="3">Total Nilai</td>
        <td><?php echo $total_nilai ==0 ? '' : $total_nilai ?></td>
      </tr>
      <tr>
        <td colspan="3">Rata Rata</td>
        <td><?php 
        $ratarata = round($total_nilai / $jmapel, 2);
        echo $ratarata == 0 ? '' : $ratarata ?></td>
      </tr>
     
      <tr>
        <td colspan="4"><u>Catatan Guru</u> <br>
          <?php echo $d_kelas_siswa['catatan_wali_kelas_semester_2'] ?>
       
        </td>
      </tr>
        
      </tbody>
    </table>
     <br>
    <a href="form/history_kelas_siswa/print_rapor_siswa.php?id=<?php echo $id ?>&id_kelas=<?php echo $id_kelas ?>&id_ta=<?php echo $id_ta_aktif ?>&status_ks=<?php echo $status_ks ?>&semester=2&tingkat=<?php echo $tingkat ?>&status_ta=<?php echo $status_ta ?>" class="btn btn-info btn-sm" target="_blank">Print Rapor Semester <?php echo $nama_semester[2] ?></a>
  </div>

</div>
<?php } ?>
<div class="clearfix"></div>

<?php if ($status_ta=="Selesai"): ?>
  
<div class="col-md-12">
  <div class="box-header">
    <div class="alert alert-info">
      Berdasarkan pencapaian kompetensi pada semester 1 dan semester 2, <br>
Peserta didik dinyatakan 
      <?php if ($status_ks=='Lanjut') {
        $next = $tingkat + 1;
        echo "Naik ke kelas ".$next;
      }if ($status_ks=='Tinggal') {
        echo "Tinggal di kelas ".$tingkat;
      }else{
        echo "Lulus ke tingkat pendidikan selanjutnya";
      } ?>
    </div>
  </div>
</div>          
        
<?php endif ?>