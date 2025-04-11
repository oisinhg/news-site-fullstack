<?php
require_once "etc/config.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['auth']) && $_SESSION['auth'] == true) {
    $_SESSION['auth'] = false;
} 
else {
    $_SESSION['auth'] = false;
}

redirect('index.php');