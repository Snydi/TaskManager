<?php
require_once "../header.php";
require_once "../logic/Handler.php";
?>
                    <h3 class="text-center"><?= $_GET["autherror"] ?? ''?></h3>
<div class="task__content">
<form class="container text-center form w-25" action="../logic/Handler.php" method = "POST">
<?php if (isset($_GET["login"])) { ?>
    <h1>Login</h1>
<?php } else { ?>
    <h1>Register</h1>
    <?php }?>
    <label class="form-label row">
        <input class="form-control" name="email" placeholder="Email:" type="text" value="<?= $_POST['email'] ?? '' ?>" >
    </label>
    <label class="form-label row">
        <input class="form-control" name="password" placeholder="Password:" type="password" value="<?= $_POST['password'] ?? '' ?>" >
    </label>
<?php if (isset($_GET["login"])) { ?>
    <input type="submit" name="submitLogin"  value="Login" class="btn btn-success">
<?php } else { ?>
    <input type="submit" name="submitRegister"  value="Register" class="btn btn-success">
    <?php }?>
</form>
</div>
<?php
require_once "../footer.php";