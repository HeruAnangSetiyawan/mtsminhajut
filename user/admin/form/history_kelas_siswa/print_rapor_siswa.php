<?php

include "../../../../assets/koneksi.php";
require_once("../../../../assets/dompdf/src/Autoloader.php");
Dompdf\Autoloader::register();
use Dompdf\Dompdf;


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
  left join wali_kelas wk on ks.id_kelas = wk.id_kelas and wk.status_wali_kelas='1'
  left join guru as g on wk.id_guru = g.id_guru
  where ks.id_siswa='$id_siswa' and ks.id_kelas='$id_kelas' and ks.id_ta='$id_ta_aktif'
  ");
$d_kelas_siswa = mysqli_fetch_array($q_kelas_siswa);


$html = '

<center>
  <h3>LAPORAN HASIL BELAJAR <br>PENILAIAN AKHIR SEMESTER </h3>
</center>
<hr>
<table style="font-size:12px;border-collapse: collapse;" >
      <tr>
        <td width = "200px">Nama Siswa</td>
        <td>'.$d1['nama_siswa'].'</td>
      </tr>
      <tr>
        <td>NISN / NIS</td>
        <td>'.$d1['nisn'].'/'.$d1['nis'].'</td>
      </tr>
      <tr>
        <td>Kelas</td>
        <td>'.$d_kelas_siswa['tingkat'].' - '.$d_kelas_siswa['nama_kelas'].'</td>
      </tr>
      <tr>
        <td>Nama Sekolah</td>
        <td>SD NEGERI 15 PADANG PASIR</td>
      </tr>
      <tr>
        <td>Semester</td>
        <td>'.$semester.' ('.$semester_aktif.')</td>
      </tr>
      <tr>
        <td>Tahun Ajaran</td>
        <td>'.$d_kelas_siswa['nama_ta'].'</td>
      </tr>
      </table>
      <br>
    ';
$html .= '
<table style="font-size:12px;border-collapse: collapse;" border=1 width="100%">
      <tr>
        <th align="center" width="30px">No</th>
        <th align="center">Mata Pelajaran</th>
        <th align="center" width="50px">KKM</th>
        <th align="center" width="50px">Nilai</th>
        
     

';
$no = 1;
$total_nilai = 0;
foreach ($kumpulkan_mapel as $dmapel){ 
  $id_mapel = $dmapel['id_mapel'];
            
$qnilai = mysqli_query($conn, "SELECT * from nilai where id_kelas='$id_kelas' and id_ta='$id_ta_aktif' and id_mapel='$id_mapel' and id_siswa='$id' and semester='$semester'");
$dnilai = mysqli_fetch_array($qnilai);
$nilai = $dnilai['nilai'];
$total_nilai += $nilai;

if ($nilai<$dmapel['kkm']) {
              $warna = "red";
              $satu = 1;
            }else{
              $warna = "green";
              $satu = 1;
            } 
$html .= '

      <tr>
        <td align="center">'.$no++.'</td>
        <td>'.$dmapel['nama_mapel'].'</td>
        <td align="center">'.$dmapel['kkm'].'</td>
        <td align="center" style="color:'.$warna.'; border-color:black">'.$nilai.'</td>
        
     

';
 }

$ratarata = round($total_nilai / $jmapel, 2);
$show_ratarata = $ratarata == 0 ? '' : $ratarata;
$html .= '
     <tr>
        <td colspan="4" align="center">JUMLAH NILAI = '.$total_nilai.'</td>
      </tr>
     <tr>
        <td colspan="4" align="center">RATA RATA = '.$show_ratarata.'</td>
      </tr>
    </table>
      <br>
';


if ($status_ks!="Aktif" && $semester=='2'){
  if ($status_ks=='Lanjut') {
        $next = $tingkat + 1;
        $keputusan =  "Naik ke kelas ".$next;
      }else{
        $keputusan =  "Tinggal di kelas ".$tingkat;
      }         



$html .= '
<div style="font-size:14px">
<b>Keputusan :</b> <br>
Berdasarkan pencapaian kompetensi pada semester 1 dan semester 2, <br>
Peserta didik dinyatakan '.$keputusan.'
</div>
     
';

}


$html .= '
<div style="float:left; font-size:14px">
<br>
Wali Murid 
 <br> <br> <br> <br>
'.$d1['nama_ayah'].'
</div>';
$html .= '
<div style="float:right; font-size:14px">
Padang, '.date('d').' '.$nama_bulan[date('n')].' '.date('Y').' <br>
Wali Kelas '.$d_kelas_siswa['nama_kelas'].' 
 <br> <br> <br> <br>
'.$d_kelas_siswa['nama_guru'].'
</div>';
$html .= '
<div style="clear:both"></div>
<br><br>';
$html .= '
<div style="font-size:14px">
<center>

Mengetahui, <br>
KEPALA SD NEGERI 15 PADANG PASIR
 <br> <br> <br> <br>
ROHANI, S.Pd <br>
NIP : 19660821 199005 2 001
</center>
</div>';

$dompdf = new Dompdf();

$dompdf->loadHtml($html);
$dompdf->render();
$dompdf->stream('Data Raport '.$d1['nama_siswa'].'.pdf', ['Attachment'=>0]);

?>
<p style="font-size: "></p>

