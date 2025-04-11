<?php

try {
    $categories = Category::findAll();
} catch (Exception $e) {
    echo $e->getMessage();
    exit();
}
?>
<div id="navbar">
    <div class="container-no-padding">
        <ul class="navbar-items width-12">
            <li><a href="index.php">Home</a></li>

            <?php foreach ($categories as $c) { ?>
                <li><a href="story_by_category.php?id=<?= $c->id ?>"><?= $c->name ?></a></li>
            <?php } ?>

            <li id="login-li">
                <a href="login.php">Login</a>
            </li>

            <div class="dropdown">
                <li><button id="dropbtn">Admin</button>
                </li>

                <div class="dropdown-content">
                    <a href="story_create.php">Add Story</a>
                    <!-- <button id="toggle-edit">Edit Stories</button> -->
                    <a href="story_table.php">View All</a>
                    <a href="logout.php">Logout</a>
                </div>
        </ul>
    </div>
</div>