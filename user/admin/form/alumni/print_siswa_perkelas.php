<?php

include "../../../../koneksi.php";
require_once("../../../../library/dompdf/src/Autoloader.php");
Dompdf\Autoloader::register();
use Dompdf\Dompdf;

$id = $_GET['id'];
$qkelas = mysqli_query($conn, "SELECT * from kelas as a 
join ptk as b on a.id_ptk=b.id_ptk where a.id_kelas = '$id'");
$dkelas= mysqli_fetch_array($qkelas);  

  $perintah="SELECT * From siswa join kelas on kelas.id_kelas=siswa.id_kelas where kelas.id_kelas='$id'";
  $jalan=mysqli_query($conn, $perintah)or die(mysqli_error());


  $ql= mysqli_query($conn, "SELECT * From siswa where id_kelas='$id' and jk='L'");
  $qp= mysqli_query($conn, "SELECT * From siswa where id_kelas='$id' and jk='P'");

  $jl = mysqli_num_rows($ql);
  $jp = mysqli_num_rows($qp);

  $total = mysqli_num_rows($jalan);
  $no=1;


$html = '
<center>
  <div style="width: 50px;float: left">
  <img src="../../../../home/gambar/logosumbar.png" style="width: 50px; margin-top: 20px">
</div>

<div style="width: 600px; float: left;">
  <center>
    <h3>
      PEMERINTAH KABUPATEN PESISIR SELATAN <br>
    DINAS PENDIDIKAN DAN KEBUDAYAAN <br> 
    <b>SMA NEGERI 5 PARIAMAN</b></h3>
    <p style="margin-top: -10px">Jln. Kayu Gadang Desa Pakasai kec. Pariaman Timur  kode pos : 25524<br><i> Email : sman5pariaman@yahoo.co.id website : <b>www.sman5pariaman.sch.id</b></i></p>
    
  </center>
</div>
<div style="width: 50px;float: left">
  <img src="../../../../home/gambar/logo.jpg" style="width: 70px; margin-top: 20px">
</div>
</center>

<div style="clear:both;"></div>
<hr>

<br>

   Data Siswa Kelas  '.$dkelas['nama_kelas'].'

<br> <br>

<table class="table table-striped table-bordered" id="example1" border="1" style="border-collapse: collapse;width: 100%; font-size:11px">
  <thead>
  <tr>
    <td>No</td>
    <td>NIS</td>
    <td>Nama</td>
    <td>L / P</td>
  </tr>
</thead>
               
';
while ($data=mysqli_fetch_array($jalan))
{ 




  $html .='<tr>
    <td>'.$no++.'</td>
  <td>'.$data['nis'].'</td>
  <td>'.$data['nama_siswa'].'</td>
  <td>'.$data['jk'].'</td>
    </tr>';
}


$html .= '
</table>
<br>
<div style="float:left">
  Cat : <br>
L : '.$jl.'<br>
P : '.$jp.'
</div>
<div style="float:right">
  Wali Kelas 
  <br><br><br><br>
  '.$dkelas['nama_ptk'].'<br>
 NIP : '.$dkelas['nip'].'
</div>


';

$dompdf = new Dompdf();

$dompdf->loadHtml($html);
$dompdf->render();
$dompdf->stream('Data siswa kelas '.$dkelas['nama_kelas'].'.pdf', ['Attachment'=>0]);

?>
<p style="font-size: "></p>

