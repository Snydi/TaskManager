<?php
class TaskManager
{
    public function getTasks($id) //$query here needs fixing(gives obly one task)
    {
        $query = "SELECT * FROM tasks WHERE id = '$id'";
        $queryResult = mysqli_query(Database::connection(), $query) or die(mysqli_error(Database::connection()));
        if(isset($queryResult))
        {
            if (mysqli_num_rows($queryResult))
                while ($row = mysqli_fetch_assoc($queryResult))
                    $result[] = $row;
        }
        return $result;
    }
    public function addTask($id,$task)
    {
        $query = "INSERT INTO tasks (id, task) VALUES('$id', '$task')";
        mysqli_query(Database::connection(), $query) or die(mysqli_error(Database::connection()));
    }
    public function deleteTask($id)
    {
        $query = "DELETE FROM tasks WHERE id = '$id'";
    }
}