<?php 
    include 'database.php';
    $obj=new Database();
    $join= "citytb ON students.city=citytb.cid";
    $colName='students.id,students.student_name,students.age,citytb.cname';

    $limit=null;
    $obj->select('students','*',$join,null,'id',$limit);
    $result=$obj->getResult();
    //convert to json
    $result=json_encode($result);
    echo $result;
?>