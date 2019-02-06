var base_url = window.location.protocol + "//" + window.location.hostname + "/exam/byjus/";

app.directive('ngConfirmClick', [
    function () {
        return {
            link: function (scope, element, attr) {
                var msg = attr.ngConfirmClick || "Are you sure?";
                var clickAction = attr.confirmedClick;
                element.bind('click', function (event) {
                    if (window.confirm(msg)) {
                        scope.$eval(clickAction)
                    }
                });
            }
        };
    }
]);

app.controller('taxationCntrl', function ($scope, $http, $timeout, $log) {
    $scope.search = {};
    $scope.getUserData = function (page, size) {

        return $http({
            method: "POST",
            url: base_url + "public/byjus/ecryptedData",
            data: {'page': page, 'size': size, 'search': $scope.search},
        }).then(function successCallback(response) {
            //success code
            if (response.data.status.type == 'Success') {
                $scope.count = response.data.status.count;
                $scope.taxation = response.data.response;
            }
            else if (response.data.status.type == 'Error') {
                // return response;
                // console.log(response);
            }
            $(".load-par").hide();
        }, function errorCallback(response) {
            console.log(response);
        });
    }
    $scope.getUserData();

    $scope.insert = {};
    $scope.addUser = function () {
        $http({
            method: "POST",
            url: base_url + "public/byjus/addUser",
            data: $scope.insert,
        }).then(function successCallback(response) {
            //success code
            if (response.data.status.type == 'Success') {
                $scope.errorUserName = null;
                $scope.errorEmail = null;
                $scope.errorMobile = null;
                $scope.successInsert = response.data.status.message;
                $timeout(function () {
                    $scope.successInsert = false;
                }, 2000);
                $scope.getUserData();
            }
            else if (response.data.status.type == 'Error') {
                $scope.errorUserName = response.data.response.userName;
                $scope.errorEmail = response.data.response.email;
                $scope.errorMobile = response.data.response.mobile;
                $scope.successInsert = null;
            }
        }, function errorCallback(response) {
            console.log(response);
        });
    }
});