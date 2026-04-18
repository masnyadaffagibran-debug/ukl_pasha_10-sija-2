<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>museum</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="hero">
    <div class="hero-left">
        <h1 class="super-big">museum</h1>

        <div class="btn-group">
            <a href="exhibition.php" class="btn-main">go to exhibition</a>

            <?php if (!isset($_SESSION['id'])) { ?>
                <a href="login.php" class="btn-small">login</a>
            <?php } else { ?>
                <a href="profile.php?id=<?php echo $_SESSION['id']; ?>" class="btn-small">profile</a>
            <?php } ?>
        </div>
    </div>

    <img src="image/landing.jpeg">
</div>

</body>
</html>