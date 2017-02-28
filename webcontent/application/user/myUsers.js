angular.module('myApp', []).controller
('userCtrl',['$scope','$http', function($scope,$http)
{
    $scope.edit = true;
    $scope.error = false;
    $scope.incomplete = false;
    $scope.form={
        name:'',
        pwd:'',
        count:1,
        errormessage:''
    }


    $scope.$watch('form.pwd',function() {
        //$scope.form.count++;
        $scope.test();
    },true);
    $scope.$watch('form.name',function() {
        //$scope.form.count++;
        $scope.test();
    },true);

    $scope.test = function() {
        //console.log("$scope.form.pwd.length="+$scope.form.pwd.length);
        //console.log("$scope.form.name="+$scope.form.name);
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
            headers:{ 'Content-Type': 'application/x-www-form-urlencoded' },
            data: $scope.form,
            transformRequest: function(obj) {
                var str = [];
                for (var p in obj) {
                    str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
                }
                return str.join("&");
            }

        }).
        success(function(data, status) {
            //$scope.status = status;
            //$scope.users = data;
            $scope.form.errormessage=data['message'];
            if(data['errorcode']=="0000")
            {
                $scope.getUserById(data['userid']);
            }else{

            }

            //$scope.users.push({USER_NAME:$scope.form.name,USER_PWD:$scope.form.pwd});

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
            $scope.form.name = '';
            $scope.form.email = '';
            $scope.form.pwd = '';
        } else {
            $scope.edit = false;
            $scope.form.name = $scope.users[id-1].USER_NAME;
            $scope.form.email = $scope.users[id-1].USER_NAME;
            $scope.form.pwd = $scope.users[id-1].USER_PWD;
        }

        //$scope.apply();
    };



    $scope.getUserById = function(id) {

        $http({
            method: "POST",
            url: "http://localhost:8089/skytalk/user/login/getuserbyid?userid="+id

        }).
        success(function(data, status) {
            //$scope.status = status;
            $scope.users.push(data[0]) ;
        }).
        error(function(data, status) {
            //$scope.data = data || "Request failed";
            //$scope.status = status;
        });


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