<?php
require_once '../connect.php';

// if(!$_SESSION['login']){
//     header('Location: login.php');
//     exit;
// }
$jmlhDataPerHal = 6;
$result = mysqli_query($con, "SELECT * FROM blog");
$jmlDataDb = mysqli_num_rows($result);

$jmlhHal = ceil($jmlDataDb / $jmlhDataPerHal);

// Set Hal
if(isset($_GET['page'])){
  $halAktif = $_GET['page'];
}else{
  $halAktif = 1;
}

$awalData = ($jmlhDataPerHal * $halAktif) - $jmlhDataPerHal;



$blog = query("SELECT * FROM blog ORDER BY no DESC LIMIT $awalData,$jmlhDataPerHal");

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link rel="stylesheet" href="../style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
  </head>
  <body>
    <?php require_once '../partials/navbar.php' ?>
    <div class="container">
  <?php 
  ?>
    <h1>Hi👋👋 </h1>
    <?php
      $filter = mysqli_query($con, "SELECT tag FROM BLOG ORDER BY tag");
    ?> 
   <div class="row justify-content-center justify-content-xl-around">
            <?php foreach($blog as $row) : ?>
                <div class="card col-xl-6 mt-5" style="max-width: 300px; border:none; box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1); ">
                    <img src="../img/1.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?=$row['judul'] ?></h5>
                        <p class="card-text"><?=$row['subtitle'] ?></p>
                        <a href="detail_blog.php?id=<?=$row['no']?>" class="btn btn-outline-success mt-2">Baca Selengkapnya</a>
                    </div>
                </div>
            <?php endforeach ?>
            </div>
    </div>

    <div class="container text-center ">
      <!-- Jika hal aktif lebih besar dari 1 -->
      <?php if($halAktif > 1) : ?>
      <a href="?page=<?= $halAktif - 1 ?>">&laquo;</a>
      <?php endif ?>

      <?php for($i = 1; $i <= $jmlhHal; $i++) : ?>
        <?php if($i == $halAktif) : ?>
          <a href="?page=<?=$i?>" style="font-weight: bold;"><?= $i ?></a>
          <?php else : ?>
            <a href="?page=<?=$i?>" style=""><?= $i ?></a>
            <?php endif ?>
      <?php endfor; ?>

      <!-- Jika aktif  dibawah jmlh hal -->
      <?php if($halAktif < $jmlhHal) : ?>
        <a href="?page=<?= $halAktif + 1 ?>">&raquo;</a>
        <?php endif ?>
    </div>

    

    <?php require_once '../partials/subfooter.php' ?>
    <?php require_once '../partials/footer.php' ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
  </body>
</html>