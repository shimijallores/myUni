<?php

require('../functions.php');
require('../partials/database.php');

try {
    // Delete from subjects table
    $stmt = $connection->prepare("delete from subjects where id = ?");

    $stmt->execute([$_POST['id']]);
} catch (Exception $e) {
    $_SESSION['redirect'] = 'index.php';

    header("Location: 404.php");
    exit();
}

header("Location: index.php");
exit();
