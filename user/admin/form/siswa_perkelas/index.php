<?php 
// ta = tahun ajaran  
  $qta = mysqli_query($conn, "SELECT * from tahun_ajaran where status_ta='Aktif'");
  $jta = mysqli_num_rows ($qta);
  $dta = mysqli_fetch_array($qta);
  $id_ta = $dta['id_ta'];
 ?>

<div class="box-header with-border">
  <h3 class="box-title">
    Data Siswa Per Kelas
  </h3>
  
  
</div>


<?php

if ($jta>0) {


  $perintah="SELECT * From kelas ";
  $jalan=mysqli_query($conn, $perintah);

  $total = mysqli_num_rows($jalan);
  $no=1;
?>
<table class="table table-striped table-bordered" id="example1">
  <thead>
  <tr>
    <td>No</td>
    <td>Kelas</td>
    <td>Lokal</td>
    
    <td>Wali Kelas</td>
    <td>Jumlah Siswa</td>
    
    <td>Option</td>
  </tr>
</thead>
  

<?php

while ($data=mysqli_fetch_array($jalan))
{ 
  $idkelas = $data['id_kelas'];
$q = mysqli_query($conn, "SELECT b.nama_guru, a.status_wali_kelas, a.id_walikelas from wali_kelas a left join guru b on a.id_guru = b.id_guru where a.status_wali_kelas='1' and a.id_kelas = '$idkelas'");
$d = mysqli_fetch_array($q);
$id_wk = $d['id_walikelas'];
$j = mysqli_num_rows($q);
$status_wali_kelas = $d['status_wali_kelas'];
if ($status_wali_kelas>0) {
  $walikelas = $d['nama_guru'];
}else{
  $walikelas = "Wali kelas belum ditentukan";

}
$id=$data['id_kelas'];
$kelas=$data['nama_kelas'];

// qks = query kelas siswa
$qks = mysqli_query($conn, "SELECT * from kelas_siswa where id_kelas='$idkelas' and status_ks='Aktif' and id_ta='$id_ta'");
$jks = mysqli_num_rows($qks);
;

?>
  <tr>
    <td><?php echo $no++; ?></td>
  

    
  
  <td><?php echo $data['tingkat']; ?></td>
  <td><?php echo $kelas; ?></td>
  <td>  <?php echo  $walikelas; ?></td>
  <td>  <?php echo  $jks; ?></td>
  
  <td>
    <a href="?a=data_siswa_kelas&id_kelas=<?php echo $id ?>&id_ta=<?php echo $id_ta ?>&id_wk=<?php echo $id_wk ?>" class="btn btn-default btn-xs">Lihat Siswa</a> 

  </td>
    </tr>

    <?php } ?>
        
  </table>

<?php }else{ ?>
<div class="alert alert-info">
  Saat ini tidak ada tahun ajaran aktif <br>Data siswa ditampilkan jika ada tahun ajaran aktif
</div>
<?php   } ?>

  