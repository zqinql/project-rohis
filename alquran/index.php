<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<script>

</script>
<h1>Haloo</h1>

<?php

$authorId = "1.json";
$url = "https://raw.githubusercontent.com/penggguna/QuranJSON/master/surah/{$authorId}";
// Untuk melakukan inisialisasi
$ch = curl_init();
// untuk melakukan config curl
curl_setopt($ch, CURLOPT_URL, $url);
// Mengeksekusi
$response = curl_exec($ch);
// Untuk menampung curl berupa header response
$resultInfo = curl_getinfo($ch);
// Tutup 
curl_close($ch);
// Untukk melakukan decode kebentuk array php
$authorJSON = json_decode($response);


?>


<a href="../index.php">Kembali Ke Home</a>
</body>
</html>