<?php 
// ta = tahun ajaran  
$id_ta_aktif = $_GET['id_ta'];
$id_kelas = $_GET['id_kelas'];
$id_wk = $_SESSION['id_user'];


  $qta = mysqli_query($conn, "SELECT * from tahun_ajaran where id_ta='$id_ta_aktif'");
  $jta = mysqli_num_rows ($qta);
  $dta = mysqli_fetch_array($qta);
  $id_ta = $dta['id_ta'];
  $qkelas = mysqli_query($conn, "SELECT * from kelas where id_kelas='$id_kelas'");
  $dkelas = mysqli_fetch_array($qkelas);


   $qcekwk = mysqli_query($conn, "SELECT b.nama_guru, a.status_wali_kelas, a.id_guru, b.nip, a.username, a.id_walikelas from wali_kelas a left join guru b on a.id_guru = b.id_guru where a.id_kelas='$id_kelas' order by id_walikelas desc limit 1");
      $jcekwk = mysqli_num_rows($qcekwk);
      $dcekwk = mysqli_fetch_array($qcekwk);
      $id_wk_aktif = $dcekwk['id_guru'];
      $id_wali_kelas = $dcekwk['id_walikelas'];
 ?>
























<div class="col-md-4">
   <div class="box-header with-border">
      <h3 class="box-title">
       Identitas Kelas
      </h3>
      
      
      
    </div>
    <div class="box-body">
      
      
        <table class="table">
          <tr>
            <td>Kelas</td>
            <td><?php echo $dkelas['tingkat'] ?></td>
          </tr>
          <tr>
            <td>Lokal</td>
            <td><?php echo   $dkelas['nama_kelas'] ?></td>
          </tr>
          <tr>
            <td>Tahun Ajaran</td>
            <td><?php echo $dta['nama_ta'] ?></td>
          </tr>
          <tr>
            <td>Status Tahun Ajaran</td>
            <td><?php echo $dta['status_ta'] ?></td>
          </tr>
     
     
          <tr>
            <td>Wali Kelas</td>
            <td><?php echo $dcekwk['nama_guru'] ?></td>
          </tr>
          <tr>
            <td>NIP</td>
            <td><?php echo $dcekwk['nip'] ?></td>
          </tr>
     
         
        </table>
    </div>



</div>
<div class="col-md-8">
  <div class="box-header with-border">
    <h3 class="box-title">
      Data Absensi Siswa

    </h3>
       <div class="pull-right">
         <a href="?a=absensi" class="btn btn-info btn-sm">Kembali</a>
       </div>
   
  </div>

  <table class="table table-striped table-bordered" id="example1">
    <thead>
      <tr>
      <td >No</td>
        <td >NIS</td>
        <td >NISN</td>
        <td >Nama siswa</td>
        <td >Jenis Kelamin</td>
        <td>Sakit</td>
        <td>Izin</td>
        <td>Tanpa Keterangan</td>
       
      <td >Option</td>
      </tr>
      
    </thead>
    

  <?php
  $no=1;
$siswa = mysqli_query($conn, "SELECT a.status_ks, a.id_siswa, a.id_kelas, a.id_ta,  b.nama_siswa, b.nis, b.nisn, b.jk, b.agama, b.tmpl, b.tgll, c.tingkat, c.nama_kelas, ta.nama_ta
 from kelas_siswa a
 left join siswa b on a.id_siswa = b.id_siswa
 left join kelas c on a.id_kelas = c.id_kelas
 left join tahun_ajaran ta on a.id_ta = ta.id_ta
  where a.id_kelas='$id_kelas' and a.id_ta='$id_ta_aktif'");
  while ($data=mysqli_fetch_array($siswa))
  { 
$id_siswa = $data['id_siswa'];
$id_kelas = $data['id_kelas'];
$id_ta = $data['id_ta'];
$q_absen = mysqli_query($conn, "SELECT * from absensi where id_kelas='$id_kelas' and id_siswa='$id_siswa' and id_ta='$id_ta'");
$d_absen = mysqli_fetch_array($q_absen);
$pt = explode('-', $data['tgll']);
$tgll = $pt[2].'-'.$pt[1].'-'.$pt[0];


?>
  <tr>
    <td><?php echo $no++; ?></td>
  

    
  <td><?php echo $data['nis']; ?></td>
  <td><?php echo $data['nisn']; ?></td>
  <td><?php echo $data['nama_siswa']; ?></td>
  <td><?php echo $data['jk']; ?></td>
  <td><?php echo $d_absen['sakit'] ?></td>
  <td><?php echo $d_absen['izin'] ?></td>
  <td><?php echo $d_absen['alfa'] ?></td>
  
  
  <td>
    <?php if ($id_wk_aktif!=$id_wk) {
      if ($dcekwk['status_wali_kelas']=="0") {
        echo "Anda di nonaktifkan sebagai wali kelas ".$dkelas['nama_kelas'];
      }else{
        echo "Wali kelas sudah di ganti ";
      }
    }else{ ?>
  

 <a href="#" class=" btn btn-info btn-xs"  data-toggle="modal" data-target="#absensi_<?php echo $data['id_siswa'] ?>">Input Absensi</a>   
<form action="form/absensi/simpan_absensi.php" method="post"  enctype="multipart/form-data">
<div class="modal fade" id="absensi_<?php echo $data['id_siswa'] ?>">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Input Data Absensi Siswa</h4>
              </div>
              <div class="modal-body">

               <div class="form-group">
                <table class="table" style="width:100%">
                  <tr>
                    <td>Siswa</td>
                    <td>:</td>
                    <td><?php echo $data['nama_siswa'] ?></td>
                  </tr>
                  <tr>
                    <td>Kelas</td>
                    <td>:</td>
                    <td><?php echo $data['tingkat'].' - '.$data['nama_kelas'] ?></td>
                  </tr>
                  <tr>
                    <td>Tahun Ajaran</td>
                    <td>:</td>
                    <td><?php echo $data['nama_ta'] ?></td>
                  </tr>
                  <tr>
                    <td>Sakit</td>
                    <td>:</td>
                    <td><input type="number" name="sakit" class="form-control" value="<?php echo $d_absen['sakit'] ?>"></td>
                  </tr>
                  <tr>
                    <td>Izin</td>
                    <td>:</td>
                    <td><input type="number" name="izin" class="form-control" value="<?php echo $d_absen['izin'] ?>"></td>
                  </tr>
                  <tr>
                    <td>Tanpa Keterangan</td>
                    <td>:</td>
                    <td><input type="number" name="alfa" class="form-control" value="<?php echo $d_absen['alfa'] ?>"></td>
                  </tr>

                 
                </table>
                <input type="hidden" name="id_kelas" class="form-control" value="<?php echo $data['id_kelas'] ?>">
                <input type="hidden" name="id_siswa" class="form-control" value="<?php echo $data['id_siswa'] ?>">
                <input type="hidden" name="id_ta" class="form-control" value="<?php echo $data['id_ta'] ?>">
                 
              </div>
            
            </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan Keputusan</button>
               
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
</form>
  </td>
  <?php } ?>
    </tr>

    <?php } ?>
        
          
    </table>
</div>