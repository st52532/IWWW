<?php
ob_start();
session_start();
include "config.php";
function _autoload($className){
    if(file_exists('./class/'.$className.'.php')){
        require_once './class/'.$className.'.php';
        return true;
    }
    return false;
}
?>
<html lang="en">
<head>
    <title>PHP OOP example</title>
</head>
<body>
<nav>
    <a href="<?= BASE_URL; ?>">Home</a>
   <!-- <a href="<?= BASE_URL . "?page=blog" ?>">Blog</a>-->
    <a href="<?= BASE_URL . "?page=user&action=read-all" ?>">Read all</a>
    <a href="<?= BASE_URL . "?page=user&action=by-email" ?>">By email</a>
    <a href="<?= BASE_URL . "?page=logout" ?>">Logout</a>
    <a href="<?= BASE_URL . "?page=login" ?>">Login</a>

   <!-- <?php if (!empty($_SESSION["user_id"])) { ?>
        <a href="<?= BASE_URL . "?page=users" ?>">Users</a>
        <a href="<?= BASE_URL . "?page=logout" ?>">Logout</a>
    <?php } else { ?>
        <a href="<?= BASE_URL . "?page=login" ?>">Login</a>
    <?php } ?>-->
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