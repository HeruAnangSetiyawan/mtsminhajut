<?php 
@$menu = $_GET['a'];
if ($menu=='') {
  include "form/dashboard/dashboard_siswa.php";
}
else if ($menu=='pengumuman') {
  include "form/pengumuman/index.php";
}
else if ($menu=='siswa_pj_wk') {
  include "form/siswa_walikelas/index.php";
}
else if ($menu=='history_kelas') {
  include "form/history_kelas_siswa/index.php";
}

else if ($menu=='edit_akun') {
  include "form/dashboard/edit_akun.php";
}
else if ($menu=='aktivitas_siswa_kelas') {
  include "form/history_kelas_siswa/aktivitas_siswa_kelas.php";
}
else if ($menu=='detail_siswa') {
  include "form/siswa_walikelas/detail_siswa.php";
}

elseif ($menu=='detail_pengambilan') {
  include "form/pengambilan/detail_pengambilan.php";
}
else{
	echo "Fitur ini belum tersedia";
}
 ?>

