<?php

use Config\Connection;
use Config\createDatabase as createDatabase;
use Models\UserTable as userTable;

require_once __DIR__.'/config/conn.php';
require_once __DIR__.'/config/database.php';
require_once __DIR__.'/Models/userTable.php';

$method = $_SERVER['REQUEST_METHOD'];
$serverUri = $_SERVER['REQUEST_URI'];
$host = $_SERVER['HTTP_HOST'];
$url = "http://$host$serverUri";

$url_name = '/new_webservice';

$conn = new Connection;
$database = new createDatabase($conn);



switch ($method) {
    case "GET":
        if ($serverUri === "$url_name/user/all" ) {
            echo "Fetching all users...";

        }else if($serverUri === "$url_name/createTable"){
            $userTable = new userTable($conn);
            if($userTable){
                echo 'Table Created';
            }
        } 
        else {
            echo "Invalid GET route.";
        }
        break;

    case "POST":
        if ($serverUri === "/new_webservice/user/one") {
            echo "Creating a new user...";
        } else {
            echo "Invalid POST route.";
        }
        break;

    case "PUT":
        if ($serverUri === "/new_webservice/user/put") {
            echo "Updating user...";
        } else {
            echo "Invalid PUT route.";
        }
        break;

    case "DELETE":
        if ($serverUri === "/new_webservice/user/del") {
            echo "Deleting user...";
        } else {
            echo "Invalid DELETE route.";
        }
        break;

    default:
        echo "Unsupported HTTP method.";
        break;
}

?>
