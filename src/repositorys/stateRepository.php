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

    public function find(string $phone): array|bool
    {
        $stmt = $this->prepare("SELECT type_state FROM states WHERE phone = :phone LIMIT 1");
        $stmt->bindValue(':phone', $phone);
        $stmt->execute();
        
        if ($stmt->rowCount() == 1) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        return [];
    }

    /**
     * Añade un nuevo estado
     */
    public function add(array $datos): bool
    {
        $stmt = $this->prepare("INSERT INTO states (type_state, phone) VALUES (:type_state, :phone)");
        $stmt->bindValue(':phone', $datos['phone']);
        $stmt->bindValue(':type_state', $datos['type']);
        return $stmt->execute();
    }

    /**
     * Actualiza un estado existente
     */
    public function update(array $datos): bool
    {
        $stmt = $this->prepare("UPDATE states SET type_state = :type_state WHERE phone = :phone");
        $stmt->bindValue(':phone', $datos['phone']);
        $stmt->bindValue(':type_state', $datos['type']);
        return $stmt->execute();
    }
}