<?php
class TaskManager
{
    public function getTasks($id)
    {
        $query = "SELECT * FROM tasks WHERE user_id = '$id'";
        $queryResult = mysqli_query(Database::connection(), $query) or die(mysqli_error(Database::connection()));
        if(isset($queryResult))
        {
            if (mysqli_num_rows($queryResult))
                while ($row = mysqli_fetch_assoc($queryResult))
                    $result[] = $row;
        }
        return $result ?? NULL;
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