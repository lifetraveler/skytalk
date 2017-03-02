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
            $scope.form.pwd = '';
        } else {
            //console.log($scope.users);
            $scope.edit = false;
            $scope.form.name = $scope.users[(id%5?id%5:5)-1].USER_NAME;
            $scope.form.pwd = $scope.users[(id%5?id%5:5)-1].USER_PWD;
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
        //$scope.users = data;
        $scope.data = data;
        $scope.pageSize = 5;
        $scope.pages = Math.ceil($scope.data.length / $scope.pageSize); //分页数
        $scope.newPages = $scope.pages > 5 ? 5 : $scope.pages;
        $scope.pageList = [];
        $scope.selPage = 1;
        $scope.items = $scope.data.slice(0, $scope.pageSize);
        //分页要repeat的数组
        for (var i = 0; i < $scope.newPages; i++) {
            $scope.pageList.push(i + 1);
        }
        $scope.setData();


    }).
    error(function(data, status) {
        //$scope.data = data || "Request failed";
        //$scope.status = status;
    });

    //设置表格数据源(分页)
    $scope.setData = function () {
        $scope.users = $scope.data.slice(
            ($scope.pageSize * ($scope.selPage - 1)),
            ($scope.selPage * $scope.pageSize));//通过当前页数筛选出表格当前显示数据
    };

    //打印当前选中页索引
    $scope.selectPage = function (page) {
        //不能小于1大于最大
        if (page < 1 || page > $scope.pages) return;
        //最多显示分页数5
        if (page > 2) {
        //因为只显示5个页数，大于2页开始分页转换
            var newpageList = [];
            for (var i = (page - 3) ; i < ((page + 2) > $scope.pages ? $scope.pages : (page + 2)) ; i++) {
                newpageList.push(i + 1);
            }
            $scope.pageList = newpageList;
        }
        $scope.selPage = page;
        $scope.setData();
        $scope.isActivePage(page);
        console.log("选择：" + page);
    };



//设置当前选中页样式
    $scope.isActivePage = function (page) {
        return $scope.selPage == page;
    };


//上一页
    $scope.Previous = function () {
        $scope.selectPage($scope.selPage - 1);
    }
//下一页
    $scope.Next = function () {
        $scope.selectPage($scope.selPage + 1);
    };


}]);