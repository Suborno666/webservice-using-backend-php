<?php

use Config\Connection;
use Config\createDatabase as createDatabase;
use Models\UserTable as userTable;
use Controller\Users as Users;
use Controller\Auth as Auth;

require_once __DIR__.'/config/conn.php';
require_once __DIR__.'/config/database.php';
require_once __DIR__.'/Models/userTable.php';
require __DIR__.'/Controller_lists.php';

$method = $_SERVER['REQUEST_METHOD'];
$serverUri = $_SERVER['REQUEST_URI'];
$host = $_SERVER['HTTP_HOST'];

$id = isset($_GET['id'])?$_GET['id']:'';

$url_name = '/new_webservice';

$conn = new Connection;
$database = new createDatabase($conn);

$Users = new Users($conn);
$Auth = new Auth($conn);

switch ($method) {
    case "GET":
        if ($serverUri === "$url_name/user/all" ) {
            
            $Users->getAllUsers();

        }else if($serverUri === "$url_name/createTable"){
            
            $userTable = new userTable($conn);
            if($userTable){
                echo json_encode(["message"=>"Success"]);
            }
        
        } else if($serverUri === "$url_name/user?id=$id"){
        
            $Users->getOneUser($id);
        
        } 
        else {
            // echo "Invalid GET route.";
        }
        break;

    case "POST":
        
        // Creating User
        if ($serverUri === "$url_name/user/create/one") {
            $Users->createUser();
        }

        // Logging In
        elseif ($serverUri === "$url_name/login") {
            $Auth->Login();
        } 
        
        else {
            echo "Invalid POST route.";
        }
        break;

    case "PUT":
        if ($serverUri === "$url_name/user/put?id=$id") {
            echo "Updating user...";
        } else {
            echo "Invalid PUT route.";
        }
        break;

    case "DELETE":
        if ($serverUri === "$url_name/user/del?id=$id") {
            $Users->deleteUser($id);
        }
        break;

    default:
        echo "Unsupported HTTP method.";
        break;
}

?>
