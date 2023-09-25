
<?php 
$id = $_SESSION['id_user'];
$nama_semester = [1=>'Ganjil','Genap'];



  $q = mysqli_query($conn, "SELECT * from siswa   where id_siswa='$id'");
$d = mysqli_fetch_array($q);
$d1 = $d;
$namauser =  $d['nama_siswa']; 
   

   $qta = mysqli_query($conn, "SELECT * from tahun_ajaran where status_ta='Aktif'");
          $jta = mysqli_num_rows ($qta);
          $dta = mysqli_fetch_array($qta);
          $id_ta = $dta['id_ta'];




if ($jta==0) { 
  $kelas_aktif  = "Tidak ada tahun ajaran aktif saat ini";

}else{
  $qkelas = mysqli_query($conn, "SELECT 
    a.status_ks, a.id_ta, b.tingkat, b.nama_kelas, d.nama_guru as wali_kelas, ta.semester

    from kelas_siswa a 
    left join kelas b on a.id_kelas = b.id_kelas
    left join wali_kelas c on a.id_kelas = c.id_kelas and c.status_wali_kelas = '1'
    left join guru d on c.id_guru = d.id_guru
    left join tahun_ajaran ta on a.id_ta = ta.id_ta
    where a.id_siswa = '$id' and a.status_ks='Aktif' and a.id_ta='$id_ta' order by id_ks asc limit 1");
  $dkelas = mysqli_fetch_array($qkelas);
  if ($dkelas['id_ta']==$id_ta) {
    $kelas_aktif  = $dkelas['tingkat'].' - '.$dkelas['nama_kelas'];
    $wali_kelas  = $dkelas['wali_kelas']== '' ? 'Wali Kelas Belum Ditentukan' : $dkelas['wali_kelas'];
    $semester = $dkelas['semester'];
  }else{
    $kelas_aktif  = "Kelas belum ditentukan";
    $wali_kelas  = '';
    $semester = 0;
  }
}
?>
	



	<div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-aqua">
              <div class="widget-user-image">
                <img class="img" src="<?php echo $gambar ?>" alt="User Avatar">
              </div>
              <!-- /.widget-user-image -->
              <h5 class="widget-user-desc">Selamat Datang di Halaman User</h5>
              <h3 class="widget-user-username">Hak Akses : <?php echo $_SESSION['level'] ?></h3>
              
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
          <td><?php echo $d1['status_siswa'] =='Selesai' ? 'Alumni' : $d1['status_siswa'] ?></td>
        </tr>
        <?php if ($d1['status_siswa']!='Selesai') { ?>
        <tr>
          <td>Kelas Aktif</td>
          <td>:</td>
          <td><?php echo $kelas_aktif ?></td>
        </tr>
        <tr>
          <td>Semester</td>
          <td>:</td>
          <td><?php echo $nama_semester[$semester] ?></td>
        </tr>
        <tr>
          <td>Wali Kelas</td>
          <td>:</td>
          <td><?php echo $wali_kelas ?></td>
        </tr>
      <?php } ?>
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
          <td>Pendidikan Sebelumnya</td>
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
