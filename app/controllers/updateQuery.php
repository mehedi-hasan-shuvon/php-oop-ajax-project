<?php
    include '../models/database.php';
    $obj=new Database();

    $requestData = json_decode(file_get_contents('php://input'), true);
    $userId = $requestData['id'];
    $sname = $requestData['name'];
    $sage = $requestData['age'];
    $scity = $requestData['city'];


    
    $where="id=".$userId;
    

    $value= [
        'student_name'=>$sname,
        'age'=>$sage,
        'city'=>$scity
    ];


    $obj->update('students',$value,$where);
    $result=$obj->getResult();





?>