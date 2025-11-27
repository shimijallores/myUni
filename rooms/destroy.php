<?php

require('../functions.php');
require('../partials/database.php');

try {
    // Delete from teachers table
    $stmt = $connection->prepare("delete from teachers where id = ?");

    $stmt->execute([$_POST['id']]);
} catch (Exception $e) {
    $_SESSION['redirect'] = 'index.php';

    header("Location: 404.php");
    exit();
}

header("Location: index.php");
exit();
