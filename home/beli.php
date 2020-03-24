<?php 

  if ( !isset($_SESSION["pelanggan"]) ) {

     header("Location: home/login_pelanggan.php");
     setcookie("alert",true,time()+1);
     exit;

  }

  if ( isset( $_GET["idProduk"] ) ) {

     $idProduk = $_GET["idProduk"];
 
     if ( isset($_SESSION["_".$idProduk]) ) {

 	      $_SESSION["_".$idProduk]++;

  } else {

 	     $_SESSION["_".$idProduk] = 1;
  } 

     header("Location: ?folder=home&menu=beli");

  }

  // Remove menu
 
  if ( isset ( $_GET["hapus"] ) ) {
    
     $id = $_GET["hapus"];
     unset($_SESSION["_".$id]);
     header("Location: ?folder=home&menu=beli");
  }

  // Plus/minus menu

  if ( isset ( $_GET["update"] ) ) {
     
     $id = $_GET["id"];

     switch ( $_GET["update"] ) {
     
            case 'plus':
              $_SESSION["_".$id]++;
            break;

            case 'minus':
              $_SESSION["_".$id]--;
            break;
           
            default:
              # code...
            break;
     }


     if ( $_SESSION["_".$id] == 0 ) {

        unset($_SESSION["_".$id]);

     }


    header("Location: ?folder=home&menu=beli");

  }

  $no = 1;
  $totalPembayaran = 0;

?>


<h3> Keranjang anda </h3>

<?php if ( isset ( $_COOKIE["alert"] ) ) : ?>

  <div class="alert alert-success mt-5" > Pembelian anda berhasil,  <b>TERIMA KASIH</b> telah berbelanja </div>

<?php endif; ?>
 
<table class="table mt-5 text-center">

      <thead class="thead-dark">

            <tr>
              <th scope="col">NO</th>
              <th scope="col">GAMBAR</th>
              <th scope="col">MENU</th>
              <th scope="col">JUMLAH</th>
              <th scope="col">TOTAL</th>
            </tr>

      </thead>

      <tbody>

      	     <?php foreach ($_SESSION as $sessionKey => $sessionValue) : ?>
           
             <?php if ( $sessionKey != "pelanggan" && $sessionKey != "id" && $sessionKey != "email" ) : ?>

             <?php 
               $idProduk = substr($sessionKey, 1);
               $dataAll = $database->getAll ( "SELECT * FROM tabel_menu WHERE id_menu=$idProduk" );
             ?>

             <?php foreach ( $dataAll as $data ) : ?>

               <tr>
                   <th scope="row" >

                      <div class="dropdown">
                          <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <?= $no++; ?>
                          </button>

                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                             <a class="dropdown-item" href="?folder=home&menu=beli&hapus=<?= $data["id_menu"] ?>">Remove</a>
                          </div>

                      </div>

                   </th>

                   <td> 
                       <img  style="width: 100px;" src="assets/upload/<?= $data["gambar"] ?>"> 
                   </td>

                   <td> <?= $data["menu"] ?> </td>

                   <td>

                      <a href="?folder=home&menu=beli&update=plus&id=<?= $data["id_menu"] ?>"><button class="btn btn-outline-success w-25 mr-1" > + </button></a>
                      <?= $sessionValue ?>
                      <a href="?folder=home&menu=beli&update=minus&id=<?= $data["id_menu"] ?>"> 
                        <button class="btn btn-outline-danger w-25 ml-2" > - </button> 
                      </a>

                    </td>

                   <td> <?php $totalHarga = $data["harga"] * $sessionValue; echo "RP ".number_format($totalHarga,0,'','.'); ?> </td>

               </tr>

                 <?php $totalPembayaran = $totalPembayaran + ( $data["harga"] * $sessionValue ) ?>

                 <?php endforeach; ?>

                 <?php endif; ?>

                 <?php endforeach; ?>

               <?php if ($totalPembayaran != 0) :  ?>

                 <tr>
                     <th colspan="4" > <p class="float-left my-auto" >  TOTAL PEMBAYARAN </p> </th>
                     <td class="text-warning"> RP <?= number_format($totalPembayaran,0,'','.') ?> </td>
                 </tr>
               
               <?php else : ?>

                <tr>
                    <td colspan="5" >  <div class="w-100 alert alert-secondary" role="alert"> Keranjang anda masih kosong </div> </td>
                </tr>

               <?php endif; ?>

       </tbody>

</table>

<?php if ($totalPembayaran != 0) :  ?>

  <a href="?folder=home&menu=checkout&total=<?= $totalPembayaran ?>"> 
    <button class="btn btn-success" > CHECKOUT </button> 
  </a>

<?php endif; ?>

