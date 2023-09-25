<?php

include "../../../../koneksi.php";
require_once("../../../../library/dompdf/src/Autoloader.php");
Dompdf\Autoloader::register();
use Dompdf\Dompdf;

$q = mysqli_query($conn, "SELECT * from ptk");
$no=1;

$html = '
<br>
<h4>Data Pendidik Dan Tenaga Kependidikan <br>
SMAN 5 Pariaman <br>
Kecamatan Kec. Pariaman Timur, Kabupaten Kota Pariaman, Provinsi Prov. Sumatera Barat</h4>


<table class="table table-striped table-bordered" id="tabelscrol" border="1" style="border-collapse: collapse; font-size:11px">
  <thead>
  <tr>
    <td align="center" rowspan="2">No</td>
    <td align="center" rowspan="2">Nama</td>
    <td align="center" rowspan="2">NUPTK</td>
    <td align="center" rowspan="2">JK</td>
    <td align="center" rowspan="2">Tempat Lahir</td>
    <td align="center" rowspan="2">Tanggal Lahir</td>
    <td align="center" rowspan="2">NIP</td>
    <td align="center" rowspan="2">Status Kepegawaian</td>
    <td align="center" rowspan="2">Jenis PTK</td>
    <td align="center" colspan="7">Keterangan</td>
    
  </tr>
  <tr>
    
    <td align="center">Gelar Depan</td>
    <td align="center">Gelar Belakang </td>
    <td align="center">Jenjang Pendidikan</td>
    <td align="center">Jurusan</td>
    <td align="center">Sertifikasi</td>
    <td align="center">TMT Kerja</td>
    <td align="center">Tugas Tambahan</td>
  </tr>
</thead>
               
';
while ($data=mysqli_fetch_array($q))
{ 




  $html .='
  <tr>
    <td>'.$no++.'</td>
    <td>'.$data['nama_ptk'].'</td>
    <td>'.$data['nuptk'].'</td>
    <td align="center">'.$data['jk'].'</td>
    <td>'.$data['tmpl'].'</td>
    <td>'.$data['tgll'].'</td>
    <td>'.$data['nip'].'</td>
    <td>'.$data['status_pegawai'].'</td>
    <td>'.$data['jenis_ptk'].'</td>
    <td>'.$data['gelar_depan'].'</td>
    <td>'.$data['gelar_belakang'].'</td>
    <td>'.$data['jenjang_pendidikan'].'</td>
    <td>'.$data['jurusan'].'</td>
    <td>'.$data['sertifikasi'].'</td>
    <td>'.$data['tmt_kerja'].'</td>


    <td>'.$data['tugas_tambahan'].'</td>


    </tr>
  ';
}


$html .= '
</table>
';

$dompdf = new Dompdf();

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream('Data Pendidik dan Tenaga Kependidikan.pdf', ['Attachment'=>0]);

?>
<p style="font-size: "></p>

