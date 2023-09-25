<?php

$id=$_SESSION['id_user'];
?>



<?php

$qkelas = mysqli_query($conn, "SELECT 
  a.status_ks, a.id_ks, a.id_siswa, a.id_wali_kelas, a.id_kelas, a.id_ta,
  b.nama_ta, b.status_ta, c.nama_kelas, c.tingkat

  from kelas_siswa a 
  left join tahun_ajaran b on a.id_ta = b.id_ta
  left join kelas c on a.id_kelas = c.id_kelas
  
  where a.id_siswa = '$id' group by a.id_ta");
$jkelas = mysqli_num_rows($qkelas);
?>


 <div class="box-header with-border">
    <h3 class="box-title">
      History Kelas Siswa

    </h3>
    
    
  </div>
  <div class="box-body">
     
      <?php 
      if ($jkelas==0) { ?>
       <div class="alert alert-info">
         Ini merupakan siswa baru <br>  Silahkan tentukan kelas siswa lebih dahulu <br> 
        <a href="#" class=" btn btn-success btn-xs"  data-toggle="modal" data-target="#addkelas">Tentukan Kelas Awal</a>
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
                  <td>Semester Aktif</td>
                  <td>Status</td>
                  <td>Option</td>
                </tr>
              </thead>
              <?php 
              $no=1;
              while ($dkelas = mysqli_fetch_array($qkelas)) { 
                $id_kelas = $dkelas['id_kelas'];
                $q_wali_kelas = mysqli_query($conn, "SELECT g.nama_guru from wali_kelas wk left join guru g on wk.id_guru = g.id_guru where wk.id_kelas='$id_kelas' and wk.status_wali_kelas='1'");
                $d_wali_kelas = mysqli_fetch_array($q_wali_kelas);
                $id_ta = $dkelas['id_ta'];
                $q_semester = mysqli_query($conn, "SELECT * from tahun_ajaran where id_ta = '$id_ta' and status_ta='Aktif'");
                $d_semester = mysqli_fetch_array($q_semester);
                $semester = [1=>'Ganjil','Genap'];
                ?>
              
              <tr>
                <td><?php echo $no++ ?></td>
                <td><?php echo $dkelas['tingkat'] ?></td>
                <td><?php echo $dkelas['nama_kelas'] ?></td>
                <td><?php echo $d_wali_kelas['nama_guru'] ?></td>
                <td><?php echo $dkelas['nama_ta'] ?></td>
                <td>
	            	<?php 
	            		if ($dkelas['status_ks']=='Aktif') {
	            			echo $semester[$d_semester['semester']]; 
	            			$semester_aktif = $d_semester['semester'];
	            		}else{
	            			echo "Selesai di kelas ini";
	            			$semester_aktif =2;
	            		}
	            	?>
            		
            	</td>
                <td>
                  <?php if ($dkelas['status_ks']=='Lanjut') {
                    $next = $dkelas['tingkat'] + 1;
                    $keterangan = "Naik ke kelas ".$next;
                  }elseif ($dkelas['status_ks']=='Tinggal') {
                    $keterangan = "Tinggal di kelas ".$dkelas['tingkat'];
                  }else{
                    $keterangan = $dkelas['status_ks'];

                  } 
                  echo $keterangan?>
                    
                  </td>
                <td>
                  <a href="?a=aktivitas_siswa_kelas&id=<?php echo $dkelas['id_siswa'] ?>&id_kelas=<?php echo $dkelas['id_kelas'] ?>&id_ta=<?php echo $dkelas['id_ta'] ?>&status_ks=<?php echo $dkelas['status_ks'] ?>&semester=<?php echo $semester_aktif ?>&tingkat=<?php echo $dkelas['tingkat'] ?>&status_ta=<?php echo $dkelas['status_ta'] ?>" class="btn btn-info btn-xs">Lihat Aktivitas</a>
                </td>
              </tr>
              <?PHP } ?>
            </table>
          </div>

      <?php } ?>
  </div>
