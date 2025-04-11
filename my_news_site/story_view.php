<?php
require_once "etc/config.php";

try {
    if (!isset($_GET["id"])) {
        throw new Exception("Story ID not provided.");
    }
    $id = $_GET["id"];
    $s = Story::findById($id);
    if ($s == null) {
        throw new Exception("Story not found.");
    }
    $category = Category::findById($s->category_id);

    $related_stories = Story::findByCategory($category->id, $options = array('limit' => 3, 'order_by' => 'updated_at DESC'));

    $readableDate = date("jS F Y H:i", strtotime($s->updated_at));

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
    <link rel="stylesheet" href="css/view.css">
    <link rel="stylesheet" href="css/fonts.css">

    <script defer src="js/app.js"></script>
    <script defer src="js/modal.js"></script>

    <title><?= $s->short_headline ?></title>
</head>

<body>
    <?php require "./etc/login_status.php"; ?>
    <?php require_once "etc/navbar.php"; ?>
    <?php require_once "etc/flash_message.php"; ?>

    <div class="container">
        <div class="main-story width-12">
            <div id="pre-headline">
                <span class="category space-mono-bold"><?= Category::findById($s->category_id)->name ?></span>

                <p class="author space-mono-bold">
                    <?= Author::findById($s->author_id)->first_name . " " . Author::findById($s->author_id)->last_name ?>
                </p>

                <p class="space-mono-regular"><?= $readableDate ?></p>
            </div>

            <h1 class="headline pt-serif-bold"><?= $s->headline ?></h1>

            <p><img src="assets/images/<?= $s->img_url ?>" id='main-img' /></p>

            <p class="space-mono-bold location"><?= Location::findById($s->location_id)->name ?></p>

            <div class=" article-text lato-regular">
                <?= $s->article ?>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="width-12 relCat">
            <h2 class="cat-head">More <?= Category::findById($s->category_id)->name ?> Stories</h2>
        </div>


        <?php foreach ($related_stories as $rs) { ?>
            <?php if ($rs->id == $s->id) {
                continue;
            } ?>
            <div class="width-4 relatedStory">
                <h3 class="lato-bold">
                    <a href="story_view.php?id=<?= $rs->id ?>"><?= $rs->headline ?></a>
                </h3>

                <div>
                    <a href="story_view.php?id=<?= $rs->id ?>">
                        <p class="space-mono-bold">
                            <?= Author::findById($rs->author_id)->first_name . " " . Author::findById($rs->author_id)->last_name ?>
                        </p>

                        <p>Updated: <?= $rs->updated_at ?></p>

                        <img src="assets/images/<?= $rs->img_url ?>">
                    </a>
                </div>
            </div>
        <?php } ?>
    </div>
    <?php require_once "./etc/footer.php"; ?>
</body>

</html>