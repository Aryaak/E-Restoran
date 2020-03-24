<?php 

  $id = $_GET["id"];

  $database->runSql("DELETE FROM tabel_pelanggan WHERE id_pelanggan = $id");

  header("Location: ?folder=pelanggan&menu=select");
?>