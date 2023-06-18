<?php
require_once '../components/header.php';
require_once "../logic/controller.php";
?>

<div class="wrapper">
<div class="task__content">
                                    <H1>Tasks</H1>
<?php if (isset($_SESSION["userEmail"])) {?>

    <form class="" action="../logic/controller.php" method = "POST">

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
                 else echo '<tr>'; ?>

                 <form method="post" action="../logic/controller.php?taskId=<?=urlencode($item['id'])?>">

                 <td class="td__text text-center"> <input type="text" name="task" value="<?= htmlspecialchars($item["task"]) ?>">  </td>
                 <td class="td__text text-center"> <input type="date" name="deadline" value="<?= htmlspecialchars($item["deadline"]) ?>"> </td>
                 <td class="td__text text-center"> <input type="text" name="status" value="<?= htmlspecialchars($item["status"]) ?>"> </td>
                 <td> <a type="button" class="button bd__green" href ="?taskId=<?=urlencode($item['id'])?>&taskStatus=Done">Done</a>
                 <a type="button"  class="button bd__yellow" href ="?taskId=<?=urlencode($item['id'])?>&taskStatus=In progress">In progress</a>
                     <input type="submit" name="Update"  value="Update" class="button bd__blue">
                 <a type="button" onclick="return deletionCheck()" class="button bd__red" href ="?deleteTaskId=<?= urlencode($item['id'])?>">Delete</a>
                 </td>
                 </form>
                <?php echo '</tr>' . " ";
             }
         }
         ?>
        </tr>
        </tbody>
    </table>


    <?php
    if(isset($tasks)) {
        foreach ($tasks as $item ) {
            if ($item["status"] == "Done") {
                echo '<tr class = "taskComplete">';
            }
            else echo '<tr>';

            echo '<td class="td__text text-center"> <input type="text" /> ' . htmlspecialchars($item["task"]) . '</td>';
            echo '<td class="td__text text-center">' . htmlspecialchars($item["deadline"]) . '</td>';
            echo '<td class="td__text text-center">' . htmlspecialchars($item["status"]) . '</td>';
            echo '<td> <a type="button" class="button bd__green" href ="?taskId='. urlencode($item['id']).'&taskStatus=Done">Done</a>' ;
            echo '<a type="button"  class="button bd__yellow" href ="?taskId='. urlencode($item['id']).'&taskStatus=In progress">In progress</a>';
            echo '<a type="button"  class="button bd__blue" ">Edit</a>';
            echo '<a type="button" onclick="return deletionCheck()" class="button bd__red" href ="?deleteTaskId=' . urlencode($item['id']) . '">Delete</a>' . '</td>';
            echo '</tr>' . " ";

        }
    }
    ?>












    </div>
<?php
} else {
    require_once '../components/footer.php';
}

