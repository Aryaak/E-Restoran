<?php 

  if ( isset ( $_POST["simpan"] ) ) {

     $kategori = htmlspecialchars ( $_POST["kategori"] );
     $sql = "INSERT INTO tabel_kategori VALUES ('', '$kategori')";
     $database->runSql($sql);

     header("Location: ?folder=kategori&menu=select");
  }

?>


<h3> Insert Kategori </h3>

<form class="form-inline mt-5" action="" method="post">

	 <div class="form-group mx-sm-3 mb-2">

	     <input type="text" name="kategori" class="form-control" placeholder="Kategori" required="">

	 </div>

	 <button type="submit" name="simpan" class="btn btn-primary mb-2"> Tambah Data </button>

</form>

