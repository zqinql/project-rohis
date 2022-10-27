<?php 
$authorId = "1.json";
$url = "https://raw.githubusercontent.com/penggguna/QuranJSON/master/quran.json";
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
<script>

</script>

<div class="container text-center">
  <h1>Al Quran digital Mar'asyra</h1>
</div>
<div class="container">
  <a href="../index.php" class="btn btn-outline-secondary">Back Home</a>
</div>

<!-- <div class="container d-flex filter">
    <h3>No Ayat:</h3>
  <select name="no-ayat">
    <option value="">No Surah</option>
      <?php foreach($authorJSON as $no) : ?>
      <option value="<?=$no['number_of_surah']?>"><?=$no['number_of_surah']?></option>
      <?php endforeach ?>
    </select>
    <h3>Surah:</h3>
    <select name="surah">
      <option value="">Surah</option>
      <?php foreach($authorJSON as $name) : ?>
      <option value="<?=$name['name']?>"><?=$name['name']?></option>
      <?php endforeach ?>
    </select>
    <button type="submit">Cari</button>
</div> -->

<table class="table container table-striped">
  <thead>
    <tr>
      <th>No</th>
      <th>Nama Surah</th>
      <th>Latin</th>
      <th>Diturunkan</th>
    </tr>
  </thead>
  <tbody>
    <?php $authorJSON; ?>
    <?php for($i = 0; $i <= 113; $i++) : ?>
     
    <tr> 
      <th scope="row"><?=$authorJSON[$i]['number_of_surah']?></th>
      <td> <a href="surat.php?surah=<?=$authorJSON[$i]['number_of_surah']?>" class="link-surah"><h5 class="arabic">(<?=$authorJSON[$i]['name_translations']['ar']?>)</h5></a><?=$authorJSON[$i]['name']?> </td>
      <td><?=$authorJSON[$i]['name_translations']['id']?></td>
      <td><?=$authorJSON[$i]['place']?> <br><?=$authorJSON[$i]['number_of_ayah']?> Ayat</td>
    </tr>
   
   <?php endfor ?>
  </tbody>
</table>



<audio src="./067.mp3" autoplay></audio>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>