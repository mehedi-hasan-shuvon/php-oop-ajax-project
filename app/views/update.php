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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>


    <link rel="stylesheet" href="../../styles/style.css">
    <title>Update Page</title>

    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
    <script src="../../myScript.js"></script>
    
</head>
<body ng-app="myApp" ng-controller="myCtrl">
    <div class="container mt-3"
   
     >
        <h1>Update Page</h1>
        <form ng-init="updatedName='<?php echo $name ?>'; updatedAge='<?php echo $age ?>'; updatedCityId='<?php echo $city ?>'">
            <input type="text" id="sname"  ng-model="updatedName" placeholder="enter name">
            <input type="text" id="sage" ng-model="updatedAge" placeholder="enter age">
            <select name="scity" id="scity" ng-model="updatedCityId">
                    <?php
                        $obj->select('citytb','*');
                        $result=$obj->getResult();
                        foreach ($result as list("cid"=>$cid,"cname"=>$name)) {
                            echo "<option value='".$cid."'>".$name."</option>";
                        }
                    ?>
            </select>
            <br>
            <button class="btn btn-outline-dark" ng-click="UPDATE_DATA(<?php echo $id ?>)">Update</button>
            <button class="btn btn-outline-dark" ng-click="backToHome()">Home</button>
        </form>
    </div>

    <script>
    var selectElement = document.getElementById("scity");
    var javascriptVariable = "<?php echo $city ?>";
   
    selectElement.selectedIndex = javascriptVariable-1; 
    </script>
</body>
</html>


