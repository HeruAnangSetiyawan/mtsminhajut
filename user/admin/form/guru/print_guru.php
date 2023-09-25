<?php
session_start();
include "../../../../assets/koneksi.php";
require_once("../../../../assets/dompdf/src/Autoloader.php");
Dompdf\Autoloader::register();
use Dompdf\Dompdf;


$html = '

<center>
  <h3>LAPORAN DATA GURU SDN 15 PADANG PASIR</h3>
</center>
<hr>  
    ';




$html .= '
 <table style="font-size:12px;border-collapse: collapse; width:100%" border = 1>
    <thead>
      <tr>
        <td>No</td>
        <td>Nama</td>
        <td>Tempat /Tanggal Lahir</td>
        <td>NIP</td>
        <td>JK</td>
        <td>Pangkat / Gol</td>
        <td>TMT</td>
        <td>Jabatan</td>
        <td>Ijazah Tahun</td>
        <td>Alamat</td>
        <td>Mulai di sekolah ini</td>
      </tr>

';
  $perintah="SELECT * From guru";
  $jalan=mysqli_query($conn, $perintah)or die(mysqli_error());
$no = 1;
while ($data=mysqli_fetch_array($jalan))
{ 
  $html .= '
      <tr>
        <td>'.$no++.'</td>
        <td>'.$data['nama_guru'].'</td>
        <td>'.$data['tmpl'].' / '.$data['tgll'].'</td>
        <td>'.$data['nip'].'</td>
        <td>'.$data['jk'].'</td>
        <td>'.$data['gol'].'</td>
        <td>'.$data['tmt'].'</td>
        <td>'.$data['jabatan'].'</td>
        <td>'.$data['ijazah_tahun'].'</td>
        <td>'.$data['alamat'].'</td>
        <td>'.$data['mulai_masuk'].'</td>
      </tr>

';

}




$dompdf = new Dompdf();

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream('Data gURU.pdf', ['Attachment'=>0]);

?>
<p style="font-size: "></p>

