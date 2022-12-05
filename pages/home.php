<?php
require_once '../header.php';
require_once "../logic/controller.php";
?>
<div class="task__content">
                                    <H1 class="text-center">Tasks</H1>
<?php if (isset($_SESSION["userEmail"])) {?>

    <form class="container text-center form w-25" action="../logic/controller.php" method = "POST">

        <label class="form-label row">
          <textarea class="form-control" name="task" > </textarea>
        </label>

        <label class="form-label ">
        <input type="date"  name="deadline" value="2018-07-22" min="2018-01-01" max="2018-12-31">
        </label>

        <input type="submit" name="addTask"  value="Add task" class="btn btn-success"">
    </form>

</div>
    <div class="main py-5" >
    <div class="container text-center mt-3" >
        <table class="table" >
            <thead>
            <tr>
                <th scope="col">Task</th>
                <th scope="col">Status</th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>

                <?php
                if(isset($tasks))
                {
                    foreach ($tasks as $item )
                    {
                        if ($item["status"] == "Done")
                            {
                                echo '<tr class = "taskComplete">';
                            }
                        else if ($item["status"] == "On hold")
                        {
                            echo '<tr class = "taskOnHold">';
                        }
                        else echo '<tr>';
                        echo '<td>' . htmlspecialchars($item["task"]) . '</td>';
                        echo '<td>' . htmlspecialchars($item["status"]) . '</td>';
                        echo '<td>' . '<a type="button"  class="btn btn-success" href ="?taskId='. urlencode($item['id']).'&taskStatus=Done">Done</a>' . '</td>';
                        echo '<td>' . '<a type="button"  class="btn btn-secondary" href ="?taskId='. urlencode($item['id']).'&taskStatus=In progress">In progress</a>' . '</td>';
                        echo '<td>' . '<a type="button" onclick="return deletionCheck()" class="btn btn-danger delete" href ="?deleteTaskId=' . urlencode($item['id']) . '">Delete</a>' . '</td>';
                        echo '</tr>' . " ";
                    }
                }
                ?>

            </tbody>
        </table>
    </div>
<?php
} else {
    require_once '../footer.php';
}

