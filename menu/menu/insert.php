<?php 

  $KategoriAll = $database->getAll("SELECT * FROM tabel_kategori");

  if ( isset ( $_POST["simpan"] ) ) {
     
     $kategori = $_POST["kategori"];
     $menu = $_POST["menu"];
     $harga = $_POST["harga"];
     $namaGambar = $_FILES["gambar"]["name"];
     $tmpGambar  = $_FILES["gambar"]["tmp_name"];
     $sql = "INSERT INTO tabel_menu VALUES ('', $kategori, '$menu', '$namaGambar', $harga)";
     move_uploaded_file ( $tmpGambar, "../assets/upload/".$namaGambar);
     $database->runSql($sql);
     header("Location: ?folder=menu&menu=select");
  }

?>



<h3> Insert Menu </h3>
     
<form action="" method="post" enctype="multipart/form-data">
      
      
	 <div class="form-group w-50">
        
         <label> Kategori Menu : </label> <br>
       
	     <select name="kategori" class="custom-select mr-sm-2 w-100" >
          
         <?php foreach ( $KategoriAll as $Kategori ) : ?>

           <option  value="<?= $Kategori["id_kategori"] ?>"> <?= $Kategori["kategori"] ?> </option>

         <?php endforeach; ?>

         </select>


	 </div>
      

	 <div class="form-group w-50">
        
         <label> Nama Menu : </label>
	     <input type="text" name="menu" class="form-control" required="">

	 </div>
      
      
	<div class="form-group w-50">
        
        <label> Harga Menu : </label>
	    <input type="number" name="harga" class="form-control" required="">

	</div>

	<div class="form-group w-50">
        
        <label> Gambar Menu : </label> <br>
	    <input type="file" name="gambar" required=""> <br>

	</div>


	<button type="submit" name="simpan" class="btn btn-primary mb-2"> Tambah Data </button>

</form>

