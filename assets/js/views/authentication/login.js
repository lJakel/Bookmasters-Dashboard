var login = function (Dependencies) {
   var self = this;
   self.username = '';
   self.password = '';

   self.login = function (redirect) {

      Dependencies.$timeout(function () {
      }).then(function () {
         Dependencies.AuthFactory.login({username: self.username, password: self.password}, function (res) {

            Dependencies.toasty.success({
               title: 'Authentication Successful!',
               msg: 'Welcome Jake!',
               theme: 'bootstrap',
               timeout: 5000,
            });
            Dependencies.$timeout(function () {
               Dependencies.$state.go('bm.app.page', {app: 'main', page: 'index', child: null});
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
   self.regkey = '';
   self.username = '';
   self.password = '';
   self.email = '';


   self.register = function () {

      Dependencies.AuthFactory.register({
         email: self.email,
         regkey: self.regkey,
         username: self.username,
         password: self.password
      }, function (successResponse) {


         Dependencies.toasty.success({
            title: 'Registration Successful!',
            msg: successResponse.response,
            theme: 'bootstrap',
            timeout: 5000,
         });
         $('#authmodal a[data-target="#login"]').tab('show');
         Dependencies.vm.loginCtrl.username = self.username;

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
BMApp.register.controller('LoginCtrl', ['$scope', 'AuthFactory', '$state', '$timeout', '$q', 'toasty', function ($scope, AuthFactory, $state, $timeout, $q, toasty) {
      var vm = this;
      vm.error = undefined;
      vm.success = undefined;

      vm.Dependencies = {
         $scope: $scope,
         AuthFactory: AuthFactory,
         $state: $state,
         $timeout: $timeout,
         $q: $q,
         toasty: toasty
      };

      vm.loginCtrl = new login(vm.Dependencies);
      vm.registerCtrl = new register(vm.Dependencies);
   }
]);