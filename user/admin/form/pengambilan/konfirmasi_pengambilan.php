<?php
include "../../../../assets/koneksi.php";

$id=$_POST['id_siswa'];
$barang = $_POST['barang'];
$waktu_pengambilan = date('Y-m-d h:i:s');
foreach ($barang as $value) { 
          $q_p = mysqli_query($conn, "SELECT * from penunjang_belajar where id_penunjang='$value'");
          $d_p = mysqli_fetch_array($q_p);
          $barang = $d_p['nama_penunjang'];
          $biaya = $d_p['biaya'];
$q_i = mysqli_query($conn, "INSERT Into pengambilan set 
  id_siswa='$id',
  barang='$barang',
  biaya='$biaya',
  waktu_pengambilan = '$waktu_pengambilan'
  ") or die(mysqli_error());

}
?>
<script type="text/javascript">
  alert('Pengambilan disimpan');
  window.location.href='../../?a=pengambilan'
</script>