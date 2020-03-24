<?php 
   
  session_start();

  require_once "functions.php";
  
  require_once "database_controller.php";
  $database = new Database();
  $dataAll = $database->getAll("SELECT * FROM tabel_kategori");


?>

<!DOCTYPE html>
<html>
<head>
	<title> Aplikasi Restoran </title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/cart.css">
	<link rel="shortcut icon" type="text/css" href="assets/upload/icon.png">
</head>
<body>

<div class="container" >	

	 <div class="row mt-5" >
	 	  
	 	  <div class="col-md-3 mb-1" >

	 	  	
	           <a href="index.php" class="text-dark" style="text-decoration: none;"><h1> Restoran </h1></a>
	           <?php if ( isset($_SESSION["pelanggan"]) ) : ?>
	           <p> Selamat datang <?= $_SESSION["pelanggan"] ?>  </p>
	           <?php endif; ?>

	 	  </div>

	 	  <div class="col-md-9" > 

	 	  	   <?php if ( isset($_SESSION["pelanggan"]) ) : ?>

               <a href="home/logout.php"><button type="button" class="btn btn-outline-danger float-right mr-3">Logout</button></a>
               <p class="float-right mr-5 mt-2 ml-3" > Pelanggan : <a href="?folder=home&menu=history "><?= $_SESSION["email"] ?></a> </p>

               <div class="cart float-right" > 
               	   <a href="?folder=home&menu=beli" style="color: inherit;">
                   <?php if ( countCart() != 0 ) : ?> 
	                 <div class="cart-num" ><?= countCart(); ?></div>
	               <?php endif; ?>
	               <i class="fa fa-shopping-cart" aria-hidden="true" style="font-size: 20px"></i>
	               </a>
               </div>

               <?php else : ?>

	           <a href="home/register_pelanggan.php"><button type="button" class="btn btn-primary float-right mr-3"> Register </button></a>
	           <a href="home/login_pelanggan.php"><button type="button" class="btn btn-success float-right mr-3"> Login </button></a>

	          <?php endif; ?>


	 	  </div>

	 </div>

	 <div class="row" >
	 	
	      <div class="col-md-3" >

	      	   <p> Pilih Kategori </p> <hr>
	      	
	           <ul class="nav flex-column ">
	           	  
	           	  <?php foreach ( $dataAll as $data ) : ?>

	              <li class="nav-item"> <a class="nav-link active" href="?folder=home&menu=produk&idkategori=<?= $data["id_kategori"] ?>"> <?= $data["kategori"] ?> </a> </li>
	            
                  <?php endforeach; ?>

	           </ul>

	      </div>

	      <div class="col-md-9" >

	      	   <?php if ( isset ( $_GET["folder"] ) && isset ( $_GET["menu"] ) ) : ?>

	      	         <?php 

                       $folder = $_GET["folder"];
                       $menu   = $_GET["menu"];
                       $file   = $folder."/".$menu.".php";
                       
                       require_once $file;
            
	      	         ?>

	      	    <?php else : ?>
                     
                      <?php 

                        require_once "home/produk.php";

                      ?>

	      	    <?php endif; ?>
	      	
	      </div>
	 	
	 </div>


	 <div class="row" >
	 	  
	 	  <div class="col mt-5" >
	 	  	
	           <p class="text-center"> Copyright | Arya Rizky - 2020 </p>

	 	  </div>
	 	
	 </div> 

 </div>


<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>

