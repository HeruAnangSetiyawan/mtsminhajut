<?php 
$id = $_GET['id'];
$q = mysqli_query($conn, "SELECT * from guru where id_guru = '$id'");
$d = mysqli_fetch_array($q);
 ?>


            <div class="box-header with-border">
              <h3 class="box-title">Edit Data Guru</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="form/guru/simpanedit_guru.php" method="post">

              <div class="box-body">

                <div class="form-group">
                  <label class="col-sm-2 control-label">Nama </label>
                  <div class="col-sm-10">
                    <input type="hidden" class="form-control" name="id" value="<?php echo $d['id_guru'] ?>">
                    <input type="text" class="form-control" name="nama" value="<?php echo $d['nama_guru'] ?>">
                  </div>
                </div>   

            
                <div class="form-group">
                  <label class="col-sm-2 control-label">Jenis Kelamin</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="jk" value="<?php echo $d['jk'] ?>">
                      <option value="L" <?php if($d['jk']=="L"){echo "selected";} ?>>Laki-laki</option>
                      <option value="P" <?php if($d['jk']=="P"){echo "selected";} ?>>Perempuan</option>
                    </select>
                  </div>
                </div>   

                <div class="form-group">
                  <label class="col-sm-2 control-label">Tempat Lahir </label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="tmpl" value="<?php echo $d['tmpl'] ?>">
                  </div>
                </div>   

                <div class="form-group">
                  <label class="col-sm-2 control-label">Tanggal Lahir </label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control" name="tgll" value="<?php echo $d['tgll'] ?>">
                  </div>
                </div>   

                <div class="form-group">
                  <label class="col-sm-2 control-label">NIP </label>
                  <div class="col-sm-10">
                    <input type="num" class="form-control" name="nip" value="<?php echo $d['nip'] ?>">
                  </div>
                </div>   

                  
                <div class="form-group">
                  <label class="col-sm-2 control-label">Jabatan</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="jabatan" value="<?php echo $d['gol'] ?>">
                  </div>
                </div>   
              

                <div class="form-group">
                  <label class="col-sm-2 control-label">Golongan </label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="gol" value="<?php echo $d['jabatan'] ?>">
                  </div>
                </div>   

               <div class="form-group">
                  <label class="col-sm-2 control-label">TMT</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control" name="tmt" value="<?php echo $d['tmt'] ?>">
                  </div>
                </div>   
               


                <div class="form-group">
                  <label class="col-sm-2 control-label">Alamat </label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="alamat" value="<?php echo $d['alamat'] ?>">
                  </div>
                </div>   

                <div class="form-group">
                  <label class="col-sm-2 control-label">No HP </label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="nohp" value="<?php echo $d['nohp'] ?>">
                  </div>
                </div>   

             
                <div class="form-group">
                  <label class="col-sm-2 control-label">Ijazah Tahun</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="ijazah" value="<?php echo $d['ijazah_tahun'] ?>">
                  </div>
                </div>   


              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="?a=guru" class="btn btn-default">Cancel</a>
                <button type="submit" class="btn btn-info">Simpan</button>
              </div>
              <!-- /.box-footer -->
            </form>
          