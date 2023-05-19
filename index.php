<?php
    include "app/models/database.php";
    $obj=new Database();
  

?>

<!DOCTYPE html>
<html>
<head>
  <title>AngularJS with PHP</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
  
<link rel="stylesheet" href="styles/style.css">

<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
<script src="myScript.js"></script>

</head>
<body ng-app="myApp" ng-controller="myCtrl">

  
    <!-- Your AngularJS code and HTML here -->
    <div class="container my-3">
        <h1>ANGULAR-PHP-OOP Project</h1>

        <form>
            <input type="text" id="sname" ng-model="studentName" placeholder="enter name"><br>
            <input type="number" id="sage" ng-model="age" placeholder="enter age"><br>
            <select name="scity" id="scity" ng-model="cityId" >
                    <option value="">Select City</option>
                    <?php
                        $obj->select('citytb','*');
                        $result=$obj->getResult();
                        foreach ($result as list("cid"=>$cid,"cname"=>$name)) {
                            echo "<option value='".$cid."'>".$name."</option>";
                        }
                    ?>
            </select>
            <br>
            <button class="btn btn-outline-dark" ng-click="addNewStudent()">Submit</button>
        </form>
        
        <div id="show" class="pb-3" >
                <table id="myTable" >
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Age</th>
                        <th>City</th>
                        <th>Update</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody id="tbody">
                <tr ng-repeat="x in tableData">
                    <td>{{ x.id }}</td>
                    <td>{{ x.student_name }}</td>
                    <td>{{ x.age }}</td>
                    <td>{{ x.cname }}</td>
                    <td><button type="button" class="btn btn-outline-dark"  ng-click="updateNavigation(x.id)">Update</button></td>
                    <td>
                        
                        <button type="button" ng-click="deleteModalOpen(x.id)" type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#exampleModal">  Delete
                                </button>
                </td>
                </tr>
                </tbody> 
                </table>


            </div>

        <div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
            <div class="modal-dialog modal-lg" >
                <div class="modal-content" >
                    <div class="modal-header">
                    
                        <button type="button" class="btn-close" data-bs-dismiss="modal" ng-click="cancleDelete()" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <h4>Are you sure you want to delete?</h4>
                    </div>
                        <div class="modal-footer">
                        <button type="button"  class="btn btn-outline-dark" ng-click="confirmDelete()" data-bs-dismiss="modal">Delete</button>
                            <button type="button" class="btn btn-outline-dark" ng-click="cancleDelete()" data-bs-dismiss="modal">Cancel</button>
                        </div>  
                </div>
            </div>
        </div>
    </div>



  <?php
  // Your PHP code here
  ?>

</body>
</html>