<?php //this file realises all the functions related to authentication
require_once '../classes/UserManager.php';
require_once '../classes/TaskManager.php';

if (isset($_SESSION))
{
    $db = new PDO('mysql:host=localhost;dbname=snydi_site_db;','root');
    $user = new UserManager($db);
    $userInfo = $user->getUserInfoByEmail($_SESSION["userEmail"]);
    $taskManager = new TaskManager($db);
    $tasks = $taskManager->getTasks($userInfo["id"]);
}
if (isset($_POST["submitRegister"]))
{

    $email = $_POST["email"];
    $password = $_POST["password"];
    $db = new PDO('mysql:host=localhost;dbname=snydi_site_db;','root');
    $user = new UserManager($db, $email, $password);
    if ($user->emptyInput())
    {
        header("Location: ../pages/authPage.php?autherror=Not all of fields are filled.");
    }
//    else if ($user->invalidEmail())
//    {
//        header("Location: ../pages/authPage.php?autherror=Invalid email.");
//    }
//    else if ($user->userExists())
//    {
//        header("Location: ../pages/authPage.php?autherror=User already exists.");
//    }
    else
    {
        $id = $user->registerUser();
        session_start();
        $_SESSION["userId"] = $id;
        header("Location: ../pages/home.php");
    }
}
if(isset($_POST["submitLogin"]))
{
    $email = $_POST["email"];
    $password = $_POST["password"];
    $db = new PDO('mysql:host=localhost;dbname=snydi_site_db;','root');
    $user = new UserManager($db, $email, $password);

    if ($user->emptyInput())
    {
        //$_GET["login] = true here because we need to stay on login page
        header("Location: ../pages/authPage.php?login=true&autherror=Not all of fields are filled.");
    }
//    else if ($user->wrongEmailOrPassword())
//    {
//        header("Location: ../pages/authPage.php?login=true&autherror=Wrong email or password.");
//    }
    else
    {
    session_start();
    $_SESSION["userEmail"] = $email;
    header("Location: ../pages/home.php");
    }
}
if(isset($_POST["addTask"]))
{
    session_start();
    $user = unserialize($_SESSION["user"]); //retrieving the object
    $userInfo = $user->getUserInfo();

    $task = mysqli_real_escape_string(Database::connection(),$_POST["task"]);

    $taskManager= new TaskManager();
    $taskManager->addTask( $userInfo["id"],$task);
    header("Location: ../pages/home.php");

}
if (isset($_GET["deleteTaskId"])) //if user tries to delete a task
{
    $taskManager= new TaskManager();
    $taskManager->deleteTask($_GET["deleteTaskId"]);
    header("Location: ../pages/home.php");
}
if (isset($_GET["completeTaskId"])) //if user considers task done.
{
    $taskManager = new TaskManager();
    $taskManager->changeTaskStatus($_GET["completeTaskId"],'Done');
    header("Location: ../pages/home.php");
}

