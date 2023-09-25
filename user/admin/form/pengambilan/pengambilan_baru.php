
<?php 
  $q1=mysqli_query($conn, "SELECT * from penunjang_belajar");
  $q2=mysqli_query($conn, "SELECT 
    s.nama_siswa, s.nis, s.alamat, s.no_telp, s.id_siswa,
    k.tingkat, k.nama_kelas 
    from kelas_siswa ks
    left join siswa s on ks.id_siswa = s.id_siswa
    left join kelas k on ks.id_kelas = k.id_kelas
    left join tahun_ajaran ta on ks.id_ta = ta.id_ta
    where s.status_siswa = 'Aktif'
    group by id_ks
    ");
  $no=1;
 ?>
 <form method="post" action="?a=checkout_pengambilan">
<div class="col-md-7">
  <div class="box-header with-border">
    <h3 class="box-title">Siswa Pengambil</h3>
  </div>
    <table class="table table-striped table-bordered" id="example1">
      <thead>
        <tr>
          <td>Pilih SIswa</td>
          <td>Nama Siswa</td>
          <td>NIS</td>
          <td>Kelas Aktif</td>
          <td>ALamat</td>
          <td>No HP</td>
          
        </tr>
      </thead>
    <?php 
    while ($d2=mysqli_fetch_array($q2)) { 
      ?>
    <tr>
      
     
    
    
      <td>
        <input type="radio" name="id_siswa" value="<?php echo $d2['id_siswa'] ?>" required>
      </td>
      <td><?php echo $d2['nama_siswa'] ?></td>
      <td><?php echo $d2['nis'] ?></td>
      <td><?php echo $d2['tingkat'].' - '.$d2['nama_kelas'] ?></td>
      <td><?php echo $d2['alamat'] ?></td>
      <td><?php echo $d2['no_telp'] ?></td>


    </tr>
    <?php } ?>
  </table>
</div>


<div class="col-md-5">
  <div class="box-header with-border">
  <h3 class="box-title">Penunjang Belajar Yang Diambil</h3>
</div>
   <table class="table table-striped table-bordered" id="">
      <thead>
        <tr>
          <td>Item</td>
          <td>Nama Penunjang Belajar</td>
          
          <td>Biaya</td>
        </tr>
      </thead>
    <?php 
    while ($d1=mysqli_fetch_array($q1)) { 
      ?>
    <tr>
      
     
    
      <td>
        <input type="checkbox" name="penunjang[]" value="<?php echo $d1['id_penunjang'] ?>">
      </td>
      
      <td><?php echo $d1['nama_penunjang'] ?></td>
      
      <td><?php echo number_format($d1['biaya']) ?></td>

    </tr>
    <?php } ?>
  </table>
  
  <a href="?a=pengambilan" class="btn btn-info btn-sm">Kembali</a>
  <button class="btn btn-info btn-sm">Cek Total Biaya</button>
</div>
</form>