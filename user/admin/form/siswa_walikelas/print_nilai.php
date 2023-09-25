<?php
session_start();
include "../../../../assets/koneksi.php";
require_once("../../../../assets/dompdf/src/Autoloader.php");
Dompdf\Autoloader::register();
use Dompdf\Dompdf;

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




$html = '

<center>
  <h3>LAPORAN NILAI AKHIR HASIL BELAJAR <br>PENILAIAN AKHIR SEMESTER </h3>
</center>
<hr>  
<table style="font-size:14px;border-collapse: collapse;" >
   <tr>
        <td width = "200px">Kelas</td>
        <td>'.$dkelas['tingkat'].' - '.$dkelas['nama_kelas'].'</td>
      </tr>
    ';


if ($jta==0) {
            $qta_selesai = mysqli_query($conn, "SELECT * from tahun_ajaran where id_ta='$id_ta_aktif'");
            $dta_selesai = mysqli_fetch_array($qta_selesai);

$html .= '


   <tr>
        <td width = "200px">Tahun Ajaran</td>
        <td>'.$dta_selesai['nama_ta'].'</td>
      </tr>
   <tr>
        <td width = "200px">Semester</td>
        <td>'.$semester[$semester_ke].'</td>
      </tr>
      </table>
      
    ';


            }
            else{

$html .= '


   <tr>
        <td width = "200px">Tahun Ajaran</td>
        <td>'.$dta['nama_ta'].'</td>
      </tr>
   <tr>
        <td width = "200px">Semester</td>
        <td>'.$semester[$dta['semester']].'</td>
      </tr>
      </table>
      
    ';
            }



$html .= '
<br>';
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



$html .= '
 <table style="font-size:12px;border-collapse: collapse; width:100%" border = 1>
    <thead>
      <tr>
      <th rowspan="2">No</th>
        <th rowspan="2">NIS</th>
        <th rowspan="2">NISN</th>
        <th rowspan="2">Nama siswa</th>
        <th rowspan="2">Jenis Kelamin</th>
        <th colspan="'.$jmapel.'"><center>Mata Pelajaran</center></th>
        <th rowspan="2">Total Nilai</th>
        <th rowspan="2">Rata Rata</th>
        
     

';

if ($dta['status_ta']=='Selesai' && $semester_ke=='2') {

$html .= '
 <th rowspan="2">Keputusan</th>

</tr>
';
}



$html .= '
<tr>
';

foreach ($kumpulkan_mapel as $value) { 
  $html .= '
   <th style="font-size:12px; margin:5px">'.$value['nama_mapel'].'</th>     
  ';

  }


  $html .= '
   </tr>     
  ';




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
$html .= '
   <tr>     
  ';
$html .= '
  <td>'.$no++.'</td>
  

    
  <td>'.$data['nis'].'</td>
  <td>'.$data['nisn'].'</td>
  <td>'.$data['nama_siswa'].'</td>
  <td>'.$data['jk'].'</td>';


$total_nilai = 0;
      $tuntas = 0;
      $tidak_tuntas = 0;
      foreach ($kumpulkan_mapel as $dmapel) { 
    $id = $data['id_siswa'];
    $id_mapel = $dmapel['id_mapel'];
      $qnilai = mysqli_query($conn, "SELECT * from nilai where id_kelas='$id_kelas' and id_ta='$id_ta_aktif' and id_mapel='$id_mapel' and id_siswa='$id' and semester='$semester_ke'") or die(mysqli_error());
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
    $show_nilai = $nilai=='' ? ' - ': $nilai;
    $html .= '

  <td><p style="color: '.$warna.'">'.$show_nilai.'</p></td>
  ';
    }


$show_total_nilai = $total_nilai == 0 ? '-' : $total_nilai;
$ratarata = round($total_nilai / $jmapel, 2);
$show_ratarata =  $ratarata == 0 ? '-' : $ratarata; 


$html .= '
  <td>'.$show_total_nilai.'</td>     
  <td>'.$show_ratarata.'</td>     
  ';


  if ($dta['status_ta']=='Selesai' && $semester_ke=='2') { 

      if ($data['status_ks']=='Aktif') {
          $keputusan =  "Belum ada keputusan";
        }else{
          if ($data['status_ks']=='Lanjut') {
            $next_kelas = $tingkat +1;
            $keputusan =  "Naik ke Kelas ".$next_kelas;
          }else{
            $keputusan =  "Tinggal di  Kelas ".$tingkat;

          }
        }
$html .= '
  <td>'.$keputusan.'</td>     
 
  ';
}
$html .= '
   </tr>     
  ';
}



$dompdf = new Dompdf();

$dompdf->loadHtml($html);
$dompdf->render();
$dompdf->stream('Data Nilai Siswa.pdf', ['Attachment'=>0]);

?>
<p style="font-size: "></p>

