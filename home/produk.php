<?php 
 
  // Pagination variable
  
  if ( isset($_GET["idkategori"]) ) {
     
     $idKategori = $_GET["idkategori"];
     $banyakData = $database->rowCount ( "SELECT * FROM tabel_menu WHERE id_kategori = $idKategori" );

  } else {
     
     $banyakData = $database->rowCount ( "SELECT * FROM tabel_menu" );

  }

  $dataTampil = 3;
  $jumlahHalaman = ceil ( $banyakData / $dataTampil );
  $halamanAktif = ( isset ( $_GET["halaman"] ) ) ? $_GET["halaman"] : 1;
  $awalData = ( $halamanAktif * $dataTampil ) - $dataTampil;


  // Filter data
 
  if ( isset ( $_GET["idkategori"] ) ) {

     $idKategori = $_GET["idkategori"];
     $sqlMenu = "SELECT * FROM tabel_menu  WHERE id_kategori = $idKategori ORDER BY menu ASC LIMIT $awalData, $dataTampil";

  } else {
  
 	   $sqlMenu = "SELECT * FROM tabel_menu ORDER BY menu ASC LIMIT $awalData, $dataTampil";
  }

  $sqlKategori = "SELECT * FROM tabel_kategori";
  $dataAll = $database->getAll($sqlMenu);
  $kategoriAll = $database->getAll($sqlKategori);
  $no = ++$awalData;
 
?>

<h3 class="mt-0" > Menu </h3>

   <!-- Pagination -->

   <!-- Previous button -->

   <?php if ( $banyakData != 0 ) : ?>
     
     <nav aria-label="...">

         <ul class="pagination">

            <?php if ( $halamanAktif > 1 ) : ?>
              
              <?php if ( isset ( $_GET["idkategori"] ) ) : ?>

                <li class="page-item"> <a class="page-link" href="?folder=home&menu=produk&halaman=<?= $halamanAktif - 1 ?>&idkategori=<?= $idKategori ?>">Previous</a> </li>

              <?php else : ?>

                <li class="page-item"> <a class="page-link" href="?folder=home&menu=produk&halaman=<?= $halamanAktif - 1 ?>">Previous</a> </li>

              <?php endif; ?>

            <?php else : ?>
   
              <li class="page-item disabled"> <span class="page-link">Previous</span> </li>

            <?php endif; ?>

            <!-- Page number -->
         
            <?php for ( $halaman = 1; $halaman <= $jumlahHalaman; $halaman++ ) : ?>
               
              <?php if ( $halamanAktif == $halaman ) : ?>

                <li class="page-item active" aria-current="page"> <span class="page-link"> <?= $halaman ?> <span class="sr-only">(current)</span> </span> </li>

              <?php else : ?>

                <?php if ( isset($_GET["idkategori"]) ) : ?>

                  <li class="page-item"> <a class="page-link" href="?folder=home&menu=produk&halaman=<?= $halaman ?>&idkategori=<?= $idKategori ?>"> <?= $halaman ?> </a> </li>

                <?php else : ?>

                  <li class="page-item"> <a class="page-link" href="?folder=home&menu=produk&halaman=<?= $halaman ?>"> <?= $halaman ?> </a> </li>

                <?php endif; ?>

              <?php endif; ?>

            <?php endfor; ?>

            <!-- Next button -->

            <?php if ( $halamanAktif < $jumlahHalaman ) : ?>

              <?php if ( isset ( $_GET["idkategori"] ) ) : ?>

                <li class="page-item"> <a class="page-link" href="?folder=home&menu=produk&halaman=<?= $halamanAktif + 1 ?>&idkategori=<?= $idKategori ?>">Next</a> </li>

              <?php else : ?>

                <li class="page-item"> <a class="page-link" href="?folder=home&menu=produk&halaman=<?= $halamanAktif + 1 ?>">Next</a> </li>

              <?php endif; ?>

            <?php else : ?>
   
              <li class="page-item disabled"> <span class="page-link">Next</span> </li>

            <?php endif; ?>

         </ul>

     </nav>

  <?php endif; ?>

<!-- Check data -->
      
<?php if ( empty($dataAll) ) : ?>
     
  <div class="alert alert-secondary" role="alert"> Data masih kosong </div>

<?php else : ?> 

  <!-- Card menu -->

  <?php foreach ( $dataAll as $data ) : ?>     

    <div class="card" style="width: 15rem; float: left; margin: 10px;">

        <img src="assets/upload/<?= $data['gambar'] ?>" class="card-img-top" style="height: 200px;" alt="...">
        <div class="card-body">

           <h5 class="card-title"><?= $data['menu'] ?></h5>
           <p class="card-text">Harga : <?= number_format($data["harga"],0,',','.') ?></p>
           <a href="?folder=home&menu=beli&idProduk=<?= $data['id_menu'] ?>&beli=true" class="btn btn-primary">Beli</a>

        </div>

    </div>

  <?php endforeach; ?>

<?php endif; ?>
