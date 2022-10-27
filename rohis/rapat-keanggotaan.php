<?php 

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../style.css">

  </head>

  <?php require_once '../partials/navbar.php'; ?>


  <body>
  

    <div class="container">
      <div class="d-xl-flex justify-content-center">
        <div class="img">
          <img src="../img/1.jpg" alt="Logo" width="300px">
        </div>
      </div>
      <div class="row">
        <div class="col-xl-6">
          <h1>Lorem, ipsum.</h1>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Et, quos. Magni aliquid ut saepe beatae iusto, odit vel at exercitationem?</p>
        </div>
        <div class="col-xl-6">
          <h1>Lorem ipsum dolor sit amet.</h1>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium possimus delectus facere harum enim, sequi quam maiores libero aliquam architecto at repellat hic amet repudiandae et dolor qui dolore optio!</p>
      </div>
      </div>
    </div>


  <div class="container py-5">
    <div class="text-center">
        <h3 class="text-warning">Uraian Hasil Rapat keanggotaan angkatan</h3>
        <p class="text-bold">Periode tahun 2015-2016</p>
    </div>
  </div>

  <div class="container py-5">
    <h3 class="text-warning">Question and Answer <span class="text-success"> Rohis</span></h3>
          <div class="accordion" id="accordionPanelsStayOpenExample">
        <div class="accordion-item">
          <h2 class="accordion-header" id="panelsStayOpen-headingOne">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
              Accordion Item #1
            </button>
          </h2>
          <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
            <div class="accordion-body">
              <strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
              Accordion Item #2
            </button>
          </h2>
          <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
            <div class="accordion-body">
              <strong>This is the second item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
            </div>
          </div>
        </div>
       
      </div>
  </div>


  <div class="container py-5">
    <div class="d-xl-block justify-content-center">
    <div class="font-pesan">
    <h3 class="text-warning">Punya pertanyaan/ide tentang Rohis, yuk tuangkan <span class="text-success"> dibawah!</span></h3>
    </div>
      <div class="pesan mx-3 mx-xl-5">
        <form action="" method="post">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Nama</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" name="name" placeholder="Name">
          </div>
        <div class="mb-3">
            <label for="exampleFormControlInput2" class="form-label">Email address</label>
            <input type="email" class="form-control" name="email" id="exampleFormControlInput2" placeholder="name@example.com">
          </div>
          <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Pesan</label>
            <textarea class="form-control" name="pesan" id="exampleFormControlTextarea1" rows="3"></textarea>
          </div>
          <button type="submit" name="submit" class="btn btn-outline-success">Kirim</button>
        </form>
     </div>
    </div>
  </div>

  <?php require_once '../partials/subfooter.php'; ?>
 <?php  require_once '../partials/footer.php' ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  </body>
</html>