<?php
include 'db.php';

if (!empty($_GET['id'])) {
    $psql->query("delete from text where string='" . $psql->escape($_GET['id']) . "'");
}

header('Location: /l1.php');