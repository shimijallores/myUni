<?php

require('../functions.php');
require('../partials/database.php');

session_start();

// Store new teacher to students table
try {
    $stmt = $connection->prepare("
    insert into teachers (code, name) values (?, ?);
");

    $stmt->execute([$_POST['code'], $_POST['name']]);

    $stmt = $connection->prepare("
    insert into users (name, password, role) values (?, ?, ?);
");

    $stmt->execute([$_POST['code'], $_POST['code'], 'teacher']);
} catch (Exception $e) {
    $_SESSION['redirect'] = 'create.php';

    header("Location: 404.php");
    exit();
}

header("Location: index.php");
exit();
