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
    public function addTask($id,$task)
    {
        $stmt = $this->db->prepare( "INSERT INTO tasks (id,user_id, task, status) VALUES(NULL, ?, ? ,'In progress')");
        $stmt->execute([$id,$task]);
    }
    public function deleteTask($id)
    {
        $stmt = $this->db->prepare( "DELETE FROM tasks WHERE id = ?");
        $stmt->execute([$id]);
    }
    public function changeTaskStatus($id,$status)
    {
        $stmt = $this->db->prepare("UPDATE tasks SET status = ? WHERE id = ?");
        $stmt->execute([$id,$status]);
    }
}