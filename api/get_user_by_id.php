<?php


require_once "config.php";

class getUserById{

public function getOne($id){
$con=new Config();
$sql="SELECT * from users where id=:id";
$stmt=$con->connexion()->prepare($sql);
$stmt->execute(['id'=>$id]);
$result=$stmt->fetch();
return $result;


}


}




?>