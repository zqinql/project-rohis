<?php
require_once '../connect.php';
if(isset($_POST['submit'])){
    if(tambah($_POST) > 0){
        echo"
        <script>
        alert('data berhasil ditambahkan');
        window.location.href='blog.php'
        </script>";

    } else{
        "<script>
        alert('UPS, ada yg salah!. tapi jangan panik hehe laporin kesalahan yg kamu dapatkan agar kami perbaiki')
        </script>";
    }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">
  </head>
  <body>
    <?php
        require_once '../partials/navbar.php';
    ?>
    <br>
    <?php
    $tag_q = mysqli_query($con, "SELECT tag FROM blog ORDER BY tag");
    if(!isset($tag_q)){
      die('ada yg eror');
    }
    ?>
    <form action="" method="post">
    <div class="container container-blog">
        <div class="kiri">
          <input type="hidden" name="nama" id="nama" value="zainal">
              <label for="judul"> <b>Judul:</b></label>
              <input type="text" name="judul" id="judul">
              <br>
              <br>
              <label for="deskripsi"> <b>Deskripsi:</b>
                <textarea name="deskripsi" id="ckeditor" cols="60" rows="10" class="ckeditor"></textarea>
            </label>
            <input type="hidden" name="waktu" id="waktu" value="<?php echo date('l,d,M,Y') ?>">
            <button type="submit" name="submit">Submit</button>
            </div>


        <div class="kanan">
          <label for="tag">Tag</label>
              <select class="form-select" id="tag" aria-label="Default select example" name="tag">
                  <option selected>Open this select menu</option>
                  <?php while($opsi = mysqli_fetch_array($tag_q)) : ?>
                    <option value="1">Fiqih</option>
                  <option value="2"><?=$opsi['tag']?></option>
                  <?php endwhile ?>
              </select>
              <label for="tag-baru">Tag Baru</label>
              <input type="text" name="tag-baru" id="tag-baru">
        </div>
    </div>
  </form>


    <script src="./ckeditor/ckeditor.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
  </body>
</html>