<?php 
  
  // Pagination variable
   
  $banyakData = $database->rowCount ( "SELECT * FROM view_order_detail" );
  $dataTampil = 5;
  $jumlahHalaman = ceil ( $banyakData / $dataTampil );
  $halamanAktif = ( isset ( $_GET["halaman"] ) ) ? $_GET["halaman"] : 1;
  $awalData = ( $halamanAktif * $dataTampil ) - $dataTampil;

  $idPelanggan = $_SESSION["id"];
  $no = ++$awalData;
  $grandTotal = 0;

  if ( isset ( $_POST["cari"] ) ) {

     $tanggalAwal = $_POST["tanggalAwal"];
     $tanggalAkhir = $_POST["tanggalAkhir"];

     $sql = "SELECT * FROM view_order_detail WHERE tanggal_order BETWEEN '$tanggalAwal' AND '$tanggalAkhir' LIMIT $awalData, $dataTampil";
 
  } else {
     
     $sql = "SELECT * FROM view_order_detail LIMIT $awalData, $dataTampil";
    
  }

  $dataAll = $database->getAll($sql);

   
 ?>

<h3> Order Detail </h3>

<form action="" method="post" class="mb-3" >

  <div class="row">

    <div class="col">
      <input type="date" name="tanggalAwal" class="form-control" placeholder="First name">
    </div>

    <i class="fa fa-arrow-right mt-2" aria-hidden="true"></i>

    <div class="col">
      <input type="date" name="tanggalAkhir" class="form-control" placeholder="Last name">
    </div>

    <div class="col">
      <button type="submit" name="cari" class="btn btn-success" >	Cari berdasarkan tanggal </button>
    </div>

  </div>

</form>

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



<table class="table table-bordered w-100 text-center" >
       
      <thead>
         
             <tr>
               
              <th scope="col" > NO </th>
              <th scope="col" > Pelanggan </th>
              <th scope="col" > Tanggal </th>
              <th scope="col" > Menu </th>
              <th scope="col" > Harga </th>
              <th scope="col" > Jumlah </th>
              <th scope="col" > Alamat </th>
              <th scope="col" > Total </th>

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
                 <td> <?= $data["menu"] ?> </td>
                 <td> <?= $data["harga"] ?> </td>
                 <td> <?= $data["jumlah"] ?> </td>
                 <td> <?= $data["alamat"] ?> </td>
                 <td> <?php $total = ($data["harga"] * $data["jumlah"]); echo "RP ".number_format($total,0,",",".") ?> </td>
                  
                 <?php $grandTotal = $grandTotal + $total ?>

                </tr>

              <?php endforeach; ?>
                
                <tr>
                	
                 <td colspan="7"> <h3 class="float-left" >GRAND TOTAL</h3>  </td>
                 <td> <?= "RP ".number_format($grandTotal,0,",",".") ?> </td>

                </tr>

            <?php endif; ?>

      </tbody>

</table>

