<?php
require_once '../components/header.php';
require_once "../logic/controller.php";
?>
<div class="wrapper">
<div class="task__content">
                                    <H1>Tasks</H1>
<?php if (isset($_SESSION["userEmail"])) {?>

    <form  action="../logic/controller.php" method = "POST">

        <label>
          <textarea name="task"> </textarea>
        </label>

        <label>
        <input type="date"  name="deadline" value="<?= date("Y.m.d") ?>"  ">
        </label>

        <input type="submit" name="addTask"  value="Add task" class="button bd__green" style="border: none">
    </form>

</div>

    <table class="table">
        <thead>
        <tr>
            <th>Task</th>
            <th>Deadline</th>
            <th>Status</th>
            <th>Controls</th>
        </tr>
        </thead>
        <tbody>
        <tr>
         <?php
         if(isset($tasks)) {
             foreach ($tasks as $item ) {
                 if ($item["status"] == "Done") {
                     echo '<tr class = "taskComplete">';
                 }
                 else echo '<tr>';
                 echo '<td class="td__text text-center">' . htmlspecialchars($item["task"]) . '</td>';
                 echo '<td class="td__text text-center">' . htmlspecialchars($item["deadline"]) . '</td>';
                 echo '<td class="td__text text-center">' . htmlspecialchars($item["status"]) . '</td>';
                 echo '<td> <a type="button" class="button bd__green" href ="?taskId='. urlencode($item['id']).'&taskStatus=Done">Done</a>' ;
                 echo '<a type="button"  class="button bd__yellow" href ="?taskId='. urlencode($item['id']).'&taskStatus=In progress">In progress</a>';
                 echo '<a type="button" onclick="return deletionCheck()" class="button bd__red" href ="?deleteTaskId=' . urlencode($item['id']) . '">Delete</a>' . '</td>';
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
    require_once '../components/footer.php';
}

