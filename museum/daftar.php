<?php
include "koneksi.php";

if (isset($_POST['daftar'])) {
    $u = $_POST['username'];
    $p = $_POST['password'];

    mysqli_query($conn, "INSERT INTO user VALUES ('','$u','$p','default.png','bio kosong')");
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>daftar</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<form method="POST">
<h1>daftar</h1>
<input type="text" name="username">
<input type="password" name="password">
<button name="daftar">daftar</button>
</form>

</body>
</html>