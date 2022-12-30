<?php 
session_start();
require_once './connect.php';
if(!isset($_SESSION['login'])){
  header('Location: login');
  exit;
}
if(isset($_POST['submit'])){
  if(uploadDoksi($_POST) > 0){
    echo"  <script>
    alert('data berhasil ditambahkan');
    window.location.href='admin.php'
    </script>";
  } else{
    echo"<script>
    alert('UPS, ada yg salah!. tapi jangan panik hehe laporin kesalahan yg kamu dapatkan agar kami perbaiki')
    </script>" . mysqli_error($con);
}
}
$tag_q = query("SELECT tag FROM doksi ORDER BY id DESC");
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
    <?php require_once './partials/admin-nav.php' ?>
  <h1>Upload doksi</h1>
  <div class="container py-5">
        <form action="" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-xl-6">
              <input type="hidden" name="nama" id="nama" value="<?=$uname?>">
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="judul" required>
                <label for="floatingInput">Judul</label>
                </div>
                <div class=" mb-3">
                  <label for="gambar"> <b>thumbnail</b></label>
                  <input type="file" name="gambar" id="gambar">
                </div>
                <input type="hidden" name="waktu" id="waktu" value="<?php echo date('l,d,M') ?>">
                <label for="tag">Tag</label>
                  <select class="form-select" id="tag" name="select-tag">
                      <?php foreach($tag_q as $opsi) : ?>
                        <option selected></option>
                      <option><?=$opsi['tag']?></option>
                      <?php endforeach ?>
                  </select>
                  <br>
                <button type="submit" name="submit" class="btn btn-outline-success">Submit</button>

                </div>
    
            <div class="col-xl-4">
            
                  <label for="tag-baru">Tag Baru</label>
                  <input type="text" name="tag-baru" id="tag-baru">
            </div>
        </div>
        <div class="row">
       
        </div>
      </form>
    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  </body>
</html>