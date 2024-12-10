<?php

namespace Config;

use Config\Connection as conn;
use Dotenv\Dotenv as Envloader;
require_once __DIR__.'/conn.php';
require_once __DIR__.'/../vendor/autoload.php';

class createDatabase
{
    private $database;

    function __construct(conn $conn)
    {
        $dotenv = Envloader::createImmutable(__DIR__ . '/..');
        $dotenv->load();
        $this->database = $_ENV['DB_NAME'];

        $check_query = "SHOW DATABASES LIKE '{$this->database}'";
        $result = $conn->conn->query($check_query);

        if ($result->num_rows == 0) { 
            $create_query = "CREATE DATABASE {$this->database}";

            if ($conn->conn->query($create_query) === TRUE) {
                echo "Database '{$this->database}' created successfully.<br>";
                echo "selecting the database...<br>";
                $conn->conn->select_db($this->database);
            } else {
                echo "Error creating database '{$this->database}': " . $conn->conn->error;
            }
        } else {
            echo "Database '{$this->database}' already exists.<br>";
            echo "selecting the database...<br>";
            $conn->conn->select_db($this->database);
        }

    }
}

