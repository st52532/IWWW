<?php
ob_start();
session_start();
include "config.php";
?>
<html lang="en">
<head>
    <title>Login Example</title>
</head>
<body>
<nav>
    <a href="<?= BASE_URL; ?>">Home</a>
    <a href="<?= BASE_URL . "?page=blog" ?>">Blog</a>

    <?php if (!empty($_SESSION["user_id"])) { ?>
        <a href="<?= BASE_URL . "?page=users" ?>">Users</a>
        <a href="<?= BASE_URL . "?page=logout" ?>">Logout</a>
    <?php } else { ?>
        <a href="<?= BASE_URL . "?page=login" ?>">Login</a>
    <?php } ?>
</nav>

<?php


$file = "./page/" . $_GET["page"] . ".php";
if (file_exists($file)) {
    include $file;
} else {
    echo "<h1>This is home page</h1>";
}

?>

</body>
</html>