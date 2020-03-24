<?php 
  
  $id = $_GET["id"];

  if ( isset ( $_POST["simpan"] ) ) {

     $kategori = htmlspecialchars ( $_POST["kategori"] );
     $sql = "UPDATE tabel_kategori SET kategori='$kategori' WHERE id_kategori=$id";
     $database->runSql($sql);

     header("Location: ?folder=kategori&menu=select");
  }
  
  $data = $database->getItem("SELECT * FROM tabel_kategori WHERE id_kategori = $id ");

?>


<h3> Update Kategori </h3>

<form class="form-inline mt-5" action="" method="post">

	   <div class="form-group mx-sm-3 mb-2">

	       <input type="text" name="kategori" class="form-control" value="<?= $data['kategori'] ?>" required="">

	   </div>

	   <button type="submit" name="simpan" class="btn btn-primary mb-2"> Update Data </button>

</form>
