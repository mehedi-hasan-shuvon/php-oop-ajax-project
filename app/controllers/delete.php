<?php 
     include '../models/database.php';
     $obj=new Database();

    $requestData = json_decode(file_get_contents('php://input'), true);
    $userId = $requestData['id'];
    //  $userId=$_POST['id'];

    echo($userId);
     $where="id=".$userId;

    $obj->delete('students',$where);   
    $result=$obj->getResult();

?>