<?php
require_once '../connect.php';
$post = mysqli_query($con, "SELECT * FROM blog ORDER BY no DESC");


?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link rel="stylesheet" href="../style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
   
  </head>
  <body>
    <?php require_once '../partials/navbar.php' ?>
    <div class="container">
      


    <h1>Tes</h1>
    <h1>Halo Air</h1>
    <?php
      $filter = mysqli_query($con, "SELECT tag FROM BLOG ORDER BY tag");
    ?> 
        <form action="" method="get">
    <?php while($row = mysqli_fetch_array($post)) : ?>
        <div class="d-flex position-relative">
            <img src="../img/1.jpg" class="flex-shrink-0 me-3 profil-img" alt="...">
            <div>
                <h5 class="mt-0"><?=$row['judul'] ?></h5>
                <p><?=$row['subtitle'] ?></p>
                <i><?=$row['tgl_upload']?></i> 
                <a href="detail_blog.php?id=<?=$row['no']?>">Go somewhere</a>              
              </div>
        </div>
    <?php endwhile ?>
    </form>
    </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
  </body>
</html>