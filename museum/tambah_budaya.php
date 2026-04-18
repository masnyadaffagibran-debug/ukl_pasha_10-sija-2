<?php
session_start();
include "koneksi.php";

if (isset($_POST['submit'])) {

    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];

    $gambar = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];

    move_uploaded_file($tmp, "image/".$gambar);

    mysqli_query($conn, "INSERT INTO budaya VALUES ('','".$_SESSION['id']."','$judul','$deskripsi','$gambar')");

    header("Location: profile.php?id=".$_SESSION['id']);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>tambah budaya</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<form method="POST" enctype="multipart/form-data">
<h1>tambah budaya</h1>
<input type="text" name="judul">
<textarea name="deskripsi"></textarea>
<input type="file" name="gambar">
<button name="submit">upload</button>
</form>

</body>
</html>