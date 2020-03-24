<?php 
  
  class Database {

	  private   $host = "localhost",       
	            $user = "root",
	            $password = "",
	            $database = "database_restoran",
	            $koneksi;

	  public function __construct () {

                 $this->koneksi = $this->connectDB();	        

	  }

	  public function connectDB () {

	           return $koneksi = mysqli_connect ( $this->host, $this->user, $this->password, $this->database );

 	  }

 	  public function getAll ($sql) {

                 $result = mysqli_query ( $this->koneksi, $sql );

                 while ( $row = mysqli_fetch_assoc ( $result ) ) {

                       $data[] = $row;

                 }
             
                 if ( !empty ( $data ) ) {

                    return $data;

                 }

 	  }

 	  public function getItem ($sql) {
    
                 $result = mysqli_query ( $this->koneksi, $sql );
                 $row = mysqli_fetch_assoc ( $result );
                   
                 return $row;
 	  }  

 	  public function rowCount ( $sql ) {

                 $result = mysqli_query ( $this->koneksi, $sql );
                 $row = mysqli_num_rows ( $result );

                 return $row;
 	  }

 	  public function runSql ( $sql ) {
           
                 $query = mysqli_query ( $this->koneksi, $sql );

 	  }

 	  public function message ( $text = "unkown" ) {

                 return 2+2;

 	  }

 }

 ?>