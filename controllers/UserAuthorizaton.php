<?php

namespace Controller;

require_once __DIR__."/../config/conn.php";

use Config\Connection as Connection;
use Status;

final class Auth extends Status{

    private $conn;
    private $tableName = "UserTable";
    function __construct(Connection $conn)
    {
        $this->conn = $conn;
    }

    function Login(){
        header("Content Type: application/json");
        $login_data = json_decode(file_get_contents("php://input"),true);
        $username = $login_data['username'];
        $stmt = $this->conn->conn->prepare("SELECT * FROM {$this->tableName} where `username` = ?");
        $stmt->bind_param('s',$username);
        if($stmt->execute()){
            $this->status(200,'Logged In');
        }
        
    }
}