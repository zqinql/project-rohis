<?php
session_start();
require_once '../connect.php';
?>
<?php
if(isset($_POST['register'])){
  if(registrasi($_POST) > 0){
    echo "<script>
      alert('berhasil register')
    </script>";
  } else{
    echo mysqli_error($con);
  }
 
}

?>

<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

	<title>Register Member - PHP</title>
</head>
<body>
	<div class="container">

		<div class="row">
			<div class="col-md-4 offset-md-4 mt-5">
				<div class="card ">
					<div class="card-title text-center">
						<h1>Register Form</h1>
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
        <a href="index.php"> <button>Back</button></a>
			</div>
		</div>

	</div>
</body>
<?php
session_destroy();
?>
