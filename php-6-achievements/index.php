<?php 

require_once 'GameStorage.php';
require_once 'AchievementStorage.php';


$gamesStorage = new GameStorage();
$achStorage = new AchievementStorage();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task 6</title>
    <link rel="stylesheet" href="src/index.css">
    <link rel="stylesheet" href="src/task.css">
</head>

<body>
    <header>
        <h1>6. Teljesítmények / Achievements</h1>
    </header>

    <div id="content">
        <form method="post" action="add.php">
            <div class="input">
                <label for="name">Teljesítmény neve / Achievement name</label>
                <input type="text" name="name" id="name" placeholder="Teljesítmény neve / Achievement name">
            </div>
            <div class="input">
                <label for="desc">Leírás / Description</label>
                <textarea name="desc" id="desc" placeholder="Leírás / Description"></textarea>
            </div>
            <div class="input">
                <label for="game">Játék / Game</label>
                <select name="game" id="game">
                    <?php foreach($gamesStorage->findAll() as $game): ?>
                        <option value="<?= $game['id']?>"><?= $game['name']?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="input">
                <button type="submit">➕</button>
            </div>
        </form>

        <table id="achievements">
            <thead>
                <tr>
                    <th>Játék / Game</th>
                    <th>Teljesítmény neve / Achievement name</th>
                    <th>Leírás / Description</th>
                    <th>Törlés</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                foreach($achStorage->findAll() as $achievement): ?>
                    <tr>
                        <td><a href="details.php?id=<?=$gamesStorage->findById($achievement['game'])['id']?>"><?= $gamesStorage->findById($achievement['game'])["name"]?></a></td>
                        <td><?= $achievement['name']?></td>
                        <td>
                        <?= $achievement['desc']?>
                        </td>
                        <td><form method="post" action='delete.php?id=<?= $achievement['id'] ?>'><button>🚯</button></form></td>
                    </tr>
                <?php endforeach ?>
            </tbody>      
        </table>
    </div>
</body>

</html>