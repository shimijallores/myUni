<?php

require('../functions.php');
require('../partials/database.php');

session_start();

// Update subject
try {
    $stmt = $connection->prepare("
        update subjects set code = ?, description = ?, days = ?, time = ?, room_id = ?, teacher_id = ?, price_unit = ?, units = ? where id = ?;
    ");

    $stmt->execute([
        $_POST['code'],
        $_POST['description'],
        $_POST['days'],
        $_POST['time'],
        $_POST['room'],
        $_POST['teacher'],
        $_POST['price_unit'],
        $_POST['units'],
        $_POST['id']
    ]);
} catch (Exception $e) {
    $_SESSION['redirect'] = 'edit.php?id=' . $_POST['id'];

    header("Location: 404.php");
    exit();
}

header("Location: index.php");
exit();
