<?php
session_start();
include "koneksi.php";

if (isset($_POST['login'])) {
    $u = $_POST['username'];
    $p = $_POST['password'];

    $data = mysqli_query($conn, "SELECT * FROM user WHERE username='$u'");
    $cek = mysqli_fetch_assoc($data);

    if ($cek) {
        if ($p == $cek['password']) {
            $_SESSION['id'] = $cek['id'];
            header("Location: index.php");
        } else {
            echo "password salah";
        }
    } else {
        echo "user tidak ada";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>login</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="wrapper">
    <div class="login-box">
        <h1>login</h1>

        <form method="POST">
            <input type="text" name="username" placeholder="username">
            <input type="password" name="password" placeholder="password">

            <div class="btn-group">
                <button type="submit" name="login">login</button>
                <a href="daftar.php" class="btn-daftar">daftar</a>
            </div>
        </form>

    </div>
</div>

</body>
</html>

<?php if (isset($_SESSION['id'])) { ?>
    <a href="profile.php?id=<?php echo $_SESSION['id']; ?>">ke profile</a>
<?php } ?>