<?php
require_once '../classes/UserManager.php';

if (isset($_POST["submitRegister"]))
{
    $email = mysqli_real_escape_string(Database::connection(),$_POST["email"]);
    $password = mysqli_real_escape_string(Database::connection(),$_POST["password"]);
    $user = new UserManager($email, $password);
    if ($user->emptyInput())
    {
        header("Location: ../pages/authPage.php?autherror=Not all of fields are filled.");
    }
    else if ($user->userExists())
    {
        header("Location: ../pages/authPage.php?autherror=User already exists.");
    }
    $user->registerUser();
    session_start();
    $_SESSION["auth"] = true;
    header("Location: ../pages/home.php");
}
else if(isset($_POST["submitLogin"]))
{
    $email = mysqli_real_escape_string(Database::connection(),$_POST["email"]);
    $password = mysqli_real_escape_string(Database::connection(),$_POST["password"]);
    $user = new UserManager($email, $password);

    if ($user->emptyInput())
    {
        header("Location: ../pages/authPage.php?login=true&autherror=Not all of fields are filled."); //$_GET["login] = true because we need to stay on login page
    }
    else
    {
    session_start();
    $_SESSION["auth"] = true;
    header("Location: ../pages/home.php");
    }
}


