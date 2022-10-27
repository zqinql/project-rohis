<?php
$con = mysqli_connect('localhost','root', '', 'crud-blog');
if(!$con){
    echo 'Konekkin db yg bener blog' . mysqli_connect_error($con);
}

function query($query){
    global $con;
    $result = mysqli_query($con, $query) or die('ada yg salah!' . mysqli_error($con));
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

function inputyt($data){
    global $con;
    $judul = htmlspecialchars($data['judul']);
    $subjudul = htmlspecialchars($data['subjudul']);
    $id_vidio = htmlspecialchars($data['id_vidio']);
    $materi = htmlspecialchars($data['materi']);
    $title = htmlspecialchars($data['title'] );

    
    $querys = "INSERT INTO youtube VALUES(
        '', '$judul', '$subjudul', '$id_vidio','$materi', '$title'
    )";
    mysqli_query($con, $querys) or die('insert youtube salah' . mysqli_error($con));
    return mysqli_affected_rows($con);
}

function inputemail($data){
    global $con;
    $name = htmlspecialchars($data['name']);
    $institusi = htmlspecialchars($data['institusi']);
    $email = htmlspecialchars($data['email']);

    $query = "INSERT INTO subscribers VALUES('', '$name', '$institusi', '$email')";
    mysqli_query($con, $query) or die('insert subscriber salah' . mysqli_error($con)) ;
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
    if(!empty($nama) && !empty($password)){

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

    
    mysqli_query($con, "INSERT INTO users  VALUES('', '$nama', '$email', '$password','$level', '$foto')");
    return mysqli_affected_rows($con);
  } else{
    echo "<script> 
        alert('Isi data terlebih dahulu')
        </script>";
        return false;
  }

}

function hapus($id){
    global $con;
    mysqli_query($con, "DELETE FROM blog WHERE id = $id");
    return mysqli_affected_rows($con);
}

?>
