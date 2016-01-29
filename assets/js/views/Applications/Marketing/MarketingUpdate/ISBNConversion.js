BMApp.register.controller('UtilitiesISBNConversion', ['$http', '$scope', 'toasty', '$timeout', function ($http, $scope, toasty, $timeout) {
      var self = this;
      self.model = {
         input: '',
         output: '',
         isbns: []
      }
      self.Convert = function () {
         $http.post('API/ISBN/GetInfo', self.model).then(function (response) {
            self.model.output = '';
            $.each(response.data.data, function (k, item) {
               console.log(item);
               self.model.output += (item.isbn13 || "") + "\n";
            });
            self.model.isbns = response.data.data;
            
         }, function (response) {
            toasty.Warning({title: 'Warning!', msg: 'An error occured.', theme: 'bootstrap', timeout: 5000});
         });
      };

   }]);