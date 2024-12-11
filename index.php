<?php

use Config\Connection;
use Config\createDatabase as createDatabase;
use Models\UserTable as userTable;
use Controller\Users as Users;

require_once __DIR__.'/config/conn.php';
require_once __DIR__.'/config/database.php';
require_once __DIR__.'/Models/userTable.php';
require __DIR__.'/Controller_lists.php';

$method = $_SERVER['REQUEST_METHOD'];
$serverUri = $_SERVER['REQUEST_URI'];
$host = $_SERVER['HTTP_HOST'];

$arr_url   = explode('/',$serverUri);

$id = (int)$arr_url[3];

$url_name = '/new_webservice';

$conn = new Connection;
$database = new createDatabase($conn);

$Users = new Users($conn);

switch ($method) {
    case "GET":
        if ($serverUri === "$url_name/user/all" ) {
            echo "Fetching all users...<br>";
            $Users->getAllUsers();

        }else if($serverUri === "$url_name/createTable"){
            $userTable = new userTable($conn);
            if($userTable){
                echo 'Table Created';
            }
        } else if($serverUri === "$url_name/user/$id"){
            echo $id."<br>";
            $Users->getOneUser($id);
        } 
        else {
            echo "Invalid GET route.";
        }
        break;

    case "POST":
        if ($serverUri === "$url_name/user/one") {
            echo "Creating a new user...";
        } else {
            echo "Invalid POST route.";
        }
        break;

    case "PUT":
        if ($serverUri === "$url_name/user/put") {
            echo "Updating user...";
        } else {
            echo "Invalid PUT route.";
        }
        break;

    case "DELETE":
        if ($serverUri === "$url_name/user/del") {
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
