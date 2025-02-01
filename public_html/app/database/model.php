<?php


require_once './Database.php';

class Model {
    protected $modelo;

    public function __construct() {
        $this->modelo = Database::getInstance();
    }

    // Use only for direct queries without parameters
    public function query(string $query) {
        return $this->modelo->getConnection()->query($query);
    }

    // Use this for prepared statements
    public function prepare(string $query) {
        return $this->modelo->getConnection()->prepare($query);
    }
}
