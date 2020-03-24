<?php 

  $id = $_GET["id"];

  $database->runSql("DELETE FROM tabel_user WHERE id_user = $id");

  header("Location: ?folder=user&menu=select");

?>