//insert section starts here
$(".btn").click(function () {
  var name = $("#sname").val();
  var age = $("#sage").val();
  var city = $("#scity").val();

  $.ajax({
    method: "POST",
    url: "insert.php",
    data: { name: name, age: age, city: city },
    success: function (data) {
      alert("Data Inserted Successfully");
      //decode json data
      var data1 = JSON.parse(data);

      homeTable(data1.id, data1.name, data1.age, data1.city);
    },
  });
});

function homeTable(id, name, age, city) {
  //make the id as string
  var id = id.toString();

  var name = name;
  var age = age;
  var city = city;
  $.ajax({
    url: "index.php",
    method: "POST",
    data: { id: id, name: name, age: age, city: city },
    success: function (data) {
      var tableData = getTableData();
      newTableObject = {
        id: id,
        student_name: name,
        age: age,
        city: city,
      };
      tableData.push(newTableObject);

      var html = generateHtmlTable(tableData);

      $("#show").html(html);
    },
  });
}

function getTableData() {
  var table = document.getElementById("myTable");
  var rows = table.getElementsByTagName("tr");

  var data = [];

  // Start from index 1 to skip the table header row
  for (var i = 1; i < rows.length; i++) {
    var row = rows[i];
    var cells = row.getElementsByTagName("td");

    var rowData = {
      id: cells[0].textContent,
      student_name: cells[1].textContent,
      age: cells[2].textContent,
      city: cells[3].textContent,
    };

    data.push(rowData);
  }

  // Do something with the table data
  return data;
}

function generateHtmlTable(data) {
  var table = document.getElementById("myTable");
  table.innerHTML = "";

  var row = document.createElement("tr");
  var cell1 = document.createElement("th");
  cell1.innerHTML = "Id";
  row.appendChild(cell1);

  var cell2 = document.createElement("th");
  cell2.innerHTML = "Name";
  row.appendChild(cell2);

  var cell3 = document.createElement("th");
  cell3.innerHTML = "Age";
  row.appendChild(cell3);

  var cell4 = document.createElement("th");
  cell4.innerHTML = "City";
  row.appendChild(cell4);

  var cell5 = document.createElement("th");
  cell5.innerHTML = "Update";
  row.appendChild(cell5);

  var cell6 = document.createElement("th");
  cell6.innerHTML = "Delete";
  row.appendChild(cell6);

  table.appendChild(row);

  for (var i = 0; i < data.length; i++) {
    var row = document.createElement("tr");
    var cell1 = document.createElement("td");
    cell1.innerHTML = data[i].id;
    row.appendChild(cell1);

    var cell2 = document.createElement("td");
    cell2.innerHTML = data[i].student_name;
    row.appendChild(cell2);

    var cell3 = document.createElement("td");
    cell3.innerHTML = data[i].age;
    row.appendChild(cell3);

    if (data[i].cname) {
      var cell4 = document.createElement("td");
      cell4.innerHTML = data[i].cname;
      row.appendChild(cell4);
    } else {
      var cell4 = document.createElement("td");
      cell4.innerHTML = data[i].city;
      row.appendChild(cell4);
    }

    var cell5 = document.createElement("td");
    cell5.innerHTML =
      '<button type="button" class="btn btn-primary custom-btn"  onclick="Update(' +
      data[i].id +
      ')">Update</button>';
    row.appendChild(cell5);

    var cell6 = document.createElement("td");
    cell6.innerHTML =
      "<button class='btn btn-danger' onclick='Delete(" +
      data[i].id +
      ")'>Delete</button>";
    row.appendChild(cell6);

    table.appendChild(row);
  }
}

function fetchData() {
  $.ajax({
    url: "fetch.php",
    method: "POST",
    success: function (data) {
      var data = JSON.parse(data);
      var html = generateHtmlTable(data);

      $("#show").html(html);
    },
  });
}

//delete section starts here
function Delete(userId) {
  $con = confirm("Are you sure you want to delete this data?");
  if ($con == true) {
    $.ajax({
      url: "delete.php",
      method: "POST",
      data: { id: userId },
      success: function (data) {
        alert("Data Deleted Successfully with id " + userId + "");
        fetchData();
      },
    });
  }
}
//delete section ends here

//update section starts here
function Update(userId) {
  var name = $("#sname").val();
  var age = $("#sage").val();
  var city = $("#scity").val();

  $.ajax({
    url: "update.php",
    method: "GET",
    data: { id: userId },
    success: function (data) {
      $("body").html(data);
    },
  });
}
//update section ends here

//update query section starts here
function UPDATE_DATA(userId) {
  var name = $("#sname").val();
  var age = $("#sage").val();
  var city = $("#scity").val();
  $.ajax({
    url: "updateQuery.php",
    method: "GET",
    data: { name: name, age: age, city: city, id: userId },
    success: function (data) {
      alert("Data Updated Successfully");

      home();
    },
  });
}
//update query section ends here

function home() {
  var read = "";
  $.ajax({
    url: "index.php",
    method: "POST",
    data: { read: read },
    success: function (data) {
      $("body").html(data);
    },
  });
}
