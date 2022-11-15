<?php
require_once '../classes/UserManager.php';
if(isset($_POST["submit"]))
{
    $user = new UserManager($_POST["email"], $_POST["password"]);
    $user->registerUser();
    session_start();
    $_SESSION["auth"] = true;
    header("Location: ../pages/home.php");
}

