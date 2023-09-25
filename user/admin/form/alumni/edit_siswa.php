<?php 
$id = $_GET['id'];
$t = $_GET['t'];
$status_siswa = $_GET['status'];
$q = mysqli_query($conn, "SELECT * from siswa where id_siswa='$id'");
$d = mysqli_fetch_array($q);
?>            <div class="box-header with-border">
              <h3 class="box-title">Edit Data Siswa</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="form/siswa/simpanedit_siswa.php" method="post" enctype="multipart/form-data">

              <div class="box-body">

                <div class="form-group">
                  <label class="col-sm-2 control-label">Nama </label>
                  <div class="col-sm-10">
                    <input type="hidden" class="form-control" name="id" value="<?php echo $d['id_siswa'] ?>">
                    <input type="hidden" class="form-control" name="t" value="<?php echo $t ?>">
                    <input type="hidden" class="form-control" name="status_siswa" value="<?php echo $status_siswa ?>">
                    <input type="text" class="form-control" required name="nama_siswa" value="<?php echo $d['nama_siswa'] ?>">
                    
                  </div>
                </div>   

                <div class="form-group">
                  <label class="col-sm-2 control-label">NIS </label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" required name="nis" value="<?php echo $d['nis'] ?>">
                  </div>
                </div>   

                <div class="form-group">
                  <label class="col-sm-2 control-label">NISN </label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" required name="nisn" value="<?php echo $d['nisn'] ?>">
                  </div>
                </div>   

                <div class="form-group">
                  <label class="col-sm-2 control-label">Tempat Lahir </label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" required name="tmpl" value="<?php echo $d['tmpl'] ?>">
                  </div>
                </div>   

                <div class="form-group">
                  <label class="col-sm-2 control-label">Tanggal Lahir </label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control" required name="tgll" value="<?php echo $d['tgll'] ?>">
                  </div>
                </div>   

                <div class="form-group">
                  <label class="col-sm-2 control-label">Jenis Kelamin </label>
                  <div class="col-sm-10">
                    <select class="form-control" required name="jk" value="<?php echo $d['jk'] ?>">
                      <option value="L">Laki-laki</option>
                      <option value="P">Perempuan</option>
                    </select>
                  </div>
                </div>   

                <div class="form-group">
                  <label class="col-sm-2 control-label">Agama </label>
                  <div class="col-sm-10">
                    <select class="form-control" required name="agama" value="<?php echo $d['agama'] ?>">
                      <?php $agama = array('Islam','Kristen','Hindu','Budha');
                      foreach ($agama as $a) { ?>
                         
                      <option value="<?php echo $a ?>"><?php echo $a ?></option>
                       <?php } ?>
                    </select>
                  </div>
                </div>   

           
                <div class="form-group">
                  <label class="col-sm-2 control-label">Pendidikan Sebelumnya </label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" required name="pendidikan_sebelumnya" value="<?php echo $d['pendidikan_sebelumnya'] ?>">
                  </div>
                </div>   
                <div class="form-group">
                  <label class="col-sm-2 control-label">Alamat </label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" required name="alamat" value="<?php echo $d['alamat'] ?>">
                  </div>
                </div>   

                <div class="form-group">
                  <label class="col-sm-2 control-label">No HP </label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" required name="no_telp" value="<?php echo $d['no_telp'] ?>">
                  </div>
                </div>   

                

                <div class="form-group">
                  <label class="col-sm-2 control-label">Nama Ayah </label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" required name="nama_ayah" value="<?php echo $d['nama_ayah'] ?>">
                  </div>
                </div>   

                <div class="form-group">
                  <label class="col-sm-2 control-label">Nama Ibu </label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" required name="nama_ibu" value="<?php echo $d['nama_ibu'] ?>">
                  </div>
                </div>   

                <div class="form-group">
                  <label class="col-sm-2 control-label">Pekerjaan Ayah </label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" required name="kerja_ayah" value="<?php echo $d['kerja_ayah'] ?>">
                  </div>
                </div>   

                <div class="form-group">
                  <label class="col-sm-2 control-label">Pekerjaan Ibu </label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" required name="kerja_ibu" value="<?php echo $d['kerja_ibu'] ?>">
                    <input type="hidden" class="form-control" required name="fotolama" value="<?php echo $d['foto'] ?>">
                  </div>
                </div>   
                <div class="form-group">
                  <label class="col-sm-2 control-label">Foto</label>
                  <div class="col-sm-10">
                    <input type="file" class="form-control"  name="file">
                  </div>
                </div>   


             



              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="?a=detail_siswa&id=<?php echo $id ?>" class="btn btn-info">Cancel</a>
                <button type="submit" class="btn btn-info">Simpan</button>
              </div>
              <!-- /.box-footer -->
            </form>
          