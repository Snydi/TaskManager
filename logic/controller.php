<?php
require_once '../classes/UserManager.php';
require_once '../classes/TaskManager.php';

$db = new PDO('mysql:host=localhost;dbname=snydi_site_db;','root');

if (isset($_SESSION["userEmail"]))
{
    $user = new UserManager($db);
    $userInfo = $user->getUserInfoByEmail($_SESSION["userEmail"]);
    $taskManager = new TaskManager($db);
    $tasks = $taskManager->getTasks($userInfo["id"]);
}
if (isset($_POST["submitRegister"]))
{
    $user = new UserManager($db);

    if ($user->emptyInput($_POST["email"],$_POST["password"]))
    {
        header("Location: ../pages/authPage.php?autherror=Not all of fields are filled.");
    }
    else if ($user->invalidEmail($_POST["email"]))
    {
        header("Location: ../pages/authPage.php?&autherror=Invalid email.");
    }
    else if ($user->invalidPassword($_POST["password"]))
    {
        header("Location: ../pages/authPage.php?autherror=Password must be at least 8 characters long, have numbers in it");
    }
    else if ($user->userExists($_POST["email"]))
    {
        header("Location: ../pages/authPage.php?autherror=User already exists.");
    }
    else
    {
        $user->registerUser($_POST["email"],$_POST["password"]);
        session_start();
        $_SESSION["userEmail"] = $_POST["email"];
        header("Location: ../pages/home.php");
    }
}
if(isset($_POST["submitLogin"]))
{
    $user = new UserManager($db);

    if ($user->emptyInput($_POST["email"],$_POST["password"]))
    {
        //$_GET["login] = true here because we need to stay on login page
        header("Location: ../pages/authPage.php?login=true&autherror=Not all of fields are filled.");
    }
    else if ($user->wrongEmailOrPassword($_POST["email"],$_POST["password"]))
    {
        header("Location: ../pages/authPage.php?login=true&autherror=Wrong email or password.");
    }
    else
    {
    session_start();
    $_SESSION["userEmail"] = $_POST["email"];
    header("Location: ../pages/home.php");
    }
}
if(isset($_POST["addTask"]))
{
    session_start();
    $user = new UserManager($db);
    $taskManager= new TaskManager($db);

    $userInfo = $user->getUserInfoByEmail($_SESSION["userEmail"]);
    $taskManager->addTask($userInfo["id"],$_POST["task"]);
    header("Location: ../pages/home.php");
}
if (isset($_GET["deleteTaskId"])) //if user tries to delete a task
{
    $taskManager= new TaskManager($db);
    $taskManager->deleteTask($_GET["deleteTaskId"]);
    header("Location: ../pages/home.php");
}
if (isset($_GET["completeTaskId"])) //if user considers task done.
{
    $taskManager = new TaskManager($db);
    $taskManager->changeTaskStatus($_GET["completeTaskId"],'Done');
    header("Location: ../pages/home.php");
}

