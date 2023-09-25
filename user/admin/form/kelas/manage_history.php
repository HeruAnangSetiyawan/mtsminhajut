<?php

$id=$_GET['id'];
$idta=$_GET['id_ta'];

  $perintah="SELECT * From kelas where id_kelas='$id'";
  $jalan=mysqli_query($conn, $perintah);
  $d1=mysqli_fetch_array($jalan);
  $no=1;
 $tingkat = $d1['tingkat'] -1;
 $qta = mysqli_query($conn, "SELECT * from tahun_ajaran where id_ta='$idta'");
          $jta = mysqli_num_rows ($qta);
          $dta = mysqli_fetch_array($qta);
          $id_ta = $dta['id_ta'];

  $qcekwk = mysqli_query($conn, "SELECT b.nama_guru, a.status_wali_kelas, a.id_guru, b.nip, a.username, a.id_walikelas from wali_kelas a left join guru b on a.id_guru = b.id_guru where a.id_kelas='$id' and a.status_wali_kelas='1'");
      $jcekwk = mysqli_num_rows($qcekwk);
      $dcekwk = mysqli_fetch_array($qcekwk);
      $id_wk_aktif = $dcekwk['id_guru'];
?>
<div class="box-header with-border">
  <h3 class="box-title">
    Manajemen Kelas <?php echo $d1['nama_kelas'] ?> <br>
    Tahun Ajaran <?php echo $dta['nama_ta'] ?>

  </h3>
<div class="pull-right">
      <a href="?a=history_kelas&id_ta=<?php echo $idta ?>" class="btn btn-info btn-sm"  >Kembali</a>
    </div>
  
</div>

<form action="form/kelas/simpan_wali_kelas.php" method="post"  enctype="multipart/form-data">
<div class="modal fade" id="addwali">
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



<form action="form/kelas/simpan_siswa.php" method="post"  enctype="multipart/form-data">
<div class="modal fade" id="addsiswa">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Pilih Siswa yang akan di tetapkan di kelas <?php echo $d1['nama_kelas'] ?></h4>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <input type="hidden" name="id_kelas" value="<?php echo $d1['id_kelas'] ?>">
                  <input type="hidden" name="id_wali_kelas" value="<?php echo $dcekwk['id_walikelas']; ?>">
                  <input type="hidden" name="id_ta" value="<?php echo $dta['id_ta']; ?>">
                  <input type="hidden" name="tingkat" value="<?php echo $tingkat; ?>">
                </div>
                <div class="form-group">
                  <table class="table">
                    <tr>
                      <td>Pilih</td>
                      <td>Nama</td>
                      <td>NIS</td>
                      <td>NISN</td>
                      <td>Kelas Sebelumnya</td>
                    </tr>
                    <?php 
                    if ($d1['tingkat']=='1') {
                      $tingkat_tinggal = $d1['tingkat'];
                       $q_pilih_siswa_tinggal_kelas = mysqli_query($conn, "SELECT ks.status_ks, 
                        s.id_siswa, s.nama_siswa, s.nis, s.nisn, 
                        k.nama_kelas, k.tingkat 
                        from kelas_siswa ks
                        left join siswa s on ks.id_siswa = s.id_siswa
                        left join kelas k on ks.id_kelas = k.id_kelas

                        where ks.status_ks='Tinggal' and k.tingkat='$tingkat_tinggal' and ks.id_ta!='$id_ta' and ks.id_siswa not in(SELECT id_siswa from kelas_siswa where id_kelas='$id' and id_ta='$id_ta')")or die(mysqli_error());
                        while ($d_pilih_siswa_tinggal_kelas=mysqli_fetch_array($q_pilih_siswa_tinggal_kelas)) { ?>
                        <tr>
                          <td><input type="checkbox" name="id_siswa[]" value="<?php echo $d_pilih_siswa_tinggal_kelas['id_siswa'] ?>"></td>
                          <td><?php echo $d_pilih_siswa_tinggal_kelas['nama_siswa'] ?></td>
                          <td><?php echo $d_pilih_siswa_tinggal_kelas['nis'] ?></td>
                          <td><?php echo $d_pilih_siswa_tinggal_kelas['nisn'] ?></td>
                          <td><?php echo $d_pilih_siswa_tinggal_kelas['nama_kelas'] ?></td>
                        </tr>
                      <?php }
                      $status_siswa = 'Calon Siswa';
                      $q_pilih_siswa = mysqli_query($conn, "SELECT id_siswa,nama_siswa,nis,nisn from siswa where status_siswa='Calon Siswa' and id_siswa not in(SELECT id_siswa from kelas_siswa where id_kelas='$id' and id_ta='$id_ta')")or die(mysqli_error());
                      while ($d_pilih_siswa=mysqli_fetch_array($q_pilih_siswa)) { ?>
                        <tr>
                          <td><input type="checkbox" name="id_siswa[]" value="<?php echo $d_pilih_siswa['id_siswa'] ?>"></td>
                          <td><?php echo $d_pilih_siswa['nama_siswa'] ?></td>
                          <td><?php echo $d_pilih_siswa['nis'] ?></td>
                          <td><?php echo $d_pilih_siswa['nisn'] ?></td>
                          <td>-</td>
                        </tr>
                      <?php }

                    }else{
                      $tingkat_tinggal = $tingkat - 1;
                      $status_siswa = 'Aktif';
                       $q_pilih_siswa_naik_kelas = mysqli_query($conn, "SELECT ks.status_ks, 
                        s.id_siswa, s.nama_siswa, s.nis, s.nisn, 
                        k.nama_kelas, k.tingkat 
                        from kelas_siswa ks
                        left join siswa s on ks.id_siswa = s.id_siswa
                        left join kelas k on ks.id_kelas = k.id_kelas

                        where ks.status_ks='Lanjut' and k.tingkat='$tingkat' and ks.id_ta!='$id_ta' and ks.id_siswa not in(SELECT id_siswa from kelas_siswa where id_kelas='$id' and id_ta='$id_ta')")or die(mysqli_error());
                       $q_pilih_siswa_tinggal_kelas = mysqli_query($conn, "SELECT ks.status_ks, 
                        s.id_siswa, s.nama_siswa, s.nis, s.nisn, 
                        k.nama_kelas, k.tingkat 
                        from kelas_siswa ks
                        left join siswa s on ks.id_siswa = s.id_siswa
                        left join kelas k on ks.id_kelas = k.id_kelas

                        where ks.status_ks='Tinggal' and k.tingkat='$tingkat_tinggal' and ks.id_ta!='$id_ta' and ks.id_siswa not in(SELECT id_siswa from kelas_siswa where id_kelas='$id' and id_ta='$id_ta')")or die(mysqli_error());
                        while ($d_pilih_siswa_tinggal_kelas=mysqli_fetch_array($q_pilih_siswa_tinggal_kelas)) { ?>
                        <tr>
                          <td><input type="checkbox" name="id_siswa[]" value="<?php echo $d_pilih_siswa_tinggal_kelas['id_siswa'] ?>"></td>
                          <td><?php echo $d_pilih_siswa_tinggal_kelas['nama_siswa'] ?></td>
                          <td><?php echo $d_pilih_siswa_tinggal_kelas['nis'] ?></td>
                          <td><?php echo $d_pilih_siswa_tinggal_kelas['nisn'] ?></td>
                          <td><?php echo $d_pilih_siswa_tinggal_kelas['nama_kelas'] ?></td>
                        </tr>
                      <?php }
                      while ($d_pilih_siswa_naik_kelas=mysqli_fetch_array($q_pilih_siswa_naik_kelas)) { ?>
                        <tr>
                          <td><input type="checkbox" name="id_siswa[]" value="<?php echo $d_pilih_siswa_naik_kelas['id_siswa'] ?>"></td>
                          <td><?php echo $d_pilih_siswa_naik_kelas['nama_siswa'] ?></td>
                          <td><?php echo $d_pilih_siswa_naik_kelas['nis'] ?></td>
                          <td><?php echo $d_pilih_siswa_naik_kelas['nisn'] ?></td>
                          <td><?php echo $d_pilih_siswa_naik_kelas['nama_kelas'] ?></td>
                        </tr>
                      <?php }
                    }
                     ?>
                    
                  </table>
                </div>
              
            </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan Siswa Terpilih</button>
               
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
</form>

<div class="clearfix"></div>



<?php



  
 
  $no=1;
?>
<div class="col-md-4">
   <div class="box-header with-border">
      <h3 class="box-title">
        Wali Kelas 

      </h3>
      
      
      
    </div>
    <div class="box-body">
      <?php 
      
      if ($jcekwk==1) { ?>
        <table class="table">
          <tr>
            <td>Nama</td>
            <td><?php echo $dcekwk['nama_guru'] ?></td>
          </tr>
          <tr>
            <td>NIP</td>
            <td><?php echo $dcekwk['nip'] ?></td>
          </tr>
          <tr>
            <td>Username</td>
            <td><?php echo $dcekwk['username'] ?></td>
          </tr>
        </table>
        <?php 
        // ta = tahun ajaran  
          $qta = mysqli_query($conn, "SELECT * from tahun_ajaran where id_ta='$idta'");
          $jta = mysqli_num_rows ($qta);
          $dta = mysqli_fetch_array($qta);
          $id_ta = $dta['id_ta'];
           ?>
        
      <?php }else{ ?>
        <!-- <a href="" class=" btn btn-info btn-xs"  data-toggle="modal" data-target="#addwali">Atur Wali Kelas</a> -->
      <?php } ?>
    </div>



</div>
<div class="col-md-8">
  <div class="box-header with-border">
    <h3 class="box-title">
      Data Siswa 

    </h3>
    <div class="pull-right">
      
    </div>
    
  </div>

  <table class="table table-striped table-bordered" id="example1">
  	<thead>
  	<tr>
  		<td>No</td>
      <td>NIS</td>
      <td>NISN</td>
      <td>Nama</td>
  		<td>Keterangan</td>
  	</tr>
  </thead>
  	

  <?php
$mapel = mysqli_query($conn, "SELECT ks.*, s.nama_siswa, s.nis, s.nisn, ks.status_ks, k.tingkat from kelas_siswa ks
left join siswa s on ks.id_siswa = s.id_siswa 
left join kelas k on ks.id_kelas = k.id_kelas
where ks.id_kelas='$id' and ks.id_ta='$id_ta' order by s.nama_siswa asc");
  while ($data=mysqli_fetch_array($mapel))
  { 

  $naik_kelas = $data['tingkat'] +1;
  $tinggal_kelas = $data['tingkat'];
  ?>
  	<tr>
  		<td><?php echo $no++; ?></td>
  	

  		
    
    <td><?php echo $data['nis']; ?></td>
    <td><?php echo $data['nisn']; ?></td>
    <td><?php echo $data['nama_siswa']; ?></td>
   
  	
  	<td>
     <?php if ($data['status_ks']=='Lanjut') {
       echo "Naik Ke Kelas ".$naik_kelas;
     }else if ($data['status_ks']=='Tinggal') {
       echo "Tinggal Di Kelas ".$tinggal_kelas;
       
     }else{
      echo "Belum Ada Keputusan"; ?><br>
      <a href="form/kelas/keputusan.php?id=<?php echo $data['id_ks'] ?>&status_ks=Lanjut&id_ta=<?php echo $idta ?>&id_kelas=<?php echo $id ?>" class="btn btn-info btn-xs">Naikkan ke kelas <?php echo $naik_kelas ?></a>
      <a href="form/kelas/keputusan.php?id=<?php echo $data['id_ks'] ?>&status_ks=Tinggal&id_ta=<?php echo $idta ?>&id_kelas=<?php echo $id ?>" class="btn btn-info btn-xs">Tinggalkan Di kelas <?php echo $tinggal_kelas ?></a>
      
     <?php } ?> 
     
  	</td>
  		</tr>

  		<?php } ?>
  				
  	</table>
</div>