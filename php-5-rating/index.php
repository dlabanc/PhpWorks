<?php 

$errors = [];
$data = [];

$ratings = [
    '5-excellent' => 5,
    '4-good' => 4,
    '3-average' => 3,
    '2-bad' => 2,
    '1-terrible' => 1
];

$username = trim($_GET['username'] ?? '');
$email = trim($_GET['email'] ?? '');
$hours = trim($_GET['hours'] ?? '');
$rating = trim($_GET['rating'] ?? '');
$opinion = trim($_GET['opinion'] ?? '');

$nameLength = strlen($username);

if ($nameLength === 0) {
    $errors['username'] = 'A felhasználónév megadása kötelező!';    
} elseif ($nameLength < 8 || $nameLength > 20) {
    $errors['username'] = 'A felhasználónév hossza 8 és 20 karakter közötti lehet!';
}

if (strlen($email) === 0) {
    $errors['email'] = 'Az e-mail cím megadása kötelező!';
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = 'Az e-mail cím formátuma helytelen!';
}


if (strlen($hours) === 0) {
    $errors['hours'] = 'A "játszott órák" megadása kötelező!';
} elseif (!is_numeric($hours)) {
    $errors['hours'] = 'A "játszott órák" csak szám lehet!';
} elseif (!filter_var($hours, FILTER_VALIDATE_INT)) {
    $errors['hours'] = 'A "játszott órák" csak egész szám lehet!';
} else {
    $hours = intval($hours); 
    if ($hours < 0 || $hours > 999) {
        $errors['hours'] = 'A "játszott órák" csak 0 és 999 közötti lehet!';
    }
}

if (strlen($rating) === 0) {
    $errors['rating'] = 'Az értékelés megadása kötelező!';
} elseif (!in_array($rating, array_keys($ratings))) {
    $errors['rating'] = 'Az értékelés csak a megadott lista beli értéket veheti fel!';
}

if (strlen($opinion) === 0) {
    $errors['opinion'] = 'A vélemény megadása kötelező!';
} else {
    if (!isset($errors['rating']) and $rating == "2-bad" and !str_contains($opinion, strtolower("crash"))){
        $errors['opinion'] = 'A véleményben "bad" értékelésnél kötelező a "bug" szó!';
    } elseif (!isset($errors['rating']) and $rating == "1-terrible" and !str_contains($opinion, strtolower("crash"))){
        $errors['opinion'] = 'A véleményben "terrible" értékelésnél kötelező a "crash" szó!';
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task 5</title>
    <link rel="stylesheet" href="src/index.css">
    <link rel="stylesheet" href="src/task.css">
</head>

<body>
    <header>
        <h1>5. Értékelés / Rating</h1>
    </header>

    <div id="content">
        <h2>Értékeld / Rate : Fallout 4</h2>
        <form novalidate>
            <div class="input">
                <label for="username">Felhasználónév / Username</label>
                <input type="text" name="username" id="username" placeholder="Felhasználónév / Username">
            </div>
            <div class="input">
                <label for="email">E-mail cím / E-mail address</label>
                <input type="email" name="email" id="email" placeholder="E-mail cím / E-mail address">
            </div>
            <div class="input">
                <label for="hours">Hány órád van a játékban? / How many hours do you have in the game?</label>
                <input type="number" name="hours" id="hours" placeholder="Hány órád van a játékban / How many hours do you have in the game?">
            </div>
            <div class="input">
                <label for="rating">Értékelés / Rating</label>
                <select name="rating" id="rating">
                    <option value="5-excellent">Nagyon jó / Excellent</option>
                    <option value="4-good">Jó / Good</option>
                    <option value="3-average">Átlagos / Average</option>
                    <option value="2-bad">Rossz / Bad</option>
                    <option value="1-terrible">Nagyon rossz / Terrible</option>
                </select>
            </div>
            <div class="input">
                <label for="opinion">Vélemény / Opinion</label>
                <textarea name="opinion" id="opinion" placeholder="Vélemény / Opinion"></textarea>
            </div>
            <div class="input">
                <button type="submit">Küldés / Send</button>
            </div>
        </form>
        <?php if(count($errors) !== 0): ?>
        <div id="error">
            <img src="img/error.jpg">
            <ul>
                <?php foreach($errors as $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php else: ?>
        <div id="success">
            <img src="img/success.jpg">
        </div>
        <?php endif; ?>
    </div>

    <div id="testing">
        <h2>Linkek a teszteléshez / Links for testing</h2>
        <div>A megoldásod nem elég, ha helyes eredményt ad ezekre a tesztekre! Ez csak segítség, ha szeretnéd ellenőrizni.</div>
        <div>Your solution is not necessarily correct if it passes these tests! This is just a help if you want to check.</div>

        <ul>
            <li><a href="index.php?username=tesztteszt&email=teszt%40teszt.hu&hours=10&rating=5-excellent&opinion=teszt">Helyes / Correct</a></li>
            <li><a href="index.php?username=&email=teszt%40teszt.hu&hours=10&rating=5-excellent&opinion=teszt">Hiányzó felhasználónév / Missing username</a></li>
            <li><a href="index.php?username=teszt&email=teszt%40teszt.hu&hours=10&rating=5-excellent&opinion=teszt">Túl rövid felhasználónév / Too short username</a></li>
            <li><a href="index.php?username=tesztteszt&email=&hours=10&rating=5-excellent&opinion=teszt">Hiányzó e-mail cím / Missing e-mail address</a></li>
            <li><a href="index.php?username=tesztteszt&email=almafa&hours=10&rating=5-excellent&opinion=teszt">Hibás e-mail cím / Invalid e-mail address</a></li>
            <li><a href="index.php?username=tesztteszt&email=teszt%40teszt.hu&hours=&rating=5-excellent&opinion=teszt">Hiányzó játszott órák / Missing hours</a></li>
            <li><a href="index.php?username=tesztteszt&email=teszt%40teszt.hu&hours=-10&rating=5-excellent&opinion=teszt">Hibás játszott órák (negatív) / Invalid hours (negative)</a></li>
            <li><a href="index.php?username=tesztteszt&email=teszt%40teszt.hu&hours=10.5&rating=5-excellent&opinion=teszt">Hibás játszott órák (nem egész) / Invalid hours (non-integer)</a></li>
            <li><a href="index.php?username=tesztteszt&email=teszt%40teszt.hu&hours=ten&rating=5-excellent&opinion=teszt">Hibás játszott órák (szöveg) / Invalid hours (text)</a></li>
            <li><a href="index.php?username=tesztteszt&email=teszt%40teszt.hu&hours=10&rating=&opinion=teszt">Hiányzó értékelés / Missing rating</a></li>
            <li><a href="index.php?username=tesztteszt&email=teszt%40teszt.hu&hours=10&rating=teszt&opinion=teszt">Hibás értékelés / Invalid rating</a></li>
            <li><a href="index.php?username=tesztteszt&email=teszt%40teszt.hu&hours=10&rating=5-excellent&opinion=">Hiányzó vélemény / Missing opinion</a></li>
            <li><a href="index.php?username=tesztteszt&email=teszt%40teszt.hu&hours=10&rating=2-bad&opinion=teszt">Hibás vélemény "bad" értékelésnél / Invalid opinion at "bad" rating</a></li>
            <li><a href="index.php?username=tesztteszt&email=teszt%40teszt.hu&hours=10&rating=1-terrible&opinion=teszt">Hibás vélemény "terrible" értékelésnél / Invalid opinion at "terrible" rating</a></li>
        </ul>
    </div>
</body>

</html>