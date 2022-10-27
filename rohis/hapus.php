<?php 
require_once '../connect.php';
$id = $_GET['id'];

if(hapus($id) > 0){
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


?>