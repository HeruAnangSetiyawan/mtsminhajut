<?php 
@$menu = $_GET['a'];
if ($menu=='') {
  include "form/dashboard/dashboard_admin.php";
}
else if ($menu=='pengumuman') {
  include "form/pengumuman/index.php";
}
else if ($menu=='tambah_pengumuman') {
  include "form/pengumuman/tambah.php";
}
else if ($menu=='manage_kelas') {
  include "form/kelas/manage.php";
}
else if ($menu=='manage_history_kelas') {
  include "form/kelas/manage_history.php";
}
else if ($menu=='manage_mapel') {
  include "form/mapel/manage.php";
}
else if ($menu=='edit_pengumuman') {
  include "form/pengumuman/edit.php";
}
else if ($menu=='calon_siswa') {
  include "form/siswa/calon_siswa.php";
}
else if ($menu=='alumni') {
  include "form/alumni/data_alumni.php";
}
else if ($menu=='detail_alumni') {
  include "form/alumni/detail_alumni.php";
}
else if ($menu=='edit_akun') {
  include "form/dashboard/edit_akun.php";
}
else if ($menu=='siswa_aktif') {
  include "form/siswa/siswa_aktif.php";
}
else if($menu=='tambah_siswa'){
  include "form/siswa/tambah_siswa.php";
}
else if($menu=='edit_siswa'){
  include "form/siswa/edit_siswa.php";
}
else if($menu=='detail_siswa'){
  include "form/siswa/detail_siswa.php";
}
else if($menu=='siswa_perkelas'){
  include "form/siswa_perkelas/index.php";
}
else if($menu=='data_siswa_kelas'){
  include "form/siswa_perkelas/data_siswa_perkelas.php";
}
else if($menu=='mapel'){
  include "form/mapel/data_kelas.php";
}
else if($menu=='edit_mapel'){
  include "form/mapel/edit_mapel.php";
}
else if($menu=='kelas'){
  include "form/kelas/data_kelas.php";
}
else if($menu=='history_kelas'){
  include "form/kelas/data_history_kelas.php";
}
else if($menu=='edit_kelas'){
  include "form/kelas/edit_kelas.php";
}
else if($menu=='guru'){
  include "form/guru/data_guru.php";
}
else if($menu=='tambah_guru'){
  include "form/guru/tambah_guru.php";
}
else if($menu=='edit_guru'){
  include "form/guru/edit_guru.php";
}
elseif ($menu=='pembagian_kelas') {
  include "form/pembagian_kelas/data_pembagian_kelas.php";
}
elseif ($menu=='pembagian_mapel') {
  include "form/pembagian_mapel/data_pembagian_mapel.php";
}
elseif ($menu=='kelola_mapel') {
  include "form/pembagian_mapel/kelola_mapel.php";
}
elseif ($menu=='tahun_ajaran') {
  include "form/ta/data_tahun_ajaran.php";
}
elseif ($menu=='penunjang') {
  include "form/penunjang_belajar/index.php";
}
elseif ($menu=='edit_penunjang_belajar') {
  include "form/penunjang_belajar/edit_penunjang_belajar.php";
}
elseif ($menu=='pengambilan') {
  include "form/pengambilan/index.php";
}
elseif ($menu=='pengambilan_baru') {
  include "form/pengambilan/pengambilan_baru.php";
}
elseif ($menu=='hutang_perkelas') {
  include "form/pengambilan/hutang_perkelas.php";
}
elseif ($menu=='checkout_pengambilan') {
  include "form/pengambilan/checkout_pengambilan.php";
}
elseif ($menu=='detail_pengambilan') {
  include "form/pengambilan/detail_pengambilan.php";
}

else{
	echo "Fitur ini belum tersedia";
}
 ?>

