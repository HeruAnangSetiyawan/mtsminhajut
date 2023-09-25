<div class="box-header with-border">
  <h3 class="box-title">Hutang Piutang Siswa</h3>

  <div class="box-tools pull-right">
    <!-- <a href="" class="btn btn-default btn-sm"  target="_blank">Print Data Paket</a> -->

    <a href="" class=" btn btn-info btn-sm"  data-toggle="modal" data-target="#cari">Cari Hutang Perkelas</a>
    <a href="?a=pengambilan_baru" class="btn btn-info btn-sm" >Tambah Hutang</a>
  </div>
</div>



<form action="?a=hutang_perkelas" method="post"  enctype="multipart/form-data">
<div class="modal fade" id="cari">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Cari Hutang Per Kelas</h4>
              </div>
              <div class="modal-body">

              <div class="form-group">
                  <label>Kelas</label>
                  <select name="id_kelas" class="form-control">
                    <?php
                    $q_kelas = mysqli_query($conn, "SELECT * from kelas order by tingkat");
                    while($d_kelas = mysqli_fetch_array($q_kelas)){ ?>
                        <option value="<?php echo $d_kelas['id_kelas'] ?>"><?php echo $d_kelas['tingkat'].' - '.$d_kelas['nama_kelas'] ?></option>
                      <?php } ?>
                    
                  </select>
              </div>
              <div class="form-group">
                  <label>Tahun Ajaran</label>
                  <select name="ta" class="form-control">
                    <?php
                    $q_ta = mysqli_query($conn, "SELECT * from tahun_ajaran group by id_ta");
                    while($d_ta = mysqli_fetch_array($q_ta)){ ?>
                        <option value="<?php echo $d_ta['id_ta'] ?>"><?php echo $d_ta['nama_ta'] ?></option>
                      <?php } ?>
                    
                  </select>
              </div>
            
            </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Cari</button>
               
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
</form>
<hr>
<?php 
  $q1=mysqli_query($conn, "SELECT pg.id_siswa, 
    s.nama_siswa, s.nis, s.alamat,s.no_telp


   from pengambilan pg 
   left join siswa s on pg.id_siswa = s.id_siswa
   group by pg.id_siswa
    ");
  $no=1;
 ?>

 <table class="table table-striped table-bordered" id="example1">
    <thead>
      <tr>
        <td width="25px">No</td>
        <td width="40px">NIS</td>
        <td>Nama Siswa</td>
        <td>Kelas</td>
        <td>ALamat</td>
        <td>Jumlah Item</td>
        <td>Biaya</td>
        <td>Dibayar</td>
        <td>Sisa</td>
        <td>Action</td>
      </tr>
    </thead>
  <?php 
  while ($d1=mysqli_fetch_array($q1)) { 
    $id_siswa = $d1['id_siswa'];
    
      $q2=mysqli_query($conn, "SELECT count(id_pengambilan) as qty, sum(biaya) as biaya from pengambilan where id_siswa='$id_siswa'
    ");
      $d2 = mysqli_fetch_array($q2);
      $q3=mysqli_query($conn, "SELECT sum(jumlah) as dibayar from pembayaran where id_siswa='$id_siswa'
    ");
      $d3 = mysqli_fetch_array($q3);

      $q4 = mysqli_query($conn, "SELECT k.tingkat, k.nama_kelas from kelas_siswa ks 
        left join kelas k on ks.id_kelas=k.id_kelas where  ks.id_siswa='$id_siswa' order by id_ks desc limit 1");
      $d4 = mysqli_fetch_array($q4);
    $hutang = $d2['biaya'];
    $dibayar = $d3['dibayar'] =='' ? 0 : $d3['dibayar'];
    $sisa = $hutang - $dibayar;
    ?>
  <tr>
    <td><?php echo $no++ ?></td>
   
  
    
    <td><?php echo $d1['nis'] ?></td>
    <td><?php echo $d1['nama_siswa'] ?></td>
    <td><?php echo $d4['tingkat'].' - '.$d4['nama_kelas'] ?></td>
    <td><?php echo $d1['alamat'] ?></td>
    <td><?php echo $d2['qty'] ?></td>
    <td><?php echo number_format($hutang) ?></td>
    <td><?php echo number_format($dibayar) ?></td>
    <td><?php echo number_format($sisa) ?></td>
    <td>
      <a href="?a=detail_pengambilan&id_siswa=<?php echo $d1['id_siswa'] ?>&menu=hutang" class="btn btn-info btn-xs">Detail Hutang Piutang</a>
    </td>
    
    
   
    
  </tr>
  <?php } ?>
</table>
