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
    public function removeUserAccount() //function is not yet complete nor used
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
    public function invalidEmail(): bool // function checks if user has a valid email using this monstrosity
    {
        $userInfo = $this->getUserInfo();
        if (preg_match('/^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?))
                            {255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?))
                            {65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22
                            (?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))
                            (?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22
                            (?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@
                            (?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:
                            (?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:
                            (?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]
                            {1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:
                            (?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::
                            [a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2
                            [0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})
                            |(?:[1-9]?[0-9]))){3}))\]))$/iD',
        $userInfo["email"]) == 1) return false;
        else {
            return true;
        };
    }
}