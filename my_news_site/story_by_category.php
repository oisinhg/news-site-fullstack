<?php
require_once "./etc/config.php";

try {
    if (!isset($_GET["id"])) {
        throw new Exception("Category ID not provided.");
    }
    $categoryId = $_GET["id"];
    $category = Category::findById($categoryId);
    if ($category == null) {
        throw new Exception("Category not found.");
    }
    // $stories = Story::findByCategory($categoryId);
    $stories = Story::findByCategory($categoryId, $options = array('limit' => 3));
    // $stories = Story::findByCategory($categoryId, $options = array('limit' => 3, 'offset' => 2));
} catch (Exception $e) {
    echo $e->getMessage();
    exit();
}
?>
<html>

<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=PT+Serif:ital,wght@0,400;0,700;1,400;1,700&family=Space+Mono:ital,wght@0,400;0,700;1,400;1,700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/grid.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/fonts.css">
    <link rel="stylesheet" href="css/category.css">

    <script defer src="js/app.js"></script>

    <title>Stories: <?= $category->name ?></title>
</head>

<body>
    <?php require "./etc/login_status.php"; ?>
    <?php require_once "./etc/navbar.php"; ?>
    <?php require_once "./etc/flash_message.php"; ?>

    <div class="container">
        <div class="width-12">
            <h1 class="cat-head"><?= $category->name ?></h1>
        </div>
    </div>


    <div class="grid-container">
        <div class="news-grid">
            <?php foreach ($stories as $key => $s) { ?>
                <div class='news-item item-<?= $key ?>'>
                    <a href="story_view.php?id=<?= $s->id ?>">
                        <p><img src="assets/images/<?= $s->img_url ?>" /></p>

                        <span class="category space-mono-bold"><?= Category::findById($s->category_id)->name ?></span>

                        <h2><?= $s->headline ?></h2>
                    </a>
                    <div>
                        <a href="story_view.php?id=<?= $s->id ?>">
                            <?= substr($s->article, 0, 100) ?>...
                        </a>
                    </div>

                    <a href="story_view.php?id=<?= $s->id ?>">
                        <p class="space-mono-bold">
                            <?= Author::findById($s->author_id)->first_name . " " . Author::findById($s->author_id)->last_name ?>
                        </p>
                    </a>

                </div>
            <?php } ?>
        </div>
    </div>

    <?php require_once "./etc/footer.php"; ?>
</body>

</html>