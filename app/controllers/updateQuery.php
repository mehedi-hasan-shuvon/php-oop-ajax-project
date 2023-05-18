<?php
    include '../models/database.php';
    $obj=new Database();


    $userId=$_GET['id'];
    $sname=$_GET['name'];
    $sage=$_GET['age'];
    $scity=$_GET['city'];
    
    $where="id=".$userId;
    

    $value= [
        'student_name'=>$sname,
        'age'=>$sage,
        'city'=>$scity
    ];


    $obj->update('students',$value,$where);
    $result=$obj->getResult();





?>