<?php

$menu=$_GET['menu'];
$id=$_GET['id_siswa'];
  $perintah="SELECT * From siswa where id_siswa='$id'";
  $jalan=mysqli_query($conn, $perintah);
  $d1=mysqli_fetch_array($jalan);
  $no=1;

?>
<div class="box-header with-border">
  <h3 class="box-title">
   Detail Hutang Piutang Siswa

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

$qambil = mysqli_query($conn, "SELECT * from pengambilan where id_siswa='$id'");
$j_ambil = mysqli_num_rows($qambil);
?>

  <div class="box-body">

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
<hr>
      <div class="box-header with-border">
        <h3 class="box-title">
          Data Transaksi
        </h3>
        <div class="pull-right">
           <?php if ($_SESSION['level'] == 'Administrator') { 
            if ($menu=='filter') { ?>
              












<form action="?a=hutang_perkelas" method="post"  enctype="multipart/form-data">

                  <input type="hidden" name="id_kelas" class="form-control" value="<?php echo $_GET['id_kelas'] ?>">
                  <input type="hidden" name="ta" class="form-control"  value="<?php echo $_GET['id_ta'] ?>">
                <button type="submit" class="btn btn-info btn-sm">Kembali</button>
                <?php if ($j_ambil>0) { ?>
              <a href="" class=" btn btn-info btn-sm"  data-toggle="modal" data-target="#bayar">Pembayaran</a>
            <?php } ?>
               
</form>




            <?php }else{ ?>
            <a href="?a=pengambilan" class="btn btn-info btn-sm">Kembali</a>
            <?php if ($j_ambil>0) { ?>
              <a href="" class=" btn btn-info btn-sm"  data-toggle="modal" data-target="#bayar">Pembayaran</a>
            <?php } ?>
            <?php 
            }
            ?>
          <?php } ?>
        </div>
      </div>

      <?php if ($j_ambil==0) { ?>
        <div class="alert alert-info">Tidak ada data</div>
      <?php }else{ ?>
      <table class="table table-bordered">
       <thead>
          <tr>
          <td>No</td>
          <TD>Waktu Transaksi</TD>
          <td>Kategori</td>
          <td>Keterangan</td>
          <td>Hutang</td>
          <td>Sudah Dibayar</td>
          <td>Action</td>
        </tr>
       </thead>
       
       <?php 
       $kumpuldata = [];
       
       while ($dambil = mysqli_fetch_array($qambil)) {
         $data = [
          'id'=>$dambil['id_pengambilan'],
          'keterangan'=>$dambil['barang'],
          'kategori'=>'Pengambilan',
          'debit'=>$dambil['biaya'],
          'kredit'=>0,
          'waktu_transaksi'=>$dambil['waktu_pengambilan'],
         ];
         array_push($kumpuldata,$data);
       }

       $q_pemb = mysqli_query($conn, "SELECT * from pembayaran where id_siswa='$id'");
       while ($dpemb = mysqli_fetch_array($q_pemb)) {
         $data = [
          'id'=>$dpemb['id_pembayaran'],
          'keterangan'=>$dpemb['keterangan'],
          'kategori'=>'Pembayaran',
          'debit'=>0,
          'kredit'=>$dpemb['jumlah'],
          'waktu_transaksi'=>$dpemb['tanggal_bayar'],
         ];
         array_push($kumpuldata,$data);
       }
       // arsort($kumpuldata);
       $totdebit = 0 ;
       $totkredit = 0 ;
       foreach ($kumpuldata as $key => $value) { 
        $totdebit += $value['debit'];
        $totkredit += $value['kredit'];
        ?>
          <tr>
          <td><?php echo $no++ ?></td>
          <td><?php echo $value['waktu_transaksi'] ?></td>
          <td><?php echo $value['kategori'] ?></td>
          <td><?php echo $value['keterangan'] ?></td>
          <td><?php echo number_format($value['debit']) ?></td>
          <td><?php echo number_format($value['kredit']) ?></td>
          <td>
            <?php if ($_SESSION['level'] == 'Administrator') { ?>

            <a href="form/pengambilan/hapus_transaksi.php?id=<?php echo $value['id'] ?>&kategori=<?php echo $value['kategori'] ?>&id_siswa=<?php echo $id ?>" class="btn btn-danger btn-xs" onclick="return confirm('Apakah anda yakin.?')">Hapus</a>
            <?php } ?>
          </td>
        </tr>
       <?php }
       $sisa = $totdebit - $totkredit ; 
       ?>
        <tr>
          <td colspan="4">Total</td>
          <td><?php echo number_format($totdebit) ?></td>
          <td><?php echo number_format($totkredit) ?></td>
          <td>Sisa : <?php echo number_format($sisa) ?></td>
        </tr>
      </table>
    <?php } ?>
    
      
 
   
    <div class="clearfix"></div>
    
    
  </div>


<form action="form/pengambilan/simpan_pembayaran.php" method="post"  enctype="multipart/form-data">
<div class="modal fade" id="bayar">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Pembayaran Hutang</h4>
              </div>
              <div class="modal-body">

              <div class="form-group">
                  <label>Hutang Tersisa</label>
                  <input type="hidden" name="id_siswa" class="form-control" value="<?php echo $id ?>" readonly>
                  <input type="hidden" name="sisa" class="form-control" value="<?php echo $sisa ?>" readonly>
                  <input type="text" name="" class="form-control" value="<?php echo number_format($sisa) ?>" readonly>
              </div>
              <div class="form-group">
                  <label>Dibayar</label>
                  <input type="number" name="bayar" class="form-control" required>
              </div>
              <div class="form-group">
                  <label>Keterangan</label>
                  <input type="text" name="ket" class="form-control" required>
              </div>
            
            </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan Pembayaran</button>
               
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
</form>
