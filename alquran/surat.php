<?php 
$surat = $_GET['surah'];
$url = "https://raw.githubusercontent.com/penggguna/QuranJSON/master/surah/$surat.json";
// Untuk melakukan inisialisasi
$ch = curl_init();
// untuk melakukan config curl
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($ch);
if($response == false){
    echo 'ups curl mu eror' . curl_error($ch);
}

curl_close($ch);
// Untukk melakukan decode kebentuk array php
$authorJSON = json_decode($response, true);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">
    <style>
       @font-face {
        font-family: 'Uthmani';
        src: url('assets/font/UthmanicHafs1Ver09.otf') format('truetype');

      }
      .arabic{
        font-family: 'Uthmani', sans-serif;
      }
    </style>
</head>
<body>

   <div class="container nama-surah">
    <h1><?=$authorJSON['name_translations']['ar']?></h1>
    <h1><?=$authorJSON['name']?></h1>
    <h5> <?=$authorJSON['type']?> <?=$authorJSON['number_of_ayah']?> Ayat</h5> 
    <?php $audio = $authorJSON['recitations'] ?>
    <?php foreach($audio as $row) : ?>
    <h6><?=$row['name'] ?></h6>
    <audio src="<?=$row['audio_url']?>" controls></audio>
    <?php endforeach; ?>
   </div>
   <?php $ayat = $authorJSON['verses'] ?>

   <a href="index" class="btn btn-outline-success mx-5">Back</a>

    <?php define('bismillah', 'بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ'); ?>
    
    <h1 class="text-center"><?= bismillah ?></h1>

   <table class="table table-striped container">
  <!-- <thead>
    <tr>
      <th scope="col">Latin</th>
      <th scope="col">Ayat</th>
      <th scope="col">No</th>
    </tr>
  </thead> -->
  <tbody>
   <?php foreach($ayat as $row) : ?>
    <tr>
      <td><p style="font-size: 11px;"><?= $row['translation_id'] ?></p></td>
      <td colspan="1" class="text-end arabic surat-arab"><h3 class="arabic"><?= $row['text'] ?></h3></td>
      <td ><?= $row['number'] ?> </td>
    </tr>
    <?php endforeach ?>
   
  </tbody>
</table>

<div class="container py-5">
</div>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  </body>
</body>
</html>