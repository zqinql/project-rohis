<?php
session_start();
if(!isset($_SESSION['login'])){
  header('Location: login');
  exit;
}
require_once './connect.php';
$kajian = query("SELECT * FROM youtube ORDER BY materi DESC");
if(isset($_POST['youtube'])){
  if(inputyt($_POST) > 0){
    echo"
        <script>
        alert('data berhasil ditambahkan');
        window.location.href='admin.php'
        </script>";
  } else{
    echo"<script>
    alert('UPS, ada yg salah!. tapi jangan panik hehe laporin kesalahan yg kamu dapatkan agar kami perbaiki')
    </script>" . mysqli_error($con);
  }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mar'asyra | Kajian</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  </head>
  <body>

<?php require_once './partials/admin-nav.php' ?>
  <div class="container my-5">
    <h1>Kajian</h1>
    <div class="row">
      <div class="col-xl-4">

     
  <form action="" method="post">
  <div class="mb-3">
    <label for="judul" class="form-label"> <b>Judul Video</b></label>
    <input type="text" class="form-control" id="judul" name="judul" aria-describedby="judulvideo" required>
  </div>
  <div class="form-floating">
    <textarea class="form-control" name="subjudul" placeholder="Sub Judul" id="subjudul" style="height: 100px"></textarea>
    <label for="subjudul"> Deskripsi </label>
  </div>
  <div class="mb-3">
    <label for="idvideo" class="form-label"> <b>Id video</b></label>
    <input type="text" class="form-control" id="idvideo" name="id_vidio" required>
  </div>
   <div class="mb-3">
    <label for="materi" class="form-label"> <b> Materi video</b></label>
    <input type="text" class="form-control" id="materi" name="materi">
  </div>
  <div class="mb-3">
    <label for="title" class="form-label">Title Video</label>
    <input type="text" class="form-control" id="title" name="title">
  </div>
 
  
  <button type="submit" class="btn btn-primary" name="youtube">Submit</button>
  
</form>
 </div>
</div>
<div class="col-6">

</div>
    </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  </body>
</html>