<?php
session_start();
include "koneksi.php";

$id_user = $_GET['id'];
$id_follower = $_SESSION['id'];

mysqli_query($conn, "DELETE FROM follow 
WHERE id_user='$id_user' AND id_follower='$id_follower'");

header("Location: profile.php?id=".$id_user);
?>