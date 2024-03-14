
<?php

header('Content-type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Accept');


require_once 'config.php';

class AddUser
{
    
    public function insert($fname, $lname, $email, $phone)
    {
        $con=new config();
        $sql = 'INSERT INTO users(first_name, last_name, email, phone) 
                VALUES (:fname, :lname, :email, :phone)';
        $stmt = $con->connexion()->prepare($sql);
        $stmt->execute([
            ':fname' => $fname,
            ':lname' => $lname,
            ':email' => $email,
            ':phone' => $phone
        ]);
        return true;
    }
}
/*
$db = new AddUser();

// Handle Add New User Ajax request
$fname = $_POST['firstName'];
$lname = $_POST['lastName'];
$email = $_POST['email'];
$phone = $_POST['phone'];

if ($db->insert($fname, $lname, $email, $phone)) {
    echo json_encode([
        'success' => true,
        'code' => 200,
    ]);   
} else {
    echo json_encode([
        'success' => false,
        'code' => 500,
    ]);   }
*/