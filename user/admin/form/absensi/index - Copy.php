<?php 
session_start();
include "../../../../assets/koneksi.php";
$id_kelas = $_POST['id_kelas'];
$id_siswa = $_POST['id_siswa'];
$id_ta = $_POST['id_ta'];
$id_mapel = $_POST['id_mapel'];
$nilai = $_POST['nilai'];

foreach ($id_mapel as $key => $v) {
  $nilaiinput = $nilai[$key];
  $idmapel  = $v;

  echo $key;
}
 ?>