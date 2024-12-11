<?php

namespace Models;

require_once __DIR__.'/../config/conn.php';
require_once __DIR__.'/../config/database.php';


use Config\Connection as conn;

class UserTable{
    function __construct(conn $conn)
    {
        $query = "CREATE TABLE IF NOT EXISTS `UserTable`(
            id INT(6) AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(50),
            email VARCHAR(50),
            password VARCHAR(50),
            createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            )";
        $result = $conn->conn->query($query);
        if($result === TRUE){
            return true;
        }elseif(!$result === TRUE){
            return false;
        }
    }
}