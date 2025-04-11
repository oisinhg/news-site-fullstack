<?php
require_once "./etc/config.php";

try {
    $stories = Story::findAll($options = array('order' => 'created_at DESC', 'limit' => 8));

    $largeStory = array_slice($stories, 0, 1)[0];
    $med_stories = array_slice($stories, 4, 4);
    $horizontal_stories = array_slice($stories, 1, 3);

    $film_stories = Story::findByCategory(5, $options = array('limit' => 4));

    $gaming_stories = Story::findByCategory(4, $options = array('limit' => 4));

    // getting time difference for main story 
    date_default_timezone_set("Europe/Dublin");

    $updatedTime = $largeStory->updated_at;
    $currentTime = date("Y-m-d H:i:s");

    $date1 = new DateTime($updatedTime);
    $date2 = new DateTime($currentTime);
    $interval = $date1->diff($date2);

    $timeDiff = '';
    if ($interval->d != 0) {
        $timeDiff = $timeDiff . $interval->days . ' days ';
    }
    if ($interval->h == 1) {
        $timeDiff = $timeDiff . $interval->h . ' hour ';
    } else if ($interval->h != 0) {
        $timeDiff = $timeDiff . $interval->h . ' hours ';
    }
    if ($interval->i == 1) {
        $timeDiff = $timeDiff . $interval->i . ' min ';
    } else if ($interval->i != 0) {
        $timeDiff = $timeDiff . $interval->i . ' mins ';
    } else {
        $timeDiff = $timeDiff . $interval->s . ' seconds ';
    }

} catch (Exception $e) {
    echo $e->getMessage();
    exit();
}
?>
<html>

<head>
    <title>Stories</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=PT+Serif:ital,wght@0,400;0,700;1,400;1,700&family=Space+Mono:ital,wght@0,400;0,700;1,400;1,700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/grid.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/mediumStory.css">
    <link rel="stylesheet" href="css/horizStory.css">
    <link rel="stylesheet" href="css/largeStory.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/modal.css">
    <link rel="stylesheet" href="css/fonts.css">

    <script defer src="js/app.js"></script>
    <script defer src="js/modal.js"></script>
</head>

<body>
    <?php require "./etc/login_status.php"; ?>
    <?php require_once "./etc/navbar.php"; ?>
    <?php require_once "./etc/flash_message.php"; ?>

    <!-- block 1 -->
    <div class="container story-block">
        <h1 class="width-12 cat-head">Recent Stories</h1>

        <div class="width-7 largeStory story" data-id="<?= $largeStory->id ?>">

            <div class="contentDiv" style='background-image: url("assets/images/<?= $largeStory->img_url ?>");'>
                <div class="content">
                    <span
                        class="category space-mono-bold"><?= Category::findById($largeStory->category_id)->name ?></span>
                    <div class="text">
                        <h3 class="title lato-black"><?= $largeStory->headline ?></h3>
                        <p class="body"><?= substr($largeStory->article, 0, 155) ?>...</p>
                    </div>
                    <div>
                        <p class="author space-mono-regular">
                            <?= Author::findById($largeStory->author_id)->first_name . " " . Author::findById($largeStory->author_id)->last_name ?>
                        </p>
                        <p class="date space-mono-bold"><?= substr($largeStory->created_at, 0, 10) ?> Updated:
                            <?= $timeDiff ?> ago
                        </p>
                    </div>
                </div>

                <span class="actions">
                    <a href="story_edit.php?id=<?= $largeStory->id ?>" class="edit"><button
                            class="action-btn">Edit</button></a>
                    <button class='action-btn' id="delete-btn" data-id="<?= $largeStory->id ?>">Delete</button>
                </span>

            </div>
        </div>

        <div class="width-5 vertical_box">
            <?php foreach ($horizontal_stories as $key => $s) { ?>

                <div class="width-5 horizStory story" data-id="<?= $s->id ?>">
                    <span class="category space-mono-bold"><?= Category::findById($s->category_id)->name ?></span>
                    <div class="content">
                        <h3 class="title lato-black"><?= $s->short_headline ?></h3>
                        <p class="author space-mono-regular">
                            <?= Author::findById($s->author_id)->first_name . " " . Author::findById($s->author_id)->last_name ?>
                        </p>
                    </div>

                    <div class="imageSection">
                        <img src="assets/images/<?= $s->img_url ?>">
                    </div>

                    <span class="actions">
                        <a href="story_edit.php?id=<?= $s->id ?>" class="edit"><button class="action-btn">Edit</button></a>
                        <button class='action-btn' id="delete-btn" data-id="<?= $s->id ?>">Delete</button>
                    </span>
                </div>
            <?php } ?> <!-- end php -->
        </div>

        <?php foreach ($med_stories as $s) { ?>
            <div class="width-3 mediumStory story" data-id="<?= $s->id ?>">
                <div>
                    <img src="assets/images/<?= $s->img_url ?>" />

                    <div class="content">
                        <h3 class="title lato-black"><?= $s->headline ?></h3>
                        <?= substr($s->article, 0, 175) ?>...
                    </div>

                    <span class="category space-mono-bold"><?= Category::findById($s->category_id)->name ?></span>
                </div>

                <div>
                    <!-- <p>Location: <?= Location::findById($s->location_id)->name ?></p> -->
                    <p class="author space-mono-regular">
                        <?= Author::findById($s->author_id)->first_name . " " . Author::findById($s->author_id)->last_name ?>
                    </p>
                    <p class="date space-mono-bold"><?= $s->created_at ?></p>
                </div>

                <span class="actions">
                    <a href="story_edit.php?id=<?= $s->id ?>" class="edit"><button class="action-btn">Edit</button></a>
                    <button class='action-btn' id="delete-btn" data-id="<?= $s->id ?>">Delete</button>
                </span>
            </div>
        <?php } ?> <!-- end php -->
    </div>

    <!-- block 2 -->
    <div class="container story-block">
        <h1 class="width-12 cat-head">Film</h1>
        <?php foreach ($film_stories as $s) { ?>
            <div class="width-3 mediumStory story" data-id="<?= $s->id ?>">
                <div>
                    <img src="assets/images/<?= $s->img_url ?>" />

                    <div class="content">
                        <h3 class="title lato-black"><?= $s->headline ?></h3>
                        <?= substr($s->article, 0, 175) ?>...
                    </div>

                    <span class="category space-mono-bold"><?= Category::findById($s->category_id)->name ?></span>
                </div>

                <div>
                    <!-- <p>Location: <?= Location::findById($s->location_id)->name ?></p> -->
                    <p class="author space-mono-regular">
                        <?= Author::findById($s->author_id)->first_name . " " . Author::findById($s->author_id)->last_name ?>
                    </p>
                    <p class="date space-mono-bold"><?= $s->created_at ?></p>
                </div>

                <span class="actions">
                    <a href="story_edit.php?id=<?= $s->id ?>" class="edit"><button class="action-btn">Edit</button></a>
                    <button class='action-btn' id="delete-btn" data-id="<?= $s->id ?>">Delete</button>
                </span>
            </div>
        <?php } ?> <!-- end php -->
    </div>

    <!-- block 3 -->
    <div class="container story-block">
        <h1 class="width-12 cat-head">Gaming</h1>
        <?php foreach ($gaming_stories as $s) { ?>
            <div class="width-3 mediumStory story" data-id="<?= $s->id ?>">
                <div>
                    <img src="assets/images/<?= $s->img_url ?>" />

                    <div class="content">
                        <h3 class="title lato-black"><?= $s->headline ?></h3>
                        <?= substr($s->article, 0, 175) ?>...
                    </div>

                    <span class="category space-mono-bold"><?= Category::findById($s->category_id)->name ?></span>
                </div>

                <div>
                    <!-- <p>Location: <?= Location::findById($s->location_id)->name ?></p> -->
                    <p class="author space-mono-regular">
                        <?= Author::findById($s->author_id)->first_name . " " . Author::findById($s->author_id)->last_name ?>
                    </p>
                    <p class="date space-mono-bold"><?= $s->created_at ?></p>
                </div>

                <span class="actions">
                    <a href="story_edit.php?id=<?= $s->id ?>" class="edit"><button class="action-btn">Edit</button></a>
                    <button class='action-btn' id="delete-btn" data-id="<?= $s->id ?>">Delete</button>
                </span>
            </div>
        <?php } ?> <!-- end php -->
    </div>
    <?php require_once "./etc/footer.php"; ?>

    <?php require_once "./etc/deleteConfirmationModal.php"; ?>
</body>

</html>