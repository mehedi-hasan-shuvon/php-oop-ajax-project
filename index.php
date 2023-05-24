<?php
    include "app/models/database.php";
    $obj=new Database();
  

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=
    , initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">


    <!-- adding bootstarp  -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>






    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script >
        $(document).ready(function() {
            fetchData();
        });
    </script>
</head>
<body>
    <div class="container my-3">
        <h1>AJAX-OOP-PHP Project</h1>
        <input type="text" id="sname" placeholder="enter name"><br>
        <input type="number" id="sage" placeholder="enter age"><br>
       
        <select name="scity" id="scity">
                <!-- <option value="">Select City</option> -->
                <?php
                    $obj->select('citytb','*');
                    $result=$obj->getResult();
                    foreach ($result as list("cid"=>$cid,"cname"=>$name)) {
                        echo "<option value='".$cid."'>".$name."</option>";
                    }
                ?>
        </select>
        <br>
        <button class="btn btn-primary">Add</button>


      

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
            </tbody> 
            </table>


        </div>
    


    </div>



<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="app/routes/ajax.js"></script>

</body>
</html>