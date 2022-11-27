<?php
class TaskManager
{
    protected PDO $db;
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }
    public function getTasks($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM tasks WHERE user_id = ?");
        $stmt->execute([$id]);
        return $stmt;
    }
    public function addTask($userId,$task)
    {
        $query = "INSERT INTO tasks (id,user_id, task, status) VALUES(NULL,'$userId', '$task','In progress')";
        mysqli_query(Database::connection(), $query) or die(mysqli_error(Database::connection()));
    }
    public function deleteTask($id)
    {
        $query = "DELETE FROM tasks WHERE id = '$id'";
        mysqli_query(Database::connection(), $query) or die(mysqli_error(Database::connection()));
    }
    public function changeTaskStatus($id,$status)
    {
        $query = "UPDATE tasks SET status = '$status' WHERE id = '$id'";
        mysqli_query(Database::connection(), $query) or die(mysqli_error(Database::connection()));
    }
}