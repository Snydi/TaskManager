<?php  session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>TaskManager</title>
    <link href="../style.css" rel="stylesheet" type="text/css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <script type="text/javascript" src="../scripts.js"></script>
</head>

<body>
<nav class="header">
    <div class="wrapper">
        <div class="header__content">
        <a class="header__link" href ="home.php">Home</a>
        <?php if (isset($_SESSION["userEmail"])) { ?>
        <div class="header__auth">
            <a class="header__link">Profile</a>
            <a class="header__link" href ="../logic/logout.php">Logout</a>
        </div>
    <?php } else { ?>
        <div class="header__auth">
            <a class="header__link" href ="authPage.php">Register</a>
            <a class="header__link" href ="authPage.php?login=true">Login</a>
        </div>
    <?php }?>
        </div>
    </div>
</nav>
