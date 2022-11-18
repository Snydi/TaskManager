<?php
require_once '../header.php';
require_once "../logic/handler.php";
?>
<div class="task__content">
<H1 class="text-center">Tasks</H1>
<?php if (isset($_SESSION["auth"])) {?>
    <form class="container text-center form w-25" action="../logic/handler.php" method = "POST">

        <label class="form-label row">
          <textarea class="form-control" name="task" placeholder="Task:" > </textarea>
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
                <th scope="col">Time left</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <?php
                $count = 0;
                if(isset($tasks)) {
                    foreach ($tasks as $item ) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($item["task"]) . '</td>';
                        echo '<td>'  . '</td>';
                        echo '<td>' . '<a type="button" onclick="return deletionCheck()" class="btn btn-danger delete" href ="?taskId=' . htmlspecialchars($item['id']) . '">Delete</a>' . '</td>';
                        echo '</tr>' . " ";
                    }
                }
                ?>

            </tr>
            </tbody>
        </table>
    </div>
<?php
} else {
    require_once '../footer.php';
}

