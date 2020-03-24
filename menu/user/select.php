<?php 
 
  $banyakData = $database->rowCount ( "SELECT * FROM tabel_user" );
  $dataTampil = 5;
  $jumlahHalaman = ceil ( $banyakData / $dataTampil );
  $halamanAktif = ( isset ( $_GET["halaman"] ) ) ? $_GET["halaman"] : 1;
  $awalData = ( $halamanAktif * $dataTampil ) - $dataTampil;

  $sql = "SELECT * FROM tabel_user ORDER BY nama ASC LIMIT $awalData, $dataTampil";
  $dataAll = $database->getAll($sql);
  $no = ++$awalData;

?>

<h3> User </h3>
     
<nav aria-label="...">

    <ul class="pagination">

       <?php if ( $halamanAktif > 1 ) : ?>

         <li class="page-item"> <a class="page-link" href="?folder=user&menu=select&halaman=<?= $halamanAktif - 1 ?>">Previous</a> </li>

       <?php else : ?>
 
         <li class="page-item disabled"> <span class="page-link">Previous</span> </li>

       <?php endif; ?>
         
         <?php for ( $halaman = 1; $halaman <= $jumlahHalaman; $halaman++ ) : ?>
               
           <?php if ( $halamanAktif == $halaman ) : ?>

             <li class="page-item active" aria-current="page"> <span class="page-link"> <?= $halaman ?> <span class="sr-only">(current)</span> </span> </li>

           <?php else : ?>

             <li class="page-item"> <a class="page-link" href="?folder=user&menu=select&halaman=<?= $halaman ?>"> <?= $halaman ?> </a> </li>

            <?php endif; ?>

         <?php endfor; ?>

       <?php if ( $halamanAktif < $jumlahHalaman ) : ?>

        <li class="page-item"> <a class="page-link" href="?folder=user&menu=select&halaman=<?= $halamanAktif + 1 ?>">Next</a> </li>

       <?php else : ?>
 
        <li class="page-item disabled"> <span class="page-link">Next</span> </li>

       <?php endif; ?>

      </ul>

</nav>

<table class="table table-bordered w-75 text-center" >
       
      <thead>
         
             <tr>
               
              <th scope="col" > NO     </th>
              <th scope="col" > Nama   </th>
              <th scope="col" > Email  </th>
              <th scope="col" > Level  </th>
              <th scope="col" > Status </th>
              <th scope="col" > Delete </th>

             </tr>

      </thead>

      <tbody>
          
            <?php foreach ( $dataAll as $data ) : ?>

              <tr>
                
                 <th scope="row" > <?= $no++ ?> </th>
                 <td> <?= $data["nama"] ?> </td>
                 <td> <?= $data["email"] ?> </td>
                 <td> <?= $data["level"] ?> </td>
                 <td> <a href="?folder=user&menu=update&id=<?= $data["id_user"] ?>"> <button type="button" class="btn btn-primary"> <?php $status = ( $data["aktif"] == 1 ) ? "AKTIF" : "NON AKTIF"; echo $status; ?></button></a> </td>
                 <td> <a href="?folder=user&menu=delete&id=<?= $data["id_user"] ?>"> <button type="button" class="btn btn-danger"> Delete </button> </a> </td>

              </tr>

            <?php endforeach; ?>

      </tbody>

</table>

<a href="?folder=user&menu=insert"> <button type="button" class="btn btn-success">Tambah Data</button> </a>
