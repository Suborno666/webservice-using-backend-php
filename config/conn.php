<?php
namespace Config;

require_once __DIR__ . '/../vendor/autoload.php';
use Dotenv\Dotenv as Envloader;

class Connection {
    private $host;
    private $user;
    private $password;
    public $conn;

    public function __construct() {
        $dotenv = Envloader::createImmutable(__DIR__.'/..');
        $dotenv->load();    
        $this->host = $_ENV['DB_HOST'];
        $this->user = $_ENV['DB_USER'];
        $this->password = $_ENV['DB_PASS'];
        $this->conn = mysqli_connect($this->host, $this->user, $this->password);
        
        if (!$this->conn) {
            echo json_encode(['error'=>'Connection failed: '. mysqli_connect_error()]);
        }
    }
}