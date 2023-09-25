<?php 

?>            <div class="box-header with-border">
              <h3 class="box-title">Tambah Data Siswa</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="form/siswa/simpan_siswa.php" method="post" enctype="multipart/form-data">

              <div class="box-body">

                <div class="form-group">
                  <label class="col-sm-2 control-label">Nama </label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" required name="nama_siswa">
                    
                  </div>
                </div>   

                <div class="form-group">
                  <label class="col-sm-2 control-label">NIS </label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" required name="nis">
                  </div>
                </div>   

                <!-- <div class="form-group">
                  <label class="col-sm-2 control-label">NISN </label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" required name="nisn">
                  </div>
                </div>    -->

                <div class="form-group">
                  <label class="col-sm-2 control-label">Tempat Lahir </label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" required name="tmpl">
                  </div>
                </div>   

                <div class="form-group">
                  <label class="col-sm-2 control-label">Tanggal Lahir </label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control" required name="tgll">
                  </div>
                </div>   

                <div class="form-group">
                  <label class="col-sm-2 control-label">Jenis Kelamin </label>
                  <div class="col-sm-10">
                    <select class="form-control" required name="jk">
                      <option value="L">Laki-laki</option>
                      <option value="P">Perempuan</option>
                    </select>
                  </div>
                </div>   

                <div class="form-group">
                  <label class="col-sm-2 control-label">Agama </label>
                  <div class="col-sm-10">
                    <select class="form-control" required name="agama">
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
                    <input type="text" class="form-control" required name="pendidikan_sebelumnya">
                  </div>
                </div>   
                <div class="form-group">
                  <label class="col-sm-2 control-label">Alamat </label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" required name="alamat">
                  </div>
                </div>   

                <div class="form-group">
                  <label class="col-sm-2 control-label">No HP </label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" required name="no_telp">
                  </div>
                </div>   

                

                <div class="form-group">
                  <label class="col-sm-2 control-label">Nama Ayah </label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" required name="nama_ayah">
                  </div>
                </div>   

                <div class="form-group">
                  <label class="col-sm-2 control-label">Nama Ibu </label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" required name="nama_ibu">
                  </div>
                </div>   

                <div class="form-group">
                  <label class="col-sm-2 control-label">Pekerjaan Ayah </label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" required name="kerja_ayah">
                  </div>
                </div>   

                <div class="form-group">
                  <label class="col-sm-2 control-label">Pekerjaan Ibu </label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" required name="kerja_ibu">
                  </div>
                </div>   
                <div class="form-group">
                  <label class="col-sm-2 control-label">Foto</label>
                  <div class="col-sm-10">
                    <input type="file" class="form-control" required name="file">
                  </div>
                </div>   
                <div class="form-group">
                  <label class="col-sm-2 control-label">Status Siswa</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="status_siswa" id="status_siswa">
                    	<option value="Calon Siswa">Calon Siswa</option>
                    	<option value="Siswa Pindahan">Siswa Pindahan</option>
                    </select>
                  </div>
                </div>   

				<script type="text/javascript">
					$('#status_siswa').change(function(){
						var status = $('#status_siswa').val();
						if (status=='Siswa Pindahan') {
							$('#show_pindahan').show();
						}else{
							$('#show_pindahan').hide();

						}
					});
				</script>

                <div id="show_pindahan" hidden="true">
	                <div class="form-group">
	                  <label class="col-sm-2 control-label">Keterangan Pindahan</label>
	                  <div class="col-sm-10">
	                    <textarea class="form-control" name="keterangan"></textarea>
	                  </div>
	                </div>  
	                <div class="form-group">
	                  <label class="col-sm-2 control-label">Kelas Awal</label>
	                  <div class="col-sm-10">
	                    <select class="form-control" name="kelas">
	                    	<?php for ($i=2; $i <= 6; $i++) { ?>
		                    	<option value="<?php echo $i ?>"><?php echo $i ?></option>
	                    		
	                    	<?php } ?>
	                    </select>
	                  </div>
	                </div>   
                </div>


             



              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="?a=calon_siswa" class="btn btn-info">Cancel</a>
                <button type="submit" class="btn btn-info">Simpan</button>
              </div>
              <!-- /.box-footer -->
            </form>
          