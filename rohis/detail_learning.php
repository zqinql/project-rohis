<?php 
require_once '../connect.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  </head>
  <body>
    <?php
        require_once '../partials/navbar.php';
    ?>

    <div class="container">

  <?php $m =  $_GET['materi'];  
$video = query("SELECT * FROM youtube WHERE materi = '$m'") or die('select yt salah!');
?>
    <div class="row">
      <?php foreach($video as $row) : ?>
        <div class="col-xl-7">
          <h1><?=$row['judul']?></h1>
            <div class="ratio ratio-16x9">
              <iframe src="https://www.youtube.com/embed/<?=$row['id_vidio']?>" title="<?=$row['title']?>" allowfullscreen></iframe>
            </div>     
            <p><?=$row['subjudul']?></p>
        </div>
        <?php endforeach ?>
    </div>
    <a href="learning" class="btn btn-outline-success">Back</a>
  </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  </body>
</html>