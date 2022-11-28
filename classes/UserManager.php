<?php
require_once 'MyPDO.php';
class UserManager
{
    private string $email;
    private string $password;
    protected PDO $db;

    public function __construct(PDO $db,$emailPOST = " ",$passwordPOST = " ") //takes POST data as parameters and immediately hashes password
    {
        $this->db = $db;
        $this->email = $emailPOST;
        $this->password = password_hash($passwordPOST, PASSWORD_DEFAULT);
    }
    public function registerUser(): string
    {
        $stmt = $this->db->prepare("INSERT INTO users (id, email, password) VALUES (NULL, ? , ?)");
        $stmt->execute([$this->email,$this->password]);
        return $this->db->lastInsertId();
    }
    public function removeUserAccount() //function is not yet complete nor used
    {
        $query = "DELETE FROM users WHERE id = $this->id";
        mysqli_query(Database::connection(), $query) or die(mysqli_error(Database::connection()));
    }
    public function getUserInfoById($id)
    {
        $stmt =$this->db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getUserInfoByEmail($email)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    //The following functions are needed for error-checking during authentication
    public function userExists(): bool
    {
        $stmt = $this->db->prepare("SELECT email FROM users as email WHERE email = ?");
        $stmt->execute([$this->email]);
        $queryResult = $stmt->fetch(PDO::FETCH_ASSOC);
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
        $userInfo = $this->getUserInfoByEmail($this->email);
        return password_verify($userInfo["password"],$this->password);
    }
    public function invalidEmail(): bool // function checks if user has a valid email using this monstrosity
    {
        $userInfo = $this->getUserInfoByEmail($this->email);
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
        }
    }
}