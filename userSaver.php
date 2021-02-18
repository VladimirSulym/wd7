<?php

include 'db.php';

if (!empty($_POST['id'])) {
    $sql = "UPDATE users SET login='" . $psql->escape($_POST['login']) . "'";
    if (!empty($_POST['password'])) {
        $sql .= ", password='" . md5($_POST['password']) . "'";
    }
    $sql .= " WHERE id=" . $psql->escape($_POST['id']);
} else {
    $sql = "INSERT INTO users (login, password) VALUES ('" . $psql->escape($_POST['login']) . "', '" . md5($_POST['password']) . "')";
}
$psql->query($sql);

echo json_encode([
    'success' => 1
]);
//header('Location: /users.php');