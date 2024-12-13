<?php
namespace Controller;

require_once __DIR__.'/../config/conn.php';
require __DIR__.'/status.php';

use Config\Connection as Connection;
use Status;

// use Controller\Exception;

$conn = new Connection();


final class Users extends Status{
   private $conn;

   private $tableName = "UserTable";
   function __construct(Connection $conn)
   {
      $this->conn = $conn;
   }

   function status(int $int, mixed $message)
   {
      http_response_code($int);
      echo json_encode(["status" => $int, "message" => $message]);
      exit();
   }


   function getAllUsers(){

      try {
         {   
            header("Content-Type: application/json");
            $query = "SELECT * FROM $this->tableName";
            $result = $this->conn->conn->query($query);
            if ($result->num_rows == 0) {
               $this->status(200, "0 Results");
            } else {
                  $users = [];
                  while ($row = $result->fetch_assoc()) {
                     $users[] = [
                        "id" => $row["id"],
                        "username" => $row["username"],
                        "email" => $row["email"],
                        // "password" => $row["password"],
                        "createdAt" => $row["createdAt"],
                        "updatedAt" => $row["updatedAt"]
                     ];
                  }
                  $this->status(200,$users);
            }
         }
      }catch(\Exception $e) {

         $this->status(500, "An unexpected error occurred: " . $e->getMessage());
     }
   }
   

   function getOneUser($id)
   {
      try {
         {   
            header("Content-Type: application/json");
            $query = "SELECT * FROM $this->tableName where id = $id";
            $result = $this->conn->conn->query($query);
            if($result->num_rows == 0 ){
               $this->status(400,"No user exist");
            } else {
               $users = [];
               while ($row = $result->fetch_assoc()) {
                  $users[] = [
                     "id" => $row["id"],
                     "username" => $row["username"],
                     "email" => $row["email"],
                     // "password" => $row["password"],
                     "createdAt" => $row["createdAt"],
                     "updatedAt" => $row["updatedAt"]
                  ];
               }
               echo json_encode(["status" => 200, "users" => $users]);
            }
         }
      } catch (\Exception $e) {
         $this->status(500, "An unexpected error occurred: " . $e->getMessage());
      }
   }

   function createUser(){
      try {
         header("Content Type: application/json");
         $decoded_data = json_decode(file_get_contents('php://input'),true);
         if(isset($decoded_data)&& is_array($decoded_data)){
            $username = $decoded_data['username'];
            $email = $decoded_data['email'];
            $password = $decoded_data['password']; $options = ["cost"=>12];
            $password = password_hash($password, PASSWORD_DEFAULT, $options);

            $searchUsernameQuery = "SELECT * FROM $this->tableName WHERE username = '$username'";

            $searchQuery = $this->conn->conn->query($searchUsernameQuery);
            if ($searchQuery->num_rows > 0) {
               $this->status(409, "User already exists");
               exit(0);
            } else {
                  $stmt = $this->conn->conn->prepare("INSERT INTO $this->tableName (`username`, `email`, `password`) VALUES (?, ?, ?)");
                  $stmt->bind_param("sss", $username, $email, $password);
                  if ($stmt->execute()) {
                     session_start();

                     $_SESSION["session_username"] = $username;
                     $this->status(201, "User created successfully, username = {$_SESSION['session_username']}");
                  } else {
                     $this->status(500, "Error creating user: " . $stmt->error);
                  }
            }
            
         }
      } catch (\Exception $e) {
         $this->status(500, "An unexpected error occurred: " . $e->getMessage());
      }
   }

   // function UpdateUser($id){
   //    try {
   //       header("Content Type: application/json");
   //       $query = "";
   //    } catch (\Exception $e) {
   //       $this->status(500, "An unexpected error occurred: " . $e->getMessage());
   //    }
   // }

   function deleteUser($id){
      try {
         header("Content Type: application/json");
         $query = "DELETE FROM `$this->tableName` where id = $id";
         $result = $this->conn->conn->query($query);
         if($result){
            $this->status(200,"User deleted successfully");
         }else{
            $this->status(400,"User not deleted");
         }
      } catch (\Exception $e) {
         $this->status(500, "An unexpected error occurred: " . $e->getMessage());
      }
   }
}