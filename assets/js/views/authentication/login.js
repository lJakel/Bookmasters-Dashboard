var login = function (parent) {
   var self = this;
   self.username = '';
   self.password = '';
   self.login = function (redirect) {
      parent.AuthFactory.login({
         username: self.username,
         password: self.password
      }, undefined, //redirect url
              function (res) { //success
                 parent.vm.handleAlert(1, res.message.success);
                 parent.$timeout(function () {
                    parent.$state.go('bm.app.page', {app: 'main', page: 'index', child: null});
                 }, 2000);
              },
              function (err) { //error
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
   self.register = function () {
      parent.AuthFactory.register({
         email: self.email,
         regkey: self.regkey,
         username: self.username,
         password: self.password
      }, function (successResponse) {

         parent.vm.handleAlert(1, successResponse.message.success);
         $('#authmodal a[data-target="#login"]').tab('show');
         parent.vm.loginCtrl.username = self.username;

      }, function (errorResponse) {
         parent.vm.handleAlert(0, errorResponse.message.error);

      });
   };
};
BMApp.register.controller('LoginCtrl', ['$scope', 'AuthFactory', '$state', '$timeout', function ($scope, AuthFactory, $state, $timeout) {
      var vm = this;
      vm.error = undefined;
      vm.success = undefined;

      vm.loginCtrl = new login({
         AuthFactory: AuthFactory,
         $timeout: $timeout,
         vm: vm,
         $state: $state
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
                  alertSuccess.css('display', 'block');
                  $timeout(function () {
                     vm.error = undefined;
                     vm.success = undefined;
                  }, 0);
               });
            }, 4000);
         } else {
            vm.success = undefined;
            vm.error = message;
            $timeout(function () {
               alertError.fadeOut('slow', function () {
                  alertError.css('display', 'block');
                  $timeout(function () {
                     vm.error = undefined;
                     vm.success = undefined;
                  }, 0);
               });
            }, 4000);
         }
      }
   }
]);