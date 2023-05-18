<?php 
    include "../models/database.php";
    $obj=new Database();

    $join= "citytb ON students.city=citytb.cid";
    $where="id=".$_GET['id'];
    $obj->select('students','*',$join,$where,null,null);
    $result=$obj->getResult();

    $id=$result[0]['id'];
    $name=$result[0]['student_name'];
    $age=$result[0]['age'];
    $city=$result[0]['city'];
    $cname=$result[0]['cname'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styles/style.css">
    <title>Update Page</title>
    
</head>
<body>
    <div class="container mt-3">
        <h1>Update Page</h1>
        <input type="text" id="sname" value="<?php echo $name ?>" placeholder="enter name">
        <input type="number" id="sage" value="<?php echo $age ?>" placeholder="enter age">
        <select name="scity" id="scity">
                <?php
                    $obj->select('citytb','*');
                    $result=$obj->getResult();
                    foreach ($result as list("cid"=>$cid,"cname"=>$name)) {
                        echo "<option value='".$cid."'>".$name."</option>";
                    }
                ?>
        </select>
        <br>
        <button class="btn btn-primary" onclick="UPDATE_DATA(<?php echo $id ?>)">Update Data</button>
        <button class="btn btn-warning" onclick="home()">Home</button>
    </div>

    <script>
    var selectElement = document.getElementById("scity");
    var javascriptVariable = "<?php echo $city ?>";
   
    selectElement.selectedIndex = javascriptVariable-1; 
    </script>
</body>
</html>