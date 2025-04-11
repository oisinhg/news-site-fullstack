<?php
require_once "etc/config.php";
require_once "etc/global.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">

    <script defer src="js/app.js"></script>


    <title>Admin Login</title>
</head>

<body>

    <div class="container">
        <div class="form-content">
            <p>Sign in to edit and add stories. <br>(admin for both)</p>
            <form action="login_check.php" method="POST">
                <p>
                    <label for="username">Username: </label>
                    <input type="text" name="username" value="<?= old('username') ?>">
                </p>
                <span class="error"><?= error('username') ?></span>

                <p>
                    <label for="password">Password: </label>
                    <input type="password" name="password">
                </p>
                <span class="error"><?= error('password') ?></span>
               
                <span>
                    <a href="index.php"><button type="button">Cancel</button></a>
                    <button>Login</button>
                </span>
            </form>
        </div>

    </div>


</body>

</html>

<?php
if (array_key_exists("form-data", $_SESSION)) {
    unset($_SESSION["form-data"]);
}
if (array_key_exists("form-errors", $_SESSION)) {
    unset($_SESSION["form-errors"]);
}
?>