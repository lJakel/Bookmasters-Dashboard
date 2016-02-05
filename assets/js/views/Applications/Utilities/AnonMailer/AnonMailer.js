BMApp.register.controller('AnonMailerController', ['$http', 'toasty', function ($http, toasty) {
      var vm = this;

      vm.data = {
         to: '',
         subject: '',
         message: '',
      }

      vm.send = function () {
         $http.post('./Utilities/AnonMailer/Send', vm.data).then(function () {
            toasty.success({title: 'Success!', msg: 'Mail sent!', theme: 'bootstrap', timeout: 8000});
         }, function () {
            toasty.error({title: 'Error!', msg: 'Mail not sent.', theme: 'bootstrap', timeout: 8000});
         });
      }
   }]);