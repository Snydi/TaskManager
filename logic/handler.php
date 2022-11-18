<?php //this file realises all the functions related to authentication and task management
require_once '../classes/UserManager.php';
require_once '../classes/TaskManager.php';

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
    else
    {
        $user->registerUser();
        session_start();
        $_SESSION["auth"] = true;
        $_SESSION["user"] = serialize($user);
        header("Location: ../pages/home.php");
    }
}
else if(isset($_POST["submitLogin"]))
{

    $email = mysqli_real_escape_string(Database::connection(),$_POST["email"]);
    $password = mysqli_real_escape_string(Database::connection(),$_POST["password"]);
    $user = new UserManager($email, $password);

    if ($user->emptyInput())
    {
        //$_GET["login] = true here because we need to stay on login page
        header("Location: ../pages/authPage.php?login=true&autherror=Not all of fields are filled.");
    }
    else if ($user->wrongEmailOrPassword())
    {
        header("Location: ../pages/authPage.php?login=true&autherror=Wrong email or password.");
    }
    else
    {
    session_start();
    $_SESSION["auth"] = true;
    $_SESSION["user"] = serialize($user); //storing object that contains user info
    header("Location: ../pages/home.php");
    }

} else if(isset($_POST["addTask"]))
{
    session_start();
    $user = unserialize($_SESSION["user"]); //retrieving the object
    $userInfo = $user->getUserInfo();

    $id = $userInfo["id"]; //getting id of user that adds the task
    $task = mysqli_real_escape_string(Database::connection(),$_POST["task"]);

    $taskManager= new TaskManager();
    $taskManager->addTask($id,$task);
    header("Location: ../pages/home.php");

}


