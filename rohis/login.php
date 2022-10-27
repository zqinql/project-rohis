<?php 
session_start();
require_once '../connect.php';

if(isset($_POST['login'])){
 
    $username = $_POST['name'];
    $password  = $_POST['password'];

    $result = mysqli_query($con, "SELECT * FROM users WHERE username = '$username'" );

    // Cek Pw
    if(mysqli_num_rows($result) === 1){
        
        $row = mysqli_fetch_assoc($result);

        if($password == $row['password']){
                $_SESSION['login'] = true;
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

</head>
<body>
  <?php 
  require_once '../partials/navbar.php'
   ?>  

  <div class="container py-5">
      <h2 class="text-warning">Login</h2>
  </div>
   <?php 
   if(isset($error)){
    echo "<p class='form-salah'> Tidak ditemukan Akun kamu ";
   }
   ?>
   <div class="container">
    
    <div class="row justify-content-center">
      <div class="col-8">
      <form action="" method="post">
       <div class="mb-3">
         <label for="exampleInputEmail1" class="form-label">Email address</label>
         <input type="text" class="form-control" id="exampleInputEmail1" name="name">
       </div>
       <div class="mb-3">
         <label for="exampleInputPassword1" class="form-label">Password</label>
         <input type="password" class="form-control" id="exampleInputPassword1" name="password">
       </div>
     
       <button type="submit" class="btn btn-primary" name="login">Submit</button>
     </form>
     </div>
    </div>
   </div>

   <div class="container">

   </div>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

</body>
</html>