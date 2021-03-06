<?php 
  
  // Pagination variable
   
  $banyakData = $database->rowCount ( "SELECT * FROM view_order" );
  $dataTampil = 5;
  $jumlahHalaman = ceil ( $banyakData / $dataTampil );
  $halamanAktif = ( isset ( $_GET["halaman"] ) ) ? $_GET["halaman"] : 1;
  $awalData = ( $halamanAktif * $dataTampil ) - $dataTampil;
  
  $idOrder = $_GET["id"];
  $sql = "SELECT * FROM view_order_detail WHERE id_order = $idOrder ORDER BY id_order DESC LIMIT $awalData, $dataTampil";
  $dataAll = $database->getAll($sql);
  $no = ++$awalData;
   
 ?>

<h3> Riwayat pembelian </h3>

<!-- Pagination -->
     
<nav aria-label="...">

    <ul class="pagination">

       <?php if ( $halamanAktif > 1 ) : ?>

         <li class="page-item"> <a class="page-link" href="?folder=kategori&menu=select&halaman=<?= $halamanAktif - 1 ?>">Previous</a> </li>

       <?php else : ?>
 
         <li class="page-item disabled"> <span class="page-link">Previous</span> </li>

       <?php endif; ?>
       
       <?php for ( $halaman = 1; $halaman <= $jumlahHalaman; $halaman++ ) : ?>
             
         <?php if ( $halamanAktif == $halaman ) : ?>

           <li class="page-item active" aria-current="page"> <span class="page-link"> <?= $halaman ?> <span class="sr-only">(current)</span> </span> </li>

         <?php else : ?>

           <li class="page-item"> <a class="page-link" href="?folder=kategori&menu=select&halaman=<?= $halaman ?>"> <?= $halaman ?> </a> </li>

          <?php endif; ?>

       <?php endfor; ?>

       <?php if ( $halamanAktif < $jumlahHalaman ) : ?>

         <li class="page-item"> <a class="page-link" href="?folder=kategori&menu=select&halaman=<?= $halamanAktif + 1 ?>">Next</a> </li>

       <?php else : ?>
 
         <li class="page-item disabled"> <span class="page-link">Next</span> </li>

       <?php endif; ?>

    </ul>

</nav>

<table class="table table-bordered w-75 text-center" >
       
      <thead>
         
             <tr>
               
              <th scope="col" > NO </th>
              <th scope="col" > Tanggal </th>
              <th scope="col" > Kategori </th>
              <th scope="col" > Menu </th>
              <th scope="col" > Jumlah </th>

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
                 <td> <?= $data["tanggal_order"] ?> </td>
                 <td> <?= $data["kategori"] ?> </td>
                 <td> <?= $data["menu"]?> </td>
                 <td> <?= $data["jumlah"] ?> </td>

                </tr>

              <?php endforeach; ?>

            <?php endif; ?>

      </tbody>

</table>