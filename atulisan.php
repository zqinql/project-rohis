<?php
session_start();
if(!isset($_SESSION['login'])){
  header('Location: login');
  exit;
}
require_once './connect.php';
$blog = query("SELECT * FROM blog ORDER BY no DESC");

if(isset($_POST['blog'])){
  if(tambah($_POST) > 0){
      echo"
      <script>
      alert('data berhasil ditambahkan');
      window.location.href='admin.php'
      </script>";

  } else {
      echo"<script>
      alert('UPS, ada yg salah!. tapi jangan panik hehe laporin kesalahan yg kamu dapatkan agar kami perbaiki')
      </script>" . mysqli_error($con);
  }
}

$uname = $_SESSION['username'];
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mar'asyra | Tulisan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.ckeditor.com/ckeditor5/35.3.2/classic/ckeditor.js"></script>

  </head>
  <body>
    <?php require_once './partials/admin-nav.php' ?>
    <?php 
         $tag_q = mysqli_query($con, "SELECT distinct(tag) FROM blog ORDER BY tag");
         if(!isset($tag_q)){
           die('query tag yg eror');
         }
    ?>
    
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
                <div class="form-floating mb-3">
                <input type="text" class="form-control" id="subtitle" placeholder="name@example.com" name="subtitle" required>
                <label for="subtitle">Subtitle</label>
                <div id="subtitle" class="form-text mb-3 mt-1">Max 30 Chars</div>
                </div>
                
                <div class="form-floating" >
                    <textarea class="" style="height: 100px;" name="deskripsi"></textarea>
                    </div>
                </label>
                <input type="hidden" name="waktu" id="waktu" value="<?php echo date('l,d,M') ?>">
                </div>
    
            <div class="col-xl-4">
              <label for="tag">Tag</label>
                  <select class="form-select" id="tag" name="select-tag">
                      <?php while($opsi = mysqli_fetch_array($tag_q)) : ?>
                        <option selected></option>
                      <option><?=$opsi['tag']?></option>
                      <?php endwhile ?>
                  </select>
                  <label for="tag-baru">Tag Baru</label>
                  <input type="text" name="tag-baru" id="tag-baru">
  <button type="submit" class="btn btn-primary" name="blog">Submit</button>

            </div>
        </div>
        <br>

      </form>

    </div>
    
    <div class="container">
          <table class="table">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Nama</th>
              <th scope="col">Judul</th>
              <th scope="col">Subtitle</th>
              <th scope="col">Act</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1 ?>
            <?php foreach($blog as $row) : ?>
              <tr>
              <th scope="row"><?= $no ?></th>
              <td><?=$row['nama'] ?></td>
              <td><?=$row['judul'] ?></td>
              <td><?=$row['subtitle'] ?></td>
              <td> <a href="hapus?id=<?=$row['no']?>">Hapus </a> </td>
              <?php $no++ ?>
            </tr>
              <?php endforeach ?>
          </tbody>
        </table>
      </div>
    


      <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  </body>
</html>