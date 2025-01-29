<?php

namespace Rogelio\ChatBotMvc\Repositorys;

use PDO;
use Rogelio\ChatBotMvc\Database\Model;

class stateRepository extends Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function find(string $number): bool {
        $stmt = $this->prepare("SELECT number_user, type_information, additional_info FROM user_states WHERE number_user = :number_user LIMIT 1");
        $stmt->bindValue(':number_user', $number);
        $stmt->execute();
        if ($stmt->rowCount() == 1) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            return $user;
        }
        return false;
    }
     /**
     * Add State
     */
    public function add(array $datos): bool
    {
        // $stmt = $this->prepare("INSERT INTO user_states (number_user, type_information, additional_info) VALUES (:number_user, :type_information, :additional_info)");
        // $stmt->bindValue(':number_user', $datos['number']);
        // $stmt->bindValue(':type_information', $datos['type']);
        // $stmt->bindValue(':additional_info', $datos['additional_info']);
        // return $stmt->execute();
    }
    /**
     * Update State
     */
    public function update(array $datos): bool
    {
        // $stmt = $this->prepare("UPDATE user_states SET type_information = :type_information, additional_info = :additional_info WHERE number_user = :number_user");
        // $stmt->bindValue(':number_user', $datos['number']);
        // $stmt->bindValue(':type_information', $datos['type']);
        // $stmt->bindValue(':additional_info', $datos['additional_info']);
        // return $stmt->execute();
    }

}