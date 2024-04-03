<?php

require_once 'AchievementStorage.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit();
}

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit();
}

$achStorage = new AchievementStorage();
$achievement = $achStorage->delete($_GET['id']);

header('Location: index.php');
