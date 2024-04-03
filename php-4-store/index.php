<?php
require_once "data.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task 4</title>
    <link rel="stylesheet" href="src/index.css">
    <link rel="stylesheet" href="src/task.css">
</head>

<body>
    <header>
        <div>
            <img src="<?= $store_logo ?>" alt="logo">
        </div>
        <h1>4. Store</h1>
    </header>

    <div id="content">
        <!-- Az induló HTML kódot töröld ki és helyette generáld le a data.php fájlból a játékokat -->
        <!-- Delete the starting HTML code and generate the games from the data.php file -->
        <?php foreach($games_associative as $game): ?>
            <div class="game">
                <!-- Ez egy sima játék leárazás nélkül -->
                <!-- This is a normal game without discount -->
                <img src="./img/<?= $game["image"]?>.jpg" title="<?= $game["name"]?>">
                <div class="info">
                    <?php if ($game["price"] > 0 and $game["sale"] == 0): ?>
                        <span><?= $game["price"] ?>€</span>
                    <?php elseif ($game["price"] > 0 and $game["sale"] != 0): ?>
                        <span class="sale">-<?= $game["sale"] ?>%</span>
                        <span class="original"><?= $game["price"] ?>€</span>
                        <span class="final"><?= number_format($game["price"]*((100-$game["sale"])*0.01),2)?>€</span>
                    <?php elseif ($game["price"] == 0):?>
                        <span>Free to Play</span>        
                    <?php elseif ($game["price"] < 0):?>
                        <span>Add to your wishlist</span>
                    <?php endif ?>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</body>

</html>

<!--Minden div.game elembe helyezz el egy info stílusosztályú elemet, melynek tartalma:
e) 1 pont: Sima játék leárazás nélkül: Ha a játék price attribútuma egy pozitív szám, és a sale értéke nulla, a div.info elembe egy sima span elembe írd ki a játék árát, egy € jellel a végén. (Például: 59.99€)
f) 2 pont: Sima játék leárazással: Ha a játék price attribútuma egy pozitív szám, és a sale értéke nem nulla, a div.info elembe három span elem kerül. Minden kiírt ár két tizedesjegy pontossággal jelenjen meg! A leárazás mértéke maradjon sima egész szám tizedes nélkül! (Például: 60.00€, -60%) Segítség: használd a number_format függvényt.
span.sale: a leárazás mértéke negatív százalékban (pl. -60%)
span.original: a játék ára a leárazás nélkül, egy € jellel a végén (pl. 59.99€)
span.final: a játék kedvezményes ára, egy € jellel a végén (pl. 23.99€)
g) 1 pont: Ingyenes játék: Ha a játék price attribútuma nulla, a div.info elembe egy span elembe írd ki, hogy Free to Play.
h) 1 pont: Meg nem jelent játék: Ha a játék price attribútuma egy negatív szám, a div.info elembe egy span elembe írd ki, hogy Add to your wishlist.-->