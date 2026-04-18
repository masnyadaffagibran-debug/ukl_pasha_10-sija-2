<?php
session_start();
include "koneksi.php";
$data = mysqli_query($conn, "SELECT * FROM budaya");
?>

<!DOCTYPE html>
<html>
<head>
    <title>exhibition</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>exhibition</h1>
<a href="index.php">back</a>

<div class="gallery">
<?php while ($d = mysqli_fetch_assoc($data)) { ?>
    <div class="card">
        <img src="image/<?php echo $d['gambar_url']; ?>">
        <h3><?php echo $d['judul']; ?></h3>
        <a href="detail.php?id=<?php echo $d['id']; ?>">lihat</a>
    </div>
<?php } ?>
</div>

</body>
</html>