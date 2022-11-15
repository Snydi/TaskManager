<?php  session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TaskManager</title>
    <link href="style.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<!--   <script type="text/javascript" src="scripts.js"></script>-->
</head>

<body>
<nav class="navbar bg-primary text-light">
    <a class="nav-link" href ="home.php">Home</a>
    <?php if (isset($_SESSION["auth"])) { ?>
        <a class="nav-link">Profile</a>
        <a class="nav-link" href ="../logic/logout.php">Logout</a>
    <?php } else { ?>
    <a class="nav-link" href ="authPage.php">Register</a>
    <a class="nav-link" href ="authPage.php">Login</a>
    <?php }?>

</nav>
