<?php
require_once 'header.php';
?>

<form class="container text-center form w-25" method = "POST">

    <label class="form-label row">
        <input class="form-control" placeholder="Username:" type="text" >
    </label>
    <label class="form-label row">
        <input class="form-control" placeholder="email:" type="text" >
    </label>
    <label class="form-label row">
        <input class="form-control" placeholder="Password:" type="text" >
    </label>

    <input type="submit" name="signup-submit"  value="Enter" class="btn btn-success"">

</form>

<?php require_once 'footer.php';