<?php   if ($_SESSION['level']=='Administrator') { ?>
  
<a href="?a=tambah_pengumuman" class=" btn btn-sm btn-info"  >Tambah Pungumuman</a>
<?php } ?>
<?php if (isset($_SESSION['pesan'])) {
  echo $_SESSION['pesan'];
  unset($_SESSION['pesan']);
} ?>

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
        echo '<br><br><a href="form/pengumuman/file/'.$d['file'].'" target="_blank">Lihat File</a>';
      }



      if ($_SESSION['level']=='Administrator') { ?>
        <br> <br>
        <a href="?a=edit_pengumuman&id=<?php echo $d['id_pengumuman'] ?>" class="btn btn-warning btn-xs">Edit</a>
        <a href="form/pengumuman/hapus.php?id=<?php echo $d['id_pengumuman'] ?>" onclick="return confirm('Hapus pengumuman.?')" class="btn btn-danger btn-xs">Delete</a>
      <?php }else{}
       ?>
      
     
      
    </div>
    <hr>



     <?php } ?>
  