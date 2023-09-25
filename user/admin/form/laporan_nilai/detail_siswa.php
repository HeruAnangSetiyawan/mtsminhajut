<?php

$id=$_GET['id'];
$status_wali_kelas='';
$tingkat = $_GET['tingkat'];
$status_ks = $_GET['status_ks'];
$id_kelas = $id;

  $perintah="SELECT * From siswa where id_siswa='$id'";
  $jalan=mysqli_query($conn, $perintah);
  $d1=mysqli_fetch_array($jalan);
  $no=1;

$id_ta_aktif = $_GET['id_ta'];
        $id_kelas = $_GET['id_kelas'];
        
        $targetback = "?a=data_siswa_kelas_wk&id_kelas=$id_kelas&id_ta=$id_ta_aktif";
?>

  <?php 
$id_siswa = $d1['id_siswa'];
$q_kelas_siswa = mysqli_query($conn, "SELECT * from kelas_siswa
  where id_siswa='$id_siswa' and id_kelas='$id_kelas' and id_ta='$id_ta_aktif'
  ");
$d_kelas_siswa = mysqli_fetch_array($q_kelas_siswa);

?>

<div class="box-header with-border">
  <h3 class="box-title">
   Detail Siswa 

  </h3>
<div class="pull-right">
      <a href="<?php echo $targetback ?>" class="btn btn-info btn-sm"  >Kembali</a>
    </div>
  
</div>





<div class="clearfix"></div>




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
    <!--  <a href="?a=edit_siswa&id=<?php echo $d1['id_siswa'] ?>" class="btn btn-info btn-xs">Edit Siswa</a> 
     <a href="form/siswa/hapus_siswa.php?id=<?php echo $d1['id_siswa'] ?>" class="btn btn-danger btn-xs" onclick="return confirm('Apakah anda akan menghapus <?php echo $data['nama_siswa'] ?> dari data siswa?')">Hapus</a>  -->
   
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
          <td>Nama</td>
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
   Penilaian Siswa

  </h3>
  <div class="pull-right">
    <a href="#" class=" btn btn-info btn-xs"  data-toggle="modal" data-target="#inputnilai">Input Nilai</a>
  </div>





<?php

$qkelas = mysqli_query($conn, "SELECT 
  a.status_ks, a.id_ks, a.id_siswa, a.id_wali_kelas,
  b.nama_ta, c.nama_kelas, c.tingkat,
  e.nama_guru

  from kelas_siswa a 
  left join tahun_ajaran b on a.id_ta = b.id_ta
  left join kelas c on a.id_kelas = c.id_kelas
  left join wali_kelas d on a.id_wali_kelas = d.id_walikelas
  left join guru e on d.id_guru = e.id_guru
  where a.id_siswa = '$id'");
$jkelas = mysqli_num_rows($qkelas);
$dkelas = mysqli_fetch_array($qkelas);

$qmapel = mysqli_query($conn, "SELECT * from mapel where tingkat='$tingkat' ");
$jmapel = mysqli_num_rows($qmapel);
$qmapelinput = mysqli_query($conn, "SELECT * from mapel where tingkat='$tingkat' ");        
        $no=1;

$id_wali_kelas = $_SESSION['id_user'];
?>
<form action="form/siswa_walikelas/simpan_nilai.php" method="post"  enctype="multipart/form-data">
<div class="modal fade" id="inputnilai">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Input Nilai Siswa</h4>
              </div>
              <div class="modal-body">

               <div class="form-group">
                <table class="table">
                  <tr>
                    <td>Siswa</td>
                    <td>:</td>
                    <td><?php echo $d1['nama_siswa'] ?></td>
                  </tr>
                  <tr>
                    <td>Kelas</td>
                    <td>:</td>
                    <td><?php echo $tingkat.' - '.$dkelas['nama_kelas'] ?></td>
                  </tr>
                  <tr>
                    <td>Tahun Ajaran</td>
                    <td>:</td>
                    <td><?php echo $dkelas['nama_ta'] ?></td>
                  </tr>
                 
                </table>
                <hr>
                <input type="hidden" name="id_kelas" class="form-control" value="<?php echo $id_kelas ?>">
                <input type="hidden" name="id_siswa" class="form-control" value="<?php echo $id ?>">
                <input type="hidden" name="id_ta" class="form-control" value="<?php echo $id_ta_aktif ?>">
                <input type="hidden" name="status_ks" class="form-control" value="<?php echo $status_ks ?>">
                <input type="hidden" name="tingkat" class="form-control" value="<?php echo $tingkat ?>">
                  <table class="table">
                    <tr>
                      <th>Nama Pelajaran</th>
                      <th>Input Nilai</th>
                    </tr>
                    <?php while($dmapelinput = mysqli_fetch_array($qmapelinput)){ 
                        $id_mapel = $dmapelinput['id_mapel'];
                          $qnilai = mysqli_query($conn, "SELECT * from nilai where id_kelas='$id_kelas' and id_ta='$id_ta_aktif' and id_wali_kelas='$id_wali_kelas' and id_mapel='$id_mapel' and id_siswa='$id'");
                          $dnilai = mysqli_fetch_array($qnilai);
                          $nilai = $dnilai['nilai'];?>
                    <tr>
                      <td><?php echo $dmapelinput['nama_mapel'] ?></td>
                      <td><input type="hidden" name="id_mapel[]" class="form-control" value="<?php echo $dmapelinput['id_mapel'] ?>"><input type="number"  name="nilai[]" class="form-control" value="<?php echo $nilai ?>"></td>
                    </tr>
                  <?php } ?>
                  </table>
              </div>
            
            </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan Nilai</button>
               
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
</form>


</div>

<div class="box-body">
  <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>No</th>
        <th>Mata Pelajaran</th>
        <th>KKM</th>
        <th>Nilai</th>
        <!-- <th>Predikat</th> -->
      </tr>
    </thead>
    <tbody>
      <?php 
      $total_nilai = 0;
      $tuntas = 0;
      $tidak_tuntas = 0;
        while($dmapel=mysqli_fetch_array($qmapel)){    ?>
      <tr>
        <td><?php echo $no++ ?></td>
        <td><?php echo $dmapel['nama_mapel'] ?></td>
        <td><?php echo $dmapel['kkm'] ?></td>
        
        <td>
          <?php 
          $id_mapel = $dmapel['id_mapel'];
          
          $qnilai = mysqli_query($conn, "SELECT * from nilai where id_kelas='$id_kelas' and id_ta='$id_ta_aktif' and id_wali_kelas='$id_wali_kelas' and id_mapel='$id_mapel' and id_siswa='$id'");
          $dnilai = mysqli_fetch_array($qnilai);
          $nilai = $dnilai['nilai'];
          $total_nilai += $nilai;
          if ($nilai<$dmapel['kkm']) {
            $warna = "red";
            $satu = 1;
            $tidak_tuntas +=$satu;
          }else{
            $warna = "green";
            $satu = 1;
            $tuntas +=$satu;
          }
           ?>
           <p style="color: <?php echo $warna ?>"><?php echo $nilai ?></p>
          
        </td>
        <!-- <td> ???? </td> -->
      </tr>
    <?php } ?>
    <tr>
      <td colspan="3">Total Nilai</td>
      <td><?php echo $total_nilai ?></td>
    </tr>
    <tr>
      <td colspan="3">Rata Rata</td>
      <td><?php echo $ratarata = round($total_nilai / $jmapel, 2) ?></td>
    </tr>
    <tr>
      <td colspan="4">
        <u>Keputusan</u> <br>
        <?php if ($status_ks=='Aktif') {
          echo "Belum ada keputusan";
        }else{
          if ($status_ks=='Lanjut') {
            $next_kelas = $tingkat +1;
            echo "Naik ke Kelas ".$next_kelas;
          }else{
            echo "Tinggal di  Kelas ".$tingkat;

          }
        } ?>
        <br>
        <a href="#" class=" btn btn-info btn-xs"  data-toggle="modal" data-target="#keputusan">Keputusan Kelulusan</a>
      </td>
    </tr>
    <tr>
      <td colspan="4"><u>Catatan Guru</u> <br>
        <?php echo $d_kelas_siswa['catatan_wali_kelas'] ?></td>
    </tr>
      
    </tbody>
  </table>
</div>



<form action="form/siswa_walikelas/simpan_keputusan.php" method="post"  enctype="multipart/form-data">
<div class="modal fade" id="keputusan">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Keputusan Kelulusan Siswa</h4>
              </div>
              <div class="modal-body">

               <div class="form-group">
                <table class="table">
                  <tr>
                    <td>Siswa</td>
                    <td>:</td>
                    <td><?php echo $d1['nama_siswa'] ?></td>
                  </tr>
                  <tr>
                    <td>Kelas</td>
                    <td>:</td>
                    <td><?php echo $tingkat.' - '.$dkelas['nama_kelas'] ?></td>
                  </tr>
                  <tr>
                    <td>Tahun Ajaran</td>
                    <td>:</td>
                    <td><?php echo $dkelas['nama_ta'] ?></td>
                  </tr>
                  <tr>
                    <td>Banyak Mata Pelajaran</td>
                    <td>:</td>
                    <td><?php echo $jmapel ?> Mata Pelajaran</td>
                  </tr>
                  <tr>
                    <td>Tuntas</td>
                    <td>:</td>
                    <td><?php echo $tuntas ?> Mata Pelajaran</td>
                  </tr>
                  <tr>
                    <td>Tidak Tuntas</td>
                    <td>:</td>
                    <td><?php echo $tidak_tuntas ?> Mata Pelajaran</td>
                  </tr>
                  <tr>
                    <td>Total Nilai</td>
                    <td>:</td>
                    <td><?php echo $total_nilai ?></td>
                  </tr>
                  <tr>
                    <td>Rata Rata</td>
                    <td>:</td>
                    <td><?php echo $ratarata ?></td>
                  </tr>
                   <tr>
                    <td>Keputusan</td>
                    <td>:</td>
                    <td>
                      <select name="keputusan" class="form-control">
                        <option value="Lanjut" <?php if($d_kelas_siswa['status_ks']=='Lanjut'){echo "selected";} ?>>Naik Ke Kelas <?php echo $tingkat + 1; ?></option>
                        <option value="Tinggal" <?php if($d_kelas_siswa['status_ks']=='Tinggal'){echo "selected";} ?>>Tinggal Di Kelas <?php echo $tingkat ?></option>
                      </select>
                    </td>
                  </tr>
                   <tr>
                    <td>Catatan Guru</td>
                    <td>:</td>
                    <td>
                      <textarea name="catatan" class="form-control" rows="5"><?php echo str_replace('<br />', '', $d_kelas_siswa['catatan_wali_kelas']) ?></textarea>
                    </td>
                  </tr>
                 
                </table>
                <input type="hidden" name="id_kelas" class="form-control" value="<?php echo $id_kelas ?>">
                <input type="hidden" name="id_siswa" class="form-control" value="<?php echo $id ?>">
                <input type="hidden" name="id_ta" class="form-control" value="<?php echo $id_ta_aktif ?>">
                <input type="hidden" name="status_wali_kelas" class="form-control" value="<?php echo $status_wali_kelas ?>">
                <input type="hidden" name="tingkat" class="form-control" value="<?php echo $tingkat ?>">
                 
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