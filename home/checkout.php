<?php 

  require_once "functions.php";

  if ( isset( $_GET["total"] ) ) {
      
     $idOrder = idOrder();
     $total = $_GET["total"];
     $idPelanggan = $_SESSION["id"];
     $tanggal = date("Y-m-d");
     
     $sql = "SELECT * FROM tabel_order WHERE id_order = $idOrder";
     $count = $database->rowCount($sql);
      
     if ( $count == 0 ) {

        insertOrderDetail($idOrder); 
    	insertOrder($idOrder,$idPelanggan,$tanggal,$total);

     } else {
        
        insertOrderDetail($idOrder); 
 
     } 
     
     var_dump($idOrder);

     kosongkanKeranjang();
     
     header("Location: ?folder=home&menu=beli");
     setcookie("alert",true,time()+3);

  }


?>