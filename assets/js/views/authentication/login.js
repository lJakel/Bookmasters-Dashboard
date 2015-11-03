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

                 parent.vm.success = res.message.success;
                 parent.vm.error = undefined;
                 parent.$timeout(function () {
                    parent.$state.go('bm.app.page', {app: 'main', page: 'index', child: null});
                 }, 2000);
              },
              function (err) { //error
                 parent.vm.success = undefined;
                 parent.vm.error = err.message.error;
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
         parent.vm.error = undefined;
         parent.vm.success = successResponse.message.success;
         $('#authmodal a[data-target="#login"]').tab('show');
         parent.vm.loginCtrl.username = self.username;
      }, function (errorResponse) {
         parent.vm.success = undefined;
         parent.vm.error = errorResponse.message.error;
      });
   };
};
BMApp.register.controller('LoginCtrl', ['$scope', 'AuthFactory', '$state', '$timeout', function ($scope, AuthFactory, $state, $timeout) {
      var vm = this;
      vm.loginCtrl = new login({
         AuthFactory: AuthFactory,
         $timeout: $timeout,
         vm: vm,
         $state: $state
      });
      vm.registerCtrl = new register({
         AuthFactory: AuthFactory,
         vm: vm
      });
      vm.error = undefined;
      vm.success = undefined;
   }
]);