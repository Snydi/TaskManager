<?php
require_once "../components/header.php";
require_once "../logic/controller.php";
?>



<?php if (isset($_GET["login"])) { ?>
                                            <h1 class="text-center">Login</h1>
<?php } else { ?>
                                            <h1 class="text-center">Register</h1>
    <?php }?>
    <form class="auth__form form__flex" action="../logic/controller.php" method = "POST">
    <label>
        <input class="form__input" name="email" placeholder="Email:" type="text"
               value="<?= $_POST['email'] ?? '' ?>" >
    </label>

    <label>
        <input class="form__input" name="password" placeholder="Password:" type="password"
               value="<?= $_POST['password'] ?? '' ?>" >
    </label>

<?php if (isset($_GET["login"])) { ?>
    <input type="submit" name="submitLogin"  value="Login" class="button bd__green">
<?php } else { ?>
    <input type="submit" name="submitRegister"  value="Register" class="button bd__green">
    <?php }?>
</form>
    <h3 class="text-center"><?= $_GET["autherror"] ?? ''?></h3>

<?php
require_once '../components/footer.php';