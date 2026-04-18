<?php
session_start();
include "koneksi.php";

// proteksi login
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

// upload foto
if (isset($_POST['upload'])) {

    $gambar = $_FILES['foto']['name'];
    $tmp = $_FILES['foto']['tmp_name'];

    if ($gambar != "") {
        $nama_baru = time() . "_" . $gambar;

        move_uploaded_file($tmp, "image/" . $nama_baru);

        mysqli_query($conn, "UPDATE user 
        SET profile_picture='$nama_baru' 
        WHERE id='".$_SESSION['id']."'");

        header("Location: profile.php?id=".$_SESSION['id']);
        exit;
    }
}

// ambil id profile
$id = $_GET['id'] ?? $_SESSION['id'];

$data = mysqli_query($conn, "SELECT * FROM user WHERE id='$id'");
$user = mysqli_fetch_assoc($data);

if (!$user) {
    echo "user tidak ditemukan";
    exit;
}

$sendiri = ($id == $_SESSION['id']);
?>

<!DOCTYPE html>
<html>
<head>
    <title>profile</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="profile">
<h1><?php echo $user['username']; ?></h1>

<img src="image/<?php echo $user['profile_picture']; ?>" width="150">

<p><?php echo $user['bio']; ?></p>

<?php if ($sendiri) { ?>

    <a href="tambah_budaya.php">tambah budaya</a>
    <a href="logout.php">logout</a>

    <!-- upload foto -->
    <form method="POST" enctype="multipart/form-data">
        <input type="file" name="foto">
        <button type="submit" name="upload">buat pfp</button>
    </form>

<?php } else { ?>

    <?php
    $cek = mysqli_query($conn, "SELECT * FROM follow 
    WHERE id_user='$id' AND id_follower='".$_SESSION['id']."'");

    if (mysqli_num_rows($cek) == 0) {
    ?>
        <a href="follow.php?id=<?php echo $id; ?>">Follow</a>
    <?php } else { ?>
        <a href="unfollow.php?id=<?php echo $id; ?>">Unfollow</a>
    <?php } ?>

<?php } ?>

</div>

</body>
</html>