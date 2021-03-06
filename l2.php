<?php
include 'db.php';

$resp = ['success' => 0, 'string' => ''];
if (!empty($_POST['string'])) {
    $psql->query("INSERT INTO text (string) VALUES ('" . $psql->escape($_POST['string']) . "')");
    $resp['success'] = 1;
    $resp['string'] = $_POST['string'];
}
echo json_encode($resp);
//header('Location: /l1.php');