<?php 
     include 'database.php';
     $obj=new Database();

     $userId=$_POST['id'];


     $where="id=".$userId;

    $obj->delete('students',$where);   
    $result=$obj->getResult();

?>