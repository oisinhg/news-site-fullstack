<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['auth']) && $_SESSION['auth'] === true) {
    echo '<input type="hidden" id="login_status" value="true">'; 
} 
else {
    echo '<input type="hidden" id="login_status" value="false">'; 
}