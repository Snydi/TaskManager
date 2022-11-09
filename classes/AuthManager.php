<?php
require_once 'Database.php';
class AuthManager
{
    private string $email;
    private string $password;
    private string $id;
    public function __construct($email,$password)
    {
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    public function addUserToDB()
        {
            $query = "INSERT INTO users (id, email, password) VALUES (NULL, '$this->email', '$this->password') ";
            mysqli_query(Database::connection(), $query) or die(mysqli_error(Database::connection()));
        }
    public function removeUserFromDB()
    {
        $query = "DELETE FROM users WHERE id = $this->id";
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }


}