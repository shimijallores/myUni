<?php

require('../functions.php');
require('../partials/database.php');

session_start();

// Add new subject
try {
    $stmt = $connection->prepare("insert into subjects (code, description, days, time, price_unit, units, room_id, teacher_id) values (?, ?, ?, ?, ?, ?, ?, ?);");

    $stmt->execute([
        $_POST['code'],
        $_POST['description'],
        $_POST['days'],
        $_POST['time'],
        $_POST['price_unit'],
        $_POST['units'],
        $_POST['room'],
        $_POST['teacher'],
    ]);
} catch (Exception $e) {
    $_SESSION['redirect'] = 'create.php';

    header("Location: 404.php");
    exit();
}

header("Location: index.php");
exit();
