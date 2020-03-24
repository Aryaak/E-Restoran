<?php 

  $idUser = $_SESSION["id"]; 
  $data = $database->getItem("SELECT * FROM tabel_user WHERE id_user='$idUser'");

  if ( isset ( $_POST["update"] ) ) {

     $nama = htmlspecialchars ( $_POST["nama"] );
     $email = htmlspecialchars ( $_POST["email"] );
     $password = htmlspecialchars ( $_POST["password"] );
     $password2 = htmlspecialchars ( $_POST["password2"] );
     $level = htmlspecialchars ( $_POST["level"] );

     if ( $password !== $password2 ) {

        $error = true;

     } else {
       
        $password = password_hash ( $password, PASSWORD_DEFAULT );
        $sql = "UPDATE  tabel_user SET nama='$nama', email='$email', password='$password', level='$level' WHERE id_user=$idUser";
        $database->runSql($sql);

        header("Location: ?folder=user&menu=select");
     }
  }


?>

<h3 class="ml-3" > Update User </h3>

<form class="form-inline mt-5" action="" method="post">
  
      <?php if ( isset ( $error ) ) : ?>

        <div class="form-group mx-sm-3 mb-2 w-50">

	          <div class="alert alert-danger" role="alert"> Konfirmasi password salah </div>

        </div>

      <?php endif; ?>

	    <div class="form-group mx-sm-3 mb-2 w-50">

	        <input type="text" name="nama" class="form-control w-100" placeholder="user" required="" value="<?= $data["nama"] ?>">

	    </div> 

	    <div class="form-group mx-sm-3 mb-2 w-50">

	        <input type="email" name="email" class="form-control w-100" placeholder="email" required="" value="<?= $data["email"] ?>">

	    </div>

	    <div class="form-group mx-sm-3 mb-2 w-50">

	        <input type="password" name="password" class="form-control w-100" placeholder="password baru" required="" >

	    </div>

	    <div class="form-group mx-sm-3 mb-2 w-50">

	        <input type="password" name="password2" class="form-control w-100" placeholder="konfirmasi password baru" required="">

	    </div>

	    <div class="form-group mx-sm-3 mb-2 w-50">

	        <select name="level" class="custom-select mr-sm-2 w-100 mx-auto" >
	     	
                 <option value="admin" <?php if ( $data["level"] == "admin" ) {echo "selected";} ?> > admin </option>
                 <option value="koki" <?php if ( $data["level"] == "koki" ) {echo "selected";} ?> > koki </option>
                 <option value="kasir" <?php if ( $data["level"] == "kasir" ) {echo "selected";} ?> > kasir </option>

	        </select>

	    </div>


	    <div class="form-group mx-sm-3 mb-2 w-50">
         
          <button type="submit" name="update" class="btn btn-primary mb-2 w-100"> Update Data </button>
 
	     </div>

</form>