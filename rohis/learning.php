<?php 
require_once '../connect.php';
$result = mysqli_query($con, "SELECT DISTINCT(materi) FROM youtube") or die('eror select materi' . mysqli_error($con));
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  </head>
  <link rel="stylesheet" href="../style.css">
  <body>
    <?php
    require_once '../partials/navbar.php';
    ?>
    <h1>Selamat Datang di E-learning Mar'asyra :)</h1>

    <div class="container">
             <h1>Mau Belajar apa?</h1>
    </div>
     
<div class="container">
        <div class="row">
            <?php while($row = mysqli_fetch_assoc($result)) : ?>
        <div class="col-sm-4 mt-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?=$row['materi']?></h5>
        <?php $num = mysqli_query($con,"SELECT id_vidio FROM youtube WHERE materi = '$row[materi]'");?>
        <?php $no = mysqli_num_rows($num);  ?>
                <p>Tersedia <?= $no ?> <i>kelas</i></p>
              
                <a href="detail_learning.php?materi=<?=$row['materi']?>" class="btn btn-warning">Go somewhere</a>
            </div>
            </div>
    </div>
    <?php endwhile ?>
   
    </div>
</div>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  </body>
</html>