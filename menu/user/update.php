<?php 

  $id = $_GET["id"];
  $data = $database->getItem("SELECT * FROM tabel_user WHERE id_user = $id"); 
  $status = ( $data["aktif"] == 1 ) ? 0 : 1;
  $sql = "UPDATE tabel_user SET aktif=$status WHERE id_user=$id"; 

  $database->runSql($sql);

  header("Location: ?folder=user&menu=select");
 
?>
