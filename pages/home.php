<?php
require_once '../header.php';
require_once "../logic/Handler.php";
?>
<H1 class="text-center">Tasks</H1>
    <form class="container text-center form w-25" action="../logic/Handler.php" method = "POST">

        <label class="form-label row">
          <textarea class="form-control" name="task" placeholder="Task:" > </textarea>
        </label>
        <input type="submit" name="submit"  value="submit" class="btn btn-success"">

    </form>
<?php
require_once '../footer.php';