<?php 
 
  $dataTampil = 5;
  $halamanAktif = ( isset ( $_GET["halaman"] ) ) ? $_GET["halaman"] : 1;
  $awalData = ( $halamanAktif * $dataTampil ) - $dataTampil;
 
  if ( isset ( $_POST["option"] ) ) {
     

     $option = $_POST["option"];
     $sqlMenu = "SELECT * FROM tabel_menu  WHERE id_kategori = $option ORDER BY menu ASC LIMIT $awalData, $dataTampil";
     $banyakData = $database->rowCount ( "SELECT * FROM tabel_menu WHERE id_kategori = $option" );
     echo "ok";
     

  } else {

 	   $option = false;
 	   $sqlMenu = "SELECT * FROM tabel_menu ORDER BY menu ASC LIMIT $awalData, $dataTampil";
     $banyakData = $database->rowCount ( "SELECT * FROM tabel_menu" );
  }

  $jumlahHalaman = ceil ( $banyakData / $dataTampil );

  $sqlKategori = "SELECT * FROM tabel_kategori";
  $dataAll = $database->getAll($sqlMenu);
  $kategoriAll = $database->getAll($sqlKategori);
  $no = ++$awalData;
 

?>

<h3> Menu </h3>
     
<?php if ( !empty($dataAll) ) : ?>     

  <nav aria-label="...">

      <ul class="pagination">

         <?php if ( $halamanAktif > 1 ) : ?>

           <li class="page-item"> <a class="page-link" href="?folder=menu&menu=select&halaman=<?= $halamanAktif - 1 ?>">Previous</a> </li>

         <?php else : ?>
     
           <li class="page-item disabled"> <span class="page-link">Previous</span> </li>

         <?php endif; ?>
           
           <?php for ( $halaman = 1; $halaman <= $jumlahHalaman; $halaman++ ) : ?>
                 
             <?php if ( $halamanAktif == $halaman ) : ?>

               <li class="page-item active" aria-current="page"> <span class="page-link"> <?= $halaman ?> <span class="sr-only">(current)</span> </span> </li>

             <?php else : ?>

               <li class="page-item"> <a class="page-link" href="?folder=menu&menu=select&halaman=<?= $halaman ?>"> <?= $halaman ?> </a> </li>

             <?php endif; ?>

          <?php endfor; ?>

          <?php if ( $halamanAktif < $jumlahHalaman ) : ?>

            <li class="page-item"> <a class="page-link" href="?folder=menu&menu=select&halaman=<?= $halamanAktif + 1 ?>">Next</a> </li>

          <?php else : ?>
     
            <li class="page-item disabled"> <span class="page-link">Next</span> </li>

          <?php endif; ?>

        </ul>

  </nav>

<?php endif; ?>

<div class="mt-2 mb-4" >

    <form action="" method="post" >
     	
         <select name="option" onchange="this.form.submit()" class="custom-select mr-sm-2 w-25" >

           	    <?php foreach ( $kategoriAll as $kategori ) : ?>

                  <option  <?php if ( $kategori["id_kategori"] == $option ) {echo "selected";} ?> value="<?= $kategori['id_kategori'] ?>"> <?= $kategori["kategori"] ?> </option>

                <?php endforeach; ?>

         </select>

    </form>
     
</div>

<table class="table table-bordered w-90 text-center" >
       
      <thead>
        
             <tr>
               
              <th scope="col" > NO </th>
              <th scope="col" > Gambar </th>
              <th scope="col" > Menu </th>
              <th scope="col" > Harga </th>
              <th scope="col" > Update </th>
              <th scope="col" > Delete </th>

             </tr>

      </thead>

      <tbody>
          
             <?php if ( empty ( $dataAll ) ) : ?>

             <tr>
              	
                <th colspan="6" > Data Masih Kosong </th>

             </tr>

             <?php else : ?>

               <?php foreach ( $dataAll as $data ) : ?>

                 <tr>
                    
                     <th scope="row" > <?= $no++ ?> </th>
                     <td> <img style="width: 60px; height: 60px;" src="../assets/upload/<?= $data["gambar"] ?>"> </td>
                     <td> <?= $data["menu"] ?> </td>
                     <td> <?= "RP ".number_format($data["harga"],0,',','.') ?> </td>
                     <td> <a href="?folder=menu&menu=update&id=<?= $data["id_menu"] ?>"> <button type="button" class="btn btn-primary"> Update </button></a> </td>
                     <td> <a href="?folder=menu&menu=delete&id=<?= $data["id_menu"] ?>&file=<?= $data["gambar"] ?>"> <button type="button" class="btn btn-danger"> Delete </button> </a> </td>
                     
                 </tr>

               <?php endforeach; ?>
            
             <?php endif; ?>

      </tbody>

</table>

<a href="?folder=menu&menu=insert"> <button type="button" class="btn btn-success">Tambah Data</button> </a>
