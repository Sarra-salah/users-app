<?php
require_once "config.php";

class updateUser{

    public function update($id,$fname,$lname,$email,$phone){
        $conn=new config();
        $sql="UPDATE  users SET first_name=:fname,last_name=:lname,email=:email,phone=:phone WHERE id=:id  ";
        $stmt=$conn->connexion()->prepare($sql);
        $stmt->execute([
            'fname'=>$fname,
            'lname'=>$lname,
            'email'=>$email,
            'phone'=>$phone,
            'id'=>$id
        ]);
        return true;
    }
}




?>