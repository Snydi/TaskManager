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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
   <script type="text/javascript" src="scripts.js"></script>
</head>

<body>
<nav class="header">
    <div class="wrapper">
        <div class="header__content">
        <a class="header__link" href ="home.php">Home</a>
        <?php if (isset($_SESSION["auth"])) { ?>
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
