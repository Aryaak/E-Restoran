<?php 

  session_start();

  require "../database_controller.php";
  $database = new Database();

  if ( isset($_POST["register"]) ) {
     
     $pelanggan = $_POST["pelanggan"];
     $alamat = $_POST["pelanggan"];
     $telp = $_POST["telp"];
     $email = $_POST["email"];
     $password = $_POST["password"];
     $password2 = $_POST["password2"];

     if ( $password !== $password2 ) {
        
        $error = true;

     } else  {
        
        $password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO tabel_pelanggan VALUES ('','$pelanggan','$alamat','$telp','$email','$password',1)";
        $database->runSql($sql);
        header("Location: login_pelanggan.php"); 
      

     }
 
  }  


 ?>


<!DOCTYPE html>
<html>
<head>
	<title> Registrasi Pelanggan </title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>

<div class="container" >
	
    <div class="row" >
   	
        <div class="col-4 mx-auto mt-5" >

     	  <h3 class="text-center" > Register Here </h3>
	
       	<form class="form-group mt-5" action="" method="post">

             <?php if ( isset($error) ) : ?>

               <div class="form-group mx-sm-3 mb-2">

	                 <div class="alert alert-danger w-100" role="alert"> Terjadi Kesalahan </div>

	             </div>

	           <?php endif; ?>

              <div class="form-group mx-sm-3 mb-2">

                  <input type="text" name="pelanggan" class="form-control w-100" placeholder="Nama" required="">

              </div>
                
              <div class="form-group mx-sm-3 mb-2">

                  <input type="text" name="alamat" class="form-control w-100" placeholder="Alamat" required="">

              </div>
                
              <div class="form-group mx-sm-3 mb-2">

                <input type="number" name="telp" class="form-control w-100" placeholder="No Telepon" required="">

              </div>


      	      <div class="form-group mx-sm-3 mb-2">

      	        <input type="email" name="email" class="form-control w-100" placeholder="Email" required="">

      	      </div>

      	      <div class="form-group mx-sm-3 mb-2">

      	        <input type="password" name="password" class="form-control w-100" placeholder="Password" required="">

      	      </div>

              <div class="form-group mx-sm-3 mb-2">

                <input type="password" name="password2" class="form-control w-100" placeholder="Konfirmasi Password" required="">

              </div>

      	      <div class="form-group mx-sm-3 mb-2">

      	      <button type="submit" name="register" class="btn btn-success mb-2 w-100"> Register </button>

              </div>

	      </form>

        </div>

    </div>

</div>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>
</html>