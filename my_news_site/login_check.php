<?php
require_once 'etc/global.php';
require_once 'etc/config.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

try {
    if (isset($_SESSION['auth'])) {
        $_SESSION['auth'] = false;
    }
    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        throw new Exception("Invalid request method");
    }
    $validator = new LoginFormValidator($_POST);
    $valid = $validator->validate();

    if ($valid) {
        $_SESSION['auth'] = true;
        redirect('index.php');
    } else {
        $errors = $validator->errors();

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION['form-data'] = $_POST;
        $_SESSION['form-errors'] = $errors;

        redirect('login.php');
    }
} catch (Exception $ex) {
    echo $ex->getMessage();
    exit();
}
?>