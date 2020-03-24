<?php

  // Count cart

  function countCart () {

    global $database;

    $cart = 0;

    foreach ($_SESSION as $sessionKey => $sessionValue) {

     if ( $sessionKey != "pelanggan" &&  $sessionKey != "id" &&  $sessionKey != "email" ) {

        $id = substr($sessionKey, 1);

        $dataAll = $database->getAll("SELECT * FROM tabel_menu WHERE id_menu = $id");
          
        foreach ($dataAll as $data) {
            
           $cart++;

        }
        
     }
     
   }

   return $cart;

  }

 // Create id order 

 function idOrder () {
   
    global $database;
    $sql = "SELECT id_order FROM tabel_order ORDER BY id_order DESC";
    $jumlah = $database->rowCount ($sql);

    if ( $jumlah == 0 ) {

       $idOrder = 1;

    } else {
      
       $item = $database->getItem($sql);
       $idOrder = $item["id_order"] + 1;

    }
  
    return $idOrder;

  }


 // Insert order 

 function insertOrder ( $idOrder, $idPelanggan, $tanggalOrder, $total) {

    global $database;
 
    $sql = "INSERT INTO tabel_order VALUES ( $idOrder, $idPelanggan, '$tanggalOrder', $total, 0,0,0 )"; 
    $database->runSql($sql);    

  }

 
 // Insert order detail

 function insertOrderDetail ($idOrder) {

    global $database;

    foreach ($_SESSION as $sessionKey => $sessionValue) {

      if ( $sessionKey != "pelanggan" &&  $sessionKey != "id" &&  $sessionKey != "email" ) {

         $id = substr($sessionKey, 1);

         $dataAll = $database->getAll("SELECT * FROM tabel_menu WHERE id_menu = $id");
          
         foreach ($dataAll as $data) {
            
            $idMenu = $data["id_menu"];
            $menu = $data["menu"];
            $jumlah = $sessionValue;
            $harga = $data["harga"];
            $sql = "INSERT INTO tabel_order_detail VALUES ('',$idOrder,$idMenu,'$menu',$jumlah,$harga)";
            $database->runSql($sql);

        }
    
      }
     
    }

  }

  // Remove cart
  
  function kosongkanKeranjang () {

    foreach ($_SESSION as $sessionKey => $sessionValue) {
     
      if ($sessionKey != "pelanggan" && $sessionKey != "id" && $sessionKey != "email" ){

         unset($_SESSION[$sessionKey]);

      } 

    }

  }


?>