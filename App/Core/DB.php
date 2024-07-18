<?php

namespace App\Core;

use PDO;
use PDOException;

class DB
{

    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbName = DB_NAME;
    private $driver = DB_DRIVER;

    private $conn;
    private $stmt;
    public function __construct()
    {
        // data source name
        $dsn = "$this->driver:host=$this->host;dbname=$this->dbName";
        $option = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_PERSISTENT => true
        ];

        try {
            $this->conn = new PDO($dsn, $this->user, $this->pass, $option);

        } catch (PDOException $e) {
            abort(401, $e->getMessage());
        }
    }

    public function query($query): void
    {
        $this->stmt = $this->conn->prepare($query);

    }

    public function bind($param, $value, $type = null): void
    {

        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }

        $this->stmt->bindValue($param, $value, $type);

    }

    public function execute()
    {
        $this->stmt->execute();
        return $this->stmt;
    }


    public function update()
    {
    }

}