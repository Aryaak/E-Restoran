<?php 

  $id = $_GET["id"];
  $data = $database->getItem("SELECT * FROM tabel_pelanggan WHERE id_pelanggan = $id"); 
  $status = ( $data["aktif"] == 1 ) ? 0 : 1;
  $sql = "UPDATE tabel_pelanggan SET aktif=$status WHERE id_pelanggan=$id"; 

  $database->runSql($sql);

  header("Location: ?folder=pelanggan&menu=select");
 
?>
