<?php
session_start();
include "koneksi.php";

$id_user = $_GET['id'];
$id_follower = $_SESSION['id'];

$cek = mysqli_query($conn, "SELECT * FROM follow 
WHERE id_user='$id_user' AND id_follower='$id_follower'");

if (mysqli_num_rows($cek) == 0) {

    mysqli_query($conn, "INSERT INTO follow (id_user, id_follower, waktu)
    VALUES ('$id_user','$id_follower', NOW())");

}

header("Location: profile.php?id=".$id_user);
?>