<?php 
if ($_SESSION['level']=="Wali Kelas") {
  include "konten_walikelas.php";
  # code...
}
else if ($_SESSION['level']=="Siswa") {
  include "konten_siswa.php";
  # code...
}else{
  include "konten_admin.php";
}
 ?>


