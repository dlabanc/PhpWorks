<?php

require_once 'AchievementStorage.php';

// ha nem POST kérés akkor ne csináljunk semmit
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit();
}

$storage = new AchievementStorage();

// ha már létezik frissítsük
$achievement = $storage->findOne(['name' => $_POST['name']]);

if ($achievement) {
    $storage->update($achievement['id'], [
        'id' => $achievement['id'],
        'name' => $_POST['name'],
        'desc' => $_POST['desc'],
        'game' => $_POST['game']
    ]);
} else {
    // id-t majd a storage magátal hozzáadja
    // danger már $_POST-ba tömbként kerül bele 
    $storage->add([
        'name' => $_POST['name'],
        'desc' => $_POST['desc'],
        'game' => $_POST['game']
    ]);
}

header('Location: index.php');
