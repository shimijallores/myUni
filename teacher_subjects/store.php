<?php

require('../functions.php');
require('../partials/database.php');

session_start();


// Add new room
try {
    $stmt = $connection->prepare("insert into rooms (name) values (?);");

    $stmt->execute([$_POST['name']]);
} catch (Exception $e) {
    $_SESSION['redirect'] = 'create.php';

    header("Location: 404.php");
    exit();
}

header("Location: index.php");
exit();
