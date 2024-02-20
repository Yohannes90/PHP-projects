<?php require "includes/header.php"; ?>

<?php
    if ($_SESSION['username']) {
        echo("Welcome " . $_SESSION['username']);
    }
?>

<?php require "includes/footer.php"; ?>
