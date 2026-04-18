<?php
session_start();
include "koneksi.php";

$id_user = $_SESSION['id'];
$id_budaya = $_GET['id'];

// cek sudah like atau belum
$cek = mysqli_query($conn, "SELECT * FROM likes 
WHERE id_user='$id_user' AND id_budaya='$id_budaya'");

if (mysqli_num_rows($cek) == 0) {
    mysqli_query($conn, "INSERT INTO likes VALUES ('','$id_user','$id_budaya')");
}

header("Location: detail.php?id=".$id_budaya);
?>