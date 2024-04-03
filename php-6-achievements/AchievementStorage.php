<?php 

require_once "Storage.php";

// kiterjesztett osztály, hogy ne kelljen mindig slopes.json fájlnevet irogatni
class AchievementStorage extends Storage {
    public function __construct(){
        parent::__construct(new JsonIO("data_achievements.json"));
    }
}