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
<?php 
include "../../../../koneksi.php";
$id = $_GET['id'];
$qkelas = mysqli_query($conn, "SELECT * from kelas as a 
join ptk as b on a.id_ptk=b.id_ptk where a.id_kelas = '$id'");
$dkelas= mysqli_fetch_array($qkelas);

$no=1;
 ?>
<br>

   Kelas <?php echo $dkelas['tingkat'] ?> Lokal  <?php echo $dkelas['nama_kelas'] ?>






<?php


  
  $perintah="SELECT * From siswa join kelas on kelas.id_kelas=siswa.id_kelas where kelas.id_kelas='$id'";
  $jalan=mysqli_query($conn, $perintah)or die(mysqli_error());


  $ql= mysqli_query($conn, "SELECT * From siswa where id_kelas='$id' and jk='L'");
  $qp= mysqli_query($conn, "SELECT * From siswa where id_kelas='$id' and jk='P'");

  $jl = mysqli_num_rows($ql);
  $jp = mysqli_num_rows($qp);

  $total = mysqli_num_rows($jalan);
  $no=1;
?>
<br> <br>

<table class="table table-striped table-bordered" id="example1" border="1" style="border-collapse: collapse;width: 100%">
  <thead>
  <tr>
    <td>No</td>
    <td>NIS</td>
    <td>Nama</td>
    <td>L / P</td>
  </tr>
</thead>
  

<?php

while ($data=mysqli_fetch_array($jalan))
{ 
$pt = explode('-', $data['tgll']);
$tgll = $pt[2].'-'.$pt[1].'-'.$pt[0];


?>
  <tr>
    <td><?php echo $no++; ?></td>
  

    
  <td><?php echo $data['nis']; ?></td>
  <td><?php echo $data['nama_siswa']; ?></td>
  <td><?php echo $data['jk']; ?></td>
  

    </tr>

    <?php } ?>
        
  </table>


<br>
<div style="float:left">
  Cat : <br>
L : <?php echo $jl ?><br>
P : <?php echo $jp ?>
</div>
<div style="float:right">
  Wali Kelas 
  <br><br><br><br>
  <?php echo $dkelas['nama_ptk'] ?><br>
 NIP : <?php echo $dkelas['nip'] ?>
</div>


    <script type="text/javascript">
      window.print();
    </script>