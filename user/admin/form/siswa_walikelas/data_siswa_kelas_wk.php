<?php 
// ta = tahun ajaran  
$id_ta_aktif = $_GET['id_ta'];
$id_kelas = $_GET['id_kelas'];
$semester_ke = $_GET['semester'];
$id_wk = $_SESSION['id_user'];
$semester = [1=>'Ganjil','Genap'];

  $qta = mysqli_query($conn, "SELECT * from tahun_ajaran where id_ta='$id_ta_aktif' and semester='$semester_ke'");
  $jta = mysqli_num_rows ($qta);
  $dta = mysqli_fetch_array($qta);
  $id_ta = $dta['id_ta'];
  $status_ta = $dta['status_ta'];
  $semester_aktif = $dta['semester'];
  $qkelas = mysqli_query($conn, "SELECT * from kelas where id_kelas='$id_kelas'");
  $dkelas = mysqli_fetch_array($qkelas);


   $qcekwk = mysqli_query($conn, "SELECT b.nama_guru, a.status_wali_kelas, a.id_guru, b.nip, a.username, a.id_walikelas from wali_kelas a left join guru b on a.id_guru = b.id_guru where a.id_kelas='$id_kelas' order by id_walikelas desc limit 1");
      $jcekwk = mysqli_num_rows($qcekwk);
      $dcekwk = mysqli_fetch_array($qcekwk);
      $id_wk_aktif = $dcekwk['id_guru'];
      $id_wali_kelas = $dcekwk['id_walikelas'];
 ?>




   <div class="box-header with-border">
      <h3 class="box-title">
       Identitas Kelas

      </h3>
      
      
      
    </div>

<div class="col-md-6">
    <div class="box-body">
      
      
        <table class="table">
          <tr>
            <td>Kelas</td>
            <td><?php echo $dkelas['tingkat'] ?></td>
          </tr>
          <tr>
            <td>Lokal</td>
            <td><?php echo   $dkelas['nama_kelas'] ?></td>
          </tr>
           <tr>
            <td>Wali Kelas</td>
            <td><?php echo $dcekwk['nama_guru'] ?></td>
          </tr>
          <tr>
            <td>NIP</td>
            <td><?php echo $dcekwk['nip'] ?></td>
          </tr>
     
        
         
        </table>
    </div>




</div>
<div class="col-md-6">
    <div class="box-body">
      
      
        <table class="table">
          
        
     
          <?php if ($jta==0) {
            $qta_selesai = mysqli_query($conn, "SELECT * from tahun_ajaran where id_ta='$id_ta_aktif'");
            $dta_selesai = mysqli_fetch_array($qta_selesai); ?>
           <tr>
            <td>Tahun Ajaran</td>
            <td><?php echo $dta_selesai['nama_ta'] ?></td>
          </tr>
         
          <tr>
            <td>Status Tahun Ajaran</td>
            <td><?php echo $dta_selesai['status_ta'] ?></td>
          </tr>
          <?php }else{ ?>
          <tr>
            <td>Tahun Ajaran</td>
            <td><?php echo $dta['nama_ta'] ?></td>
          </tr>
          <tr>
            <td>Semester</td>
            <td>
              <?php echo $semester[$dta['semester']].'<br>'; 
              if ($dta['semester']=='2') { ?>
                <!-- <a href="">Lihat Semester Ganjil</a> -->
              <?php } ?>
              
            </td>
          </tr>
          <tr>
            <td>Status Tahun Ajaran</td>
            <td><?php echo $dta['status_ta'] ?></td>
          </tr>
          <?php } ?>
        </table>
    </div>



</div>

<div class="clearfix"></div>
<hr>
  <div class="box-header with-border">
    <h3 class="box-title">
      Data Siswa Dan Penilaian

    </h3>
   <div class="pull-right">
     <a href="form/siswa_walikelas/print_nilai.php?id_kelas=1&id_ta=4&semester=2" class="btn btn-info btn-sm" target="_blank">Print</a>
   </div>
  </div>
<?php
$tingkat = $dkelas['tingkat']; 
$qmapel = mysqli_query($conn, "SELECT * from mapel where tingkat='$tingkat' ");
$jmapel = mysqli_num_rows($qmapel); 
$kumpulkan_mapel = [];
while ($dmapel = mysqli_fetch_array($qmapel)) {
  $data = [
    'id_mapel'=>$dmapel['id_mapel'],
    'nama_mapel'=>$dmapel['nama_mapel'],
    'kkm'=>$dmapel['kkm']
  ];
  array_push($kumpulkan_mapel, $data);
}
 ?>
  <table class="table table-striped table-bordered" id="example1">
    <thead>
      <tr>
      <td rowspan="2">No</td>
        <td rowspan="2">NIS</td>
        <td rowspan="2">NISN</td>
        <td rowspan="2">Nama siswa</td>
        <td rowspan="2">Jenis Kelamin</td>
        <td colspan="<?php echo $jmapel ?>"><center>Mata Pelajaran</center></td>
        <td rowspan="2">Total Nilai</td>
        <td rowspan="2">Rata Rata</td>
        <?php if (/*$dta['status_ta']=='Selesai' && */$semester_ke=='2') { ?>
        <td rowspan="2">Keputusan</td>
      <?php } ?>
      <td rowspan="2">Input Nilai Semester</td>
      </tr>
      <tr>
        <?php foreach ($kumpulkan_mapel as $value) { ?>
          <td><?php echo $value['nama_mapel'] ?></td>
        <?php } ?>
      </tr>
      
    </thead>
    

  <?php
  $no=1;
$mapel = mysqli_query($conn, "SELECT a.status_ks, a.id_siswa,  b.nama_siswa, b.nis, b.nisn, b.jk, b.agama, b.tmpl, b.tgll, c.tingkat
 from kelas_siswa a
 left join siswa b on a.id_siswa = b.id_siswa
 left join kelas c on a.id_kelas = c.id_kelas
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
   <?php 

      $total_nilai = 0;
      $tuntas = 0;
      $tidak_tuntas = 0;
      foreach ($kumpulkan_mapel as $dmapel) { 
    $id = $data['id_siswa'];
    $id_mapel = $dmapel['id_mapel'];
      $qnilai = mysqli_query($conn, "SELECT * from nilai where id_kelas='$id_kelas' and id_ta='$id_ta_aktif' and id_wali_kelas='$id_wk' and id_mapel='$id_mapel' and id_siswa='$id' and semester='$semester_ke'") or die(mysqli_error());
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
      }?>
          <td><p style="color: <?php echo $warna ?>"><?php echo $nilai=='' ? ' - ': $nilai ?></p></td>
        <?php } ?>
  <td><?php echo $total_nilai == 0 ? '-' : $total_nilai ?></td>
  <td><?php 
      $ratarata = round($total_nilai / $jmapel, 2);
      echo $ratarata == 0 ? '-' : $ratarata ?></td>

 <?php if (/*$dta['status_ta']=='Selesai' && */$semester_ke=='2') { 

      if ($data['status_ks']=='Aktif') {
          $keputusan =  "Belum ada keputusan";
        }else{
          if ($data['status_ks']=='Lanjut') {
            $next_kelas = $tingkat +1;
            $keputusan =  "Naik ke Kelas ".$next_kelas;
          }
          elseif ($data['status_ks']=='Lulus') {
            $keputusan =  "Lulus ke tingkat pendidikan selanjutnya";
          }else{
            $keputusan =  "Tinggal di  Kelas ".$tingkat;

          }
        }
  ?>
        <td><?php echo $keputusan ?></td>
      <?php } ?>
  <td>
    <?php if ($id_wk_aktif!=$id_wk) {
      if ($dcekwk['status_wali_kelas']=="0") {
        echo "Anda di nonaktifkan sebagai wali kelas ".$dkelas['nama_kelas'];
      }else{
        echo "Wali kelas sudah di ganti ";
      }
    }else{ 
       ?>
    
        
    <a href="?a=detail_siswa&id=<?php echo $data['id_siswa'] ?>&t=1&id_kelas=<?php echo $id_kelas ?>&id_ta=<?php echo $id_ta_aktif ?>&id_wk=<?php echo $id_wk ?>&tingkat=<?php echo $data['tingkat'] ?>&status_ks=<?php echo $data['status_ks'] ?>&semester=<?php echo $semester_ke ?>&status_ta=<?php echo $status_ta ?>" class="btn btn-info btn-xs"><!-- <i class="fa fa-sort-numeric-asc"></i> --> Penilaian</a> 
          
      
  </td>
    <?php 
        }
      
     ?>
    </tr>

    <?php } ?>
        
          
    </table>
