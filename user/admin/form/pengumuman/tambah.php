 <head>
     <script type="text/javascript" src="form/ckeditor/ckeditor.js"></script>
</head> 
<?php 
   



 ?>
 <form action="form/pengumuman/simpan_pengumuman.php" method="post" enctype="multipart/form-data">
                                           
      
    <div class="form-group">
        <label>Judul</label>
      <input type="text" name="judul" class="form-control">
    </div>   
       <div class="form-group">
        <label>Keterangan</label>
       <textarea name="ket" class="ckeditor" id="ckedtor"  required ></textarea>
    </div>                                    
   
<div class="form-group">
        <label>File</label> <br>
      <input type="file" name="file" >
    </div>   
                            
    
                                   
              

     











    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
        
        <span id="payment-button-amount">Simpan Pengumuman</span>
      </button>
                                           
                                        </form>