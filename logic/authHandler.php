<?php
require_once '../classes/AuthManager.php';

if(isset($_POST["submit"]))
{
    $user = new AuthManager($_POST["email"], $_POST["password"]);
    $user->addUserToDB();
}
