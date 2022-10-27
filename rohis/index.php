<?php
require_once '../connect.php';

if(isset($_POST['submit'])){
    if(inputemail($_POST) > 0){
        echo "<div class='alert alert-info' role='alert'>
        Terimakasih! Data kamu berhasil dikirim.
      </div>";
    } else{
        echo "<div class='alert alert-info' role='alert'>
        Ups ada yg salah! ceritakan masalahmu kami.
      </div>" . mysqli_error($con);
    }
}

$blog = query("SELECT * FROM blog ORDER BY no DESC LIMIT 4");
$video = query("SELECT * FROM youtube ORDER BY id DESC LIMIT 1")

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mar'asyra</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>
<body>
    <?php require_once '../partials/navbar.php' ?>
   
  <div class="bg-slate" >
    <div class="container py-5">
        <h1>Halo Selamat datang dihalaman utama kami</h1>
        <h2>Support kami terus yuks dengan membeli danus kami :) </h2>
        <blockquote>“Tidak ada suatu hari pun ketika seorang hamba melewati paginya kecuali akan turun (datang) dua malaikat kepadanya, lalu salah satunya berdoa; Ya Allah, berikanlah pengganti bagi siapa yang menafkahkan hartanya. Sedangkan yang satunya lagi berdoa; Ya Allah, berikanlah kehancuran (kebinasaan) kepada orang yang menahan hartanya.” <cite>(HR Bukhari)</cite></blockquote>
    </div>
 </div>
<!-- 
    <div id="carouselExampleCaptions" class="carousel slide container" data-bs-ride="false">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <div class="carousel-caption d-none d-md-block">
        <h5>First slide label</h5>
        <p>Some representative placeholder content for the first slide.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="../img/pp-wa-aesthetic-54.jpg" class="d-block w-100 h-auto overflow-hidden" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Second slide label</h5>
        <p>Some representative placeholder content for the second slide.</p>
      </div>
    </div>
  
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
 -->

    <div class="container py-5 justify-content-xl-between">
        <div class="row">
        <div class="blog col-xl-8">
            <div class="row justify-content-center justify-content-xl-around">
            <?php foreach($blog as $row) : ?>
                <div class="card col-xl-6 mb-4" style="max-width: 300px; border:none; box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1); ">
                    <img src="../img/1.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?=$row['judul'] ?></h5>
                        <p class="card-text"><?=$row['subtitle'] ?></p>
                        <a href="detail_blog.php?id=<?=$row['no']?>" class="btn btn-outline-success mt-2">Baca Selengkapnya</a>
                    </div>
                </div>
            <?php endforeach ?>
          </div>
          <a href="blog.php" class="btn btn-outline-warning mb-5">Lihat lebih banyak</a>
         </div>

                <div class="subscribe col-xl-4" style=" background-color: #f1f5f9">

                    <div class="kotak p-3 ">
                        <h2 class=""> <u>Newsletter..</u> </h2>
                        <h3>Mau dapet info seputar Islam? Langsung ke email mu?</h3>
                        <form action="" method="post">
                        <div class="my-3">
                            <label for="exampleInputName1" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="exampleInputName1" name="name" placeholder="Adit" required>
                            
                          </div>
                          <div class="my-3">
                            <label for="exampleInputInstitusi1" class="form-label">Status</label>
                            <input type="text" name="institusi" class="form-control" id="exampleInputInstitusi1" placeholder="Pelajar">
                          </div>
                          <div class="my-3">
                            <label for="exampleInputEmail1" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" placeholder="name@gmail.com" required>
                            <div id="emailHelp" class="form-text mb-3 mt-2">We'll never share your email with anyone else.</div>
                          </div>
                          <button type="submit" class="btn btn-warning" name="submit">Submit</button>
                        </form>
                    </div>
                </div>
                </div>
        </div>

    <div class="container py-5">
          <div class="card">
            <div class="card-header">
                Quote
            </div>
            <div class="card-body">
                <blockquote class="blockquote mb-0">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim ex corporis commodi similique error voluptatem quas, mollitia unde dicta ut nisi ea blanditiis molestiae inventore magnam asperiores, aut, nihil nemo.</p>
                <footer class="blockquote-footer">Someone famous in <cite title="Source Title">Source Title</cite></footer>
                </blockquote>
            </div>
         </div>
    </div>

 <!-- <a href="registrasi.php"><button>Masuk</button></a>
 <a href="login.php"><button>Login</button></a>  -->
    <div class="container py-5">
 <div class="row justify-content-center">
      <?php foreach($video as $row) : ?>
        <div class="col-xl-4">
          <h4><?=$row['judul']?></h4>
            <div class="ratio ratio-16x9">
              <iframe src="https://www.youtube.com/embed/<?=$row['id_vidio']?>" title="<?=$row['title']?>" allowfullscreen></iframe>
            </div>     
            <p><?=$row['subjudul']?></p>
            <a href="learning" class="btn btn-outline-success">Learning</a>
        </div>
        <?php endforeach ?>
    </div>
    </div>

    <div class="rka py-5" style=" background-color: #f1f5f9">
    <div class="container py-5">
        <div class="row">
            <div class="col">
                <h1>R.K.A Rohis</h1>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Cumque, dolorum! Aperiam ab, odit nobis inventore exercitationem est nulla necessitatibus reiciendis veniam placeat eligendi alias nisi? Aut magnam cum quasi optio! Lorem ipsum, dolor sit amet consectetur adipisicing elit. Et aliquam voluptatibus fugit! Vero deserunt nulla harum repellendus iste reiciendis ipsum!</p>
                <a href="rapat-keanggotaan" class="btn btn-outline-warning">More info</a>
            </div>
        </div>
    </div>
    </div>
 <?php require_once '../partials/subfooter.php' ?>
<?php require_once '../partials/footer.php' ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>
</html>