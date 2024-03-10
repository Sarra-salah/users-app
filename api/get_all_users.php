<?php 

header('Content-type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Accept');


require_once 'config.php';

class getAllUsers {
    private $conn;

    public function __construct() {
        $this->conn =  pdo_connect_mysql();


    }

    // Fetch all data from the database
    public function read() {

        $sql = 'SELECT * FROM users ORDER BY id DESC';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
}

// Initialize the database object
$db = new getAllUsers();

// Handle fetch all users Ajax request

    $users = $db->read();

    if($users) {
        // Return data in JSON format
        header('Content-Type: application/json');
        echo json_encode([
            'success' => true,
            'code' => 200,
            'data' => $users,
        ]);
    } else {
        // Return empty array if no users found
        header('Content-Type: application/json');
        echo json_encode([
            'success' => true,
            'code' => 200,
            'data' => [],
        ]);    }
