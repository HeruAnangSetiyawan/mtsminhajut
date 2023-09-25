<div class="box">
	<div class="box-body">
		
<?php 
$id = $_SESSION['id_user'];




  $q = mysqli_query($conn, "SELECT * from kantibmas as a 
    left join pangkat_kantibmas as b on a.id_pangkat = b.id_pangkat
    left join polsek as c on a.id_polsek = c.id_polsek
    where id_kantibmas='$id'");
$d = mysqli_fetch_array($q);
$namauser =  $d['nama']; 
$pangkat =  $d['nama_pangkat']; 
   

?>
	



	<div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-aqua">
              <div class="widget-user-image">
                <img class="img" src="<?php echo $gambar ?>" alt="User Avatar">
              </div>
              <!-- /.widget-user-image -->
              <h5 class="widget-user-desc">Selamat Datang di Halaman Administrator</h5>
              <h3 class="widget-user-username"><?php echo $namauser ?> - <?php echo $pangkat ?></h3>
              <p  class="widget-user-desc">NRP : <?php echo $d['nrp'] ?> | Polsek : <?php echo $d['nama_polsek'] ?></p>
            </div>
            
          </div>



	</div>
</div>
