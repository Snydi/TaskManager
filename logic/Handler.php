<?php
require_once '../classes/UserManager.php';
if(isset($_POST["submit"]))
{
    $email = mysqli_real_escape_string(Database::connection(),$_POST["email"]);
    $password = mysqli_real_escape_string(Database::connection(),$_POST["password"]);
    $user = new UserManager($_POST["email"], $_POST["password"]);
    if ($user->userExists())
    {
        header("Location: ../pages/authPage.php?autherror=User already exists");
    }
//    $user->registerUser();
//    session_start();
//    $_SESSION["auth"] = true;
//    header("Location: ../pages/home.php");
}

