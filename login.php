<?php 
session_start();
require_once './connect.php';

if(isset($_POST['login'])){
 
    $username = $_POST['name'];
    $password  = $_POST['password'];

    $result = mysqli_query($con, "SELECT * FROM users WHERE username = '$username'" );

    // Cek Pw
    if(mysqli_num_rows($result) === 1){
        
        $row = mysqli_fetch_assoc($result);

        if($password == $row['password']){
                $_SESSION['login'] = true;
                $_SESSION['username'] = $username;
                header("Location: admin");
                exit;
        }
    }
      $error = true;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MA'SY | Login</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <?php require_once 'partials/logo.php' ?>
  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Raleway:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">
</head>
<body>
  <?php 
  require_once 'partials/nav.php'
   ?>  

  <div class="container py-5">
      <h2 class="text-success">Pastikan kamu sudah punya akun ya!</h2>
  </div>
  
   <div class="container">
   <?php 
   if(isset($error)){
    echo "<p class='form-salah'> Tidak ditemukan Akun kamu ";
   }
   ?>
    <div class="row justify-content-center">
      <div class="col-8">
      <form action="" method="post">
       <div class="mb-3">
         <label for="exampleInputEmail1" class="form-label">Username</label>
         <input type="text" class="form-control" id="exampleInputEmail1" name="name">
       </div>
       <div class="mb-3">
         <label for="exampleInputPassword1" class="form-label">Password</label>
         <input type="password" class="form-control" id="exampleInputPassword1" name="password">
       </div>
     
       <button type="submit" class="btn btn-warning" name="login">Submit</button>
     </form>
     </div>
    </div>
   </div>

   <div class="container">

   </div>

   <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<div id="preloader"></div>

<!-- Vendor JS Files -->
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/aos/aos.js"></script>
<script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>
</body>
</html>