<?php 
session_start();
if(!isset($_SESSION['login'])){
  header('Location: login');
  exit;
}
require_once '../connect.php';
$blog = query("SELECT * FROM blog ORDER BY no DESC");

if(isset($_POST['blog'])){

  if(tambah($_POST) > 0){
      echo"
      <script>
      alert('data berhasil ditambahkan');
      window.location.href='blog.php'
      </script>";

  } else {
      echo"<script>
      alert('UPS, ada yg salah!. tapi jangan panik hehe laporin kesalahan yg kamu dapatkan agar kami perbaiki')
      </script>" . mysqli_error($con);
  }
}
if(isset($_POST['youtube'])){
  if(inputyt($_POST) > 0){
    echo"
        <script>
        alert('data berhasil ditambahkan');
        window.location.href='blog.php'
        </script>";
  } else{
    echo"<script>
    alert('UPS, ada yg salah!. tapi jangan panik hehe laporin kesalahan yg kamu dapatkan agar kami perbaiki')
    </script>" . mysqli_error($con);
  }
}

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
    <?php 
    ?>

    

    
  <nav class="navbar navbar-expand-lg bg-light">
  <div class="container">
    <a class="navbar-brand" href="../index">Ruang Rohis</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index">Home</a>
        </li>
       
        <li class="nav-item">
          <a class="nav-link " href="logout">Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

    <h1>Blog</h1>
   
  
  <?php
    $tag_q = mysqli_query($con, "SELECT distinct(tag) FROM blog ORDER BY tag");
    if(!isset($tag_q)){
      die('ada yg eror');
    }
    ?>


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

  <div class="container my-5">
    <h1>Input Learning</h1>
        <form action="" method="post">
            <label for="judul">Judul</label>
            <input type="text" name="judul" id="judul">
            <br>
            <br>
            <label for="subjudul">subjudul</label>
            <input type="text" name="subjudul" id="subjudul">
            <br>
            <br>
            <label for="id_vidio">Id vidio</label>
            <input type="text" name="id_vidio" id="id_vidio">
            <br>
            <br>
            <label for="materi">materi</label>
            <input type="text" name="materi" id="materi">
            <br>
            <br>
            <label for="title">title</label>
            <input type="text" name="title" id="title">
          <br>
          <button type="submit" name="youtube"> Submit</button>
          </form>
    </div>



    <h1>Input Blog</h1>
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
            <button type="submit" name="blog">Submit</button>
            </div>

        <div class="kanan">
          <label for="tag">Tag</label>
              <select class="form-select" id="tag" name="select-tag">
                  <?php while($opsi = mysqli_fetch_array($tag_q)) : ?>
                  <option value="<?=$opsi['tag']?>"><?=$opsi['tag']?></option>
                  <?php endwhile ?>
              </select>
              <label for="tag-baru">Tag Baru</label>
              <input type="text" name="tag-baru" id="tag-baru">
        </div>
    </div>
  </form>
  </h1>


<div class="container">
      <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">First</th>
          <th scope="col">Last</th>
          <th scope="col">Handle</th>
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

 



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  </body>
</html>