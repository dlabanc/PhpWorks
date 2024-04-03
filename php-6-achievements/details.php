<?php

require_once 'GameStorage.php';
require_once 'AchievementStorage.php';

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit();
}

$gamesStorage = new GameStorage();
$achStorage = new AchievementStorage();

$game = $gamesStorage->findById($_GET['id']);

if (!$game) {
    header('Location: index.php');
    exit();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task 6</title>
    <link rel="stylesheet" href="src/index.css">
    <link rel="stylesheet" href="src/task.css"></head>
<body>
    <header>
        <h1><?= $game['name'] ?>
    </h1></header>
    
    <div id="content">Achievements:
        <ul>
            <?php foreach($achStorage->findAll() as $achievement): ?>
                <?php if ($achievement['game'] == $game['id']): ?>
                <li><?= $achievement['name']?></li>
                <?php endif ?>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>