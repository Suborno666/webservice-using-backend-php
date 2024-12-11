<?php
namespace Controller;

require_once __DIR__.'/../config/conn.php';

use Config\Connection as Connection;

// use Controller\Exception;

$conn = new Connection();

class Users{
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
            $query = "INSERT INTO $this->tableName (`username`, `email`) VALUES('$username','$email')";
            $result = $this->conn->conn->query($query);
            if($result){
               $this->status(200,"User created successfully");
            }
         }
      } catch (\Exception $e) {
         $this->status(500, "An unexpected error occurred: " . $e->getMessage());
      }
   }

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