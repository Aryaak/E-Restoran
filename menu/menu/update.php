<?php 

  $kategoriAll = $database->getAll("SELECT * FROM tabel_kategori");
  $id = $_GET["id"];
  $data = $database->getItem("SELECT * FROM tabel_menu WHERE id_menu = $id");
  $idkategori = $data["id_kategori"];


  if ( isset ( $_POST["simpan"] ) ) {
     
     $kategori = $_POST["kategori"];
     $menu = $_POST["menu"];
     $harga = $_POST["harga"];
     $gambar = $data["gambar"];
     $tmpGambar = $_FILES["gambar"]["tmp_name"];

     if ( !empty ( $tmpGambar ) ) {

        $gambar = $_FILES["gambar"]["name"];  
        move_uploaded_file ( $tmpGambar, "../assets/upload/".$gambar );

     }

     $database->runSql("UPDATE tabel_menu SET id_kategori=$kategori, menu='$menu', gambar='$gambar', harga=$harga WHERE id_menu = $id");

     header("Location: ?folder=menu&menu=select");

  }

?>

<h3> Insert Menu </h3>
     
<form action="" method="post" enctype="multipart/form-data">
           
     <div class="form-group w-50">
        
         <label> kategori Menu : </label> <br>
       
         <select name="kategori" class="custom-select mr-sm-2 w-100" >
          
                <?php foreach ( $kategoriAll as $kategori ) : ?>

                  <option <?php if ( $kategori["id_kategori"] == $idkategori ) {echo "selected";} ?> value="<?= $kategori["id_kategori"] ?>"> <?= $kategori["kategori"] ?> </option>

                <?php endforeach; ?>

         </select>

    </div>   

    <div class="form-group w-50">
        
        <label> Nama Menu : </label>
        <input type="text" name="menu" class="form-control" value="<?= $data['menu'] ?>">

    </div>
      
    <div class="form-group w-50">
        
        <label> Harga Menu : </label>
        <input type="number" name="harga" class="form-control" value="<?= $data['harga'] ?>">

    </div>

    <div class="form-group w-50">
        
        <label> Gambar Menu : </label> <br>
        <input type="file" name="gambar"> <br>

    </div>

    <button type="submit" name="simpan" class="btn btn-primary mb-2"> Update Data </button>

</form>



