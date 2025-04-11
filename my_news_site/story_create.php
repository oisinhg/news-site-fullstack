<?php
require_once "etc/config.php";
require_once "etc/global.php";

date_default_timezone_set("Europe/Dublin");

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$authors = Author::findAll();
$locations = Location::findAll();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=PT+Serif:ital,wght@0,400;0,700;1,400;1,700&family=Space+Mono:ital,wght@0,400;0,700;1,400;1,700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/grid.css">
    <link rel="stylesheet" href="css/story_create.css">
    <link rel="stylesheet" href="css/navbar.css">

    <script defer src="js/app.js"></script>

    <title>Story Entry</title>
</head>

<body>
    <?php require_once "etc/navbar.php"; ?>

    <div class="container">
        <div class="content width-12">
            <h2>Story Entry Form</h2>
            <form action="story_store.php" method="POST" enctype="multipart/form-data">
                <p>
                    <label for="headline">Headline:</label>
                    <input type="text" name="headline" value="<?= old('headline') ?>">
                </p>
                <span class="error"><?= error('headline') ?></span>

                <p>
                    <label for="short_headline">Short Headline:</label>
                    <input type="text" name="short_headline" value="<?= old('short_headline') ?>">
                </p>
                <span class="error"><?= error('short_headline') ?></span>

                <p id="articleText">
                    <label for="article">Article:</label>
                    <textarea name="article"><?= old('article') ?></textarea>
                </p>
                <span class="error"><?= error('article') ?></span>

                <p>
                    <label for='img_url'>Image:</label>
                    <input type="file" id="img_url" name="img_url">
                    <!-- <input type="text" name="img_url" value="<?= old('img_url') ?>"> -->
                </p>
                <span class="error"><?= error('img_url') ?></span>

                <p>
                    <label for="author_id">Author:</label>
                    <select name="author_id">
                        <option value="">Please choose the author...</option>
                        <?php foreach ($authors as $author): ?>
                            <option id="author-option" value=<?= $author->id ?>     <?= chosen("author_id", $author->id) ? "selected" : ""; ?>>
                                <?= $author->first_name ?>     <?= $author->last_name ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </p>
                <span class="error"><?= error('author_id') ?></span>

                <p>
                    <label for="category_id">Category:</label>
                    <select name="category_id">
                        <option value="">Please choose the category...</option>
                        <?php foreach ($categories as $category): ?>
                            <option value=<?= $category->id ?>     <?= chosen("category_id", $category->id) ? "selected" : ""; ?>>
                                <?= $category->name ?></option>
                        <?php endforeach; ?>
                    </select>
                </p>
                <span class="error"><?= error('category_id') ?></span>

                <p>
                    <label for="location_id">Location:</label>
                    <select name="location_id">
                        <option value="">Please choose the location...</option>
                        <?php foreach ($locations as $location): ?>
                            <option value=<?= $location->id ?>     <?= chosen("location_id", $location->id) ? "selected" : ""; ?>>
                                <?= $location->name ?></option>
                        <?php endforeach; ?>
                    </select>
                </p>
                <span class="error"><?= error('location_id') ?></span>

                <span class="error"><?= error('created_at') ?></span>

                <input type="hidden" name="created_at" value="<?= date("Y-m-d H:i:s") ?>">
                <input type="hidden" name="updated_at" value="<?= date("Y-m-d H:i:s") ?>">

                <p id="control-btns">
                    <a href="index.php"><button type="button">Cancel</button></a>
                    <button type="submit">Submit</button>
                </p>
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