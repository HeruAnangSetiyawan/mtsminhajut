<?php

$id=$_GET['id'];
$t=$_GET['t'];
$status_siswa=$_GET['status'];

  $perintah="SELECT * From siswa where id_siswa='$id'";
  $jalan=mysqli_query($conn, $perintah);
  $d1=mysqli_fetch_array($jalan);
  $no=1;

$qta = mysqli_query($conn, "SELECT * from tahun_ajaran where status_ta='Aktif'");
$dta = mysqli_fetch_array($qta);
$jta = mysqli_num_rows($qta);

  $qcekwk = mysqli_query($conn, "SELECT b.nama_guru, a.status_wali_kelas, a.id_guru, b.nip, a.username, a.id_walikelas from wali_kelas a left join guru b on a.id_guru = b.id_guru where a.id_kelas='$id' and a.status_wali_kelas='1'");
      $jcekwk = mysqli_num_rows($qcekwk);
      $dcekwk = mysqli_fetch_array($qcekwk);
      $id_wk_aktif = $dcekwk['id_guru'];
?>
<div class="box-header with-border">
  <h3 class="box-title">
   Detail Siswa 

  </h3>
<div class="pull-right">
      
    </div>
  
</div>

<form action="form/siswa/simpan_kelas_awal.php" method="post"  enctype="multipart/form-data">
<div class="modal fade" id="addkelas">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Pilih Kelas</h4>
              </div>
              <div class="modal-body">
                <?php if ($jta>0) { 
                  $hiddenbtn = "style=''";
                  ?>
                    <div class="form-group">
                      <div class="alert alert-info">Tahun ajaran aktif : <?php echo $dta['nama_ta'] ?></div>
                    </div>
                    <div class="form-group">
                      <label>Pilih Kelas Awal</label>
                      <input type="hidden" name="id_siswa" value="<?php echo $id ?>">
                      <input type="hidden" name="id_ta" value="<?php echo $dta['id_ta'] ?>">
                      <select name="id_kelas" class="form-control">
                        <option value="">--Pilih Kelas Awal--</option>
                        <?php
                          $qkelas = mysqli_query($conn, "SELECT * from kelas where tingkat = '1'");
                          while ($dkelas = mysqli_fetch_array($qkelas)) { ?>
                            <option value="<?php echo $dkelas['id_kelas'] ?>"><?php echo $dkelas['nama_kelas'] ?></option>
                          <?php } ?>
                        
                      </select>
                  </div>
                <?php }else{ 
                  $hiddenbtn = "style='display:none'";
                  ?>
                  <div class="alert alert-info">ANda tidak bisa memilih kelas karena belum ada tahun ajaran aktif <br>Silahkan atur dulu tahun ajaran dan aktifkan tahun ajarannya</div>
                <?php } ?>
             
            
            </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" <?php echo $hiddenbtn ?>>Simpan Kelas</button>
               
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
</form>


<form action="form/kelas/ganti_wali_kelas.php" method="post"  enctype="multipart/form-data">
<div class="modal fade" id="ganti">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Pilih wali Kelas <?php echo $d1['nama_kelas'] ?></h4>
              </div>
              <div class="modal-body">

               <div class="form-group">
                  <label>Wali Kelas</label>
                  <input type="hidden" name="id_kelas" value="<?php echo $id ?>">
                  <input type="hidden" name="id_wali_sebelumnya" value="<?php echo $id_wk_aktif ?>">
                  <select name="wali" class="form-control">
                    <option value="">--Pilih Guru--</option>
                    <?php
                      $qguru = mysqli_query($conn, "SELECT * from guru where id_guru not in (SELECT id_guru from wali_kelas where status_wali_kelas='1')");
                      while ($dguru = mysqli_fetch_array($qguru)) { ?>
                        <option value="<?php echo $dguru['id_guru'] ?>"><?php echo $dguru['nama_guru'] ?></option>
                      <?php } ?>
                    
                  </select>
              </div>
            
            </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan Kelas</button>
               
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
</form>




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
<div class="col-md-3">
  
    <div class="box-body">
      <?php 
      if ($d1['foto']=="") {
        $foto = "default.jpg";
      }else{
        $foto = $d1['foto'];
      }
       ?>
      
      <img src="form/siswa/foto/<?php echo $foto ?>" width=100%>
      
      <table class="table">
         <tr>
          <td colspan="3"><h4><?php echo $d1['nama_siswa'] ?></h4></td>
        </tr>
        <tr>
          <td>Status</td>
          <td>:</td>
          <td><?php echo $d1['status_siswa'] ?></td>
        </tr>
        <tr>
          <td>Pendaftaran Via</td>
          <td>:</td>
          <td><?php echo $d1['daftar_via'] ?></td>
        </tr>
      </table>
     <a href="?a=edit_siswa&id=<?php echo $d1['id_siswa'] ?>&t=<?php echo $t ?>&status=<?php echo $status_siswa ?>" class="btn btn-info btn-xs">Edit Siswa</a> 
     <a href="form/siswa/hapus_siswa.php?id=<?php echo $d1['id_siswa'] ?>" class="btn btn-danger btn-xs" onclick="return confirm('Apakah anda akan menghapus <?php echo $data['nama_siswa'] ?> dari data siswa?')">Hapus</a> 
     <?php if ($t=='0') {
      if ($status_siswa=='0') {
       $targetback = "?a=calon_siswa";
      }else{
       $targetback = "?a=siswa_aktif";
      }
     }else{
        $id_ta_aktif = $_GET['id_ta'];
        $id_kelas = $_GET['id_kelas'];
        $id_wk = $_GET['id_wk'];
        $targetback = "?a=data_siswa_kelas&id_kelas=$id_kelas&id_ta=$id_ta_aktif&id_wk=$id_wk";
     } ?>
     <a href="<?php echo $targetback ?>" class="btn btn-info btn-xs"  >Kembali</a>
    </div>



</div>
<div class="col-md-9">
  <div class="box-header with-border">
    <h3 class="box-title">
      Biodata

    </h3>
    
    
  </div>
  <div class="box-body">
    <div class="col-md-6">
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
          <td>Tempat Lahir</td>
          <td>:</td>
          <td><?php echo $d1['tmpl'] ?></td>
        </tr>
        <tr>
          <td>Tanggal Lahir</td>
          <td>:</td>
          <td><?php echo $d1['tgll'] ?></td>
        </tr>
        <tr>
          <td>Jenis Kelamin</td>
          <td>:</td>
          <td><?php echo $d1['jk'] ?></td>
        </tr>
        <tr>
          <td>Agama</td>
          <td>:</td>
          <td><?php echo $d1['agama'] ?></td>
        </tr>
      
       
      </table>
    </div>
    <div class="col-md-6">
      <table class="table">
        <tr>
          <td>Penfifikan Sebelumnya</td>
          <td>:</td>
          <td><?php echo $d1['pendidikan_sebelumnya'] ?></td>
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
        <tr>
          <td>Nama Ayah</td>
          <td>:</td>
          <td><?php echo $d1['nama_ayah'] ?></td>
        </tr>
        <tr>
          <td>Nama Ibu</td>
          <td>:</td>
          <td><?php echo $d1['nama_ibu'] ?></td>
        </tr>
        <tr>
          <td>Pekerjaan Ayah</td>
          <td>:</td>
          <td><?php echo $d1['kerja_ayah'] ?></td>
        </tr>
        <tr>
          <td>Pekerjaan Ibu</td>
          <td>:</td>
          <td><?php echo $d1['kerja_ibu'] ?></td>
        </tr>
      </table>
    </div>
    <div class="clearfix"></div>
    
    
  </div>

</div>
  <div class="clearfix"></div>
<hr>

 <div class="box-header with-border">
    <h3 class="box-title">
      History Kelas Siswa

    </h3>
    
    
  </div>
  <div class="box-body">
     
      <?php 
      if ($status_siswa==0) { ?>
       <div class="alert alert-info">
         Ini merupakan siswa baru <br>  Silahkan tentukan kelas siswa lebih dahulu di menu Kelas <br> 
        <!-- <a href="#" class=" btn btn-success btn-xs"  data-toggle="modal" data-target="#addkelas">Tentukan Kelas Awal</a> -->
       </div>
      
        
      <?php }else{ ?>
         
         <div class="box-body">
            <table class="table"  id="example1">
              <thead>
                <tr>
                  <td>No</td>
                  <td>Kelas</td>
                  <td>Lokal</td>
                  <td>Wali Kelas</td>
                  <td>Tahun Ajaran</td>
                  <td>Status</td>
                </tr>
              </thead>
              <?php 
              $no=1;
              while ($dkelas = mysqli_fetch_array($qkelas)) { ?>
              
              <tr>
                <td><?php echo $no++ ?></td>
                <td><?php echo $dkelas['tingkat'] ?></td>
                <td><?php echo $dkelas['nama_kelas'] ?></td>
                <td><?php echo $dkelas['nama_guru'] ?></td>
                <td><?php echo $dkelas['nama_ta'] ?></td>
                <td>
                  <?php 
                  $kelas_selanjutnya = $dkelas['next_kelas'] =='' ? $dkelas['tingkat'] +1  : $dkelas['next_kelas'];
                  if ($dkelas['status_ks']=='Lanjut') {
                    $keterangan = "Naik Ke Kelas ".$kelas_selanjutnya;
                  }
                  elseif ($dkelas['status_ks']=='Tinggal') {
                    $keterangan = "Tinggal di Kelas ".$kelas_selanjutnya;
                  }else{
                    $keterangan = "Aktif";
                  }
                  echo $keterangan;
                   ?>
                  
                    
                  </td>
              </tr>
              <?PHP } ?>
            </table>
          </div>

      <?php } ?>
  </div>
