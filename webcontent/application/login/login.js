/**
 * Created by zhn on 2017/3/3.
 */

angular.module('st_myApp', []).controller
('st_userCtrl',['$scope','$http', function($scope,$http)
{
    //判断用户名是否存在，不存在的话弹出验证码验证，邮箱录入
    $scope.usercheck=function(){
        console.log($scope.form.user);
    };

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
    $scope.loginOrRegister=function(){
        //判断输入框是否合法
        $scope.test();
        if($scope.error==true){
            console.log('用户名或者密码格式不正确');
            return false;
        }
        //登陆判断
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
}]);