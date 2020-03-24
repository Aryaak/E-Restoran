<?php 
 
  if ( isset( $_GET["total"] ) ) {

     $totalPembayaran = $_GET["total"];

  }

  if ( isset ( $_POST["simpan"] ) ) {
     
     $total = $_POST["total"];
     $bayar = $_POST["bayar"];
     $id = $_GET["id"];
     $kembali = 0;

     if ( $bayar < $total ) {
        
        $error = true;

     } else if ( $bayar > $total ) {

       $kembali = $bayar - $total;
       $database->runSql("UPDATE tabel_order SET bayar=$bayar, kembali=$kembali, status=1 WHERE id_order=$id");

       header("Location: ?folder=order&menu=select");

     }

    
  }

?>


<h3> Pembayaran </h3>

<form class="form-inline mt-5" action="" method="post">

    <?php if ( isset($error) ) : ?>

      <div class="form-group mx-sm-3 mb-2 w-100">

         <div class="alert alert-danger w-50" > Uang pembayaran anda <b>kurang</b> </div>

      </div>

    <?php endif ?>

	 <div class="form-group mx-sm-3 mb-2 w-100">

	     <input type="number" name="total" class="form-control w-50" readonly="" value="<?= $totalPembayaran ?>"> 

	 </div>

   <div class="form-group mx-sm-3 mb-2 w-100">

       <input type="number" name="bayar" class="form-control w-50" placeholder="Masukan Pembayaran" required="">

   </div>

   <div class="form-group mx-sm-3 mb-2 w-100">

       <button type="submit" name="simpan" class="btn btn-success mb-2 w-50"> Bayar </button>

   </div>

</form>

