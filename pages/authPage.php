<?php
require_once "../header.php";
require_once "../logic/Handler.php";
?>
<form class="container text-center form w-25" action="../logic/Handler.php" method = "POST">

    <label class="form-label row">
        <input class="form-control" name="email" placeholder="Email:" type="text" value="<?= $_POST['email'] ?? '' ?>" >
    </label>
    <label class="form-label row">
        <input class="form-control" name="password" placeholder="Password:" type="password" value="<?= $_POST['password'] ?? '' ?>" >
    </label>

    <input type="submit" name="submit"  value="submit" class="btn btn-success"">

</form>
<?php
require_once "../footer.php";