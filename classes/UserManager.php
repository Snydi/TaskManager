<?php
require_once 'Database.php';
class UserManager
{
    private string $email;
    private string $password;
    private string $id;

    public function __construct($email,$password) //takes POST data as parameters and immediately hashes password
    {
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    public function registerUser()
    {
        $query = "INSERT INTO users (id, email, password) VALUES (NULL, '$this->email', '$this->password') ";
        mysqli_query(Database::connection(), $query) or die(mysqli_error(Database::connection()));
    }
    public function userExists()
    {
        $query = "SELECT email FROM users as email WHERE email = '$this->email' ";
        $queryresult =  mysqli_query(Database::connection(), $query) or die(mysqli_error(Database::connection()));
        $emailFromDB = mysqli_fetch_assoc($queryresult);
        return $emailFromDB["email"] === $this->email;
    }
    public function emptyInput()
    {
        if (($this->email === '') ||($this->password === '') )
        {
            return true;
        }
        else return false;
    }

    public function removeUserFromDB()
    {
        $query = "DELETE FROM users WHERE id = $this->id";
        mysqli_query(Database::connection(), $query) or die(mysqli_error(Database::connection()));
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