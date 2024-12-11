<?php
namespace Controller;

require_once __DIR__.'/../config/conn.php';

use Config\Connection as Connection;

$conn = new Connection();

class Users{
   private $conn;

   function __construct(Connection $conn)
   {
      $this->conn = $conn;
   }
   function getAllUsers()
   {   
      $query = "SELECT * FROM `UserTable`";
      $result = $this->conn->conn->query($query);
      if($result->num_rows == 0 ){
         echo "0 Results <br>";
      }elseif($result->num_rows != 0){
         while($row = $result->fetch_assoc()){
            echo "id: " . $row["id"]. " - Username: " . $row["username"]. " " ."<br>";
         }
      }
   }

   function getOneUser($id)
   {   
      $query = "SELECT * FROM `UserTable` where id = $id";
      $result = $this->conn->conn->query($query);
      if($result->num_rows == 0 ){
         echo "0 Results <br>";
      }elseif($result->num_rows != 0){
         while($row = $result->fetch_assoc()){
            echo "id: " . $row["id"]. " - Username: " . $row["username"]. " " ."<br>";
         }
      }
   }

   
}