<?php
$con = mysqli_connect('localhost','root', '', 'crud-blog');
if(!$con){
    echo 'Konekkin db yg bener blog' . mysqli_connect_error($con);
}

function query($query){
    global $con;
    $result = mysqli_query($con, $query);
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

    $querys = "INSERT INTO blog VALUES(
        '', '$nama', '$judul', '$deskripsi', '$waktu'
    )";
    mysqli_query($con, $querys) or die('insert salah');
    return mysqli_affected_rows($con);
}



?>