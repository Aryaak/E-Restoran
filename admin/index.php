<?php 
   
  session_start();

  require_once "../database_controller.php";

  $database = new Database();

  // Check session

  if ( !isset ( $_SESSION["user"] ) ) {
     
    header("Location: login.php");
  }
  
  $idUser = $_SESSION["id"];
  $data = $database->getItem("SELECT * FROM tabel_user WHERE id_user=$idUser");

?>

<!DOCTYPE html>
<html>
<head>
	<title> Admin Page | Aplikasi Restoran </title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<div class="container" >	

	<div class="row mt-5" >
	 	  
	 	<div class="col-md-3" >
	 	  	
	        <h1> <a href="index.php" style="text-decoration: none; color: black">Restoran</a>  </h1>

	        <p class="float-left mr-5" >user : <a href="?folder=user&menu=update_user&id=<?= $_SESSION["id"] ?>"> <?= $data["email"] ?> </a> </p>
	        <p class="float-left mr-5" >level : <a href="?folder=user&menu=update_user&id=<?= $_SESSION["id"] ?>"> <?= $data["level"] ?> </a> </p>

	 	</div>

	 	<div class="col-md-9" >

	        <a href="logout.php"><button type="button" class="btn btn-outline-danger float-right mt-5"> Logout </button></a>


	 	</div>

	</div>

	 <!-- List menu -->

	<div class="row" >
	 	
	    <div class="col-md-3" >

	    	<h5> Fitur </h5>

	    	<hr>
	      	
	        <ul class="nav flex-column">

	        	<?php if ( $data["level"] == "admin" ) : ?>
	           	
	            <li class="nav-item">
	               <a class="nav-link active" href="?folder=kategori&menu=select"> Kategori </a> 
	            </li>

	            <li class="nav-item">
	               <a class="nav-link active" href="?folder=menu&menu=select"> Menu </a>
	            </li>

	            <li class="nav-item">
	               <a class="nav-link active" href="?folder=order&menu=select"> Order </a> 
	            </li>

	            <li class="nav-item">
	               <a class="nav-link active" href="?folder=order_detail&menu=select"> Order Detail </a>
	            </li>

	            <li class="nav-item"> 
	               <a class="nav-link active" href="?folder=user&menu=select"> User </a> 
	            </li>

	            <li class="nav-item">
	               <a class="nav-link active" href="?folder=pelanggan&menu=select"> Pelanggan </a> 
	            </li>

	            <?php elseif ( $data["level"] == "kasir" )  : ?>

	              <li class="nav-item">
	                <a class="nav-link active" href="?folder=order&menu=select"> Order </a> 
	              </li>

	            <li class="nav-item">
	               <a class="nav-link active" href="?folder=order_detail&menu=select"> Order Detail </a>
	            </li>

	            <?php elseif ( $data["level"] == "koki" )  : ?>

	              <li class="nav-item">
	                 <a class="nav-link active" href="?folder=order_detail&menu=select"> Order Detail </a>
	              </li>

	            <?php endif; ?>



	        </ul>

	    </div>

	      <!-- Require file menu -->

	    <div class="col-md-9" >

	        <?php if ( isset ( $_GET["folder"] ) && isset ( $_GET["menu"] ) ) : ?>

	      	  <?php 

                $folder = $_GET["folder"];
                $menu   = $_GET["menu"];
                $file   = "../menu/".$folder."/".$menu.".php";
                       
                require_once $file;
            
	      	  ?>

	      	  <?php else : ?>

	      	    <div class="alert alert-success w-25 mr-5" role="alert"> Welcome <?= $data["nama"] ?> </div>

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

