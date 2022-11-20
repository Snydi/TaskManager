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
        <input type="submit" name="submit"  value="submit" class="btn btn-success transform">
    </form>

</div>
<?php } else {
    require_once '../footer.php';
}

