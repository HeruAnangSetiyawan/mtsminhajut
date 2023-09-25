<?php

$id=$_POST['id_siswa'];
@$penunjang = $_POST['penunjang'];

  $perintah="SELECT * From siswa where id_siswa='$id'";
  $jalan=mysqli_query($conn, $perintah);
  $d1=mysqli_fetch_array($jalan);
  $no=1;

?>
<div class="box-header with-border">
  <h3 class="box-title">
   Checkut Pengambilan Penunjang Belajar Siswa

  </h3>

</div>


<div class="clearfix"></div>



<?php

$qkelas = mysqli_query($conn, "SELECT 
  a.status_ks, a.id_ks, a.id_siswa, a.id_wali_kelas,
  b.nama_ta, c.nama_kelas, c.tingkat,
  e.nama_guru,
  f.nama_kelas as next_kelas

  from kelas_siswa a 
  left join tahun_ajaran b on a.id_ta = b.id_ta
  left join kelas c on a.id_kelas = c.id_kelas
  left join wali_kelas d on a.id_wali_kelas = d.id_walikelas
  left join guru e on d.id_guru = e.id_guru
  left join kelas f on a.id_next_kelas = f.id_kelas
  where a.id_siswa = '$id' group by a.id_ta");
$jkelas = mysqli_num_rows($qkelas);
?>

  <div class="box-body">
    <div class="col-md-6">
    <div class="box-header with-border">
      <h3 class="box-title">
        Siswa Pengambil
      </h3>
    </div>
      <table class="table">
        <tr>
          <td>Nama</td>
          <td>:</td>
          <td><?php echo $d1['nama_siswa'] ?></td>
        </tr>
        <tr>
          <td>NIS</td>
          <td>:</td>
          <td><?php echo $d1['nis'] ?></td>
        </tr>
        <tr>
          <td>NISN</td>
          <td>:</td>
          <td><?php echo $d1['nisn'] ?></td>
        </tr>
        <tr>
          <td>Jenis Kelamin</td>
          <td>:</td>
          <td><?php echo $d1['jk'] ?></td>
        </tr>
        <tr>
          <td>Alamat</td>
          <td>:</td>
          <td><?php echo $d1['alamat'] ?></td>
        </tr>
        <tr>
          <td>No HP</td>
          <td>:</td>
          <td><?php echo $d1['no_telp'] ?></td>
        </tr>
      </table>
    </div>
    <div class="col-md-6">
      <form action="form/pengambilan/konfirmasi_pengambilan.php" method="post">
      <div class="box-header with-border">
        <h3 class="box-title">
          Barang Yang Di Ambil
        </h3>
      </div>
      <?php if (isset($penunjang)) { ?>
      <table class="table">
        <tr>
          <td>No</td>
          <td>Item</td>
          <td>Biaya</td>
        </tr>
        <?php 
        $total = 0;
        $no = 1;
        foreach ($penunjang as $value) { 
          $q_p = mysqli_query($conn, "SELECT * from penunjang_belajar where id_penunjang='$value'");
          $d_p = mysqli_fetch_array($q_p);
          $total += $d_p['biaya'];
          ?>
          
        <tr>
          <td><?php echo $no++ ?></td>
          <td><?php echo $d_p['nama_penunjang'] ?></td>
          <td><?php echo number_format($d_p['biaya']) ?></td>
        </tr>
        <input type="hidden" name="barang[]" value="<?php echo $value ?>">
        <?php } ?>
        <tr>
          <td colspan="2">Total</td>
          <td><?php echo number_format($total) ?></td>
        </tr>
       
      </table>
    
      
      <input type="hidden" name="id_siswa" value="<?php echo $id ?>">
      <button class="btn btn-info btn-sm">Konfirmasi Pengambilan</button>
    <?php }else{ ?>
      <div class="alert alert-info">Barang belum dipilih <br>Silahkan coba lagi</div>
      <a href="?a=pengambilan_baru" class="btn btn-info">Kembali</a>
    <?php } ?>
    </form>
    </div>
   
    <div class="clearfix"></div>
    
    
  </div>

