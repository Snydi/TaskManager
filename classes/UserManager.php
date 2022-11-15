<?php
require_once 'Database.php';
class UserManager
{
    private string $email;
    private string $password;
    private string $id;
    public function __construct($email,$password)
    {
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    public function registerUser()
    {
        $query = "INSERT INTO users (id, email, password) VALUES (NULL, '$this->email', '$this->password') ";
        mysqli_query(Database::connection(), $query) or die(mysqli_error(Database::connection()));
    }
    public function loginCheck() //нужно добавить больше проверок на  ошибки при авторизации или удалить нахуй
    {
        $error = 0;
        if (!$this->userExists())
        {
            $error ++;
        }
        if ($error > 0 )
        {
            return false;
        }
        return true;
    }
    private function userExists()
    {
        $query = "SELECT * FROM users WHERE email = '$this->email' ";
        $emailFromDB =  mysqli_query(Database::connection(), $query) or die(mysqli_error(Database::connection()));
        return $emailFromDB == $this->email;
    }
    public function removeUserFromDB()
    {
        $query = "DELETE FROM users WHERE id = $this->id";
    }
//    private function getUserId()
//    {
//        $query = "SELECT id FROM users as id";
//        return  mysqli_query(Database::connection(), $query) or die(mysqli_error(Database::connection()));
//    }
    public function addTask()
    {
        $query = "INSERT INTO tasks (id,task) VALUES (, '$this->task')";
        mysqli_query(Database::connection(), $query) or die(mysqli_error(Database::connection()));
    }

}