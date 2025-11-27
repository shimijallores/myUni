<?php

require('../functions.php');
require('../partials/database.php');

session_start();

// Update teacher
try {
    $stmt = $connection->prepare("
        update teachers set code = ?, name = ? where id = ?;
    ");

    $stmt->execute([$_POST['code'], $_POST['name'], $_POST['id']]);
} catch (Exception $e) {
    $_SESSION['redirect'] = 'edit.php?id=' . $_POST['id'];

    header("Location: 404.php");
    exit();
}

header("Location: index.php");
exit();
