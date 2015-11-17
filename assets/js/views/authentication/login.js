var login = function (parent) {
   var self = this;
   self.username = '';
   self.password = '';
   self.authenticating = false;

   self.login = function (redirect) {
      self.authenticating = true;

      parent.AuthFactory.login({username: self.username, password: self.password}, function (res) {
         self.authenticating = false;

         parent.vm.handleAlert(1, res.message.success);
         parent.$timeout(function () {
            parent.$state.go('bm.app.page', {app: 'main', page: 'index', child: null});
         }, 2000);
      }, function (err) {
         self.authenticating = false;

         parent.vm.handleAlert(0, err.message.error);
      });
   };
};
var register = function (parent) {
   var self = this;
   self.regkey = '';
   self.username = '';
   self.password = '';
   self.email = '';
   self.authenticating = false;

   self.register = function () {
      self.authenticating = true;

      parent.AuthFactory.register({
         email: self.email,
         regkey: self.regkey,
         username: self.username,
         password: self.password
      }, function (successResponse) {
   self.authenticating = false;

         parent.vm.handleAlert(1, successResponse.message.success);
         $('#authmodal a[data-target="#login"]').tab('show');
         parent.vm.loginCtrl.username = self.username;

      }, function (errorResponse) {
            self.authenticating = false;

         parent.vm.handleAlert(0, errorResponse.message.error);

      });
   };
};
BMApp.register.controller('LoginCtrl', ['$scope', 'AuthFactory', '$state', '$timeout', '$q', function ($scope, AuthFactory, $state, $timeout, $q) {
      var vm = this;
      vm.error = undefined;
      vm.success = undefined;

      vm.loginCtrl = new login({
         AuthFactory: AuthFactory,
         $timeout: $timeout,
         vm: vm,
         $scope: $scope,
         $state: $state,
         $q: $q,
      });
      vm.registerCtrl = new register({
         AuthFactory: AuthFactory,
         vm: vm,
         $timeout: $timeout,
      });

      vm.handleAlert = function (success, message) {

         var alertSuccess = $('.alert.alert-success');
         var alertError = $('.alert.alert-danger');



         if (success == 1) {
            vm.success = message;
            vm.error = undefined;
            $timeout(function () {
               alertSuccess.fadeOut('slow', function () {
                  $timeout(function () {
                     alertSuccess.css('display', 'block');
                     vm.error = undefined;
                     vm.success = undefined;
                  });
               });
            }, 4000);
         } else {
            vm.success = undefined;
            vm.error = message;

            $timeout(function () {
               alertError.fadeOut('slow', function () {
                  $timeout(function () {
                     alertError.css('display', 'block');
                     vm.error = undefined;
                     vm.success = undefined;
                  });
               });
            }, 4000);
         }


      }
   }
]);