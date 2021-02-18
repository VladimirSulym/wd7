<?php

include 'db.php';

$psql->query('DELETE FROM users WHERE id=' . $psql->escape($_GET['id']));


echo json_encode([
    'success' => 1
]);
//header('Location: /users.php');