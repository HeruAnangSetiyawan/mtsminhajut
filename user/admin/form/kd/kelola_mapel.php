

<?php


  $id=$_GET['id'];
  $perintah="SELECT * From kelas left join ptk on ptk.id_ptk = kelas.id_ptk where kelas.id_kelas='$id'";
  $jalan=mysqli_query($conn, $perintah)or die(mysqli_error());
  $d1=mysqli_fetch_array($jalan);

  $total = mysqli_num_rows($jalan);
  $no=1;
?>











  <div class="box box-default box-solid">
    <div class="box-header with-border">
      <h3 class="box-title">Kelola Kelas</h3>
    </div>
  
    <div class="box-body">
      


















        <div class="col-md-3">

          <div class="box-header with-border">
            <h3 class="box-title">Identitas Kelas</h3>
          </div>
            
            <div class="box-body">
              <strong>Kelas</strong>
              <p class="text-muted"><?php echo $d1['tingkat'] ?></p>
              <hr>

              <strong>Lokal</strong>
              <p class="text-muted"><?php echo $d1['nama_kelas'] ?></p>
              <hr>
              <strong>Wali Kelas</strong>
              <p class="text-muted"><?php echo $d1['nama_ptk'] ?></p>
              <hr>

            </div>
           
          </div>










        <div class="col-md-4">

          <div class="box-header with-border">
            <h3 class="box-title">Mata Pelajaran Aktif</h3>
           
          </div>

            <form action="form/pembagian_kelas/simpan_pembagian_kelas.php" method="post">
              <input type="hidden" name="id" value="<?php echo $d1['id_guru'] ?>">
            <div class="box-body">
   <?php   
              $qmapel = mysqli_query($conn, "SELECT * from pembagian_mapel join mapel on mapel.id_mapel=pembagian_mapel.id_mapel where id_kelas='$id'");
              $datamapel = [];
              while ($dmapel=mysqli_fetch_array($qmapel)) {
                $data['id_mapel'] = $dmapel['id_mapel'];
                $data['nama_mapel'] = $dmapel['nama_mapel'];
                array_push($datamapel, $data);
              }
              
              $kolom = 3;
              $chunks = array_chunk($datamapel, $kolom); 
                foreach ($chunks as $chunk) {
                echo '<ol style="float:left">';
                foreach ($chunk as $mapel) { ?>
                   <li style='list-style-type: none;'><?php echo $mapel['nama_mapel'] ?></li>
               <?php }
                echo '</ol>';
              }

              ?>            
            </div>
         
            </form>
           
          </div>





        <div class="col-md-4">

          <div class="box-header with-border">
            <h3 class="box-title">Kelola Mata Pelajaran</h3>
           
          </div>

            <form action="form/pembagian_mapel/simpan_pembagian_mapel.php" method="post">
              <input type="hidden" name="id" value="<?php echo $d1['id_kelas'] ?>">
            <div class="box-body">
   <?php   
              $qmapel = mysqli_query($conn, "SELECT * from mapel");
              $datamapel = [];
              while ($dmapel=mysqli_fetch_array($qmapel)) {
                $data['id_mapel'] = $dmapel['id_mapel'];
                $data['nama_mapel'] = $dmapel['nama_mapel'];
                array_push($datamapel, $data);
              }
              
              $kolom = 3;
              $chunks = array_chunk($datamapel, $kolom); 
                foreach ($chunks as $chunk) {
                echo '<ul style="float:left">';
                foreach ($chunk as $mapel) { ?>
                   <li style='list-style-type: none;'><input type="checkbox"  name="mapel[]" value="<?php echo $mapel['id_mapel'] ?>"> <?php echo $mapel['nama_mapel'] ?></li>
               <?php }
                echo '</ul>';
              }

              ?>            
            </div>
            <div class="box-footer">
              <button type="submit" onclick="return confirm('Apakah anda akan menyimpan perubahan data pembagian kelas.?')" class="btn btn-info">Simpan</button>
              <a href="?a=pembagian_mapel" class="btn btn-info">Kembali</a>
            </div>
            </form>
           
          </div>




    </div>
  
  </div>

