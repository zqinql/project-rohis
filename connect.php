<?php
$con = mysqli_connect('localhost','root', '', 'crud-blog');
if(!$con){
    echo 'Konekkin db yg bener blog' . mysqli_connect_error($con);
}

function query($query){
    global $con;
    $result = mysqli_query($con, $query) or die('ada yg salah!');
    $rows = [];
    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;

}



function tambah($data){
    global $con;
    $nama = htmlspecialchars($data['nama']);
    $judul = htmlspecialchars($data['judul']);
    $deskripsi = $data['deskripsi'];
    $waktu  = $data['waktu'];
    $selecttag = $data['select-tag'];
    $tagbaru = $data['tag-baru'];
    $tag = $selecttag . $tagbaru;

    $querys = "INSERT INTO blog VALUES(
        '', '$nama', '$judul', '$deskripsi','$tag', '$waktu'
    )";
    mysqli_query($con, $querys) or die('insert salah');
    return mysqli_affected_rows($con);
}



function registrasi($data){
    global $con;
    $nama = strtolower(stripslashes($data['nama']));
    $email = $data['email'];
    $password = mysqli_real_escape_string($con,$data['password']);
    $level = $data['level'];
    $foto = $data['foto'];
    $password2 =  mysqli_real_escape_string($con,$data['password_confirmation']);


    $result =  mysqli_query($con, "SELECT username FROM users WHERE username = '$nama'");
    if(mysqli_fetch_assoc($result)){
        echo "<script> 
        alert('uname dah ada!')
        </script>";
        return false;
    }


    if($password !== $password2){
        echo "
        <script>
        alert('
        Ups Salah Konfirmasi Password')
        </script>";
        return false;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);

    mysqli_query($con, "INSERT INTO users  VALUES('', '$nama', '$email', '$password','$level', '$foto')");
    return mysqli_affected_rows($con);
}


?>