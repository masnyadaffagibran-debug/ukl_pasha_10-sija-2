<?php
session_start();
include "koneksi.php";

$id = $_GET['id'] ?? 0;

// ambil data budaya
$data = mysqli_query($conn, "SELECT * FROM budaya WHERE id='$id'");
$d = mysqli_fetch_assoc($data);

if (!$d) {
    echo "data tidak ditemukan";
    exit;
}

// proses komentar
if (isset($_POST['kirim'])) {
    if (isset($_SESSION['id'])) {
        $isi = $_POST['komen'];
        $id_user = $_SESSION['id'];

        mysqli_query($conn, "INSERT INTO komentar 
        VALUES ('','$id_user','$id','$isi',NOW())");

        header("Location: detail.php?id=".$id);
    } else {
        echo "harus login dulu";
    }
}

// hitung like
$like = mysqli_query($conn, "SELECT COUNT(*) as total FROM likes WHERE id_budaya='$id'");
$l = mysqli_fetch_assoc($like);

// ambil komentar + user
$komen = mysqli_query($conn, "
SELECT komentar.*, user.username 
FROM komentar 
JOIN user ON komentar.id_user = user.id
WHERE id_budaya='$id'
");

// jumlah follower (opsional)
$jumlah = mysqli_query($conn, "SELECT COUNT(*) as total FROM follow WHERE id_user='$id'");
$j = mysqli_fetch_assoc($jumlah);
?>

<!DOCTYPE html>
<html>
<head>
    <title>detail</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="detail">
    <h1><?php echo $d['judul']; ?></h1>
    <img src="image/<?php echo $d['gambar_url']; ?>">
    <p><?php echo $d['deskripsi']; ?></p>

    <a href="exhibition.php">kembali</a>

    <br><br>

    <!-- LIKE -->
    <a href="like.php?id=<?php echo $d['id']; ?>">❤️ like</a>
    <p><?php echo $l['total']; ?> likes</p>

    <hr>

    <!-- KOMENTAR -->
    <h3>komentar</h3>

    <form method="POST">
        <textarea name="komen" placeholder="tulis komentar..."></textarea>
        <button type="submit" name="kirim">kirim</button>
    </form>

    <br>

    <?php while ($k = mysqli_fetch_assoc($komen)) { ?>
        <div>
            <b><?php echo $k['username']; ?></b>
            <p><?php echo $k['isi']; ?></p>
        </div>
    <?php } ?>

</div>

</body>
</html>