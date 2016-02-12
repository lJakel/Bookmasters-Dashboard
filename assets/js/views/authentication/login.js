var login = function (Dependencies) {
   var self = this;

   self.Model = {
      Username: "",
      Password: "",
   };

   self.login = function (redirect) {

      Dependencies.$timeout(function () {
      }).then(function () {
         Dependencies.AuthFactory.login(self.Model, function (res) {

            Dependencies.toasty.success({
               title: 'Authentication Successful!',
               msg: 'Welcome!',
               theme: 'bootstrap',
               timeout: 5000,
            });
            Dependencies.$timeout(function () {
               if (Dependencies.$rootScope.redirectToStateAfterLogin) {
                  var previousState = JSON.parse(Dependencies.$rootScope.redirectToStateAfterLogin);
               }
               if (!$.isEmptyObject(previousState)) {
                  Dependencies.$state.go('bm.app.page', previousState);
               } else {
                  Dependencies.$state.go('bm.app.page', {folder: 'Dashboard', app: 'Main', page: 'Index', child: null});
               }
            }, 2000);

         }, function (err) {
            $.each(err.errors, function (k, v) {
               Dependencies.toasty.error({
                  title: 'Authentication Error',
                  msg: v.message,
                  theme: 'bootstrap',
                  timeout: 8000,
               });
            });
         });
      });

   };
};
var register = function (Dependencies) {
   var self = this;
   self.Model = {
      Email: "",
      EmailVerify: "",
      Regkey: "",
      Username: "",
      Password: "",
      PasswordVerify: ""
   };


   self.register = function () {
      console.log('lol');
      Dependencies.AuthFactory.register(self.Model, function (successResponse) {
         Dependencies.toasty.success({
            title: 'Registration Successful!',
            msg: successResponse.response,
            theme: 'bootstrap',
            timeout: 5000,
         });
         Dependencies.$timeout(function () {
            Dependencies.$state.go('login');
         });
      }, function (err) {
         $.each(err.errors, function (k, v) {
            Dependencies.toasty.error({
               title: 'Registration Error',
               msg: v.message,
               theme: 'bootstrap',
               timeout: 8000,
            });
         });
      });
   };
};
var forgot = function (Dependencies) {
   var self = this;
   self.regkey = '';
   self.username = '';
   self.password = '';
   self.email = '';


   self.forgot = function () {

      Dependencies.AuthFactory.forgot({
         email: self.email,
         username: self.username,
      }, function (successResponse) {


         Dependencies.toasty.success({
            title: 'Registration Successful!',
            msg: successResponse.response,
            theme: 'bootstrap',
            timeout: 5000,
         });
         $('#authmodal a[data-target="#login"]').tab('show');

      }, function (err) {
         $.each(err.errors, function (k, v) {
            Dependencies.toasty.error({
               title: 'Registration Error',
               msg: v.message,
               theme: 'bootstrap',
               timeout: 8000,
            });
         });
      });
   };
};
BMApp.register.controller('AuthCtrl', ['$scope', 'AuthFactory', '$state', '$timeout', '$q', 'toasty', '$rootScope', function ($scope, AuthFactory, $state, $timeout, $q, toasty, $rootScope) {
      var vm = this;


      vm.Dependencies = {
         $scope: $scope,
         AuthFactory: AuthFactory,
         $state: $state,
         $timeout: $timeout,
         $q: $q,
         toasty: toasty,
         $rootScope: $rootScope
      };


      vm.loginCtrl = new login(vm.Dependencies);
      vm.registerCtrl = new register(vm.Dependencies);
      vm.forgotCtrl = new forgot(vm.Dependencies);
   }
]);