angular.module('myApp', []).controller
('userCtrl',['$scope','$http', function($scope,$http)
{
    $scope.edit = true;
    $scope.error = false;
    $scope.incomplete = false;
    $scope.form={
        name:'',
        pwd:'',
        count:1
    }


    $scope.$watch('form.pwd',function() {
        $scope.form.count++;
        $scope.test();
    },true);
    $scope.$watch('form.name',function() {
        $scope.form.count++;
        $scope.test();
    },true);

    $scope.test = function() {
        console.log("$scope.form.pwd.length="+$scope.form.pwd.length);
        console.log("$scope.form.name="+$scope.form.name);
        if ($scope.form.pwd.length<8 || $scope.form.pwd.length>56) {
            $scope.error =true;
        } else {
            $scope.error =  false;
        }

        $scope.incomplete = false;
        if ($scope.edit && (!$scope.form.name.length ||
            !$scope.form.pwd.length)) {
            $scope.incomplete = true;
        }
    };

    $scope.registerUser=function(){
        $scope.test();
        if($scope.error==true){
            console.log('用户名或者密码格式不正确');
            return false;
        }
        $http({
            method: "POST",
            url: "http://localhost:8089/skytalk/user/login/register",
            data:{
                'name':$scope.form.name,
                'pwd':$scope.form.pwd,
                'email':$scope.form.email
            },
            postCfg:{
                headers:{ 'Content-Type': 'application/x-www-form-urlencoded' },
                transformRequest: function (data) {
                    return $.param(data);
                }
            }
        }).
        success(function(data, status) {
            //$scope.status = status;
            $scope.users = data;
            console.log(data);
        }).
        error(function(data, status) {
            //$scope.data = data || "Request failed";
            //$scope.status = status;
            console.log(data);
        });

    };

    $scope.editUser = function(id) {

        if (id == 'new') {
            console.log(id);
            $scope.edit = true;
            $scope.incomplete = false;
            $scope.name = '';
            $scope.email = '';
            $scope.pwd = '';
        } else {
            $scope.edit = false;
            $scope.name = $scope.users[id-1].USER_NAME;
            $scope.email = $scope.users[id-1].USER_NAME;
            $scope.pwd = $scope.users[id-1].USER_PWD;
        }

        //$scope.apply();
    };



    $http({
        method: "POST",
        url: "http://localhost:8089/skytalk/user/login/getalluser",
        data:{
        }
    }).
    success(function(data, status) {
        //$scope.status = status;
        $scope.users = data;
    }).
    error(function(data, status) {
        //$scope.data = data || "Request failed";
        //$scope.status = status;
    });


}]);