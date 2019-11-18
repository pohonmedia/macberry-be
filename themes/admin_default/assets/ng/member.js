// app.js
//var base_url = '/webbinary/member/';
// create the module and name it bbmApp
var bbmMember = angular.module('bbmMember', ['ngRoute']);
// configure our routes
bbmMember.config(["$routeProvider", "$locationProvider", function ($routeProvider, $locationProvider) {
        $locationProvider.html5Mode(false);
        $routeProvider
                .when('/', {
                    templateUrl: 'init',
                    controller: 'mainController'
                })

//                PROFILE MENU
                .when('/profile', {
                    templateUrl: 'profile',
                    controller: 'mainController'
                })

                .when('/password', {
                    templateUrl: 'password_init',
                    controller: 'mainController'
                })

                .when('/download', {
                    templateUrl: 'download',
                    controller: 'mainController'
                })

                .when('/edit', {
                    templateUrl: 'edit',
                    controller: 'mainController'
                })

//                BINARY MENU
                .when('/binary/usaha', {
                    templateUrl: 'binary/usaha',
                    controller: 'mainController'
                })

                .when('/binary/downline', {
                    templateUrl: 'binary/downline',
                    controller: 'mainController'
                })

                .when('/binary/tree', {
                    templateUrl: 'binary/tree',
                    controller: 'mainController'
                })

                .when('/binary/add', {
                    templateUrl: 'binary/add_init',
                    controller: 'mainController'
                })

//                BINARY MENU
                .when('/account/balance', {
                    templateUrl: 'account/balance',
                    controller: 'mainController'
                })
                .when('/account/balance/add', {
                    templateUrl: 'account/balance_add_init',
                    controller: 'mainController'
                })

                .when('/account/fund', {
                    templateUrl: 'account/fund',
                    controller: 'mainController'
                })
				.when('/account/fund/add', {
                    templateUrl: 'account/fund_add_init',
                    controller: 'mainController'
                })

                .when('/account/withdrawal', {
                    templateUrl: 'account/withdrawal',
                    controller: 'mainController'
                })

                .when('/account/bank', {
                    templateUrl: 'account/bank',
                    controller: 'mainController'
                })
				.when('/account/bank/add', {
                    templateUrl: 'account/bank_add_init',
                    controller: 'mainController'
                })
                //OTHER
                .when('/no_layout', {
                    templateUrl: 'no_layout',
                    controller: 'mainController'
                })

                .otherwise({
                    redirectTo: "/"
                });
        // route for the contact page
//            .when('/contact', {
//                templateUrl: 'pages/contact.html',
//                controller: 'mainController'
//            });
    }]);

// create the controller and inject Angular's $scope
bbmMember.controller('mainController', function ($scope, $http, $location) {
    $scope.formMember = {};
    $scope.formPassword = {};
    $scope.msg;

    //BINARY MEMBERS ADD FORM
    $scope.processMemberForm = function () {
        $http({
            method: 'POST',
            url: 'binary/add',
            data: $.param($scope.formMember), // pass in data as strings
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}  // set the headers so angular passing info as form data (not request payload)
        }).
        success(function (data) {
            if (!data.success) {
                // if not successful, bind errors to error variables
                $scope.msg = data.msg;
                $scope.errorFirstName = data.errors.first_name;
                $scope.errorIdentity = data.errors.identity;
                $scope.errorEmail = data.errors.email;
                $scope.errorIdNo = data.errors.card_id;
                $scope.errorTelp = data.errors.phone;
            } else {
                // if successful, bind success message to message
                $location.path("binary/downline");
            }
        });
    };
    
    //BINARY MEMBERS CHANGE PASSWORD
    $scope.processPasswordForm = function (form) {
        $http({
            method: 'POST',
            url: 'password',
            data: $.param($scope.formPassword), // pass in data as strings
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}  // set the headers so angular passing info as form data (not request payload)
        }).
        success(function (data) {
            if (!data.success) {
                // if not successful, bind errors to error variables
                $scope.msg = data.msg;
                $scope.msgType = data.msgType;
                $scope.errorPassword = data.errors.password;
                $scope.errorPasswordConfirm = data.errors.password_confirm;
            } else {
                // if successful, bind success message to message
                $scope.msg = data.msg;
                $scope.msgType = data.msgType;
                $scope.formPassword = {};
            }
        });
    };
});

//bbmMember.controller('profileController', function ($scope) {
//    // create a message to display in our view
////    $scope.message = 'Look! This is My Profile.';
//});