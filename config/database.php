<?php

namespace Config;

use Config\Connection as conn;
use Dotenv\Dotenv as Envloader;
require_once __DIR__.'/conn.php';
require_once __DIR__.'/../vendor/autoload.php';

final class createDatabase
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
                $conn->conn->select_db($this->database);
                echo json_encode(["success"=>"Database '{$this->database}' created successfully.<br>"]);
                exit();
            } else {
                echo json_encode(["error"=>"Error creating database '{$this->database}': " . $conn->conn->error]);
                exit();
            }
        } else {
            $conn->conn->select_db($this->database);
            error_log("Database 'WebService' already exists.");
            error_log("Selecting the database...");
        }
    }
}

