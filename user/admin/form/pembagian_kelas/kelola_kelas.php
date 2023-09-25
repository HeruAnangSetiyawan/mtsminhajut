

<?php


include "../../koneksi.php";
  $id=$_GET['id'];
  $perintah="SELECT * From guru join mapel on mapel.id_mapel=guru.id_mapel where guru.id_guru='$id'";
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
            <h3 class="box-title">Identitas Guru</h3>
          </div>
            
            <div class="box-body">
              <strong><i class="fa fa-calendar"></i> Nama Guru</strong>
              <p class="text-muted"><?php echo $d1['nama_guru'] ?></p>
              <hr>

              <strong><i class="fa fa-calendar"></i> Mata Pelajaran</strong>
              <p class="text-muted"><?php echo $d1['nama_mapel'] ?></p>
              <hr>

            </div>
           
          </div>










        <div class="col-md-4">

          <div class="box-header with-border">
            <h3 class="box-title">Kelas Yang Diajar</h3>
           
          </div>

            <form action="form/pembagian_kelas/simpan_pembagian_kelas.php" method="post">
              <input type="hidden" name="id" value="<?php echo $d1['id_guru'] ?>">
            <div class="box-body">
   <?php   
              $qkelas = mysqli_query($conn, "SELECT * from pembagian_kelas join kelas on kelas.id_kelas=pembagian_kelas.id_kelas where id_guru='$id'");
              $datakelas = [];
              while ($dkelas=mysqli_fetch_array($qkelas)) {
                $data['id_kelas'] = $dkelas['id_kelas'];
                $data['nama_kelas'] = $dkelas['nama_kelas'];
                array_push($datakelas, $data);
              }
              
              $kolom = 3;
              $chunks = array_chunk($datakelas, $kolom); 
                foreach ($chunks as $chunk) {
                echo '<ol style="float:left">';
                foreach ($chunk as $kelas) { ?>
                   <li style='list-style-type: none;'><?php echo $kelas['nama_kelas'] ?></li>
               <?php }
                echo '</ol>';
              }

              ?>            
            </div>
         
            </form>
           
          </div>





        <div class="col-md-4">

          <div class="box-header with-border">
            <h3 class="box-title">Kelola Kelas</h3>
           
          </div>

            <form action="form/pembagian_kelas/simpan_pembagian_kelas.php" method="post">
              <input type="hidden" name="id" value="<?php echo $d1['id_guru'] ?>">
            <div class="box-body">
   <?php   
              $qkelas = mysqli_query($conn, "SELECT * from kelas");
              $datakelas = [];
              while ($dkelas=mysqli_fetch_array($qkelas)) {
                $data['id_kelas'] = $dkelas['id_kelas'];
                $data['nama_kelas'] = $dkelas['nama_kelas'];
                array_push($datakelas, $data);
              }
              
              $kolom = 3;
              $chunks = array_chunk($datakelas, $kolom); 
                foreach ($chunks as $chunk) {
                echo '<ul style="float:left">';
                foreach ($chunk as $kelas) { ?>
                   <li style='list-style-type: none;'><input type="checkbox"  name="kelas[]" value="<?php echo $kelas['id_kelas'] ?>"> <?php echo $kelas['nama_kelas'] ?></li>
               <?php }
                echo '</ul>';
              }

              ?>            
            </div>
            <div class="box-footer">
              <button type="submit" onclick="return confirm('Apakah anda akan menyimpan perubahan data pembagian kelas.?')" class="btn btn-info">Simpan</button>
              <a href="?a=pembagian_kelas" class="btn btn-info">Kembali</a>
            </div>
            </form>
           
          </div>




    </div>
  
  </div>

