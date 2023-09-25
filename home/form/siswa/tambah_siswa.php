
            <form class="form-horizontal" action="../user/admin/form/siswa/simpan_siswa.php" method="post" enctype="multipart/form-data">

              <div class="box-body">

                <div class="form-group">
                  <label class=" control-label">Nama </label>
                  <div class="">
                    <input type="text" class="form-control" required name="nama_siswa">
                    
                  </div>
                </div>   

                <div class="form-group">
                  <label class=" control-label">NIS </label>
                  <div class="">
                    <input type="number" class="form-control" required name="nis">
                  </div>
                </div>   

               <!--  <div class="form-group">
                  <label class=" control-label">NISN </label>
                  <div class="">
                    <input type="number" class="form-control" required name="nisn">
                  </div>
                </div>    -->

                <div class="form-group">
                  <label class=" control-label">Tempat Lahir </label>
                  <div class="">
                    <input type="text" class="form-control" required name="tmpl">
                  </div>
                </div>   

                <div class="form-group">
                  <label class=" control-label">Tanggal Lahir </label>
                  <div class="">
                    <input type="date" class="form-control" required name="tgll">
                  </div>
                </div>   

                <div class="form-group">
                  <label class=" control-label">Jenis Kelamin </label>
                  <div class="">
                    <select class="form-control" required name="jk">
                      <option value="L">Laki-laki</option>
                      <option value="P">Perempuan</option>
                    </select>
                  </div>
                </div>   

                <div class="form-group">
                  <label class=" control-label">Agama </label>
                  <div class="">
                    <select class="form-control" required name="agama">
                      <?php $agama = array('Islam','Kristen','Hindu','Budha');
                      foreach ($agama as $a) { ?>
                         
                      <option value="<?php echo $a ?>"><?php echo $a ?></option>
                       <?php } ?>
                    </select>
                  </div>
                </div>   

           
                <div class="form-group">
                  <label class=" control-label">Pendidikan Sebelumnya </label>
                  <div class="">
                    <input type="text" class="form-control" required name="pendidikan_sebelumnya">
                  </div>
                </div>   
                <div class="form-group">
                  <label class=" control-label">Alamat </label>
                  <div class="">
                    <input type="text" class="form-control" required name="alamat">
                  </div>
                </div>   

                <div class="form-group">
                  <label class=" control-label">No HP </label>
                  <div class="">
                    <input type="number" class="form-control" required name="no_telp">
                  </div>
                </div>   

                

                <div class="form-group">
                  <label class=" control-label">Nama Ayah </label>
                  <div class="">
                    <input type="text" class="form-control" required name="nama_ayah">
                  </div>
                </div>   

                <div class="form-group">
                  <label class=" control-label">Nama Ibu </label>
                  <div class="">
                    <input type="text" class="form-control" required name="nama_ibu">
                  </div>
                </div>   

                <div class="form-group">
                  <label class=" control-label">Pekerjaan Ayah </label>
                  <div class="">
                    <input type="text" class="form-control" required name="kerja_ayah">
                  </div>
                </div>   

                <div class="form-group">
                  <label class=" control-label">Pekerjaan Ibu </label>
                  <div class="">
                    <input type="text" class="form-control" required name="kerja_ibu">
                    <input type="hidden" class="form-control"  name="status_siswa" value="Calon Siswa">
                  </div>
                </div>   
                <div class="form-group">
                  <label class=" control-label">Foto</label>
                  <div class="">
                    <input type="file" class="form-control" required name="file">
                  </div>
                </div>   


             



              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                
                <button type="submit" class="btn btn-info">Simpan</button>
              </div>
              <!-- /.box-footer -->
            </form>
          