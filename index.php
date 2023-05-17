<?php
    include "database.php";
    $obj=new Database();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=
    , initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            fetchData();
        });
    </script>
</head>
<body>
    <div class="container">
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
        <button class="btn">Submit</button>


      

        <div id="show">
            <table id="myTable">
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


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<script src="ajax.js"></script>

</body>
</html>