<?php 
session_start();



if(!isset($_SESSION['login'])){
  header('Location: login');
  exit;
}
require_once './connect.php';
$user = query("SELECT * FROM users ORDER BY no DESC");
if(isset($_POST['register'])){

  if(registrasi($_POST) > 0){
    echo "<script>
      alert('berhasil register')
    </script>";
  } else{
    echo "<script>
    alert(' register')
  </script>" . mysqli_error($con);
  }

}


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

<div class="container my-5">
    <div class="row">
        <div class="col-8">

        <table class="table">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">username</th>
      <th scope="col">Password</th>
      <th scope="col">ACT</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($user as $row) : ?>
    <tr>
      <th scope="row"><?=$row['no']?></th>
      <td><?=$row['username']?></td>
      <td><?=$row['password'] ?></td>
      <td><a href="hapususer?id=<?=$row['no']?>">Hapus </a></td>
    </tr>
    <?php endforeach ?>
   
  </tbody>
</table>
           
        </div>
        <div class="col-4">
        <div class="card ">
					<div class="card-title text-center">
						<h1>Input User Baru</h1>
					</div>
					<div class="card-body">
						<form action="" method="post">
							<div class="form-group">
								<label for="nama">Nama Lengkap</label>
								<input type="text" name="nama" class="form-control" id="name" aria-describedby="name" placeholder="Nama lengkap" autocomplete="off" require>

							</div>
							<div class="form-group">
								<label for="email">email</label>
								<input type="email" name="email" class="form-control" id="email" aria-describedby="username" placeholder="email" autocomplete="off"  require>

							</div>
							<div class="form-group">
								<label for="password">Password</label>
								<input type="password" name="password" class="form-control" id="password" placeholder="Password"  require>
							</div>
								<input type="hidden" name="level" value="user">
								<input type="hidden" name="foto" value="1.jpg">
              
							<div class="form-group">
								<label for="password">Konfirmasi Password</label>
								<input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Password"  require>
							</div>
							<button type="submit" class="btn btn-primary" name="register">Register</button>
						</form>
					</div>
				</div>
        </div>
    </div>
</div>


			




  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  </body>
</html>