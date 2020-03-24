<?php 

  if ( isset ( $_POST["simpan"] ) ) {

     $nama = htmlspecialchars ( $_POST["nama"] );
     $email = htmlspecialchars ( $_POST["email"] );
     $password = htmlspecialchars ( $_POST["password"] );
     $password2 = htmlspecialchars ( $_POST["password2"] );
     $level = htmlspecialchars ( $_POST["level"] );

     if ( $password !== $password2 ) {

        $error = true;

     } else {
       
       $password = password_hash ( $password, PASSWORD_DEFAULT );
       $sql = "INSERT INTO tabel_user VALUES ('', '$nama', '$email', '$password', '$level',1)";
       $database->runSql($sql);

       header("Location: ?folder=user&menu=select");

     }

  }

?>

<h3 class="ml-3" > Insert User </h3>

   <form class="form-inline mt-5" action="" method="post">
  
        <?php if ( isset ( $error ) ) : ?>

          <div class="form-group mx-sm-3 mb-2 w-50">

		      <div class="alert alert-danger" role="alert">
		       Konfirmasi password salah
		      </div>

          </div>

        <?php endif; ?>

		<div class="form-group mx-sm-3 mb-2 w-50">

		    <input type="text" name="nama" class="form-control w-100" placeholder="user" required="">

		</div> 

		<div class="form-group mx-sm-3 mb-2 w-50">

		    <input type="email" name="email" class="form-control w-100" placeholder="email" required="">

		</div>

	    <div class="form-group mx-sm-3 mb-2 w-50">

	        <input type="password" name="password" class="form-control w-100" placeholder="password" required="">

	    </div>

	    <div class="form-group mx-sm-3 mb-2 w-50">

	        <input type="password" name="password2" class="form-control w-100" placeholder="konfirmasi password" required="">

	    </div>

	    <div class="form-group mx-sm-3 mb-2 w-50">

	        <select name="level" class="custom-select mr-sm-2 w-100 mx-auto" >
	     	
		           <option value="admin" > admin </option>
		           <option value="koki" > koki </option>
		           <option value="kasir" > kasir </option>

	        </select>

	    </div>

	    <div class="form-group mx-sm-3 mb-2 w-50">
         
            <button type="submit" name="simpan" class="btn btn-primary mb-2 w-100"> Tambah Data </button>
 
	    </div>

</form>


