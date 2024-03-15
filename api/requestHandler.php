<?php
require_once 'get_all_users.php';
require_once 'add_user.php';
require_once 'get_user_by_id.php';
require_once 'update_user.php';




if (isset($_GET['read'])) {
    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
    $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 10;

    $user = new User();
    $users = $user->getAll($page, $limit);

    // Send JSON response with fetched data
    if ($users) {
        echo json_encode(['success' => true, 'code' => 200, 'data' => $users]);
    } else {
        echo json_encode(['success' => false, 'code' => 404, 'message' => 'No users found']);
    }
}

/*if ( isset($_GET['read'])) {
   
    $getAllUsers = new User();
    $users = $getAllUsers->getAll();

    if ($users) {
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'code' => 200, 'data' => $users]);
    } else {
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'code' => 404, 'message' => 'No users found']);
    }
}*/
//handle delete user ajax request
if(isset($_GET['delete'])){
    $deleteUser = new User();
    $id = $_GET['id'];
    if($deleteUser->delete($id)){
        echo json_encode(['success' => true, 'code' => 200]);
    }else{
        echo json_encode(['success' => false, 'code' => 404, 'message' => 'No users found']);
    }
    
}

//Handle Add New User Ajax request 

if (isset($_POST['add'])){
    $addUser = new AddUser();
    $fname = $_POST['firstName'];
    $lname = $_POST['lastName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    if($addUser->insert($fname,$lname,$email,$phone)){
        echo json_encode([
            'success' => true,
            'code' => 200,
        ]);   
    } else {
        echo json_encode([
            'success' => false,
            'code' => 500,
        ]);
        }
}

//handle edit user ajax request
if(isset($_GET['readOne'])){
    $user=new getUserById();
    //echo json_encode(['message'=>'success']);
    $id = $_GET['id'];
    $user = $user->getOne($id);
    if($user){
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'code' => 200, 'data' => $user]);
    }else{
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'code' => 404, 'message' => 'No user found']);
    }
   
}
//handle update request
if(isset($_POST['update'])){
    $id = (($_POST['id']));
    $fname = (($_POST['fname']));
    $lname =(($_POST['lname']));
    $email =(($_POST['email']));
    $phone =(($_POST['phone']));
$updateUser= new updateUser();
    if($updateUser->update($id, $fname,$lname,$email,$phone)){
        echo json_encode([
            'success' => true,
            'code' => 200,
        ]);   
    } else {
        echo json_encode([
            'success' => false,
            'code' => 500,
        ]);
        }
}
?>