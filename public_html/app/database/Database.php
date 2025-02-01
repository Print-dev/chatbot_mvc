<?php


use PDO;
use PDOException;

// conexion a la base de datos
// Se aplico el patron Singleton para evitar multiples conexiones a la base de datos
class Database
{
    private $host;
    private $db;
    private $user;
    private $password;
    private $charset;

    private $connection;

    // Nos ayudara a determinar si ya existe una instancia de la conexion
    private static $instance = null;

    public function __construct()
    {
        
        $this->host = $_ENV['HOST'];
        $this->db = $_ENV['DB'];
        $this->user = $_ENV['USER'];
        $this->password = $_ENV['PASSWORD'];
        $this->charset = $_ENV['CHARSET'];

        $this->connect();
    }

    static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new Database();
        }

        return self::$instance;
    }

    // Conectamos a la DB
    private function connect()
    {
        try {
        $connectionString = "mysql:host={$this->host};dbname={$this->db};charset={$this->charset}";
        $options = [
            PDO::ATTR_PERSISTENT => false,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        $this->connection = new PDO($connectionString, $this->user, $this->password, $options);
        } catch (PDOException $e) {
        error_log('Database::connect() -> ' . $e->getMessage());
        die('Database connection failed: ' . $e->getMessage());
        }
    }
    
    public function getConnection()
    {
        return $this->connection;
    }
    public function lastInsertId()
    {
        return $this->connection->lastInsertId(); // Método agregado
    }
}