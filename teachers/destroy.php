<?php

require('../functions.php');
require('../partials/database.php');

dd($_POST);

// Delete from teachers table
$stmt = $connection->prepare("
    delete from teachers where id = ?
");

$stmt->execute([$_POST['id']]);

header("Location: index.php");
exit();
