            <div class="box-header with-border">
              <h3 class="box-title">Tambah Data Pendidik Dan Data Kependidikan</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="form/guru/simpan_guru.php" method="post">

              <div class="box-body">

                <div class="form-group">
                  <label class="col-sm-2 control-label">Nama </label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="nama">
                  </div>
                </div>   

            
                <div class="form-group">
                  <label class="col-sm-2 control-label">Jenis Kelamin</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="jk">
                      <option value="L">Laki-laki</option>
                      <option value="P">Perempuan</option>
                    </select>
                  </div>
                </div>   

                <div class="form-group">
                  <label class="col-sm-2 control-label">Tempat Lahir </label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="tmpl">
                  </div>
                </div>   

                <div class="form-group">
                  <label class="col-sm-2 control-label">Tanggal Lahir </label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control" name="tgll">
                  </div>
                </div>   

                <div class="form-group">
                  <label class="col-sm-2 control-label">NIP </label>
                  <div class="col-sm-10">
                    <input type="num" class="form-control" name="nip">
                  </div>
                </div>   

                  
                <div class="form-group">
                  <label class="col-sm-2 control-label">Jabatan</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="jabatan">
                  </div>
                </div>   
              

                <div class="form-group">
                  <label class="col-sm-2 control-label">Golongan </label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="gol">
                  </div>
                </div>   

               <div class="form-group">
                  <label class="col-sm-2 control-label">TMT</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control" name="tmt">
                  </div>
                </div>   
               


                <div class="form-group">
                  <label class="col-sm-2 control-label">Alamat </label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="alamat">
                  </div>
                </div>   

                <div class="form-group">
                  <label class="col-sm-2 control-label">No HP </label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="nohp">
                  </div>
                </div>   

             
                <div class="form-group">
                  <label class="col-sm-2 control-label">Ijazah Tahun</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="ijazah">
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
          