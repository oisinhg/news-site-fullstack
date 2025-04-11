<?php
require_once 'etc/global.php';
require_once 'etc/config.php';

const UPLOAD_DIR = "assets/images";

function makeParagraphs($text) {
    $sentences = explode("\n", $text);
    $sentences = array_filter($sentences, function($s) {
        return strlen(trim($s)) > 0;
    });
    $html = "<p>". implode("</p><p>", $sentences) . "</p>";

    return $html;
}

try {
    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        throw new Exception("Invalid request method");
    }
    $validator = new StoryFormValidator($_POST, $_FILES);
    $valid = $validator->validate();

    if ($valid) {
        // save the uploaded file to the server
        $img_file = new File($_FILES["img_url"]);
        $extension = $img_file->getExtension();
        $filename = "photo-". strtotime(date('Y-m-d H:i:s')) . '-' . uniqid() . '.' . $extension;
        $filepath = $img_file->move(UPLOAD_DIR, $filename);

        $data = $validator->data();
        $story = new Story($data);
        $story->img_url = $filename;
        $story->save();

        redirect('index.php');
    } else {
        $errors = $validator->errors();

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION['form-data'] = $_POST;
        $_SESSION['form-errors'] = $errors;

        redirect('story_create.php');
    }
} catch (Exception $ex) {
    echo $ex->getMessage();
    exit();
}
?>