<?php 
session_start();
if(!isset($_SESSION['login'])){
  header('Location: login');
  exit;
}
require_once './connect.php';

if(isset($_POST['register'])){

  if(registrasi($_POST) > 0){
    echo "<script>
      alert('berhasil register')
    </script>";
  } else{
    echo "<script>
    alert(' register')
  </script>" . mysqli_error($con);
  }

}

$blog = mysqli_query($con, "SELECT * FROM blog") or die('query count eror' . mysqli_error($con));
$count = mysqli_num_rows($blog);
$kajian = mysqli_query($con, "SELECT * FROM youtube") or die('query count2 eror' . mysqli_error($con));
$count2 = mysqli_num_rows($kajian);
$user = mysqli_query($con, "SELECT * FROM users") or die('query count2 eror' . mysqli_error($con));
$count3 = mysqli_num_rows($user);

$uname = $_SESSION['username'];
$pesan = query("SELECT * FROM pesan ORDER BY id DESC LIMIT 15")
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mar'asyra | Admin</title>
    <title>Impact Bootstrap Template - Blog</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <?php require_once 'partials/logo.php' ?>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

  <!-- Google Fonts -->
  </head>
  <body>
    <?php 
    require_once 'partials/admin-nav.php'
    ?>

    
 

   <div class="container">
    <h1>Halo.. <?=$uname?></h1> 
   </div>
  
   <div class="container">
    <h3>Jumlah Tulisan = <?=$count?></h3>
    <h3>Jumlah Kajian = <?=$count2?></h3>
    <h3>Jumlah User = <?=$count3?></h3>
   </div>
 

    <div class="container">
        <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Pesan</th>
    </tr>
  </thead>
  <tbody>
  <?php 
  $con = 1; 
  ?>
       <?php foreach($pesan as $row) : ?>
    <tr>
      <th scope="row"><?= $con++ ?></th>
      <td> <p> <?=$row['name']?> </p>
       <muted> <?=$row['email']?> </muted> </td>
     <td>  <p> <?=$row['pesan']?> </p> </td>
    </tr>
     <?php endforeach ?>
  </tbody>
</table>
    </div>

 



    <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

  </body>
</html>