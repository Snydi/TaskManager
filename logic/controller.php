<?php
require_once '../classes/User.php';
require_once '../classes/Task.php';

$config = include '../config.php'; //this file is in gitignore

$db = new PDO(
    'mysql:host=' . $config['database']['host'] . ';dbname=' . $config['database']['dbname'],
    $config['database']['username'],
    $config['database']['password']
);

if (isset($_SESSION["userEmail"]))
{
    $user = new User($db);
    $userInfo = $user->getUserInfoByEmail($_SESSION["userEmail"]);
    $taskManager = new Task($db);
    $tasks = $taskManager->getTasks($userInfo["id"]);
}
if (isset($_POST["submitRegister"]))
{
    $user = new User($db);

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
    $user = new User($db);

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
    $user = new User($db);
    $taskManager= new Task($db);

    $userInfo = $user->getUserInfoByEmail($_SESSION["userEmail"]);
    $taskManager->addTask($userInfo["id"],$_POST["task"],$_POST["deadline"]);
    header("Location: ../pages/home.php");
}
if (isset($_GET["deleteTaskId"])) //if user tries to delete a task
{
    $taskManager= new Task($db);
    $taskManager->deleteTask($_GET["deleteTaskId"]);
    header("Location: ../pages/home.php");
}
if (isset($_GET["taskId"]) && isset($_GET["taskStatus"]) ) //if user changes status of a task
{
    $taskManager = new Task($db);
    $taskManager->changeTaskStatus($_GET["taskId"],$_GET["taskStatus"]);
    header("Location: ../pages/home.php");
}

