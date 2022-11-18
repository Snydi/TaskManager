<?php
class TaskManager
{
    public function addTask($id,$task)
    {
        $query = "INSERT INTO tasks (id, task) VALUES('$id', '$task')";
        mysqli_query(Database::connection(), $query) or die(mysqli_error(Database::connection()));
    }
}