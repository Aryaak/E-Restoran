<?php 

  $id = $_GET["id"];
  $file = $_GET["file"];

  echo $file;

  $database->runSql("DELETE FROM tabel_menu WHERE id_menu = $id");
  unlink("../assets/upload/".$file);

  header("Location: ?folder=menu&menu=select");

?>