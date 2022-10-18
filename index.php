<?php
require_once 'connect.php';


?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Crud Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <style>
      body{
        height: 100vh;
      }
      div{
        width: 100vw;
        height: 100vh;
        justify-content: center;
        align-content: center;
      }
      h1{
        padding: 20px 40px;
        background-color: greenyellow;
        border: 1px solid black;
      }
      h2{
        padding: 20px 0;
      }
    </style>
  </head>
  <body>
<h2>Hai Pemuda Hijrah! <br>
Cari apa?</h2>
    <div>
     <a href="./alquran/index.php"><h1>Al Qur'an</h1></a>
     <a href="blog/index.php"><h1>Blog</h1></a>
     <a href="#"><h1>Jadwal Shalat</h1></a>
     <a href="#"> <h1>Learn Agama Islam</h1></a>
      <a href="#"><h1>Contribusi</h1></a>
    </div>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
  </body>
</html>