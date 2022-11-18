<?php
require_once 'Database.php';
class UserManager
{
    private string $email;
    private string $password;

    public function __construct($emailPOST,$passwordPOST) //takes POST data as parameters and immediately hashes password
    {
        $this->email = $emailPOST;
        $this->password = password_hash($passwordPOST, PASSWORD_DEFAULT);
    }

    public function registerUser()
    {
        $query = "INSERT INTO users (id, email, password) VALUES (NULL, '$this->email', '$this->password') ";
        mysqli_query(Database::connection(), $query) or die(mysqli_error(Database::connection()));
    }

    public function removeUserAccount()
    {
        $query = "DELETE FROM users WHERE id = $this->id";
        mysqli_query(Database::connection(), $query) or die(mysqli_error(Database::connection()));
    }

    public function getUserInfo()
    {
        $query = "SELECT * FROM users WHERE email = $this->email";
        $queryResult =  mysqli_query(Database::connection(), $query) or die(mysqli_error(Database::connection()));
        return mysqli_fetch_assoc($queryResult);
    }


    //The following functions are needed for error-checking during authentication
    public function userExists(): bool
    {
        $query = "SELECT email FROM users as email WHERE email = '$this->email' ";
        $queryResult =  mysqli_query(Database::connection(), $query) or die(mysqli_error(Database::connection()));
        $queryResult = mysqli_fetch_assoc($queryResult);
        return $queryResult["email"] === $this->email;

    }
    public function emptyInput(): bool
    {
        if (($this->email === '') ||($this->password === '') )
        {
            return true;
        }
        else return false;
    }
    public function wrongEmailOrPassword(): bool
    {
        $userInfo = $this->getUserInfo();
        return password_verify($userInfo["password"],$this->password);
    }

}