<?php 

  $id = $_GET["id"];

  $database->runSql("DELETE FROM tabel_kategori WHERE id_kategori = $id");

  header("Location: ?folder=kategori&menu=select");

?>