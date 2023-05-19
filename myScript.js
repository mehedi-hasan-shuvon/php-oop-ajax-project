let app = angular.module("myApp", []);

app.controller("myCtrl", ($scope, $http) => {
  $scope.title = "Stay Home Stay Safe";
  $scope.studentName = "";
  $scope.age = "";

  var url = window.location.href;
  var baseUrl = url.split("app")[0];
  $scope.inHome = false;
  if (url === baseUrl) {
    $http.get("app/controllers/fetch.php").then(
      (response) => {
        $scope.tableData = response.data;
      },
      (error) => {
        console.log(error);
      }
    );
  }

  //calling api

  $scope.deleteingId = "";

  //open delete moddal and set id
  $scope.deleteModalOpen = (userId) => {
    $scope.deleteingId = userId;
  };

  //cancel delete
  $scope.cancleDelete = () => {
    $scope.deleteingId = "";
  };

  $scope.reFetch = () => {
    $http.get("app/controllers/fetch.php").then(
      (response) => {
        $scope.tableData = response.data;
      },
      (error) => {
        console.log(error);
      }
    );
  };

  //confirm delete
  $scope.confirmDelete = () => {
    if ($scope.deleteingId !== "") {
      $scope.deleteingId = parseInt($scope.deleteingId);
      var data = {
        id: $scope.deleteingId,
      };

      $http.post("app/controllers/delete.php", data).then(
        (response) => {
          $scope.deleteingId = "";
          $scope.reFetch();
        },
        (error) => {
          console.log(error);
        }
      );
    } else {
      alert("Please select a user to delete");
    }
  };

  //add new student
  $scope.addNewStudent = () => {
    console.log($scope.studentName, $scope.age, $scope.cityId);
    if (
      $scope.studentName !== "" &&
      $scope.age !== "" &&
      typeof $scope.cityId !== "undefined"
    ) {
      console.log("ok");
      var data = {
        name: $scope.studentName,
        age: $scope.age,
        city: $scope.cityId,
      };

      $http.post("app/controllers/insert.php", data).then(
        (response) => {
          $scope.studentName = "";
          $scope.age = "";
          $scope.reFetch();
        },
        (error) => {
          console.log(error);
        }
      );
    } else {
      console.log("not ok");
      alert("Please fill all the fields");
    }
  };

  //updateNavigation
  $scope.updateNavigation = (userId) => {
    window.location.href = "app/views/update.php?id=" + userId;
  };

  //backToHome
  $scope.backToHome = () => {
    var url = window.location.href;
    var baseUrl = url.split("app")[0];

    window.location.href = baseUrl;
  };

  //UPDATE_DATA
  $scope.UPDATE_DATA = (userId) => {
    var data = {
      name: $scope.updatedName,
      age: $scope.updatedAge,
      city: $scope.updatedCityId,
      id: userId,
    };

    if (
      $scope.updatedName === "" ||
      $scope.updatedAge === "" ||
      typeof $scope.updatedCityId === "undefined"
    ) {
      alert("Please fill all the fields");
      return;
    }

    //get the base url
    var url = window.location.href;
    var baseUrl = url.split("app")[0];
    // make the url
    var newUrl = baseUrl + "app/controllers/updateQuery.php";

    $http.post(newUrl, data).then(
      (response) => {
        $scope.backToHome();
      },
      (error) => {
        console.log(error);
      }
    );
  };
});
