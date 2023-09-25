<?php
session_start();
include "../../../../assets/koneksi.php";
require_once("../../../../assets/dompdf/src/Autoloader.php");
Dompdf\Autoloader::register();
use Dompdf\Dompdf;

$id_ta_aktif = $_GET['id_ta'];
$id_kelas = $_GET['id_kelas'];
// $semester_ke = $_GET['semester'];

$semester = [1=>'Ganjil','Genap'];




$qta = mysqli_query($conn, "SELECT * from tahun_ajaran where id_ta='$id_ta_aktif' ");
$jta = mysqli_num_rows ($qta);
$dta = mysqli_fetch_array($qta);
$id_ta = $dta['id_ta'];
$status_ta = $dta['status_ta'];
$semester_aktif = $dta['semester'];
$qkelas = mysqli_query($conn, "SELECT * from kelas where id_kelas='$id_kelas'");
$dkelas = mysqli_fetch_array($qkelas);


$qcekwk = mysqli_query($conn, "SELECT b.nama_guru, a.status_wali_kelas, a.id_guru, b.nip, a.username, a.id_walikelas from wali_kelas a left join guru b on a.id_guru = b.id_guru where a.id_kelas='$id_kelas' and a.status_wali_kelas ='1' order by id_walikelas desc limit 1");
$jcekwk = mysqli_num_rows($qcekwk);
$dcekwk = mysqli_fetch_array($qcekwk);
$id_wk_aktif = $dcekwk['id_guru'];
$id_wali_kelas = $dcekwk['id_walikelas'];




$html = '

<center>
  <h3>LAPORAN DATA SISWA PERKELAS</h3>
</center>
<hr>  
<table style="font-size:14px;border-collapse: collapse;" >
   <tr>
        <td width = "200px">Kelas</td>
        <td>'.$dkelas['tingkat'].' - '.$dkelas['nama_kelas'].'</td>
      </tr>
   <tr>
        <td width = "200px">Tahun Ajaran</td>
        <td>'.$dta['nama_ta'].'</td>
      </tr>
   <tr>
        <td width = "200px">Wali Kelas</td>
        <td>'.$dcekwk['nama_guru'].'</td>
      </tr>
    ';


$html .= '
<br>';

$html .= '
 <table style="font-size:12px;border-collapse: collapse; width:100%;" border = 1>
    
      <tr  width:100%;>
        <th rowspan="2" colspan="1">No</th>
        <th rowspan="2" colspan="1">NIS</th>
        <th rowspan="2" colspan="1">Nama siswa</th>
        <th rowspan="2" colspan="1">TTL</th>
        <th rowspan="2" colspan="1">Jenis Kelamin</th>
        <th rowspan="2" colspan="1">Agama</th>
        <th rowspan="2" colspan="1">Alamat</th>
        <th rowspan="2" colspan="1">No HP</th>
        <th colspan="2">Nama Orang Tua</th>
        <th colspan="2">Pekerjaan Orang Tua</th>
      </tr>
      <tr>
          <th>Ayah</th>
          <th>Ibu</th>
          <th>Ayah</th>
          <th>Ibu</th>
      </tr>
        

';

$no = 1;
$qsiswa = mysqli_query($conn, "SELECT * from kelas_siswa ks 
  left join siswa s on ks.id_siswa = s.id_siswa
  where ks.id_kelas='$id_kelas' and ks.id_ta='$id_ta_aktif'");
while ($dsiswa = mysqli_fetch_array($qsiswa)) {
  
$html .= '
 
      <tr>
        <td>'.$no++.'</td>
        <td>'.$dsiswa['nis'].'</td>
        <td>'.$dsiswa['nama_siswa'].'</td>
        <td>'.$dsiswa['tmpl'].'  '.$dsiswa['tgll'].'</td>
        <td>'.$dsiswa['jk'].'</td>
        <td>'.$dsiswa['agama'].'</td>
        <td>'.$dsiswa['alamat'].'</td>
        <td>'.$dsiswa['no_telp'].'</td>
        <td>'.$dsiswa['nama_ayah'].'</td>
        <td>'.$dsiswa['nama_ibu'].'</td>
        <td>'.$dsiswa['kerja_ayah'].'</td>
        <td>'.$dsiswa['kerja_ibu'].'</td>
      </tr>
        
     

';
}
$html .= '
 </table>
     

';




$dompdf = new Dompdf();

$dompdf->loadHtml($html);
$dompdf->render();
$dompdf->stream('Data Nilai Siswa.pdf', ['Attachment'=>0]);

?>
<p style="font-size: "></p>

