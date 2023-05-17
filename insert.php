<?php 
     include 'database.php';
     $obj=new Database();
    
     $sname=$_POST['name'];
     $sage=$_POST['age'];
     $scity=$_POST['city'];

     //get the cname from citytb
        $where="cid=".$scity;
        $obj->select('citytb','cname',null,$where);
        $result2=$obj->getResult();
        $scityname=$result2[0]['cname'];

     $value= [
        'student_name'=>$sname,
        'age'=>$sage,
        'city'=>$scity
    ];

    if($obj->insert('students',$value)){
        $result=$obj->getResult();
    

        $resArray=[
            'id'=>$result[0],
            'name'=>$sname,
            'age'=>$sage,
            'city'=>$scityname,
        ];
       
        $result=json_encode($resArray);
        echo $result;
    }else{
        echo "Data Insertion Failed";
    }
     
?>

