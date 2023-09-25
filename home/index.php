<?php
  include 'header.php';
?>
       <!-- collection -->
    <section class="collection py-lg-4 py-md-3 py-sm-3 py-3">
      <div class="container py-lg-5 py-md-4 py-sm-4 py-3">
        <h3 class="title text-center mb-lg-5 mb-md-4 mb-sm-4 mb-3">Pengumuman</h3>
        <!--row -->

      <?php 
        include '../assets/koneksi.php';
        include 'form/pengumuman/index.php';
        
        ?>

      </div>
    </section>
    <!-- collection -->
    <!-- stats -->

    <!--//stats -->
    <!-- service -->
    <!-- //service -->   
<?php
  include 'footer.php';
?>