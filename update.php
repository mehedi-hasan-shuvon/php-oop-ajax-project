<?php 
    include "database.php";
    $obj=new Database();
    echo $_GET['id'];
    $join= "citytb ON students.city=citytb.cid";
    $where="id=".$_GET['id'];
    $obj->select('students','*',$join,$where,null,null);
    $result=$obj->getResult();




    foreach ($result as list("id"=>$id,"student_name"=>$name,"age"=>$age,"city"=>$city, "cname"=>$cname)) {
        echo $id;
        echo $name;
        echo $age;
        echo $city;
        echo $cname;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Update Page</title>
    
</head>
<body>
    <div class="container">
        <h1>Edit Page</h1>
        <input type="text" id="sname" value="<?php echo $name ?>" placeholder="enter name"><br>
        <input type="number" id="sage" value="<?php echo $age ?>" placeholder="enter age"><br>
       
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
        <button class="btn" onclick="UPDATE_DATA(<?php echo $id ?>)">Update Data</button>
        <button class="btn" onclick="home()">Home</button>
    </div>

    <script>
    var selectElement = document.getElementById("scity");
    var javascriptVariable = "<?php echo $city ?>";
   
    selectElement.selectedIndex = javascriptVariable-1; 
    </script>
</body>
</html>