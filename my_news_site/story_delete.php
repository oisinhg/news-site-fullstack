<?php 
require_once "etc/config.php";
require_once "etc/global.php";

try {
    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        throw new Exception("Invalid request method");
    }
    if (!array_key_exists("id", $_POST)) {
        throw new Exception("Invalid request parameters");
    }

    $id = $_POST["id"];

    $story = Story::findById($id);

    if ($story === null) {
        throw new Exception("Story not found");
    }

    $story->delete();

    redirect("index_edit.php");
}
catch (Exception $ex) {
    echo $ex->getMessage();
    exit();
}
?>