<?php

    $q=mysqli_query($conn, "SELECT * from pengumuman");
    $no=1;
    while ($d = mysqli_fetch_array($q)) { 
      $pecah = explode('-', $d['tgl_input']);
      $tgli  = $pecah[2].'-'.$pecah[1].'-'.$pecah[0];?>
     



     <div class="box-header">
      <h3 class="box-title">
        <?php echo $d['nama_pengumuman'] ?>
      </h3>

      <p>Posting in <?php echo $tgli ?></p>
      
     
      <?php echo $d['keterangan'];
      if ($d['file']!='') {
        echo '<br><br><a href="../user/admin/form/pengumuman/file/'.$d['file'].'" target="_blank">Lihat File</a>';
      }

       ?>
      
     
      
    </div>
    <hr>



     <?php } ?>
  