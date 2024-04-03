<?php 

require_once "Storage.php";

class GameStorage extends Storage {
    public function __construct(){
        parent::__construct(new JsonIO("data_games.json"));
    }
}