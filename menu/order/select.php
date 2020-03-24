<?php 
  
  // Pagination variable
   
  $banyakData = $database->rowCount ( "SELECT * FROM view_order" );
  $dataTampil = 5;
  $jumlahHalaman = ceil ( $banyakData / $dataTampil );
  $halamanAktif = ( isset ( $_GET["halaman"] ) ) ? $_GET["halaman"] : 1;
  $awalData = ( $halamanAktif * $dataTampil ) - $dataTampil;
  $idPelanggan = $_SESSION["id"];
  $sql = "SELECT * FROM view_order ORDER BY status DESC LIMIT $awalData, $dataTampil";
  $dataAll = $database->getAll($sql);
  $no = ++$awalData;
   
 ?>

<h3> Order Detail </h3>

<!-- Pagination -->
     
<nav aria-label="...">

    <ul class="pagination">

       <?php if ( $halamanAktif > 1 ) : ?>

         <li class="page-item"> <a class="page-link" href="?folder=order&menu=select&halaman=<?= $halamanAktif - 1 ?>">Previous</a> </li>

       <?php else : ?>
 
         <li class="page-item disabled"> <span class="page-link">Previous</span> </li>

       <?php endif; ?>
       
       <?php for ( $halaman = 1; $halaman <= $jumlahHalaman; $halaman++ ) : ?>
             
         <?php if ( $halamanAktif == $halaman ) : ?>

           <li class="page-item active" aria-current="page"> <span class="page-link"> <?= $halaman ?> <span class="sr-only">(current)</span> </span> </li>

         <?php else : ?>

           <li class="page-item"> <a class="page-link" href="?folder=order&menu=select&halaman=<?= $halaman ?>"> <?= $halaman ?> </a> </li>

          <?php endif; ?>

       <?php endfor; ?>

       <?php if ( $halamanAktif < $jumlahHalaman ) : ?>

         <li class="page-item"> <a class="page-link" href="?folder=order&menu=select&halaman=<?= $halamanAktif + 1 ?>">Next</a> </li>

       <?php else : ?>
 
         <li class="page-item disabled"> <span class="page-link">Next</span> </li>

       <?php endif; ?>

    </ul>

</nav>



<table class="table table-bordered w-75 text-center" >
       
      <thead>
         
             <tr>
               
              <th scope="col" > NO </th>
              <th scope="col" > Pelanggan </th>
              <th scope="col" > Tanggal </th>
              <th scope="col" > Total </th>
              <th scope="col" > Bayar </th>
              <th scope="col" > kembali </th>
              <th scope="col" > Status </th>

             </tr>

      </thead>

      <tbody>
            
            <?php if ( empty ( $dataAll ) ) : ?>

              <tr>
                
               <th colspan="6" > Data Masih Kosong </th>

              </tr>

            <?php else : ?>

              <?php foreach ( $dataAll as $data ) : ?>

              	<?php $status = ( $data["status"] == 1 ) ? "LUNAS" : "BELUM LUNAS"; ?>

                <tr>
                  
                 <th scope="row" > <?= $no++ ?> </th>
                 <td> <?= $data["pelanggan"] ?> </td>
                 <td> <?= $data["tanggal_order"] ?> </td>
                 <td> <?= "RP ".number_format($data["total"],0,",",".") ?> </td>
                 <td> <?= "RP ".number_format($data["bayar"],0,",",".") ?> </td>
                 <td> <?= "RP ".number_format($data["kembali"],0,",",".") ?> </td>
                 <?php if ($status == "LUNAS") : ?>

                   <td> <?= $status ?> </td>
                 
                 <?php else : ?>

                   <td> <a href="?folder=order&menu=bayar&total=<?= $data['total'] ?>&id=<?= $data['id_order'] ?>"> <?= $status ?> </a> </td>

                 <?php endif; ?>

                </tr>

              <?php endforeach; ?>

            <?php endif; ?>

      </tbody>

</table>

