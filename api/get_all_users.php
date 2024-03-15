<?php 

header('Content-type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Accept');


require_once 'config.php';

class User {
  
    // Fetch all data from the database
   /* public function getAll() {
        $con = new Config();
        $sql = 'SELECT * FROM users ORDER BY id DESC';
        $stmt = $con->connexion()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
       return $result;
    }*/     function getAll($page, $limit) {
    $con = new Config();
    
    // Calculate the offset
    $offset = ($page > 1) ? ($page - 1) * $limit : 0;
    
    // Query to get total count
    $sqlTotal = "SELECT COUNT(*) as total FROM users";
    $stmtTotal = $con->connexion()->query($sqlTotal);
    $total = $stmtTotal->fetch(PDO::FETCH_ASSOC)['total'];

    // Query to get users for the specified page and limit
    $sql = "SELECT * FROM users ORDER BY id ASC LIMIT :limit OFFSET :offset";
    $stmt = $con->connexion()->prepare($sql);
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetchAll();

    return ['total' => $total, 'data' => $result];
}

    public function delete($id){
        $con= new config();
        $sql="DELETE From users where id = :id";
        $stmt = $con->connexion()->prepare($sql);
        $stmt->execute(['id'=>$id]);
        return true;
    }

}


